<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #eff6ff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelamar</th>
                <th>Email</th>
                <th>NIM</th>
                <th>Bidang</th>
                <th>Posisi Dilamar</th>
                <th>Status</th>
                <th>Tanggal Melamar</th>
                <th>CV</th>
                <th>Portofolio</th>
                <th>Surat Lamaran</th>
                <th>Transkrip Nilai</th>
                <th>Pas Foto</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lamaran as $index => $l)
                @php
                    $pelamar = $l['pelamar'] ?? [];
                    $lowongan = $l['lowongan'] ?? [];
                    $berkas = $l['berkas'] ?? [];
                    $statusLabels = [
                        'applied' => 'Applied',
                        'reviewed' => 'Reviewed',
                        'interview' => 'Interview',
                        'completed' => 'Completed',
                    ];
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pelamar['nama_lengkap'] ?? '-' }}</td>
                    <td>{{ $pelamar['email'] ?? '-' }}</td>
                    <td>{{ $pelamar['nim'] ?? '-' }}</td>
                    <td>{{ $pelamar['bidang'] ?? '-' }}</td>
                    <td>{{ $lowongan['judul'] ?? '-' }}</td>
                    <td>{{ $statusLabels[$l['status_terakhir'] ?? ''] ?? ($l['status_terakhir'] ?? '-') }}</td>
                    <td>{{ !empty($l['created_at']) ? \Carbon\Carbon::parse($l['created_at'])->format('d/m/Y H:i') : '-' }}</td>
                    <td>{{ !empty($berkas['cv']) ? 'Ada' : 'Tidak Ada' }}</td>
                    <td>{{ !empty($berkas['portofolio']) ? 'Ada' : 'Tidak Ada' }}</td>
                    <td>{{ !empty($berkas['surat_lamaran']) ? 'Ada' : 'Tidak Ada' }}</td>
                    <td>{{ !empty($berkas['transkip_nilai']) ? 'Ada' : 'Tidak Ada' }}</td>
                    <td>{{ !empty($berkas['pas_foto']) ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13">Belum ada pelamar yang masuk</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
