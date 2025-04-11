@extends('dashboard')

@section('content')
<div class="card-header text-center mt-3">
    <a href="#" class="text-dark text-decoration-none mx-2">Home</a> |
    <a href="{{ route('login') }}" class="text-dark text-decoration-none mx-2">Đăng nhập</a> |
    <a href="{{ route('user.createUser') }}" class="text-dark text-decoration-none fw-bold mx-2">Đăng ký</a>
</div>

    <main class="signup-form d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow rounded-3 p-4" style="width: 600px;">
            <h3 class="text-center fw-bold">Đăng ký tài khoản</h3>
            <div class="card-body">
            <form action="{{ route('user.postUser') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Họ và tên -->
    <div class="mb-3">
        <label class="form-label fw-bold">Họ và tên</label>
        <input type="text" name="username" class="form-control form-control-lg" required>
        @error('username') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- SĐT -->
    <div class="mb-3">
        <label class="form-label fw-bold">SĐT</label>
        <input type="text" name="phone" class="form-control form-control-lg" required>
        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control form-control-lg" required>
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Mật khẩu -->
    <div class="mb-3">
        <label class="form-label fw-bold">Mật khẩu</label>
        <input type="password" name="password" class="form-control form-control-lg" required>
        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Ảnh đại diện -->
    <div class="mb-3">
        <label class="form-label fw-bold">Ảnh đại diện (Tùy chọn)</label>
        <input type="file" name="profilepicture" class="form-control form-control-lg">
        @error('profilepicture') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Nút submit -->
    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">Tạo tài khoản</button>
    </div>
</form>
                <div class="text-center mt-3">
                    <a href="#" class="text-decoration-none text-primary">Quay lại đăng nhập</a>
                </div>
            </div>
        </div>
    </main>

    <div class="card-header text-center mt-3 text-muted fs-6">
        Lập trình web @012024
    </div>
@endsection
