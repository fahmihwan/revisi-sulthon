<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Detail_penjualan;
use App\Models\Penjualan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminReportExport;


class ReportController extends Controller
{
    public function confirmed()
    {

        $data =  Penjualan::filter(['status_pengiriman' => 'confirmed'])->paginate(5);

        if (request('search')) {
            $data = Penjualan::filter(['status_pengiriman' => 'confirmed', 'periode' => request(['start_date', 'end_date'])])->paginate(5);
            if ($data->count() == 0) {
                return redirect()->back()->withErrors('data tidak ada pada periode tersebut');
            }
        }
        if (request('print')) {
            $data = Penjualan::filter(['status_pengiriman' => 'confirmed', 'periode' => request(['start_date', 'end_date'])])->paginate(5);
            if ($data->count() == 0) {
                return redirect()->back()->withErrors('data tidak ada pada periode tersebut');
            }
            $periode = [
                'start_date' => request('start_date'),
                'end_date' => request('end_date'),
            ];
            $title = "Laporan Confirmed";
            return Excel::download(new AdminReportExport($data, $periode, $title), 'Laporan Confirmed.xlsx');
        }

        return view('cms.pages.report.confirmed', [
            'items' => $data
        ]);
    }


    public function rejected()
    {
        $data =  Penjualan::filter(['status_pengiriman' => 'rejected'])->paginate(5);
        if (request('search')) {
            $data = Penjualan::filter(['status_pengiriman' => 'rejected', 'periode' => request(['start_date', 'end_date'])])->paginate(5);
            if ($data->count() == 0) {
                return redirect()->back()->withErrors('data tidak ada pada periode tersebut');
            }
        }
        if (request('print')) {
            $data = Penjualan::filter(['status_pengiriman' => 'rejected', 'periode' => request(['start_date', 'end_date'])])->paginate(5);
            if ($data->count() == 0) {
                return redirect()->back()->withErrors('data tidak ada pada periode tersebut');
            }
            $periode = [
                'start_date' => request('start_date'),
                'end_date' => request('end_date'),
            ];
            $title = "Laporan Rejected";
            return Excel::download(new AdminReportExport($data, $periode, $title), 'Laporan Rejected.xlsx');
        }

        return view('cms.pages.report.rejected', [
            'items' => $data
        ]);
    }

    public function detail($id)
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
}
