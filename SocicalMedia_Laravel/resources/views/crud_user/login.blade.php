@extends('dashboard')

@section('content')
<div class="card-header text-center mt-3">
    <a href="#" class="text-dark text-decoration-none mx-2">Home</a> |
    <a href="{{ route('login') }}" class="text-dark text-decoration-none fw-bold mx-2">Đăng nhập</a> |
    <a href="{{ route('user.createUser') }}" class="text-dark text-decoration-none  mx-2">Đăng ký</a>
</div>

    <main class="login-form">
        <div class="container d-flex justify-content-center align-items-center" style="height: 90vh;">
            <div class="card shadow-lg border rounded p-4 bg-white" style="width: 600px;">
                <h2 class="text-center py-3">Màn hình đăng nhập</h2>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.authUser') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fs-5">Email</label>
                            <input type="email" placeholder="Nhập email" id="email" class="form-control form-control-lg" name="email" required autofocus>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label fs-5">Mật khẩu</label>
                            <input type="password" placeholder="Nhập mật khẩu" id="password" class="form-control form-control-lg" name="password" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                            <label class="form-check-label fs-5" for="rememberMe">Ghi nhớ đăng nhập</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Đăng nhập</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" class="fs-5">Quên mật khẩu?</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="card-header text-center mt-3 text-muted fs-6">
        Lập trình web @012024
    </div>
@endsection
