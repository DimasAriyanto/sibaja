<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <title>{{ env('APP_NAME') }} | Login</title>
</head>


<body>
    <div class="container d-flex align-items-center justify-content-center">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('LoginFailed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('LoginFailed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card login-form shadow">
            <div class="card-body">
                <h2 class="card-title">Login</h2>

                <form acton="{{ route('auth.post-login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nik" class="form-label">nik*</label>
                        <input type="nik" name="nik" class="form-control" @error('nik') is-invalid @enderror
                            id="nik" placeholder="Enter Your nik..." autofocus required
                            value={{ old('nik') }}>
                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password*</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Enter Your Password...">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
