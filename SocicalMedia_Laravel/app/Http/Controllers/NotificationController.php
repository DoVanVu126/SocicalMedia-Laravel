<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Hiển thị danh sách thông báo.
     */
    public function index(Request $request)
    {
        $query = Notification::with('user')->orderBy('created_at', 'desc');

        // Nếu có tham số "unread", chỉ lấy thông báo chưa đọc
        if ($request->has('unread') && $request->unread == 1) {
            $query->where('is_read', false);
        }

        $notifications = $query->get();

        return view('notifications.index', compact('notifications'));
    }

    // chi tiết
    public function show(string $id)
    {
        $notification = Notification::with('user')->findOrFail($id);

        // Nếu chưa đọc thì cập nhật trạng thái
        if (!$notification->is_read) {
            $notification->is_read = true;
            $notification->save();
        }

        return view('notifications.show', compact('notification'));
    }

    public function checkNew()
    {
        $userId = Auth::id(); // ID người đang đăng nhập

        $notification = Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->latest()
            ->first();

        if ($notification) {
            $notification->update(['is_read' => true]);

            return response()->json([
                'hasNotification' => true,
                'content' => $notification->notification_content
            ]);
        }

        return response()->json(['hasNotification' => false]);
    }



    /**
     * Hiển thị form thêm thông báo mới.
     */
    public function create()
    {
        return view('notifications.create');
    }

    /**
     * Lưu thông báo mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'notification_content' => 'required|string',
        ]);

        Notification::create([
            'user_id' => Auth::id(), // Lưu ID người tạo
            'notification_content' => $request->notification_content,
            'is_read' => false,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Thông báo đã được thêm!');
    }

    /**
     * Hiển thị form chỉnh sửa.
     */
    public function edit(string $id)
    {
        $notification = Notification::findOrFail($id);
        return view('notifications.edit', compact('notification'));
    }

    /**
     * Cập nhật thông báo.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'notification_content' => 'required|string',
            'is_read' => 'nullable|boolean'
        ]);

        $notification = Notification::findOrFail($id);
        $notification->update([
            'notification_content' => $request->notification_content,
            'is_read' => $request->is_read ?? 0
        ]);

        return redirect()->route('notifications.index')->with('success', 'Đã cập nhật thông báo');
    }

    /**
     * Xóa thông báo.
     */
    public function destroy($id)
{
    \App\Models\Notification::destroy($id);
    return redirect()->route('notifications.index')->with('success', 'Đã xóa thông báo');
}

public function viewAlt(Request $request)
{
    // Load thông báo cùng thông tin user liên quan
    $query = Notification::with(['user' => function ($q) {
        $q->select('id', 'username'); // Chỉ lấy những trường cần
    }])->orderBy('created_at', 'desc');

    // Lọc nếu cần
    if ($request->has('unread') && $request->unread == 1) {
        $query->where('is_read', false);
    }

    $notifications = $query->get();

    // Nếu có thông báo nào mà user không tồn tại => tránh lỗi
    foreach ($notifications as $notification) {
        if (!$notification->user) {
            $notification->user = (object)['username' => 'Người dùng ẩn danh'];
        }
    }

    return view('notifications.view_alt', compact('notifications'));
}





}
