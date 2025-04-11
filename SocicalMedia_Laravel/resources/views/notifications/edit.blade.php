<!-- resources/views/notifications/edit.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa thông báo</title>
</head>
<body>
    <h1>Chỉnh sửa thông báo</h1>

    <form action="{{ route('notifications.update', $notification->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nội dung thông báo:</label><br>
        <textarea name="notification_content" required>{{ $notification->notification_content }}</textarea><br><br>

        <label>
            <input type="checkbox" name="is_read" value="1" {{ $notification->is_read ? 'checked' : '' }}>
            Đã đọc
        </label><br><br>

        <button type="submit">Cập nhật</button>
        <a href="{{ route('notifications.index') }}">Quay lại</a>
    </form>
</body>
</html>
