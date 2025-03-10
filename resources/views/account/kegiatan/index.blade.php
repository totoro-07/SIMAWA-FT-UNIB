@extends('account.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0" style="font-size: 1.25rem; font-weight: 600; color: #333;">Daftar Kegiatan</h5>
        <div>
            <a href="{{ route('account.kegiatan.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Tambah Kegiatan</a>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('account.kegiatan.index') }}" class="d-inline-block">
            <label for="filter_date" class="me-2">Urutkan:</label>
            <select name="filter_date" id="filter_date" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                <option value="latest" {{ request('filter_date') == 'latest' ? 'selected' : '' }}>Tanggal Terbaru</option>
                <option value="oldest" {{ request('filter_date') == 'oldest' ? 'selected' : '' }}>Tanggal Terlama</option>
            </select>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">No</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Nama Kegiatan</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Jenis Kegiatan</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Lokasi</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Tanggal Mulai</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Tanggal Selesai</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Penyelenggara</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Deskripsi</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatan as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kegiatan }}</td>
                        <td>{{ $item->jenis_kegiatan }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}</td>
                        <td>{{ $item->penyelenggara }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td class="text-center">
                            @if($item->status == 'pending')
                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                            @elseif($item->status == 'approved')
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
            {{ $kegiatan->links('pagination::bootstrap-5') }}
        </div>        
    </div>
</div>
@endsection
