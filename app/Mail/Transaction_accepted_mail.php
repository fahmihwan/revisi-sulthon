<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class Transaction_accepted_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $pembayaran, $detail_penjualans;
    // protected $data;
    public function __construct($pembayaran, $detail_penjualans)
    {
        $this->pembayaran = $pembayaran;
        $this->detail_penjualans = $detail_penjualans;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('outlawsstuido@gmail.com', 'outlaws studio'),
            subject: 'Invoice Payment Confirmation',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'toko.layout.email.transaction_accepted',
            with: [
                'pembayaran' => $this->pembayaran,
                'detail_penjualan' => $this->detail_penjualans
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
