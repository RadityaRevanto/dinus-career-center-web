<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Undangan Interview — {{ $position }}</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111827; line-height:1.6; margin:0; padding:24px;">
    <p>Halo {{ $pelamarName }},</p>

    <p>
        Selamat! Lamaran Anda untuk posisi <strong>{{ $position }}</strong> di <strong>{{ $companyName }}</strong> telah lolos ke tahap berikutnya. Kami ingin mengundang Anda untuk mengikuti sesi interview yang telah dijadwalkan sebagai berikut:
    </p>

    <div style="background-color: #f3f4f6; padding: 20px; border-radius: 12px; margin: 24px 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 120px; padding: 6px 0; font-weight: bold; color: #4b5563;">Jadwal:</td>
                <td style="padding: 6px 0; font-weight: bold; color: #111827;">{{ $interviewTime }}</td>
            </tr>
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #4b5563;">Link Meeting:</td>
                <td style="padding: 6px 0;">
                    <a href="{{ $linkMeet }}" target="_blank" style="color: #2563eb; font-weight: bold; text-decoration: underline;">
                        {{ $linkMeet }}
                    </a>
                </td>
            </tr>
        </table>
    </div>

    @if(!empty($pesanTambahan))
        <p style="margin-top: 20px;">
            <strong>Catatan Tambahan dari Perusahaan:</strong><br>
            <span style="display: block; background-color: #fffbeb; border-left: 4px solid #f59e0b; padding: 12px; margin-top: 8px; font-style: italic; color: #78350f; border-radius: 4px;">
                {!! nl2br(e($pesanTambahan)) !!}
            </span>
        </p>
    @endif

    <p style="margin-top: 24px;">
        Informasi perusahaan:<br>
        Nama Perusahaan: {{ $companyName }}<br>
        Email Perusahaan: {{ $companyEmail }}
    </p>

    <p>
        Silakan balas email ini jika ada pertanyaan terkait jadwal di atas.
    </p>

    <p style="margin-top: 32px;">
        Hormat kami,<br>
        <strong>{{ $companyName }}</strong>
    </p>
</body>
</html>
