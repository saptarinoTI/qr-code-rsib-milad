<?php

namespace App\Jobs;

use App\Mail\QrCodeMail;
use App\Models\Peserta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendQrCodeEmailJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $peserta;
    public $qrCode;

    /**
     * Create a new job instance.
     *
     * @param Peserta $peserta
     * @param string $qrCode
     */
    public function __construct(Peserta $peserta, $qrCode)
    {
        $this->peserta = $peserta;
        $this->qrCode = $qrCode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Generate the QR code image
        $fileName = $this->peserta->qr_code . '.png';
        $qrImage = QrCode::format('png')
            ->size(1000)
            ->margin(2)
            ->style('square')
            ->errorCorrection('H')
            ->backgroundColor(255, 255, 255)
            ->color(0, 0, 0)
            ->generate($this->qrCode);

        // Store the QR code temporarily in storage
        $path = 'qrcodes/' . $fileName;
        Storage::disk('public')->put($path, $qrImage);

        // Send the email with the QR code attached
        Mail::to($this->peserta->email)->send(new QrCodeMail($this->peserta, $path));
    }
}
