<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompanyVerified extends Mailable
{
    use Queueable, SerializesModels;

    public string $namaPerusahaan;
    public string $status;
    public ?string $alasanPenolakan;

    public function __construct(string $namaPerusahaan, string $status, ?string $alasanPenolakan = null)
    {
        $this->namaPerusahaan   = $namaPerusahaan;
        $this->status           = $status;
        $this->alasanPenolakan  = $alasanPenolakan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->status === 'accepted'
                ? '✅ Akun Perusahaan Anda Telah Diverifikasi'
                : '❌ Akun Perusahaan Anda Ditolak',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.company-verified',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
