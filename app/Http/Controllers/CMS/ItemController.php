<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Kategori;
use App\Models\List_ukuran;
use App\Models\Ukuran;
use App\Services\ItemService;
use App\Services\KategoriService;
use App\Services\UkuranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    protected $itemService;
    protected $ukuranService;
    protected $kategoriService;

    public function __construct(ItemService $itemService, UkuranService $ukuranService, KategoriService $kategoriService)
    {
        // dd($this->middleware('hak_akses_dashboard:owner')->only(['index']));
        // $this->middleware('hak_akses_dashboard:owner')->only('index');


        $this->itemService = $itemService;
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
        return view('cms.pages.item.index', [
            'items' => $this->itemService->item_with_kategori()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('cms.pages.item.create', [
            'kategories' => $this->kategoriService->getKategoriLatest(),
            'ukurans' => $this->ukuranService->getUkuranLatest()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,svg|max:4096',
            'deskripsi' => 'required',
            'berat' => 'required|numeric'
        ]);

        if ($request->file('gambar')) {
            $validated['gambar'] = $request->file('gambar')->storePublicly('image-items', ['disk' => 'public']);
        }

        $validated['terjual'] = 0;
        $validated['stok'] = 0;
        $validated['admin'] = 1;

        Item::create($validated);
        return redirect('/admin/item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $item = Item::with(['kategori:id,nama'])
            ->where('id', $id)
            ->latest()->first();

        return view('cms.pages.item.show', [
            'item' => $item,
            'link' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::with(['kategori:id,nama'])
            ->where('id', $id)
            ->latest()->first();

        return view('cms.pages.item.edit', [
            'item' => $item,
            'link' => $id,
            'kategories' => Kategori::all()
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
            'kategori_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar' => 'image|mimes:jpg,png,jpeg,svg|max:4096',
            'deskripsi' => 'required',
            'terjual' => 'required|numeric',
            'stok' => 'required|numeric',
            'berat' => 'required|numeric'
        ]);

        if ($request->file('gambar')) {
            Storage::delete($validated['gambar']);
            $validated['gambar'] = $request->file('gambar')->storePublicly('image-items', ['disk' => 'public']);
        }

        Item::where('id', $id)->update($validated);

        return redirect('/admin/item/' . $id . '/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            DB::beginTransaction();
            List_ukuran::where('item_id', $id)->delete();
            Item::destroy($id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th);
        }


        return redirect('/admin/item');
    }

    public function detroy_list_ukuran($item, $id)
    {

        try {
            DB::beginTransaction();

            $item = Item::where('id', $item);
            $list_item = List_ukuran::where('id', $id);
            $stok = $item->first()->stok - $list_item->first()->qty;

            $item->update([
                'stok' => $stok
            ]);

            $list_item->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
        // List_ukuran::destroy($id);
        return redirect()->back();
    }

    public function tambah_stok_item(Request $request, $id)
    {

        // get first item where id 
        $item = Item::with(['kategori:id,nama'])
            ->where('id', $id)
            ->select(['id', 'nama', 'kategori_id', 'stok', 'gambar'])
            ->latest()->first();
        // return $item;

        // get list_ukuran where item_id
        $list_ukuran = List_ukuran::with(['ukuran'])->where('item_id', $id)->latest()->get();

        // get all ukuran where kategori_id
        $list_ukuran_item = Ukuran::where('kategori_id', $item->kategori_id)->latest()->get();


        return view('cms.pages.item.tambah_stok', [
            'list_ukuran' => $list_ukuran,
            'list_ukuran_item' => $list_ukuran_item,
            'link' => $id,
            'item' => $item
        ]);
    }

    public function store_list_item(Request $request, $id)
    {

        $validated = $request->validate([
            'ukuran_id' => 'required',
        ]);
        $validated['item_id'] = $id;
        $validated['qty'] = 0;

        List_ukuran::create($validated);

        return redirect()->back();
    }



    public function store_stok_item(Request $request, $id)
    {
        $validated =  $request->validate([
            'ukuran_id' => 'required',
            'ukuran_qty' => 'required',
        ]);

        if (count($validated['ukuran_qty']) != count($validated['ukuran_id'])) {
            return redirect()->back()->withErrors('gagal, coba tambahkan ulang!!');
        }

        $last_index =  array_keys($validated['ukuran_id']);

        $last_index =  end($last_index); //2

        try {
            DB::beginTransaction();
            $item = Item::where('id', $id);
            $sumQty = 0;
            for ($i = 1; $i <= $last_index; $i++) {
                if (!empty($validated['ukuran_id'][$i]) || !empty($validated['ukuran_qty'][$i])) {

                    $list_ukuran = List_ukuran::where([
                        'ukuran_id' => $validated['ukuran_id'][$i],
                        'item_id' => $id,
                    ]);

                    $list_ukuran->update([
                        'qty' => $list_ukuran->first()->qty + $validated['ukuran_qty'][$i]
                    ]);
                    $sumQty += $validated['ukuran_qty'][$i];
                }
            }
            $sumQty += $item->first()->stok;
            $item->update([
                'stok' => $sumQty,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
        return redirect()->back();
    }
}
