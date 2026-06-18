<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Review Lamaran</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111827; line-height:1.6;">
    <p>Halo {{ $pelamarName }},</p>

    @if($result === 'accepted')
        <p>
            Selamat, lamaran Anda untuk posisi <strong>{{ $position }}</strong> di <strong>{{ $companyName }}</strong> telah <strong>diterima</strong> pada tahap review dokumen.
            Tim kami akan menghubungi Anda untuk proses interview selanjutnya.
        </p>
    @else
        <p>
            Terima kasih atas minat Anda melamar posisi <strong>{{ $position }}</strong> di <strong>{{ $companyName }}</strong>.
            Setelah melakukan review dokumen, saat ini lamaran Anda belum dapat kami lanjutkan ke tahap berikutnya.
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
