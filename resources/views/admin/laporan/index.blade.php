@extends('admin.dashboard')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0" style="font-size: 1.25rem; font-weight: 600; color: #333;">Form Download Laporan</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.laporan.download') }}" method="GET">
            <div class="row">
                <!-- Dropdown untuk Tahun Menerima / Tahun Kegiatan -->
                {{-- <div class="col-md-4">
                    <label for="year_received">Tahun</label>
                    <select name="year_received" id="year_received" class="form-select">
                        <option value="">Pilih Tahun</option>
                        @for ($i = 2020; $i <= \Carbon\Carbon::now()->year; $i++)
                            <option value="{{ $i }}" {{ request('year_received') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div> --}}

                <!-- Dropdown untuk Tahun Melapor -->
                <div class="col-md-4">
                    <label for="year_reported">Tahun Melapor</label>
                    <select name="year_reported" id="year_reported" class="form-select">
                        <option value="">Pilih Tahun Melapor</option>
                        @for ($i = 2020; $i <= \Carbon\Carbon::now()->year; $i++)
                            <option value="{{ $i }}" {{ request('year_reported') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <!-- Dropdown untuk Urutkan Berdasarkan Tanggal -->
                <div class="col-md-4">
                    <label for="filter_date">Urutkan Berdasarkan Tanggal</label>
                    <select name="filter_date" id="filter_date" class="form-select">
                        <option value="latest" {{ request('filter_date') == 'latest' ? 'selected' : '' }}>Tanggal Terbaru</option>
                        <option value="oldest" {{ request('filter_date') == 'oldest' ? 'selected' : '' }}>Tanggal Terlama</option>
                    </select>
                </div>

                <!-- Dropdown untuk Tipe Laporan -->
                <div class="col-md-4">
                    <label for="download_type">Tipe Laporan</label>
                    <select name="download_type" id="download_type" class="form-select">
                        <option value="beasiswa" {{ request('download_type') == 'beasiswa' ? 'selected' : '' }}>Laporan Beasiswa</option>
                        <option value="prestasi" {{ request('download_type') == 'prestasi' ? 'selected' : '' }}>Laporan Prestasi</option>
                        <option value="kegiatan" {{ request('download_type') == 'kegiatan' ? 'selected' : '' }}>Laporan Kegiatan</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Download Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection
