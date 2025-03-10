@extends('account.layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header">
        <h5 class="mb-0" style="font-size: 1.25rem; font-weight: 600; color: #333;">Tambah Beasiswa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('account.beasiswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="npm" name="npm" value="{{ $user->npm }}" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_penerima" class="form-label">Nama Penerima</label>
                <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" value="{{ $user->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="program_studi" class="form-label">Program Studi</label>
                <input type="text" class="form-control" id="program_studi" name="prodi" value="{{ $user->prodi }}" readonly>
            </div>
            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <input type="number" name="semester" id="semester" class="form-control" value="{{ old('semester') }}" required>
            </div>
            <div class="mb-3">
                <label for="nama_beasiswa" class="form-label">Nama Beasiswa</label>
                <input type="text" name="nama_beasiswa" id="nama_beasiswa" class="form-control" value="{{ old('nama_beasiswa') }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_menerima" class="form-label">Tanggal Menerima Beasiswa</label>
                <input type="date" id="tanggal_menerima" name="tanggal_menerima" class="form-control @error('tanggal_menerima') is-invalid @enderror" value="{{ old('tanggal_menerima') }}">
                @error('tanggal_menerima')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="bukti_beasiswa" class="form-label">Bukti Beasiswa</label>
                <input type="file" class="form-control" id="bukti_beasiswa" name="bukti_beasiswa" required>
                @error('bukti_beasiswa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('account.beasiswa.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
