<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard_alert_transaction;
use App\Models\Penjualan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $date = Carbon::now();
        $transasksi_minggu = Penjualan::select('penjualans.id', 'penjualans.created_at as date', 'email', 'transaction_status')
            ->join('users', 'users.id', '=', 'penjualans.user_id')
            ->join('pembayarans', 'pembayarans.id', '=', 'penjualans.pembayaran_id')
            ->whereDate('penjualans.created_at', '>=', $date->startOfWeek())
            ->whereDate('penjualans.created_at', '<=', $date->endOfWeek())
            ->get();


        $produk_terjual = Penjualan::join('pembayarans', 'pembayarans.id', '=', 'penjualans.pembayaran_id')
            ->join('detail_penjualans', 'detail_penjualans.id', '=', 'penjualans.id')
            ->whereDate('penjualans.created_at', '>=', $date->startOfMonth())
            ->whereDate('penjualans.created_at', '<=', $date->endOfMonth())
            ->whereIn('transaction_status', ['settlement', 'capture'])
            ->sum('penjualans.qty');


        $transaksi_bulanan = Penjualan::select('penjualans.created_at as date', 'email', 'transaction_status')
            ->whereDate('penjualans.created_at', '>=', $date->startOfMonth())
            ->whereDate('penjualans.created_at', '<=', $date->endOfMonth())
            ->count();

        $chartCountSuccess = Penjualan::select(DB::raw('count(penjualans.created_at) as total'))
            ->join('pembayarans', 'pembayarans.id', '=', 'penjualans.pembayaran_id')
            ->groupby(DB::raw('month(penjualans.created_at)'))
            ->whereYear('penjualans.created_at', Carbon::now()->format('Y'))
            ->whereIn('transaction_status', ['settlement', 'capture'])
            ->pluck('total');

        $chartCountFail = Penjualan::select(DB::raw('count(penjualans.created_at) as total'))
            ->join('pembayarans', 'pembayarans.id', '=', 'penjualans.pembayaran_id')
            ->groupby(DB::raw('month(penjualans.created_at)'))
            ->whereYear('penjualans.created_at', Carbon::now()->format('Y'))
            ->whereNot('transaction_status', ['settlement', 'capture'])
            ->pluck('total');


        $chartMonth = Penjualan::select(DB::raw('monthname(penjualans.created_at) as bulan'))
            ->groupby(DB::raw('MONTHNAME(penjualans.created_at)'))
            ->whereYear('penjualans.created_at', Carbon::now()->format('Y'))
            ->pluck('bulan');



        return view('cms.pages.dashboard.index', [
            'jumlah_pengguna' =>  User::count(),
            'transasksi_minggu' => Dashboard_alert_transaction::collection($transasksi_minggu),
            'produk_terjual' => $produk_terjual,
            'transaksi_bulanan' => $transaksi_bulanan,
            'chart' => [
                'chart_count' => [
                    'count_success' => $chartCountSuccess,
                    'count_fail' => $chartCountFail
                ], 'chart_month' => $chartMonth
            ]
        ]);
    }
}
