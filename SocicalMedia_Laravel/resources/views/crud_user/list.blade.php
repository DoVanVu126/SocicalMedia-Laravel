@extends('dashboard')

@section('content')
<div class="card mb-4 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <div>
            <a href="#" class="text-white text-decoration-none me-3">🏠 Home</a>
            <a href="{{ route('notifications.index') }}" class="text-white text-decoration-none me-3">🔔 Thông báo</a>
            <a href="{{ route('signout') }}" class="text-white fw-bold text-decoration-none">🚪 Đăng xuất</a>
        </div>
        @if(Auth::check())
            <div class="text-end">
                <span class="fw-bold">👤 Tài khoản:</span> {{ Auth::user()->username }}
            </div>
        @endif
    </div>
</div>

<main class="container">
    <h3 class="fw-bold text-center mb-4">📋 Danh sách tài khoản</h3>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>#</th>
                    <th>👤 Username</th>
                    <th>📧 Email</th>
                    <th>⚙️ Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.updateUser', ['id' => $user->id]) }}" class="btn btn-sm btn-warning me-1">
                                ✏️ Sửa
                            </a>
                            <a href="{{ route('user.readUser', ['id' => $user->id]) }}" class="btn btn-sm btn-info me-1 text-white">
                                👁️ Xem
                            </a>
                            <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xoá tài khoản này?')">
                                🗑️ Xoá
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
    {{ $users->links() }}
</div>



</main>
@endsection
