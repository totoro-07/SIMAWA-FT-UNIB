@extends('admin.dashboard')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>@yield('crud-title')</h3>
            @yield('crud-action')
        </div>
        <div class="card-body">
            @yield('crud-content')
        </div>
    </div>
@endsection