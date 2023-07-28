<?php

namespace App\Http\Controllers\CMS\master_item;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Ukuran;
use App\Services\KategoriService;
use App\Services\UkuranService;
use Exception;
use Illuminate\Http\Request;

class UkuranController extends Controller
{

    private $ukuranService, $kategoriService;
    public function __construct(UkuranService $ukuranService, KategoriService $kategoriService)
    {
        $this->ukuranService = $ukuranService;
        $this->kategoriService = $kategoriService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $this->ukuranService->getUkuranLatest();
        return view('cms.pages.master_item.ukuran.index', [
            'kategories' => $this->kategoriService->getKategoriLatest(),
            'items' => $this->ukuranService->getUkuranLatest()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->ukuranService->storeUkuran($request);
        } catch (Exception $e) {
            return redirect()->back($e->getMessage());
        }

        return redirect('/admin/master-item/ukuran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('cms.pages.master_item.ukuran.edit', [
            'item' =>  $this->ukuranService->find_ukuran_and_kategori($id),
            'kategories' => $this->kategoriService->getKategoriLatest()
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
        $validated = $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required|numeric'
        ]);

        Ukuran::where('id', $id)->update($validated);
        return redirect('/admin/master-item/ukuran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ukuran::destroy($id);
        return redirect()->back();
    }
}
