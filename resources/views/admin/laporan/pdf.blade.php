<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Beasiswa</title>
</head>
<body>
    <h1>Laporan Beasiswa</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama Penerima</th>
                <th>Program Studi</th>
                <th>Nama Beasiswa</th>
                <th>Keterangan</th>
                <th>Tanggal Menerima</th>
                <th>Tanggal Melapor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beasiswas as $beasiswa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $beasiswa->npm }}</td>
                <td>{{ $beasiswa->nama_penerima }}</td>
                <td>{{ $beasiswa->prodi }}</td>
                <td>{{ $beasiswa->nama_beasiswa }}</td>
                <td>{{ $beasiswa->keterangan }}</td>
                <td>{{ \Carbon\Carbon::parse($beasiswa->tanggal_menerima)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($beasiswa->created_at)->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
