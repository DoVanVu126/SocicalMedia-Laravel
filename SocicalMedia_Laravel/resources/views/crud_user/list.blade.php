@extends('dashboard')

@section('content')
<div class="card mb-4 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 px-4 rounded-top">
        <div>
            <a href="#" class="text-white text-decoration-none me-4">🏠 Trang chủ</a>
            <a href="{{ route('notifications.index') }}" class="text-white text-decoration-none me-4">🔔 Thông báo</a>
            <a href="{{ route('signout') }}" class="text-white fw-bold text-decoration-none">🚪 Đăng xuất</a>
        </div>
        @if(Auth::check())
    <div class="d-flex align-items-center">
        <div class="me-2"> Tài khoản:
            <img
                src="{{ asset(Auth::user()->profilepicture ?? 'image/default.jpg') }}"
                onerror="this.onerror=null;this.src='{{ asset('image/default.jpg') }}';"
                alt="Avatar"
                class="rounded-circle border border-light shadow-sm"
                style="object-fit: cover; width: 50px; height: 50px;"
            >
        </div>
        <span class="fw-semibold text-white"> {{ Auth::user()->username }}</span>
    </div>
@endif
    </div>
</div>

<main class="container">
    <h3 class="fw-bold text-center mb-4 text-primary">📋 Danh sách tài khoản</h3>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>#</th>
                    <th>👤 Tên người dùng</th>
                    <th>📧 Email</th>
                    <th>🖼 Ảnh đại diện</th>
                    <th>⚙️ Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr class="text-center align-middle">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img src="{{ asset($user->profilepicture ?? 'image/default.jpg') }}" alt="avatar" class="rounded-circle" width="40" height="40">
                        </td>
                        <td>
                            <a href="{{ route('user.readUser', ['id' => $user->id]) }}" class="btn btn-sm btn-info me-1 text-white">
                                👁️ Xem
                            </a>
                            <a href="{{ route('user.updateUser', ['id' => $user->id]) }}" class="btn btn-sm btn-warning me-1">
                                ✏️ Sửa
                            </a>
                            <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}" class="btn btn-sm btn-danger"
                               onclick="return confirm('Bạn có chắc muốn xoá tài khoản này?')">
                                🗑️ Xoá
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>
</main>
@endsection
