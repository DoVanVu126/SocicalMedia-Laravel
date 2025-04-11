<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('components.add_post');
    }

    public function store(Request $request)
{
    $request->validate([
        'content' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10048',
        'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:50000',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/image', $imageName); // Upload vào storage
        $imagePath = $imageName; // Lưu tên file vào DB
    }

    $videoPath = null;
    if ($request->hasFile('video')) {
        $video = $request->file('video');
        $videoName = time() . '_' . $video->getClientOriginalName();
        $video->storeAs('public/video', $videoName); // Upload vào storage
        $videoPath = $videoName; // Lưu tên file vào DB
    }

    Post::create([
        'user_id' => Auth::id(),
        'content' => $request->input('content'),
        'imageurl' => $imagePath,
        'videourl' => $videoPath,
        'status' => 1,
    ]);

    return redirect()->back()->with('success', 'Đăng bài thành công!');
}



    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa bài viết này!');
        }

        $post->delete();

        return redirect()->back()->with('success', 'Đã xóa bài viết thành công!');
    }
}
