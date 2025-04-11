@extends('dashboard')

@section('content')

<div class="card-header text-center mt-3">
    <a href="#" class="text-dark text-decoration-none mx-2">Home</a> |
    <a href="{{ route('login') }}" class="text-dark text-decoration-none mx-2">Đăng nhập</a> |
    <a href="{{ route('user.createUser') }}" class="text-dark text-decoration-none fw-bold mx-2">Đăng ký</a>
</div>
    <main class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container text-center">
            <div class="card shadow rounded-3 p-4 mx-auto mt-5" style="width: 600px;">
                <h3 class="text-center fw-bold">Màn hình cập nhật</h3>
                <div class="card-body">
                    <form action="{{ route('user.postUpdateUser') }}" method="POST">
                        @csrf
                        <input name="id" type="hidden" value="{{ $user->id }}">

                        <div class="mb-3 text-start">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control form-control-lg" name="username" value="{{ $user->username }}" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control form-control-lg" name="phone" value="{{ $user->phone }}" required>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-bold">Mật khẩu</label>
                            <input type="password" class="form-control form-control-lg" name="password" required>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-bold">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control form-control-lg" name="confirm_password" required>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control form-control-lg" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Đăng ký</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="#" class="text-decoration-none text-primary">Đã có tài khoản</a>
                    </div>
                </div>
            </div>

            <div class="mt-3 card-header text-center mx-2">
                <p class="text-muted">Lập trình web © 01/2024</p>
            </div>
        </div>
    </main>
@endsection
