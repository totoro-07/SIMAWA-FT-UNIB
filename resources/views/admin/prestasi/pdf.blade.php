<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prestasi Mahasiswa</title>
    <style>
        @page {
            margin: 20px; /* Atur margin sesuai kebutuhan */
        }
        body {
            font-size: 12px; /* Pastikan ukuran font cukup kecil agar semua muat */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
            word-wrap: break-word; /* Hindari konten keluar dari sel */
        }
        th {
            background-color: #f4f4f4;
        }
    </style>    
</head>
<body>
    <h3>Data Prestasi Mahasiswa</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Program Studi</th>
                <th>Nama Perlombaan</th>
                <th>Juara</th>
                <th>Tingkat Perlombaan</th>
                <th>Tanggal Pelaporan</th>
                <th>Sertifikat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestasis as $prestasi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $prestasi->npm }}</td>
                <td>{{ $prestasi->nama_mahasiswa }}</td>
                <td>{{ $prestasi->program_studi }}</td>
                <td>{{ $prestasi->nama_perlombaan }}</td>
                <td>{{ $prestasi->juara }}</td>
                <td>{{ $prestasi->tingkat_perlombaan }}</td>
                <td>{{ \Carbon\Carbon::parse($prestasi->tanggal_pelaporan)->format('d-m-Y') }}</td>
                <td>
                    @if($prestasi->sertifikat)
                        <a href="{{ asset('storage/sertifikat/' . $prestasi->sertifikat) }}" target="_blank">Lihat Sertifikat</a>
                    @else
                        Tidak Ada
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center;">Data prestasi tidak tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
