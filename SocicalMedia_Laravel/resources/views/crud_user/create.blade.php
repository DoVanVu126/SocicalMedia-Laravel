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
                <form action="{{ route('user.postUser') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ và tên</label>
                        <input type="text" placeholder="Nhập họ và tên" id="username" class="form-control form-control-lg" name="username" required autofocus>
                        @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">sdt</label>
                        <input type="text" placeholder="Nhập họ và tên" id="phone" class="form-control form-control-lg" name="phone" required autofocus>
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" placeholder="Nhập email" id="email_address" class="form-control form-control-lg" name="email" required>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mật khẩu</label>
                        <input type="password" placeholder="Nhập mật khẩu" id="password" class="form-control form-control-lg" name="password" required>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
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
