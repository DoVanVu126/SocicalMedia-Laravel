<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông báo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .notification-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
            background-color: #f9f9f9;
        }

        .notification-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .notification-content {
            flex: 1;
        }

        .tabs {
            margin-bottom: 20px;
        }

        .is-read {
            font-size: 12px;
            font-style: italic;
        }

        .notification-link {
            text-decoration: none;
            color: inherit;
        }

        .notification-link:hover {
            background-color: #eaeaea;
            border-radius: 10px;
            transition: 0.3s;
        }
    </style>
</head>
<body class="p-4 bg-light">

<!-- Thông báo dòng trên cùng (toast) -->
<div id="toast-notification" class="toast position-fixed top-0 start-50 translate-middle-x bg-primary text-white mt-3 px-3 py-2 rounded shadow" role="alert" style="display: none; z-index: 1055;">
    <div class="toast-body" id="toast-body"></div>
</div>

    <div class="container">
        <h3 class="mb-4">🔔 Danh sách thông báo</h3>

        {{-- Tabs --}}
        <ul class="nav nav-tabs tabs">
            <li class="nav-item">
                <a class="nav-link {{ !request()->has('unread') ? 'active' : '' }}"
                   href="{{ route('notifications.index') }}">Tất cả</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->get('unread') == 1 ? 'active' : '' }}"
                   href="{{ route('notifications.index', ['unread' => 1]) }}">Chưa đọc</a>
            </li>
        </ul>

        @forelse($notifications as $notification)
            <a href="{{ route('notifications.show', $notification->id) }}" class="notification-link">
                <div class="notification-card">
                <img src="{{ $notification->user->avatar_url ?? 'https://via.placeholder.com/50' }}" alt="Avatar người gửi" width="50" height="50" class="rounded-circle me-3">

                    <div class="notification-content">
                        <strong>{{ $notification->user->username ?? 'Người dùng ẩn danh' }}</strong> <br>
                        <p>{{ \Illuminate\Support\Str::limit($notification->notification_content, 100) }}</p>
                        <span class="is-read text-{{ $notification->is_read ? 'success' : 'danger' }}">
                            {{ $notification->is_read ? 'Đã đọc' : 'Chưa đọc' }}
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="alert alert-warning">Không có thông báo nào.</div>
        @endforelse

        <a href="{{ route('notifications.create') }}" class="btn btn-primary">+ Thêm thông báo mới</a>
    </div>
    <script>
    function checkNewNotification() {
        fetch("{{ route('notifications.check') }}")
            .then(response => response.json())
            .then(data => {
                if (data.hasNotification) {
                    const toast = document.getElementById('toast-notification');
                    const body = document.getElementById('toast-body');

                    body.textContent = data.content;
                    toast.style.display = 'block';

                    // Tự động ẩn sau 5 giây
                    setTimeout(() => {
                        toast.style.display = 'none';
                    }, 5000);
                }
            });
    }

    // Gọi API mỗi 10 giây
    setInterval(checkNewNotification, 10000);
</script>

</body>
</html>
