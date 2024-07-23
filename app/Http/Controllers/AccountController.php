<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Info;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function getAdminAccount()
    {
        $datas = Account::where('roleID', 1)->get();
        return view('admin.pages.admin-account', compact('datas'));
    }
    public function createAccountForm()
    {
        return view('admin.pages.add-account');
    }
    public function createAccount(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:accounts,email',
            'password' => 'required|min:6',
            'desc' => 'nullable|string',
        ]);

        // Create a new record in the 'infos' table
        $info = Info::create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
        ]);

        // Create a new record in the 'accounts' table
        $account = Account::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'roleID' => 1,
            'infoID' => $info->id,
        ]);

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('taikhoanhethong')->with('success', 'Tài Khoản đã được tạo thành công.');
    }

    public function updateAccountAdmin(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'user_name' => 'required|string|max:255',
            'desc' => 'string|max:255',
            'email' => 'required|string|max:255|email',
            'password' => 'nullable|string|min:6',
        ]);

        // Find the account by ID
        $account = Account::find($request->id);

        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        // Update the account details
        $account->email = $request->email;
        if ($request->password != "") {
            $account->password = bcrypt($request->password);
        }
        $account->save();

        // Update the info details
        $info = Info::find($account->infoID);
        if ($info) {
            $info->name = $request->user_name;
            $info->desc = $request->desc;
            $info->save();
        } else {
            return redirect()->back()->with('error', 'Associated info not found.');
        }

        return redirect()->route('taikhoanhethong')->with('success', 'Tài khoản đã được cập nhật thành công.');
    }
    public function deleteAccountAdmin(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        Account::destroy($request->id);

        return redirect()->route('taikhoanhethong')->with('success', 'Tài khoản đã được xóa thành công.');
    }
    public function accountEditForm()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();
        return view('client.pages.user-account-update', compact('user'));
    }
    public function accountUserUpdate(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'desc' => 'string|max:255',
            'role' => 'string|max:255',
            'image' => 'nullable|image|max:2048', // Kiểm tra loại file ảnh và kích thước tối đa
        ]);

        // Tìm tài khoản theo ID
        $account = Account::find($request->id);

        // Cập nhật thông tin chi tiết
        $info = Info::find($account->infoID);
        if ($info) {
            $info->name = $request->name;
            $info->desc = $request->desc;
            $info->role = $request->role;

            if ($request->hasFile('image')) {
                // Lưu trữ file ảnh và cập nhật đường dẫn
                $imagePath = $request->file('image')->store('images', 'public');
                $info->image = $imagePath;
            }

            $info->save();
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin liên quan.');
        }

        return redirect()->route('account-edit.form')->with('success', 'Thông Tin Tài Khoản Đã Được Cập Nhật Thành Công.');
    }
    public function accountUser($accountID)
    {
        // Lấy thông tin bài viết và danh mục của bài viết
        $account = Account::findOrFail($accountID);
        $datas = Post::where('status', 'approved')->where('accountID', $accountID)
        ->orderBy('created_at', 'desc')
        ->paginate(12);
        $dataPendings = Post::where('status', 'pending')->where('accountID', $accountID)
        ->orderBy('created_at', 'desc')
        ->paginate(12);
        $dataRejects = Post::where('status', 'rejected')->where('accountID', $accountID)
        ->orderBy('created_at', 'desc')
        ->paginate(12);
        // Trả về view với thông tin bài viết, danh mục, và dữ liệu bổ sung
        return view('client.pages.account-user',compact('account','datas','dataPendings','dataRejects'));
    }
}