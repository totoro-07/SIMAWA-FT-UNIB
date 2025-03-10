@extends('admin.dashboard')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0" style="font-size: 1.25rem; font-weight: 600; color: #333;">Daftar Prestasi Mahasiswa</h5>
        <div>
            <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Tambah Prestasi</a>
            {{-- <a href="{{ route('admin.prestasi.download') }}" class="btn btn-secondary btn-sm"><i class="bi bi-download"></i> Download Data Prestasi (PDF)</a> --}}
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <form method="GET" action="{{ route('admin.prestasi.index') }}" class="d-inline-block">
                <label for="filter_date" class="me-2">Urutkan:</label>
                <select name="filter_date" id="filter_date" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                    <option value="latest" {{ request('filter_date') == 'latest' ? 'selected' : '' }}>Tanggal Terbaru</option>
                    <option value="oldest" {{ request('filter_date') == 'oldest' ? 'selected' : '' }}>Tanggal Terlama</option>
                </select>
            </form>
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">No</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">NPM</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Nama Mahasiswa</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Program Studi</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Nama Perlombaan</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Juara</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Tingkat Perlombaan</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Tanggal Perlombaan</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Tanggal Pelaporan</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Sertifikat</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Status</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Aksi</th>
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
                        <td>{{ \Carbon\Carbon::parse($prestasi->created_at)->format('d M Y') }}</td>
                        <td class="text-center">
                            @if($prestasi->sertifikat)
                                <a href="{{ asset('storage/sertifikat/' . $prestasi->sertifikat) }}" target="_blank" class="btn btn-sm btn-info"><i class="bi bi-file-earmark-pdf"></i> Lihat Sertifikat</a>
                            @else
                                <span class="text-muted">Tidak Ada Sertifikat</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($prestasi->status == 'pending')
                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                            @elseif($prestasi->status == 'approved')
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>                    
                        <td class="text-center">
                            <a href="{{ route('admin.prestasi.edit', $prestasi->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('admin.prestasi.destroy', $prestasi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
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
            {{ $prestasis->links('pagination::bootstrap-5') }}
        </div>        
    </div>
</div>
@endsection
