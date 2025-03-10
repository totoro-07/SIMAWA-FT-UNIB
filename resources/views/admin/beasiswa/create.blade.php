@extends('admin.dashboard')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0" style="font-size: 1.25rem; font-weight: 600; color: #333;">Tambah Penerima Beasiswa</h5>
        <a href="{{ route('admin.beasiswa.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.beasiswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- NPM -->
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" id="npm" name="npm"
                    class="form-control @error('npm') is-invalid @enderror"
                    value="{{ old('npm') }}">
                @error('npm')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Penerima -->
            <div class="mb-3">
                <label for="nama_penerima" class="form-label">Nama Penerima</label>
                <input type="text" id="nama_penerima" name="nama_penerima"
                    class="form-control @error('nama_penerima') is-invalid @enderror"
                    value="{{ old('nama_penerima') }}">
                @error('nama_penerima')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Program Studi -->
            <div class="mb-3">
                <label for="prodi" class="form-label">Program Studi</label>
                <input type="text" id="prodi" name="prodi"
                    class="form-control @error('prodi') is-invalid @enderror"
                    value="{{ old('prodi') }}">
                @error('prodi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Semester -->
            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <input type="number" id="semester" name="semester"
                    class="form-control @error('semester') is-invalid @enderror"
                    value="{{ old('semester') }}">
                @error('semester')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Beasiswa -->
            <div class="mb-3">
                <label for="nama_beasiswa" class="form-label">Nama Beasiswa</label>
                <input type="text" id="nama_beasiswa" name="nama_beasiswa"
                    class="form-control @error('nama_beasiswa') is-invalid @enderror"
                    value="{{ old('nama_beasiswa') }}">
                @error('nama_beasiswa')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_menerima" class="form-label">Tanggal Menerima</label>
                <input type="date" id="tanggal_menerima" name="tanggal_menerima"
                    class="form-control @error('tanggal_menerima') is-invalid @enderror"
                    value="{{ old('tanggal_menerima') }}">
                @error('tanggal_menerima')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea id="keterangan" name="keterangan"
                    class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bukti Beasiswa -->
            <div class="mb-3">
                <label for="bukti_beasiswa" class="form-label">Bukti Beasiswa</label>
                <input type="file" id="bukti_beasiswa" name="bukti_beasiswa"
                    class="form-control @error('bukti_beasiswa') is-invalid @enderror">
                @error('bukti_beasiswa')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Tambah Penerima Beasiswa</button>
        </form>
    </div>
</div>
@endsection
