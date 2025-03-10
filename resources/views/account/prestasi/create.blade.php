@extends('account.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header">
        <h5 class="mb-0">Laporkan Prestasi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('account.prestasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="npm" name="npm" value="{{ $user->npm }}" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ $user->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="program_studi" class="form-label">Program Studi</label>
                <input type="text" class="form-control" id="program_studi" name="program_studi" value="{{ $user->prodi }}" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_perlombaan" class="form-label">Nama Perlombaan</label>
                <input type="text" name="nama_perlombaan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="juara" class="form-label">Juara</label>
                <input type="text" name="juara" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tingkat_perlombaan" class="form-label">Tingkat Perlombaan</label>
                <select class="form-select @error('tingkat_perlombaan') is-invalid @enderror" id="tingkat_perlombaan"
                    name="tingkat_perlombaan">
                    <option value="">Pilih Tingkat</option>
                    <option value="Universitas" {{ old('tingkat_perlombaan')=='Universitas' ? 'selected' : '' }}>
                        Universitas</option>
                    <option value="Provinsi" {{ old('tingkat_perlombaan')=='Provinsi' ? 'selected' : '' }}>Provinsi
                    </option>
                    <option value="Nasional" {{ old('tingkat_perlombaan')=='Nasional' ? 'selected' : '' }}>Nasional
                    </option>
                    <option value="Internasional" {{ old('tingkat_perlombaan')=='Internasional' ? 'selected' : '' }}>
                        Internasional</option>
                </select>
                @error('tingkat_perlombaan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_pelaporan" class="form-label">Tanggal Perlombaan</label>
                <input type="date" name="tanggal_pelaporan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="sertifikat" class="form-label">Upload Sertifikat (PDF)</label>
                <input type="file" name="sertifikat" class="form-control" accept="application/pdf">
            </div>
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <button type="submit" class="btn btn-primary">Laporkan Prestasi</button>
        </form>
    </div>
</div>
@endsection