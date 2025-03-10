@extends('admin.dashboard')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0" style="font-size: 1.25rem; font-weight: 600; color: #333;">Daftar Penerima Beasiswa</h5>
        <div>
            <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary btn-sm"><i
                    class="bi bi-plus-circle"></i> Tambah Penerima Beasiswa</a>
            {{-- <a href="{{ route('admin.beasiswa.download') }}" class="btn btn-secondary btn-sm"><i
                    class="bi bi-download"></i> Download Data Beasiswa (PDF)</a> --}}
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <form method="GET" action="{{ route('admin.beasiswa.index') }}" class="d-inline-block">
                <label for="filter_date" class="me-2">Urutkan:</label>
                <select name="filter_date" id="filter_date" class="form-select form-select-sm d-inline-block w-auto"
                    onchange="this.form.submit()">
                    <option value="latest" {{ request('filter_date')=='latest' ? 'selected' : '' }}>Tanggal Terbaru
                    </option>
                    <option value="oldest" {{ request('filter_date')=='oldest' ? 'selected' : '' }}>Tanggal Terlama
                    </option>
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
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Nama Penerima</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Program Studi</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Nama Beasiswa</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Keterangan</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Tanggal Menerima</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Tanggal Melapor</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Bukti Beasiswa</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Status</th>
                        <th class="text-center" style="font-weight: 500; font-size: 0.7rem;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beasiswas as $beasiswa)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $beasiswa->npm }}</td>
                        <td>{{ $beasiswa->nama_penerima }}</td>
                        <td>{{ $beasiswa->prodi }}</td>
                        <td>{{ $beasiswa->nama_beasiswa }}</td>
                        <td>{{ $beasiswa->keterangan }}</td>
                        <td class="text-center">
                            @if($beasiswa->tanggal_menerima)
                            {{ \Carbon\Carbon::parse($beasiswa->tanggal_menerima)->format('d M Y') }}
                            @else
                            <span>-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($beasiswa->created_at || $beasiswa->updated_at)
                                {{ \Carbon\Carbon::parse($beasiswa->created_at ?? $beasiswa->updated_at)->format('d M Y') }}
                            @else
                                <span>-</span>
                            @endif
                        </td>                        
                        <td class="text-center">
                            @if($beasiswa->bukti_beasiswa)
                            <a href="{{ asset('storage/' . $beasiswa->bukti_beasiswa) }}" target="_blank"
                                class="btn btn-sm btn-info">
                                <i class="bi bi-file-earmark-pdf"></i> Lihat Bukti
                            </a>
                            @else
                            <span>-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($beasiswa->status_verifikasi == 'terverifikasi')
                            <span class="badge bg-success">Terverifikasi</span>
                            @else
                            <span class="badge bg-warning text-dark">Belum Terverifikasi</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.beasiswa.edit', $beasiswa->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.beasiswa.destroy', $beasiswa->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus Beasiswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i>
                                    Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $beasiswas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection