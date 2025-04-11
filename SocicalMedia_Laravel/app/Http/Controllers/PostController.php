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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/image', $filename);
            $imagePath = $filename;
        }

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'imageurl' => $imagePath,
            'videourl' => null,
            'status' => 1, // hoặc status mặc định
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
