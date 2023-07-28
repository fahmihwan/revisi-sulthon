<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Mail\Bill_mail;
use App\Models\Alamat;
use App\Models\Credential;
use App\Models\Detail_penjualan;
use App\Models\Keranjang;
use App\Models\Kurir;
use App\Models\Pembayaran;
use App\Models\Penjualan;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Mail\DemoMail;

use Illuminate\Support\Facades\Mail;


class CheckoutController extends Controller
{

    public function keranjang()
    {
        $items = Keranjang::with([
            'item',
            'ukuran:id,nama'
        ])->where('user_id', auth()->user()->id)->latest()->get();

        $total_keranjang = $items->sum(function ($item) {
            return $item->qty * $item->item->harga;
        });

        return view('toko.pages.checkout.keranjang', [
            'items' => $items,
            'total_keranjang' => $total_keranjang
        ]);
    }




    public function pengiriman()
    {
        $alamats = Alamat::with('credential:id,alamat_id')->where('user_id', auth()->user()->id)->get();

        $keranjang = Keranjang::with([
            'item:id,nama,gambar,harga,kategori_id',
            'item.kategori',
            'ukuran:id,nama'
        ])->where('user_id', auth()->user()->id)->get();

        $sub_total = $keranjang->sum(function ($item) {
            return $item->qty * $item->item->harga;
        });

        return view('toko.pages.checkout.pengiriman', [
            'alamats' => $alamats,
            'items' => $keranjang,
            'sub_total' => $sub_total
        ]);
    }




    public function pembayaran()
    {
        // get session
        $get_sesssion_rajaongkir = session()->get('rajaongkir');
        $get_session_credential = session()->get('rajaongkir_credential');

        if (request('metode_pengiriman') == null || request('ongkir') == null) {
            return redirect()->back()->withErrors('pilih layanan paket');
        }
        $get_detail_rajaongkir =  $this->cek_session_rajaongkir($get_sesssion_rajaongkir, $get_session_credential);

        $keranjang = Keranjang::with([
            'item:id,nama,gambar,harga,kategori_id',
            'item.kategori',
            'ukuran:id,nama'
        ])->where('user_id', auth()->user()->id)->get();


        $sub_total = $keranjang->sum(function ($item) {
            return $item->qty * $item->item->harga;
        });

        $total =  $sub_total +  $get_detail_rajaongkir['cost'][0]['value'];

        return view('toko.pages.checkout.pembayaran', [
            'items' => $keranjang,
            'sub_total' =>  $sub_total,
            'total' => $total,
            'info_pengiriman' => [
                'code' => $get_session_credential['code'],
                'value' => $get_detail_rajaongkir['cost'][0]['value'],
                'service' => $get_session_credential['service'],
                'description' => $get_detail_rajaongkir['description']
            ]
        ]);
    }

    private function cek_session_rajaongkir($get_sesssion_rajaongkir, $get_session_credential)
    {
        if ($get_sesssion_rajaongkir == null || $get_session_credential == null) {
            return redirect()->back()->withErrors('pilih metode pengiriman');
        }
        if ($get_sesssion_rajaongkir[0]['code'] == $get_session_credential['code']) {
            foreach ($get_sesssion_rajaongkir[0]['costs'] as $service) {
                if ($service['service'] == $get_session_credential['service']) {
                    $get_detail_rajaongkir = $service;
                }
            }
            return $get_detail_rajaongkir;
        } else {
            return redirect()->back()->withErrors('terjadi kesalahan');
        }
    }


    // midtrans
    public function pay(Request $request)
    {

        $request->validate([
            'bank' => 'required',
        ]);

        //  nota
        $nota = $this->create_nota();

        $get_sesssion_rajaongkir = session()->get('rajaongkir');
        $get_session_credential = session()->get('rajaongkir_credential');

        // ongkir
        $get_detail_rajaongkir =  $this->cek_session_rajaongkir($get_sesssion_rajaongkir, $get_session_credential);

        // sum qty keranjang
        $sum_qty_keranjang = Keranjang::where('user_id', auth()->user()->id)
            ->selectRaw('sum(qty) as qty_keranjang')
            ->first()->qty_keranjang;

        // subtotal
        $sub_total = Keranjang::where('user_id', auth()->user()->id)
            ->join('items', 'keranjangs.item_id', '=', 'items.id')
            ->selectRaw('sum(keranjangs.qty * items.harga) as sub_total')
            ->first();

        // total = subtotal + ongkir
        $gross_amount = $sub_total['sub_total'] + $get_detail_rajaongkir['cost'][0]['value'];

        $keranjang = Keranjang::with([
            'item:id,nama,harga,gambar',
            'ukuran:id,nama'
        ])
            ->select(['id', 'user_id', 'qty', 'item_id', 'ukuran_id'])
            ->where('user_id', auth()->user()->id)
            ->get();


        $user = User::with([
            'credential.alamat',
        ])->where('id', auth()->user()->id)
            ->get()->first();

        // cek metode pembayaran
        $data = $this->cek_data_midtrans($request->bank, $gross_amount, $keranjang, $user);

        $batas_akhir_pembayaran = Carbon::parse($data['custom_expiry']['order_time'])
            ->addHour(24)
            ->format('d F Y H:i:s');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/charge",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Basic U0ItTWlkLXNlcnZlci1NLUVmN0E3clFQU0tPd2J2RVc0VmtPOXM6',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return $err;
        } else {
            $response_success = json_decode($response, true);
            // pembayaran
            try {
                DB::beginTransaction();
                $pembayaran_id = Pembayaran::create([
                    'code_transaction' => $response_success['transaction_id'],
                    'code_order' => $response_success['order_id'],
                    'code_merchant' => $response_success['merchant_id'],
                    'code_bank' => $request->bank == 'echannel' ? 'mandiri' : $request->bank,
                    'transaction_status' => $response_success['transaction_status'],
                    'va_number' => isset($response_success['va_numbers'][0]['va_number']) ? $response_success['va_numbers'][0]['va_number'] : null,
                    'bill_key' => isset($response_success['bill_key']) ? $response_success['bill_key'] : null,
                    'biller_code' => isset($response_success['biller_code']) ? $response_success['biller_code'] : null,
                ])->id;

                // kurir
                $kurir_id = Kurir::create([
                    'code' => $get_session_credential['code'],
                    'service' => $get_detail_rajaongkir['service'],
                    'deskripsi' => $get_detail_rajaongkir['description'],
                    'tarif' => $get_detail_rajaongkir['cost'][0]['value'],
                    'estimasi' => $get_detail_rajaongkir['cost'][0]['etd'],
                ])->id;

                $penjualan_id = Penjualan::create([
                    'nota' => $nota,
                    'tanggal_pembelian' => Carbon::now(),
                    'pembayaran_id' => $pembayaran_id,
                    'alamat_id' => $user->credential->alamat_id,
                    'kurir_id' => $kurir_id,
                    'qty' => $sum_qty_keranjang,
                    'total' => $gross_amount,
                    'status_pengiriman' => 'pending',
                    'user_id' => auth()->user()->id,
                ])->id;

                foreach ($keranjang as $krj) {
                    Detail_penjualan::create([
                        'penjualan_id' => $penjualan_id,
                        'item_id' => $krj['item_id'],
                        'ukuran_id' => $krj['ukuran_id'],
                        'qty' => $krj['qty']
                    ]);
                }
                DB::commit();
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
                return redirect()->back()->withErrors($th->getMessage());
            }


            // dd($keranjang);
            $data = [
                'response' => $response_success,
                'batas_akhir_pembayaran' => $batas_akhir_pembayaran,
                'user' => $user,
                'keranjang' => $keranjang,
                'pengiriman' => $get_session_credential['code'] . ' - ' . $get_session_credential['service'] . ' ' . $get_detail_rajaongkir['description'],
                'ongkir' => $get_detail_rajaongkir['cost'][0]['value'],
                'sub_total' => $sub_total['sub_total']
            ];
            // with QUEUE
            // SendEmailJob::dispatch($data);

            Mail::to(auth()->user()->email)->send(new Bill_mail([
                'response' => $response_success,
                'batas_akhir_pembayaran' => $batas_akhir_pembayaran,
                'user' => $user,
                'keranjang' => $keranjang,
                'pengiriman' => $get_session_credential['code'] . ' - ' . $get_session_credential['service'] . ' ' . $get_detail_rajaongkir['description'],
                'ongkir' => $get_detail_rajaongkir['cost'][0]['value'],
                'sub_total' => $sub_total['sub_total']
            ]));

            return view('toko.layout.transaksi_success_ini');
        }
    }



    private function cek_data_midtrans($bank, $gross_amount, $keranjang, $user)
    {
        if ($bank == 'echannel') {
            $data = [
                "payment_type" => $bank,
                "transaction_details" => [
                    "order_id" => rand(),
                    "gross_amount" => $gross_amount
                ], "echannel" => [
                    "bill_info1" => "Payment:",
                    "bill_info2" => "Online purchase"
                ]
            ];
        } else {
            $data = [
                "payment_type" => "bank_transfer",
                "transaction_details" => [
                    "order_id" => rand(),
                    "gross_amount" => $gross_amount
                ],
                "bank_transfer" => [
                    "bank" => $bank
                ],
            ];
        }
        foreach ($keranjang as $item) {
            $data['items_details'][] = [
                "id" => $item->item->id,
                "price" => $item->item->harga,
                "quantity" => $item->qty,
                "name" => $item->item->nama
            ];
        }

        $data['customer_details'] =   [
            "first_name" => $user->credential->nama_depan,
            "last_name" => $user->credential->nama_belakang,
            "email" => $user->email,
            "phone" => $user->credential->telp,
            "shipping_address" => [
                "first_name" => $user->credential->nama_depan,
                "last_name" => $user->credential->nama_belakang,
                "email" => $user->email,
                "phone" => $user->credential->alamat->telp,
                "address" => $user->credential->alamat->alamat,
                "city" => $user->credential->alamat->kota,
                "postal_code" => $user->credential->alamat->kode_pos,
                "country_code" => "IDN"
            ]
        ];
        $data["custom_expiry"] = [
            "order_time" => Carbon::now()->format('Y-m-d H:i:s O'),
            "expiry_duration" => 1440,
            "unit" => "minute"
        ];

        return $data;
    }

    private function create_nota()
    {
        $notaDB = Penjualan::select('nota')->latest()->first();
        if ($notaDB == null) {
            $nota = 'OS' . date('m') . '-' . date('Y') . '0001' . date('d') . 'E';
        } elseif (substr($notaDB->nota, 2, 2) != date('m')) {
            $nota = 'OS' . date('m') . '-' . date('Y') . '0001' . date('d') . 'E';
        } else {
            $cut =  substr($notaDB->nota, 10, -3);
            $number = str_pad($cut + 1, 4, "0", STR_PAD_LEFT);;
            $nota = 'OS' . date('m') . '-' . date('Y') . $number . date('d') . 'E';
        }
        return $nota;
    }

    public function set_alamat_primary_customer($idAlamat)
    {

        $credential = Alamat::select(['id', 'alamat', 'user_id'])->with(
            ['user:id,credential_id']
        )->where([
            ['id', '=', $idAlamat],
            ['user_id', '=', auth()->user()->id]
        ])->first();


        Credential::where('id', $credential->user->credential_id)->update([
            'alamat_id' => $idAlamat
        ]);

        return response()->json([
            'code' => 'User Updated Successfully!',
            'data' => $credential->alamat
        ]);
    }
}
