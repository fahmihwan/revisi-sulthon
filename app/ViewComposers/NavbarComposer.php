<?php

// namespace App\View\Composers;
namespace App\ViewComposers;

use App\Models\Item;
use App\Models\Keranjang;
use App\Models\Wish_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavbarComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {

        if (!auth()->check()) {
            $data = [
                'data_cart' => [],
                'count' => 0,
                'wish_list_count' => 0,
                'isSuspend' => false
            ];
        } else {

            $keranjang = Keranjang::select([
                'keranjangs.id as keranjang_id',
                'gambar',
                'ukurans.nama as ukuran',
                'item_id',
                'items.nama',
                'qty',
                'harga'
            ])
                ->join('items', 'keranjangs.item_id', '=', 'items.id')
                ->join('ukurans', 'keranjangs.ukuran_id', '=', 'ukurans.id')
                ->where('user_id', auth()->user()->id)
                ->selectRaw('harga * qty as subtotal')
                ->orderBy('keranjangs.created_at', 'desc')
                ->get();

            $sub_total =  $keranjang->sum(function ($data) {
                return $data->subtotal;
            });


            $data = [
                'data_cart' => $keranjang,
                'count' => $keranjang->count(),
                'wish_list_count' => Wish_list::where('user_id', auth()->user()->id)->count(),
                'sub_total' => $sub_total
            ];
        }
        $items = Item::select('id', 'nama', 'gambar')->get();
        $data['items'] = $items;

        $view->with($data);
    }
}
