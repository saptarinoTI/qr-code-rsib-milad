<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QrCodeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $peserta;
    public $qrPath;
    public function __construct($peserta, $qrPath)
    {
        $this->peserta = $peserta;
        $this->qrPath = $qrPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Qr Code Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.qrcode',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        // return $this->subject('QR Code Absensi ' . $this->peserta->nama_karyawan)
        //     ->markdown('emails.qrcode')
        //     ->attach(storage_path('app/public/' . $this->qrPath), [
        //         'as' => 'qrcode.png',
        //         'mime' => 'image/png',
        //     ]);
        return $this->subject('QR Code Absensi ' . $this->peserta->nama_karyawan)
            ->view('emails.qrcode')
            ->attach(storage_path('app/public/' . $this->qrPath), [
                'as' => 'qrcode.png',
                'mime' => 'image/png',
            ]);
    }
}
