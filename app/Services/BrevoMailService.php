<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class BrevoMailService
{
    /**
     * Mengirim email menggunakan Brevo HTTPS API.
     */
    public function send(
        string $recipientEmail,
        string $recipientName,
        string $subject,
        string $htmlContent
    ): array {
        $apiKey = config('services.brevo.api_key');
        $fromEmail = config('services.brevo.from_email');
        $fromName = config('services.brevo.from_name');

        if (!$apiKey || !$fromEmail) {
            throw new RuntimeException(
                'Konfigurasi Brevo belum tersedia.'
            );
        }

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'api-key' => $apiKey,
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name' => $fromName,
                'email' => $fromEmail,
            ],
            'to' => [
                [
                    'email' => $recipientEmail,
                    'name' => $recipientName,
                ],
            ],
            'subject' => $subject,
            'htmlContent' => $htmlContent,
        ]);

        if ($response->failed()) {
            throw new RuntimeException(
                'Gagal mengirim email: '.$response->body()
            );
        }

        return $response->json();
    }
}
