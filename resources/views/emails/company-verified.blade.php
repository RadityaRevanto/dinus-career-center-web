<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Poppins', Arial, sans-serif; background: #f1f5f9; margin: 0; padding: 40px 0; }
        .container { max-width: 560px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { padding: 40px; text-align: center; background: {{ $status === 'accepted' ? '#059669' : '#e11d48' }}; }
        .header h1 { color: white; margin: 0; font-size: 22px; }
        .body { padding: 40px; }
        .body p { color: #475569; line-height: 1.7; font-size: 15px; }
        .badge { display: inline-block; padding: 8px 20px; border-radius: 999px; font-weight: 600; font-size: 14px;
            background: {{ $status === 'accepted' ? '#d1fae5' : '#ffe4e6' }};
            color: {{ $status === 'accepted' ? '#065f46' : '#9f1239' }};
        }
        .btn { display: inline-block; margin-top: 24px; padding: 12px 28px; background: #2563eb; color: white; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; }
        .footer { padding: 24px 40px; background: #f8fafc; text-align: center; color: #94a3b8; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $status === 'accepted' ? '🎉 Selamat!' : '😔 Mohon Maaf' }}</h1>
        </div>
        <div class="body">
            <p>Halo <strong>{{ $namaPerusahaan }}</strong>,</p>

            @if($status === 'accepted')
            <p>Akun perusahaan Anda di <strong>Dinus Career Center</strong> telah <span class="badge">Diverifikasi</span></p>
            <p>Sekarang Anda sudah bisa login dan mulai memposting lowongan kerja untuk merekrut kandidat terbaik.</p>
            <a href="{{ url('/login') }}" class="btn">Login Sekarang →</a>
            @else
            <p>Akun perusahaan Anda di <strong>Dinus Career Center</strong> <span class="badge">Ditolak</span></p>
            <p>Silakan hubungi admin untuk informasi lebih lanjut mengenai alasan penolakan.</p>
            @endif
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Dinus Career Center — Universitas Dian Nuswantoro</p>
        </div>
    </div>
</body>
</html>
