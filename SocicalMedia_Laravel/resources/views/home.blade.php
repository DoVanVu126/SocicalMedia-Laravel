<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Mạng xã hội</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { margin: 0; font-family: sans-serif; }
        .container { display: flex; }
        .main {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
            background: #f4f4f4;
        }
        .post {
            background: white;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .actions {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }
        .actions button {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 16px;
            color: #333;
        }
        .actions button:hover {
            color: #007BFF;
        }
    </style>
</head>
<body>
    <div class="container">
        @include('components.navbar') {{-- Đây là navbar --}}
        <div class="main">
            <h2>Bài viết mới</h2>

            @foreach ($posts as $post)
                <div class="post">
                    <div class="user-info">
                        @if ($post->user->ProfilePicture)
                            <img src="{{ asset('image/' . $post->user->ProfilePicture) }}" alt="Avatar">
                        @else
                            <img src="{{ asset('image/default-avatar.png') }}" alt="Avatar">
                        @endif
                        <strong>{{ $post->user->Username }}</strong>
                    </div>
                    <small>{{ $post->CreatedAt }}</small>
                    <p>{{ $post->Content }}</p>
                    @if ($post->ImageURL)
                        <img src="{{ asset('image/' . $post->ImageURL) }}" alt="Ảnh" width="50%">
                    @endif

                    {{-- Các nút Like, Comment, Share --}}
                    <div class="actions">
                        <button>👍 Like</button>
                        <button>💬 Comment</button>
                        <button>🔗 Share</button>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</body>
</html>
