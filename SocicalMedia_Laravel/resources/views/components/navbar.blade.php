<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar - Social App</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #fff;
            color: #333;
            padding: 20px;
            position: fixed;
            border-right: 2px solid #ddd;
        }
        .sidebar h3 {
            margin-bottom: 30px;
            font-size: 22px;
            color: #007BFF;
        }
        .sidebar a {
            display: block;
            margin: 18px 0;
            color: #333;
            text-decoration: none;
            font-size: 16px;
            padding-left: 5px;
            transition: 0.2s;
        }
        .sidebar a:hover {
            color: #007BFF;
            font-weight: bold;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .user-section img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .user-section span {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="sidebar">

        {{-- Hiện avatar và tên nếu đã login --}}
        @if(Auth::check())
            <div class="user-section">
                <img src="{{ Auth::user()->profilepicture ? asset('storage/image/' . Auth::user()->profilepicture) : asset('image/default.png') }}"
                     alt="Avatar">
                <span>{{ Auth::user()->username }}</span>
            </div>
        @endif

        <h3>Social App</h3>

        <a href="{{ route('home') }}">🏠 Home</a>
        <a href="#">🔍 Tìm kiếm</a>
        <a href="{{ route('post.create') }}">➕ Thêm bài viết</a>
        <a href="#">⭐ Yêu thích</a>
        <a href="{{ route('notifications.viewAlt') }}">🔔 Thông báo</a>
        <a href="#">👤 Tài khoản</a>
        <a href="#">⚙️ Cài đặt</a>
    </div>
</body>
</html>
