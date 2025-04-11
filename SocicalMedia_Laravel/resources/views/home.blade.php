<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng tin</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            display: flex;
        }
        .main {
            margin-left: 260px;
            padding: 30px;
            flex: 1;
        }
        .post {
            background: #fff;
            margin-bottom: 25px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }
        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-info img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ccc;
        }
        .user-info strong {
            font-size: 16px;
            color: #333;
        }
        .post-options {
            position: relative;
        }
        .options-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #666;
        }
        .options-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 30px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            min-width: 120px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            z-index: 99;
        }
        .options-menu a, .options-menu form button {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .options-menu a:hover, .options-menu form button:hover {
            background-color: #f6f6f6;
        }
        .post small {
            display: block;
            margin-top: 5px;
            color: #888;
            font-size: 12px;
        }
        .post p {
            margin: 15px 0;
            line-height: 1.5;
            font-size: 15px;
            color: #444;
        }
        .post img.post-image {
            width: 40%;
            max-width: 600px;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
        }
        .actions {
            display: flex;
            gap: 25px;
            margin-top: 15px;
        }
        .actions button {
            background: none;
            border: none;
            color: #444;
            font-size: 15px;
            cursor: pointer;
        }
        .actions button:hover {
            color: #007BFF;
        }
        .media-wrapper {
    display: flex;
    gap: 20px;
    margin-top: 10px;
    flex-wrap: wrap;
}

.post-image, .post-video {
    width: 40%;
    max-width: 600px;
    border-radius: 10px;
    object-fit: cover;
}

    </style>
</head>
<body>
<div class="container">
    @include('components.navbar')
    <div class="main">
        @foreach ($posts as $post)
            <div class="post">
                <div class="post-header">
                    <div class="user-info">
                        <img src="{{ asset('storage/image/' . ($post->user->profilepicture ?? 'default-avatar.png')) }}" alt="Avatar">
                        <div>
                            <strong>{{ $post->user->username }}</strong>
                            <small>{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="post-options">
                        <button class="options-btn">⋯</button>
                        <div class="options-menu">
                            <a href="#">📝 Sửa</a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">🗑️ Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
                <p>{{ $post->content }}</p>

                <div class="media-wrapper">
    @if ($post->imageurl)
        <img src="{{ asset('storage/image/' . $post->imageurl) }}" alt="Ảnh" class="post-image">
    @endif

    @if ($post->videourl)
        <video controls class="post-video">
            <source src="{{ asset('storage/video/' . $post->videourl) }}" type="video/mp4">
            Trình duyệt của bạn không hỗ trợ video.
        </video>
    @endif
</div>

                <div class="actions">
                    <button>👍 Thích</button>
                    <button>💬 Bình luận</button>
                    <button>🔗 Chia sẻ</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    document.querySelectorAll('.options-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            document.querySelectorAll('.options-menu').forEach(m => {
                if (m !== menu) m.style.display = 'none';
            });
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        });
    });
    document.addEventListener('click', () => {
        document.querySelectorAll('.options-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    });
</script>
</body>
</html>
