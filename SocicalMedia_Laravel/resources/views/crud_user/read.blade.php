@extends('dashboard')

@section('content')
<div class="mb-3 card-header text-center">
    <a href="#" class="text-decoration-none text-dark mx-2">Home</a> |
    <a href="{{ route('signout') }}" class="text-decoration-none text-dark fw-bold mx-2">Đăng xuất</a>
</div>

<main class="container text-center mt-4">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="card shadow-lg p-4 rounded-3" style="width: 500px;">
            <h4 class="fw-bold text-dark mb-3">Màn hình chi tiết</h4>
            <form action="{{ route('user.updateUser', ['id' => $messi->id]) }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label for="username" class="form-label fw-bold text-dark">Username</label>
                    <input type="text" id="username" name="name" class="form-control" value="{{ $messi->name }}" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="email" class="form-label fw-bold text-dark">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $messi->email }}" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Chỉnh sửa</button>
            </form>
        </div>
    </div>

    <div class="mt-4 card-header text-center">
        <p class="text-dark fw-bold">Lập trình web © 01/2024</p>
    </div>
</main>
@endsection
