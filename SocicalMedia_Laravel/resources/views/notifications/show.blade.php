<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết thông báo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .notification-detail {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            background-color: #ffffff;
        }

        .notification-detail img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .header-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .header-info h5 {
            margin-bottom: 0;
        }

        .text-muted {
            font-size: 14px;
        }
    </style>
</head>
<body class="p-4 bg-light">
    <div class="container">
        <h3 class="mb-4">📄 Chi tiết thông báo</h3>

        <div class="notification-detail">
            <div class="header-info">
                <img src="https://via.placeholder.com/60" alt="Avatar người gửi">
                <div>
                    <h5>{{ $notification->user->username ?? 'Người dùng ẩn danh' }}</h5>
                    <p class="text-muted">{{ $notification->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <hr>

            <p style="font-size: 16px;">
                {{ $notification->notification_content }}
            </p>

            <p class="mt-3">
                <span class="badge bg-{{ $notification->is_read ? 'success' : 'danger' }}">
                    {{ $notification->is_read ? 'Đã đọc' : 'Chưa đọc' }}
                </span>
            </p>
            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="d-inline-block mt-2" onsubmit="return confirm('Bạn có chắc muốn xóa thông báo này?');">
    @csrf
    @method('DELETE')
    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="d-inline-block mt-2" onsubmit="return confirm('Bạn có chắc muốn xóa thông báo này?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        🗑️ Xóa thông báo
    </button>
</form>
        </div>

        <a href="{{ route('notifications.index') }}" class="btn btn-secondary mt-4">← Quay lại danh sách</a>

    </div>

</form>
</body>
</html>
