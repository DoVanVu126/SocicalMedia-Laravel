<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm thông báo mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        textarea {
            resize: vertical;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h3 class="mb-4 text-center">📝 Thêm thông báo mới</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Lỗi!</strong> Vui lòng kiểm tra lại dữ liệu nhập.<br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('notifications.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="notification_content" class="form-label">Nội dung thông báo:</label>
                    <textarea name="notification_content" class="form-control" id="notification_content" rows="5" placeholder="Nhập nội dung..." required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('notifications.index') }}" class="btn btn-secondary">← Quay lại</a>
                    <button type="submit" class="btn btn-primary">💾 Lưu thông báo</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
