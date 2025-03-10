<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMAWA - Sistem Informasi Mahasiswa</title>
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
                                    <div class="mb-5">
                                        <h4 class="text-center">Register Mahasiswa</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('account.register.process') }}" method="post">
                                @csrf
                                <div class="row gy-3 overflow-hidden">

                                    <!-- Nama input -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" placeholder="Nama Lengkap"
                                                value="{{ old('name') }}" required>
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- NPM input -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('npm') is-invalid @enderror"
                                                name="npm" id="npm" placeholder="NPM" value="{{ old('npm') }}" required>
                                            <label for="npm" class="form-label">NPM</label>
                                            @error('npm')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Program Studi input -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="prodi" id="prodi"
                                                placeholder="Program Studi" required>
                                            <label for="prodi" class="form-label">Program Studi</label>
                                        </div>
                                    </div>

                                    <!-- Password input -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" required>
                                            <label for="password" class="form-label">Password</label>
                                        </div>
                                    </div>

                                    <!-- Confirm Password input -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation" placeholder="Konfirmasi Password" required>
                                            <label for="password_confirmation" class="form-label">Konfirmasi
                                                Password</label>
                                        </div>
                                    </div>

                                    <!-- Submit button -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100">Register</button>
                                    </div>
                                </div>
                            </form>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <hr class="mb-4">
                                    <p class="small">
                                        Sudah memiliki akun?
                                        <a href="{{ route('account.login') }}" class="text-primary">Login di sini</a>
                                    </p>
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