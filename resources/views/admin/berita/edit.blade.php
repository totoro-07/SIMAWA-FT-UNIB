<!-- resources/views/admin/berita/edit.blade.php -->

@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Edit Berita</h1>

    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Method spoofing untuk PUT karena form HTML hanya mendukung GET dan POST -->

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" id="judul" value="{{ old('judul', $berita->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="konten" class="form-label">Konten</label>
            <textarea name="konten" class="form-control" id="konten" rows="4" required>{{ old('konten', $berita->konten) }}</textarea>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="form-control" id="kategori" value="{{ old('kategori', $berita->kategori) }}" required>
                <option value="prestasi">Prestasi</option>
                <option value="beasiswa">Beasiswa</option>
                <option value="kegiatan">Kegiatan Mahasiswa</option>
            </select>
        </div>
    

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ old('tanggal', $berita->tanggal) }}" required>
        </div>

        <div class="form-group">
            <label for="link">Link</label>
            <input type="url" name="link" id="link" class="form-control"id="link" value="{{ old('link', $berita->link) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="image">
            @if ($berita->image)
                <img src="{{ asset('storage/'.$berita->image) }}" alt="Image" class="img-thumbnail mt-2" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Berita</button>
    </form>
</div>
@endsection
