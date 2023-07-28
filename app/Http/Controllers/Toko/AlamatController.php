<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kota_id' => 'required|numeric',
            'kode_pos' => 'required|numeric',
            'telp' => 'required|numeric'
        ]);

        $validated['telp'] = '62' . $validated['telp'];
        $validated['user_id'] = auth()->user()->id;

        Alamat::create($validated);
        return redirect()->back();
    }
    public function delete($id)
    {
        Alamat::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->delete();

        return redirect()->back();
    }
    public function edit($id)
    {
        $alamat = Alamat::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->first();

        return view('toko.pages.customer.ubah_alamat', [
            'almt' => $alamat
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kota_id' => 'required|numeric',
            'kode_pos' => 'required|numeric',
            'telp' => 'required|numeric'
        ]);

        $alamat = Alamat::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->update($validated);
        // $alamat = Alamat::where([
        //     ['id', '=', $id],
        //     ['user_id', '=', auth()->user()->id]
        // ])->first();
        // return $alamat;

        return redirect('/customer/address');

        // return view('toko.pages.customer.ubah_alamat', [
        //     'almt' => $alamat
        // ]);
    }
}
