<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penerima Beasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Data Penerima Beasiswa</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama Penerima</th>
                <th>Prodi</th>
                <th>Semester</th>
                <th>Nama Beasiswa</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beasiswas as $beasiswa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $beasiswa->npm }}</td>
                <td>{{ $beasiswa->nama_penerima }}</td>
                <td>{{ $beasiswa->prodi }}</td>
                <td>{{ $beasiswa->semester }}</td>
                <td>{{ $beasiswa->nama_beasiswa }}</td>
                <td>{{ $beasiswa->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
