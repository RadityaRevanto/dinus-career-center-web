<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Interview — {{ $resultLabel ?? 'Hasil' }}</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111827; line-height:1.6; margin:0; padding:24px;">
    <p>Halo {{ $pelamarName }},</p>

    @php
        $isAccepted = ($result ?? '') === 'accepted';
        $statusLabel = $resultLabel ?? ($isAccepted ? 'Diterima' : 'Ditolak');
        $statusColor = $isAccepted ? '#059669' : '#e11d48';
        $statusBg = $isAccepted ? '#ecfdf5' : '#fff1f2';
    @endphp

    <p style="margin:20px 0;">
        <strong>Status Hasil Interview:</strong>
        <span style="display:inline-block; margin-top:8px; padding:8px 16px; border-radius:8px; font-weight:bold; color:{{ $statusColor }}; background:{{ $statusBg }};">
            {{ $statusLabel }}
        </span>
    </p>

    @if($isAccepted)
        <p>
            Selamat, berdasarkan hasil interview untuk posisi <strong>{{ $position }}</strong> di <strong>{{ $companyName }}</strong>, Anda dinyatakan <strong>diterima</strong>.
        </p>
    @else
        <p>
            Terima kasih sudah mengikuti proses interview untuk posisi <strong>{{ $position }}</strong> di <strong>{{ $companyName }}</strong>.
            Saat ini Anda <strong>ditolak</strong> dan belum dapat kami lanjutkan ke tahap berikutnya.
        </p>
    @endif

    @if(!empty($customMessage))
        <p>
            <strong>Pesan dari perusahaan:</strong><br>
            {!! nl2br(e($customMessage)) !!}
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
