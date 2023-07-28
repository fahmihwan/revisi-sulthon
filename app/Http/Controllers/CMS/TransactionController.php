<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Detail_penjualan;
use App\Models\Penjualan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $items = Penjualan::with(['pembayaran:id,transaction_status', 'user:id,email'])
            ->where('status_pengiriman', 'pending')
            ->latest()->paginate(5);

        return view('cms.pages.transaction.index', [
            'items' => $items
        ]);
    }

    public function detail_pembelian($id)
    {
        $penjualan = Penjualan::with([
            'kurir',
            'pembayaran',
            'alamat'
        ])->where('id', $id)
            ->first();

        $informasi_pemesanan = Detail_penjualan::select([
            'gambar',
            'items.nama as item_nama',
            'qty',
            'harga',
            'kategoris.nama as kategori_nama'
        ])
            ->join('items', 'detail_penjualans.item_id', '=', 'items.id')
            ->join('kategoris', 'items.kategori_id', '=', 'kategoris.id')
            ->where('detail_penjualans.penjualan_id', $id)
            ->selectRaw('qty * harga as harga_total')
            ->get()->makeHidden(['deskripsi']);

        return view('cms.pages.transaction.detail_pembelian', [
            'id' => $id,
            'penjualan' => $penjualan,
            'pembayaran' => $penjualan->pembayaran,
            'kurir' => $penjualan->kurir,
            'informasi_pemesanan' => $informasi_pemesanan,
            'alamat' => $penjualan->alamat
        ]);
    }

    public function konfirmasi_pembelian(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $transaction_status = Penjualan::select('transaction_status')->where('penjualans.id', $id)
                ->join('pembayarans', 'pembayarans.id', '=', 'penjualans.pembayaran_id')->first()->transaction_status;

            if ($request->status_pengiriman == 'rejected') {
                Penjualan::where('id', $id)->update(['status_pengiriman' => $request->status_pengiriman]);
            }

            if ($request->status_pengiriman == 'confirmed') {
                if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
                    Penjualan::where('id', $id)->update(['status_pengiriman' => $request->status_pengiriman]);
                } else {
                    throw new Exception("user belum melakukan transaksi");
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }

        return redirect('/admin/list-transaction');
    }
}
