<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Info;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }
    public function showLoginFormUser()
    {
        return view('auth.client.login');
    }
    public function registerForm()
    {
        return view('auth.client.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        $user = Account::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Email không tồn tại!',
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => 'Mật khẩu không đúng!',
            ]);
        }

        Auth::login($user);
        // Lưu thông báo vào session
        Session::flash('success', 'Đăng nhập thành công!');

        return redirect()->route('admin-dashboard');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        $user = Account::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Email không tồn tại!',
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => 'Mật khẩu không đúng!',
            ]);
        }

        Auth::login($user);
        // Lưu thông báo vào session
        Session::flash('success', 'Đăng nhập thành công!');

        return redirect()->route('home-page');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-user.form');
    }
    public function register(Request $request)
    {
        // Xác thực dữ liệu
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed', // `confirmed` để kiểm tra xác nhận mật khẩu
            'name' => 'required|string|max:255',
            'role' => 'required|string',
        ]);

        // Nếu xác thực không thành công
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Create a new record in the 'infos' table
        $info = Info::create([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
        ]);

        // Create a new record in the 'accounts' table
        $account = Account::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'roleID' => 2,
            'infoID' => $info->id,
        ]);

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('login-user.form')->with('success', 'Tài Khoản đã được tạo thành công, đăng nhập để sử dụng.');
    }
}