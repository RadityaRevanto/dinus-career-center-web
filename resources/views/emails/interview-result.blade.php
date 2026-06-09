<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Interview</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111827; line-height:1.6;">
    <p>Halo {{ $pelamarName }},</p>

    @if($result === 'accepted')
        <p>
            Selamat, berdasarkan hasil interview untuk posisi <strong>{{ $position }}</strong> di <strong>{{ $companyName }}</strong>, Anda dinyatakan <strong>diterima</strong>.
        </p>
    @else
        <p>
            Terima kasih sudah mengikuti proses interview untuk posisi <strong>{{ $position }}</strong> di <strong>{{ $companyName }}</strong>. Saat ini Anda belum dapat kami lanjutkan ke tahap berikutnya.
        </p>
    @endif

    @if(!empty($customMessage))
        <p>
            <strong>Pesan dari perusahaan:</strong><br>
            {{ $customMessage }}
        </p>
    @endif

    <p>
        Informasi perusahaan:<br>
        Nama Perusahaan: {{ $companyName }}<br>
        Email Perusahaan: {{ $companyEmail }}
    </p>

    <p>
        Silakan balas email ini jika ingin menghubungi perusahaan.
    </p>

    <p>
        Hormat kami,<br>
        {{ $companyName }}
    </p>
</body>
</html>
