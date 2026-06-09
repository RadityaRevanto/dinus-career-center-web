<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Verifikasi Perusahaan</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111827; line-height:1.6;">
    <p>Halo {{ $namaPerusahaan }},</p>

    @if($status === 'accepted')
        <p>
            Akun perusahaan Anda di Dinus Career Center telah diverifikasi.
        </p>
        <p>
            Sekarang Anda sudah bisa login dan mulai memposting lowongan kerja untuk merekrut kandidat terbaik.
        </p>
        <p>
            Login: {{ url('/login') }}
        </p>
    @else
        <p>
            Akun perusahaan Anda di Dinus Career Center ditolak.
        </p>

        @if(!empty($alasanPenolakan))
            <p>
                Alasan penolakan:<br>
                {{ $alasanPenolakan }}
            </p>
        @endif

        <p>
            Silakan perbaiki data atau hubungi admin Dinus Career Center jika memerlukan bantuan lebih lanjut.
        </p>
    @endif

    <p>
        Hormat kami,<br>
        Dinus Career Center<br>
        Universitas Dian Nuswantoro
    </p>
</body>
</html>
