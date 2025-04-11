<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm bài viết</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
        }

        .content {
            margin-left: 500px;
            padding: 40px;
            flex: 1;
            background-color: #fff;
            max-width: 700px;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        textarea,
        input[type="file"] {
            width: 100%;
            font-size: 16px;
            margin-bottom: 20px;
            background-color: #fdfdfd;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert-success {
            color: green;
            background-color: #e6ffe6;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <div class="content">
        <h2>📝 Thêm bài viết mới</h2>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <textarea name="content" placeholder="Bạn đang nghĩ gì?">{{ old('content') }}</textarea>

            <label>📷 Chọn ảnh:</label>
            <input type="file" name="image">
            <label>🎥 Chọn video:</label>
            <input type="file" name="video" accept="video/mp4,video/x-m4v,video/*">

            <button type="submit">Đăng bài</button>
        </form>
    </div>
</body>
</html>
