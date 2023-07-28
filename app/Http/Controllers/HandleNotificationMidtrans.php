<?php

namespace App\Http\Controllers;

use App\Mail\Transaction_accepted_mail;
use App\Models\Detail_penjualan;
use App\Models\Item;
use App\Models\List_ukuran;
use App\Models\Pembayaran;
use Exception;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Notification;

class HandleNotificationMidtrans extends Controller
{

    public function payment_handler(Request $request)
    {

        // require_once dirname(__FILE__) . '/../../../vendor/midtrans/midtrans-php/Midtrans.php';


        // \Midtrans\Config::$isProduction = false;
        // \Midtrans\Config::$serverKey = env('SERVER_KEY_MIDTRANS');
        // $notif = new \Midtrans\Notification();

        Config::$isProduction = false;
        Config::$serverKey = env('SERVER_KEY_MIDTRANS');
        $notif = new Notification();



        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        $email =  Pembayaran::select('email')->leftJoin('penjualans', 'pembayarans.id', '=', 'penjualans.pembayaran_id')
            ->leftJoin('users', 'penjualans.user_id', '=', 'users.id')
            ->where('code_order', $request->order_id)
            ->first()->email;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $data = self::queryPembelian($order_id);
            self::updateStock($data['detail_penjualan']);
            self::updateStatus($order_id, $transaction);
            Mail::to($data['pembayaran']->email)->send(new Transaction_accepted_mail($data['pembayaran'], $data['detail_penjualan']));
            echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            self::updateStatus($order_id, $transaction);
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            self::updateStatus($order_id, $transaction);
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        } else if ($transaction == 'expire') {
            self::updateStatus($order_id, $transaction);
            // TODO set payment status in merchant's database to 'expire'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        } else if ($transaction == 'cancel') {
            self::updateStatus($order_id, $transaction);
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }
    }

    static function updateStatus($order_id, $transaction)
    {
        Pembayaran::where('code_order', $order_id)->update([
            'transaction_status' => $transaction
        ]);
    }

    static function updateStock($data)
    {
        try {
            DB::beginTransaction();
            foreach ($data as $d) {
                $stok = Item::select('id', 'kategori_id', 'stok', 'terjual')->where('id', $d->item_id)->first();
                $stok->stok -=  $d->qty;
                $stok->terjual += $d->qty;
                if ($stok->stok != 0) {
                    Item::where('id', $d->item_id)->update([
                        'stok' => $stok->stok,
                        'terjual' => $stok->terjual,
                    ]);
                } else {
                    throw new Exception('stok kurang dari 0');
                }
                $list_qty = List_ukuran::where('item_id', '=', $d->item_id)
                    ->where('ukuran_id', '=', $d->ukuran_id)->first()->qty;
                $list_qty -= $d->qty;
                if ($list_qty != 0) {
                    List_ukuran::where('item_id', '=', $d->item_id)
                        ->where('ukuran_id', '=', $d->ukuran_id)->update([
                            'qty' => $list_qty
                        ]);
                } else {
                    throw new Exception('list qty kurang dari 0');
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return $th->getMessage();
        }
    }


    static function queryPembelian($order_id)
    {
        $pembayaran =  Pembayaran::select(['penjualans.id', 'email', 'code_order', 'nota', 'total', 'tarif'])
            ->leftJoin('penjualans', 'pembayarans.id', '=', 'penjualans.pembayaran_id')
            ->leftJoin('users', 'penjualans.user_id', '=', 'users.id')
            ->join('kurirs', 'penjualans.kurir_id', '=', 'kurirs.id')
            ->where('code_order', $order_id)
            ->first();

        $detail_penjualans = Detail_penjualan::select([
            'item_id',
            'ukuran_id',
            'items.nama as nama',
            'ukurans.nama as ukuran',
            'qty'
        ])
            ->join('items', 'detail_penjualans.item_id', '=', 'items.id')
            ->join('ukurans', 'detail_penjualans.ukuran_id', '=', 'ukurans.id')
            ->where('penjualan_id', $pembayaran->id)->get();


        return [
            'pembayaran' => $pembayaran,
            'detail_penjualan' => $detail_penjualans
        ];
    }
}
