<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthAdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list akun di dashboard
        return view('cms.pages.setting_account.index', [
            'users' => Admin::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.pages.setting_account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required',
            'hak_akses' => 'required',
            'password' => 'required_with:confirm_password|same:confirm_password'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'hak_akses' => $request->hak_akses,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/admin/auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //detail akun
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('cms.pages.setting_account.edit', [
            'user' => Admin::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($request->check)) {
            $rules = [
                'nama' => 'required',
                'username' => 'required|unique:admins',
                'hak_akses' => 'required',
                'password' => 'required_with:confirm_password|same:confirm_password'
            ];

            if (!Hash::check($request->old_password, Admin::find($id)->password)) {
                return redirect()->back()->withErrors('old password is correct');
            }
        } else {
            $rules = [
                'nama' => 'required',
                'username' => 'required',
                'hak_akses' => 'required'
            ];
        }
        $validated = $request->validate($rules);
        Admin::where('id', $id)->update($validated);
        return redirect('/admin/auth');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->back();
    }

    public function login()
    {
        return view('cms.pages.auth.index');
    }

    public function authenticate(Request $request)
    {
        $validated = $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);


        if (Auth::guard('webadmin')->attempt($validated)) {
            // $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }
        return redirect()->back()->withErrors('Login Error!!.');
    }

    public function logout(Request $request)
    {


        Auth::guard('webadmin')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect('/admin/auth/dashboard/login');
    }

    public function demo()
    {
        return view('welcome');
    }
}
