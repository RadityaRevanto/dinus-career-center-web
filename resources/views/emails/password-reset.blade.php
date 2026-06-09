<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111827; line-height:1.6;">
    <p>Halo {{ $userName }},</p>

    <p>
        Kami menerima permintaan untuk mengatur ulang password akun Dinus Career Center Anda.
    </p>

    <p>
        Klik link berikut untuk membuat password baru:
    </p>

    <p>
        <a href="{{ $resetLink }}" style="color:#2563eb;">Reset Password Saya</a>
    </p>

    <p>
        Jika tombol/link tidak berfungsi, salin dan tempel URL berikut ke browser Anda:<br>
        {{ $resetLink }}
    </p>

    <p>
        Link ini berlaku terbatas. Jika Anda tidak meminta reset password, abaikan email ini.
    </p>

    <p>
        Hormat kami,<br>
        Dinus Career Center
    </p>
</body>
</html>
