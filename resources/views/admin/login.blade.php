<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                    <div class="card border border-light-subtle rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                    @endif
                                    @if(Session::has('error'))
                                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                    @endif
                                    <div class="mb-5">
                                        <h4 class="text-center">Admin Login Here</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('admin.authenticate') }}" method="post">
                                @csrf
                                <div class="row gy-3 overflow-hidden">
                                    <!-- NIP Input -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                                name="nip" id="nip" placeholder="Masukkan NIP" required>
                                            <label for="nip" class="form-label">NIP</label>
                                            @error('nip')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Password Input -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" placeholder="Masukkan Password" required>
                                            <label for="password" class="form-label">Password</label>
                                            @error('password')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary py-3" type="submit">Login</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-5 mb-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center">
                                        <a href="{{ route('admin.register') }}" class="text-primary">Register Akun
                                            Admin</a> |
                                        <a href="{{ route('admin.request') }}" class="text-primary">Lupa
                                            Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>