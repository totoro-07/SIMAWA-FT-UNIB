<!-- resources/views/admin/berita/show.blade.php -->

@extends('admin.dashboard')

@section('content')

<h1 class="mb-4">{{ $berita->judul }}</h1>

<div class="news-img">
    @if ($berita->image)
        <img src="{{ asset('storage/'.$berita->image) }}" alt="Berita" class="img-fluid">
    @endif
</div>

<p><strong>Kategori:</strong> {{ $berita->kategori }}</p>
<p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</p>

<div class="news-content">
    <p>{!! $berita->konten !!}</p>
</div>

@if ($berita->link)
    <a href="{{ $berita->link }}" target="_blank" class="btn btn-primary">Kunjungi Link</a>
@endif

<a href="{{ route('admin.berita.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Berita</a>

@endsection
