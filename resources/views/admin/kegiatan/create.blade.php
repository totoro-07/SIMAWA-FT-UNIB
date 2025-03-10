@extends('admin.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Kegiatan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" 
                       id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}">
                @error('nama_kegiatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                <select class="form-select @error('jenis_kegiatan') is-invalid @enderror" 
                        id="jenis_kegiatan" name="jenis_kegiatan">
                    <option value="">Pilih Jenis Kegiatan</option>
                    <option value="Akademik" {{ old('jenis_kegiatan') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Non-Akademik" {{ old('jenis_kegiatan') == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                </select>
                @error('jenis_kegiatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                       id="lokasi" name="lokasi" value="{{ old('lokasi') }}">
                @error('lokasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                           id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                           id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" 
                       id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}">
                @error('penyelenggara')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
