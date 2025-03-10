@extends('admin.dashboard')

@section('content')

<h1 class="mb-4">Tambah Berita</h1>

<form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="judul">Judul Berita</label>
        <input type="text" class="form-control" name="judul" id="judul" required>
    </div>

    <!-- Dropdown untuk memilih kategori -->
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <select name="kategori" id="kategori" class="form-control" required>
            <option value="prestasi">Prestasi</option>
            <option value="beasiswa">Beasiswa</option>
            <option value="kegiatan">Kegiatan Mahasiswa</option>
        </select>
    </div>

    <div class="form-group">
        <label for="konten">Konten</label>
        <textarea name="konten" id="konten" class="form-control" rows="5" required></textarea>
    </div>

    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control"required>
    </div>

    <div class="form-group">
        <label for="link">Link</label>
        <input type="url" name="link" id="link" class="form-control">
    </div>

    <!-- Input untuk gambar -->
    <div class="form-group">
        <label for="image">Gambar (Opsional)</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>

@endsection
