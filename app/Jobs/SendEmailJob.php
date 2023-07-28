<?php

namespace App\Jobs;

use App\Mail\Bill_mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::to('fahmiihwan86@gmail.com')->send(new Bill_mail($this->data));
        // Mail::to('fahmiihwan86@gmail.com')->queue(new Bill_mail($this->data));



        // Mail::to('fahmiihwan86@gmail.com')->send(new Bill_mail($this->data));
        // Mail::to(auth()->guard('web')->user()->email)->send(new Bill_mail([
        //     'response' => $this->data['response'],
        //     'batas_akhir_pembayaran' => $this->data['batas_akhir_pembayaran'],
        //     'user' => $this->data['user'],
        //     'keranjang' => $this->data['keranjang'],
        //     'pengiriman' => $this->data['pengiriman'],
        //     'ongkir' => $this->data['ongkir'],
        //     'sub_total' => $this->data['sub_total']
        // ]));
    }
}
