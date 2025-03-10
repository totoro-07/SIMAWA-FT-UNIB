@extends('account.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Prestasi Mahasiswa</h5>
        <div>
            <a href="{{ route('account.prestasi.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Laporkan Prestasi </a>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('account.prestasi') }}" class="mb-4">
            <label for="filter_date">Urutkan berdasarkan:</label>
            <select name="filter_date" id="filter_date" onchange="this.form.submit()">
                <option value="newest" {{ request('filter_date') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ request('filter_date') == 'oldest' ? 'selected' : '' }}>Terlama</option>
            </select>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">NPM</th>
                        <th class="text-center">Nama Mahasiswa</th>
                        <th class="text-center">Program Studi</th>
                        <th class="text-center">Nama Perlombaan</th>
                        <th class="text-center">Juara</th>
                        <th class="text-center">Tingkat Perlombaan</th>
                        <th class="text-center">Tanggal Perlombaan</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestasis as $prestasi)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $prestasi->npm }}</td>
                        <td>{{ $prestasi->nama_mahasiswa }}</td>
                        <td>{{ $prestasi->program_studi }}</td>
                        <td>{{ $prestasi->nama_perlombaan }}</td>
                        <td>{{ $prestasi->juara }}</td>
                        <td>{{ $prestasi->tingkat_perlombaan }}</td>
                        <td>{{ \Carbon\Carbon::parse($prestasi->tanggal_pelaporan)->format('d M Y') }}</td>
                        <td class="text-center">
                            @if($prestasi->status == 'pending')
                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                            @elseif($prestasi->status == 'approved')
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $prestasis->links('pagination::bootstrap-5') }}
        </div>        
    </div>
</div>
@endsection
