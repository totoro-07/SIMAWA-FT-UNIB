@extends('admin.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Prestasi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control @error('npm') is-invalid @enderror" id="npm" name="npm" value="{{ old('npm', $prestasi->npm) }}">
                @error('npm')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $prestasi->nama_mahasiswa) }}">
                @error('nama_mahasiswa')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="program_studi" class="form-label">Program Studi</label>
                <input type="text" class="form-control @error('program_studi') is-invalid @enderror" id="program_studi" name="program_studi" value="{{ old('program_studi', $prestasi->program_studi) }}">
                @error('program_studi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_perlombaan" class="form-label">Nama Perlombaan</label>
                <input type="text" class="form-control @error('nama_perlombaan') is-invalid @enderror" id="nama_perlombaan" name="nama_perlombaan" value="{{ old('nama_perlombaan', $prestasi->nama_perlombaan) }}">
                @error('nama_perlombaan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="juara" class="form-label">Juara</label>
                <input type="text" class="form-control @error('juara') is-invalid @enderror" id="juara" name="juara" value="{{ old('juara', $prestasi->juara) }}">
                @error('juara')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tingkat_perlombaan" class="form-label">Tingkat Perlombaan</label>
                <select class="form-select @error('tingkat_perlombaan') is-invalid @enderror" id="tingkat_perlombaan" name="tingkat_perlombaan">
                    <option value="">Pilih Tingkat</option>
                    <option value="Universitas" {{ old('tingkat_perlombaan', $prestasi->tingkat_perlombaan) == 'Universitas' ? 'selected' : '' }}>Universitas</option>
                    <option value="Provinsi" {{ old('tingkat_perlombaan', $prestasi->tingkat_perlombaan) == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                    <option value="Nasional" {{ old('tingkat_perlombaan', $prestasi->tingkat_perlombaan) == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    <option value="Internasional" {{ old('tingkat_perlombaan', $prestasi->tingkat_perlombaan) == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                </select>
                @error('tingkat_perlombaan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_pelaporan" class="form-label">Tanggal Pelaporan</label>
                <input type="date" class="form-control @error('tanggal_pelaporan') is-invalid @enderror" id="tanggal_pelaporan" name="tanggal_pelaporan" value="{{ old('tanggal_pelaporan', $prestasi->tanggal_pelaporan) }}">
                @error('tanggal_pelaporan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sertifikat" class="form-label">Sertifikat</label>
                <input type="file" name="sertifikat" id="sertifikat" class="form-control @error('sertifikat') is-invalid @enderror" accept="application/pdf,image/jpeg,image/png">
                @error('sertifikat')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if($prestasi->sertifikat)
            <div class="mb-3">
                <label class="form-label">Sertifikat Saat Ini:</label>
                <a href="{{ asset('storage/sertifikat/' . $prestasi->sertifikat) }}" target="_blank" class="d-block">Lihat Sertifikat</a>
            </div>
            @endif

            <div class="mb-3">
                <label for="status" class="form-label">Status Verifikasi</label>
                <select class="form-select" id="status" name="status">
                    <option value="pending" {{ old('status', $prestasi->status) == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="approved" {{ old('status', $prestasi->status) == 'approved' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="rejected" {{ old('status', $prestasi->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>
    </div>
</div>
@endsection
