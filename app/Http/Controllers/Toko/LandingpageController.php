<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\List_ukuran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;

class LandingpageController extends Controller
{



    public function landing_page()
    {

        return view('toko.pages.landing_page');
    }

    public function list_item()
    {
        return view('toko.pages.list-item', [
            'kategories' => Kategori::all()
        ]);
    }

    public function ajax_list_items(Request $request)
    {

        if ($request->ajax()) {
            try {

                $items = Item::with(['wish_list', 'kategori:id,nama'])->select(['id', 'nama', 'harga', 'kategori_id', 'gambar'])
                    ->filter([
                        'filter' => isset($request->filter) ? $request->filter : null,
                        'isChecked' => isset($request->isChecked) ? $request->isChecked : []
                    ])->get();
                //code...


            } catch (\Throwable $th) {
                //throw $th;
                return $th->getMessage();
            }
            return $items;
        }
    }

    public function detail_item($id)
    {
        $item = Item::with([
            'kategori:id,nama',
            'list_ukurans.ukuran:id,nama',
        ])->where('id', $id)->first();



        return view('toko.pages.detail-item', [
            'item' => $item,
            'select_ukurans' =>  $item->list_ukurans
        ]);
    }

    public function detail_item_stok_ajax(Request $request)
    {


        if ($request->ajax()) {

            try {
                if (is_null($request->ukuran_id)) {
                    // jika tidak ada ukuran_id
                    $tersisa =  Item::select('stok')->where('id', $request->item_id)->first();
                } else {
                    // jika ada item_id && ukuran_id
                    $tersisa = List_ukuran::select('qty')->where([
                        ['ukuran_id', '=', $request->ukuran_id],
                        ['item_id', '=', $request->item_id]
                    ])->first();
                } //code...
            } catch (\Throwable $th) {
                //throw $th;
                return $th->getMessage();
            }

            return $tersisa;
        }
    }
}
