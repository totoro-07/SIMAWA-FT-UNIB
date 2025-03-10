@extends('admin.dashboard')

@section('content')

<h1 class="mb-4">Daftar Berita</h1>

<a href="{{ route('admin.berita.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>

<!-- Section Prestasi Mahasiswa -->
<section class="news-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Prestasi Mahasiswa</h2>
        <div class="row g-4">
            @foreach ($prestasi as $item)
            <div class="col-md-4">
                <div class="news-card">
                    <div class="news-img">
                        @if ($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="Berita" class="img-fluid">
                        @endif
                        <div class="news-date">
                            <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                            <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <h3>{{ $item->judul }}</h3>
                        <p>{{ Str::limit($item->konten, 100) }}</p>
                        @if ($item->link)
                                <a href="{{ $item->link }}" class="news-btn" target="_blank">Lihat Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                            @else
                                <a href="{{ route('admin.berita.show', $item->id) }}" class="news-btn">Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                            @endif
                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">Hapus</button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section Beasiswa -->
<section class="news-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Beasiswa</h2>
        <div class="row g-4">
            @foreach ($beasiswa as $item)
            <div class="col-md-4">
                <div class="news-card">
                    <div class="news-img">
                        @if ($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="Berita" class="img-fluid">
                        @endif
                        <div class="news-date">
                            <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                            <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <h3>{{ $item->judul }}</h3>
                        <p>{{ Str::limit($item->konten, 100) }}</p>
                        @if ($item->link)
                                <a href="{{ $item->link }}" class="news-btn" target="_blank">Lihat Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                            @else
                                <a href="{{ route('admin.berita.show', $item->id) }}" class="news-btn">Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                            @endif
                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section Kegiatan Mahasiswa -->
<section class="news-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Kegiatan Mahasiswa</h2>
        <div class="row g-4">
            @foreach ($kegiatan as $item)
            <div class="col-md-4">
                <div class="news-card">
                    <div class="news-img">
                        @if ($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="Berita" class="img-fluid">
                        @endif
                        <div class="news-date">
                            <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                            <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <h3>{{ $item->judul }}</h3>
                        <p>{{ Str::limit($item->konten, 100) }}</p>
                        @if ($item->link)
                                <a href="{{ $item->link }}" class="news-btn" target="_blank">Lihat Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                            @else
                                <a href="{{ route('admin.berita.show', $item->id) }}" class="news-btn">Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                            @endif
                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection