<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminReportExport;
use Carbon\Carbon;

class PdfController extends Controller
{

    public function print_pesanan_user($id)
    {

        $item = Penjualan::with([
            'alamat',
            'pembayaran:id,transaction_status,code_bank',
            'detail_penjualans.item',
            'detail_penjualans.ukuran',
            'detail_penjualans.item.kategori',
            'kurir',
            'alamat'
        ])->where([
            ['user_id', '=', auth()->user()->id],
            ['id', '=', $id]
        ])->first();

        $subTotal = $item->detail_penjualans->sum(function ($q) {
            return $q->qty * $q->item->harga;
        });

        $pdf = Pdf::loadView('print_pdf.print_pesanan_user', [
            'item' => $item,
            'detail_penjualans' => $item->detail_penjualans,
            'pengiriman' => $item->kurir,
            'sub_total' => $subTotal,
            'total' => $item->total,
            'alamat' => $item->alamat,
            'pembayaran' => $item->pembayaran->code_bank
        ]);
        return $pdf->download('invoice.pdf');

        // return view('', );
    }

    public function print_admin_laporan_confirmed(Request $request)
    {

        $items = Penjualan::with([
            'pembayaran:id,transaction_status',
            'user:id,email',
            'detail_penjualans.item:id,nama'
        ])
            ->where('status_pengiriman', 'confirmed')
            ->whereBetween('tanggal_pembelian', [$request->start_date, $request->end_date])
            ->get();

        $periode = [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        $title = "Laporan Confirmed";

        return Excel::download(new AdminReportExport($items, $periode, $title), 'users.xlsx');
        // return $items;
    }
    public function print_admin_laporan_rejected(Request $request)
    {
        return $request;
    }
}
