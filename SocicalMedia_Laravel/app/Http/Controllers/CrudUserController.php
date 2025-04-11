<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * CRUD User controller
 */
class CrudUserController extends Controller
{
    /**
     * Login page
     */
    public function login()
    {
        return view('crud_user.login');

    }

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('list')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    /**
     * Registration page
     */
    public function createUser()
    {
        return view('crud_user.create');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'phone' => 'required',
            'profilepicture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
    
        // Xử lý ảnh đại diện (upload vào storage/app/public/image)
        $imagePath = 'image/default.png'; // ảnh mặc định
    
        if ($request->hasFile('profilepicture')) {
            $file = $request->file('profilepicture');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/image', $fileName); // lưu vào storage/app/public/image
            $imagePath = $fileName; // đường dẫn khi dùng asset()
        }
    
        User::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'profilepicture' => $imagePath, // dùng đường dẫn public (có 'storage/')
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect("login")->withSuccess('Tài khoản đã được tạo thành công!');
    }


    /**
     * View user detail page
     */
    public function readUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.read', ['messi' => $user]);
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::destroy($user_id);

        return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'username' => 'required',
            'phone' => 'required',
            'profilepicture' => 'required',
            'email' => 'required|email|unique:users,email,' . $input['id'],
            'password' => 'required|min:6',
        ]);

        $user = User::find($input['id']);
        $user->username = $input['username'];
        $user->phone = $input['phone'];
        $user->profilepicture = $input['profilepicture'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->save();

        return redirect("list")->withSuccess('User updated successfully');
    }

    /**
     * List of users
     */
    public function listUser()
{
    if (Auth::check()) {
        // Sắp xếp theo ID mới nhất và phân trang
        $users = User::orderBy('id', 'desc')->paginate(5); // 5 user mỗi trang

        return view('crud_user.list', ['users' => $users]);
    }

    return redirect("login")->withSuccess('You are not allowed to access');
}

    /**
     * Sign out
     */
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
