@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Profil Saya</h2>
    
    <!-- Card Profil -->
    <div class="card shadow-lg mx-auto my-5" style="max-width: 800px;">
        <div class="card-body text-center">
            <p class="card-text"><strong>Nama:</strong> {{ Auth::guard('admin')->user()->name }}</p>
            <p class="card-text"><strong>NIP:</strong> {{ Auth::guard('admin')->user()->nip }}</p>
            <p class="card-text"><strong>Tanggal Bergabung:</strong> {{ Auth::guard('admin')->user()->created_at->format('d M Y') }}</p>
            
            <!-- Button untuk membuka form ubah password -->
            <div class="mt-4">
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Ubah Password</button>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('account.password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
