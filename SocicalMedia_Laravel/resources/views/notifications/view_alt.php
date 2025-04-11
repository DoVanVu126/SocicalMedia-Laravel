<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông báo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f4f7;
            font-family: 'Segoe UI', sans-serif;
        }

        .notification-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 15px;
            transition: all 0.2s ease-in-out;
        }

        .notification-card:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }

        .notification-card img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        .notification-content {
            flex: 1;
        }

        .notification-content strong {
            color: #0d6efd;
        }

        .notification-time {
            font-size: 0.85rem;
            color: #888;
        }

        .nav-tabs .nav-link.active {
            font-weight: bold;
            background-color: #ffffff;
            border-bottom: 3px solid #0d6efd;
        }

        .notification-link {
            text-decoration: none;
            color: inherit;
        }

        .notification-link:hover {
            text-decoration: none;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1055;
        }
    </style>
</head>
<body class="p-4">

<!-- Toast thông báo -->
<div class="toast-container">
    <div id="toast-notification" class="toast align-items-center text-bg-primary border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center">
                <i class="fas fa-bell me-2"></i>
                <span id="toast-body">Bạn có thông báo mới!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<div class="container">
    <h3 class="mb-4"><i class="fas fa-bell text-primary"></i> Thông báo mới nhất</h3>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ !request()->has('unread') ? 'active' : '' }}" href="{{ route('notifications.index') }}">Tất cả</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->get('unread') == 1 ? 'active' : '' }}" href="{{ route('notifications.index', ['unread' => 1]) }}">Chưa đọc</a>
        </li>
    </ul>

    <!-- Danh sách thông báo -->
    @forelse($notifications as $notification)
        <a href="{{ route('notifications.show', $notification->id) }}" class="notification-link">
            <div class="notification-card">
                <img src="https://via.placeholder.com/50" alt="Avatar">
                <div class="notification-content">
                    <strong>{{ $notification->user->username ?? 'Người dùng ẩn danh' }}</strong><br>
                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($notification->notification_content, 100) }}</p>
                    <div class="notification-time">
                        <i class="far fa-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </a>
    @empty
        <div class="alert alert-warning">Không có thông báo nào.</div>
    @endforelse
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const toastEl = document.getElementById('toast-notification');
    const toastBootstrap = new bootstrap.Toast(toastEl, { delay: 5000 });

    function checkNewNotification() {
        fetch("{{ route('notifications.check') }}")
            .then(response => response.json())
            .then(data => {
                if (data.hasNotification) {
                    document.getElementById('toast-body').textContent = data.content;
                    toastBootstrap.show();
                }
            });
    }

    // Kiểm tra mỗi 10 giây
    setInterval(checkNewNotification, 10000);
</script>

</body>
</html>
