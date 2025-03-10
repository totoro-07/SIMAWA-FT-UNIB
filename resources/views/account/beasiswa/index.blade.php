@extends('account.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0" style="font-size: 1.25rem; font-weight: 600; color: #333;">Daftar Beasiswa</h5>
        <a href="{{ route('account.beasiswa.create') }}" class="btn btn-primary" style="font-size: 0.9rem;">Laporkan Beasiswa</a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">No</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">NPM</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Nama Penerima</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Prodi</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Semester</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Nama Beasiswa</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Tanggal Menerima</th> 
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Keterangan</th>
                        <th class="text-center" style="font-weight: 600; font-size: 0.9rem;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beasiswas as $beasiswa)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $beasiswa->npm }}</td>
                        <td>{{ $beasiswa->nama_penerima }}</td>
                        <td>{{ $beasiswa->prodi }}</td>
                        <td>{{ $beasiswa->semester }}</td>
                        <td>{{ $beasiswa->nama_beasiswa }}</td>
                        <td class="text-center">
                            {{ $beasiswa->tanggal_menerima ? \Carbon\Carbon::parse($beasiswa->tanggal_menerima)->format('d-m-Y') : '-' }} <!-- Menampilkan tanggal -->
                        </td>
                        <td>{{ $beasiswa->keterangan }}</td>
                        <td class="text-center">
                            @if($beasiswa->status_verifikasi == 'terverifikasi')
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-warning text-dark">Belum Terverifikasi</span>
                            @endif
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