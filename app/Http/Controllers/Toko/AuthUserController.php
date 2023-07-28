<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailVerifyJob;
use App\Models\Credential;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthUserController extends Controller
{
    public function register()
    {
        return view('toko.pages.auth.register');
    }

    public function store_account(Request $request)
    {
        $validated = $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'tanggal' => 'required|numeric',
            'bulan' => 'required|numeric',
            'tahun' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'telp' => 'required|numeric',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        if ($validated['password'] != $validated['confirm_password']) {
            return redirect()->back()->withErrors('Password and Confirm Password must be equal');
        }
        $validated['password'] = Hash::make($validated['password']);

        try {
            DB::beginTransaction();
            $credential_id = Credential::create([
                'nama_depan' => $validated['nama_depan'],
                'nama_belakang' => $validated['nama_belakang'],
                'tanggal_lahir' => $validated['tahun'] . '-' . $validated['bulan'] . '-' . $validated['tanggal'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'telp' => '+62' . $validated['telp']
            ])->id;

            User::create([
                'email' => $validated['email'],
                'password' => $validated['password'],
                'credential_id' => $credential_id,
                'status' => 'active'
            ]);


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }


        return redirect('/')->with('status', 'anda berhasil registerasi, silahkan Login');
    }


    public function update_account(Request $request)
    {

        $user =  User::where('id', auth()->user()->id)->first();
        $rules = [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'tanggal' => 'required|numeric',
            'bulan' => 'required|numeric',
            'tahun' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'telp' => 'numeric',
        ];
        $validated = $request->validate($rules);
        if ($request->ganti_email) {
            $validated['email'] = $request->email;
        }
        if ($request->ganti_password) {
            if ($request->new_password != $request->confirm_password) {
                return redirect()->back()->withErrors('Password and Confirm Password must be equal');
            }
            $validated['password'] = Hash::make($request->new_password);
        }

        // cek katasandi lama
        if ($request->ganti_email !== null || $request->ganti_password !== null) {
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withErrors('old password must is correct');
            }
        }

        try {
            DB::beginTransaction();
            $user->update($validated);
            Credential::where('id', auth()->user()->id)->update([
                'nama_depan' => $validated['nama_depan'],
                'nama_belakang' => $validated['nama_belakang'],
                'tanggal_lahir' => $validated['tahun'] . '-' . $validated['bulan'] . '-' . $validated['tanggal'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'telp' =>  $validated['telp']
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
        return redirect()->back();
    }



    public function authenticate(Request $request)
    {
        $validated =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $validated['status'] = 'active';
        if (Auth::guard('web')->attempt($validated)) {

            // $request->session()->regenerate();
            // return redirect()->intended('/');
            return redirect('/');
        }
        return redirect('/customer/account/login')->withErrors('The account sign-in was incorrect or your account is disabled temporarily. Please wait and try again later.');
    }

    public function register_or_login()
    {
        return view('toko.pages.auth.register_or_login');
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->back();
    }





    // email verificataion
    public function verification_notice()
    {
        return view('toko.pages.auth.verify-email');
    }

    public function verification_handler(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/customer/account')->with('thanks', 'Terimakasih sudah mendaftar di Outlaws Studio store');
    }

    public function resend_verification(Request $request)
    {




        $request->user()->sendEmailVerificationNotification();

        return back()->with('send-link-email', 'cek email anda untuk melakuakn verifikasi!');
    }



    // reset password
    public function forgot_password()
    {
        return view('toko.pages.auth.forgot_password');
    }

    public function send_forgot_password_email(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public  function reset_password($token)
    {
        return view('toko.pages.auth.reset_password', ['token' => $token]);
    }


    public function update_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);


        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
