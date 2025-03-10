@extends('admin.dashboard')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0" style="font-size: 1.25rem; font-weight: 600; color: #333;">Daftar Kegiatan</h5>
        <div>
            <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary btn-sm me-2"><i class="bi bi-plus-circle"></i> Tambah Kegiatan</a>
            {{-- <a href="{{ route('admin.kegiatan.download') }}" class="btn btn-secondary btn-sm"><i class="bi bi-download"></i> Download Data Kegiatan (PDF)</a> --}}
        </div>
    </div>    
    <div class="card-body">
        <form method="GET" action="{{ route('admin.kegiatan.index') }}" class="d-inline-block">
            <label for="filter_date" class="me-2">Urutkan:</label>
            <select name="filter_date" id="filter_date" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                <option value="latest" {{ request('filter_date') == 'latest' ? 'selected' : '' }}>Tanggal Terbaru</option>
                <option value="oldest" {{ request('filter_date') == 'oldest' ? 'selected' : '' }}>Tanggal Terlama</option>
            </select>
        </form>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">No</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Nama Kegiatan</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Jenis Kegiatan</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Lokasi</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Tanggal Mulai</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Tanggal Selesai</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Tanggal Melapor</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Deskripsi</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Gambar</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Status Verifikasi</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Aksi</th>
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
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td class="text-center">
                            @if($item->gambar)
                            <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank"
                                class="btn btn-sm btn-info">
                                <i class="bi bi-file-earmark-pdf"></i> Lihat Brosur
                            </a>
                            @else
                            <span>-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status == 'pending')
                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                            @elseif($item->status == 'approved')
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>                                        
                        <td class="text-center">
                            <a href="{{ route('admin.kegiatan.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('admin.kegiatan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
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
