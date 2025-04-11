<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .sidebar {
            width: 220px;
            height: 100vh;
            background: white; /* Sửa lại từ while -> white */
            color: red;
            padding: 20px;
            position: fixed;
            border-right: 2px solid black; /* Thêm viền đen bên phải */
        }

        .sidebar a {
            display: block;
            margin: 30px 20px;
            color: black;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
            <h3>Social App</h3>
            <a href="./">🏠 Home</a>
            <a href="#">🔍 Tìm kiếm</a>
            <a href="#">➕ Thêm bài viết</a>
            <a href="#">⭐ Yêu thích</a>
            <a href="{{ route('notifications.viewAlt') }}">🔔 Thông báo</a>
            <a href="#">👤 User</a>
            <a href="#">⚙️ Cài đặt</a>
    </div>
</body>
</html>
