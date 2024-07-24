<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Doc;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // Lấy các bài viết có status là 'pending'
        $datas = Post::where('status', 'approved')
            ->with('categories') // Eager load categories
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pages.post', compact('datas'));
    }
    public function doc()
    {
        // Lấy các bài viết có status là 'pending'
        $datas = Post::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pages.doc', compact('datas'));
    }
    public function active()
    {
        // Lấy các bài viết có status là 'pending'
        $datas = Post::where('status', 'pending')
            ->with('categories') // Eager load categories
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pages.post-pending', compact('datas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'doc' => 'required|file|mimes:pdf',
            'title' => 'required|string|max:255',
            'category' => 'required|integer',
            'desc' => 'nullable|string',
            'privacy' => 'required|in:public,private',
        ]);

        // Lưu tài liệu
        $file = $request->file('doc');
        // Lưu file vào public/documents
        $path = $file->store('documents', 'public');

        // Tạo bản ghi tài liệu mới
        $doc = Doc::create([
            'docLink' => $path,
        ]);

        // Xác định trạng thái của bài viết dựa trên quyền riêng tư
        $status = $request->input('privacy') === 'private' ? 'limited' : 'pending';

        // Tạo bản ghi bài viết mới
        $post = Post::create([
            'name' => $request->input('title'),
            'desc' => $request->input('desc'),
            'docID' => $doc->id,
            'privacy' => $request->input('privacy'),
            'accountID' => auth()->id(), // Assuming the user is authenticated
            'categoryID' => $request->input('category'),
            'status' => $status,
        ]);

        PostCategory::create([
            'categoryID' => $request->category,
            'postID' => $post->id,
        ]);

        return redirect()->route('home-page')->with('success', 'Đã upload tài liệu thành công.');
    }
    public function approved(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Find the category by ID
        $post = Post::find($request->id);

        if (!$post) {
            return redirect()->route('posts.active')->with('error', 'Tài liệu không tồn tại.');
        }

        // Update the category information
        $post->status = 'approved';

        // Save the updated category
        $post->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('posts.active')->with('success', 'Tài Liệu Đã Được Duyệt.');
    }
    public function rejected(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Find the category by ID
        $post = Post::find($request->id);

        if (!$post) {
            return redirect()->route('posts.active')->with('error', 'Tài liệu không tồn tại.');
        }

        // Update the category information
        $post->status = 'rejected';

        // Save the updated category
        $post->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('posts.active')->with('success', 'Đã Từ Chối Duyệt Thành Công.');
    }

    public function delete(Request $request)
    {
        // Tìm bài viết theo ID
        $post = Post::findOrFail($request->id);

        $doc = Doc::findOrFail($post->docID);
        // Xóa tài liệu liên quan nếu tồn tại
        if ($doc) {
            // Xóa file tài liệu khỏi storage
            Storage::disk('public')->delete($doc->docLink);

            // Xóa tài liệu khỏi database
            $doc->delete();
        }

        // Xóa bài viết
        $post->delete();

        // Trả về phản hồi sau khi xóa
        return redirect()->route('posts.index')->with('success', 'Tài Liệu Đã Được Xóa Thành Công.');
    }
    public function deletePostUser(Request $request)
    {
        // Tìm bài viết theo ID
        $post = Post::findOrFail($request->id);

        $doc = Doc::findOrFail($post->docID);
        // Xóa tài liệu liên quan nếu tồn tại
        if ($doc) {
            // Xóa file tài liệu khỏi storage
            Storage::disk('public')->delete($doc->docLink);

            // Xóa tài liệu khỏi database
            $doc->delete();
        }

        // Xóa bài viết
        $post->delete();

        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();

        // Trả về phản hồi sau khi cập nhật
        return redirect()->route('account-user', ['accountID' => $userId])->with('success', 'Bài Viết Đã Được Xóa Thành Công.');
    }
    public function updatePostUser(Request $request)
    {
        // Xác thực dữ liệu từ yêu cầu
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:255',
            'doc' => 'nullable|file|mimes:pdf|max:10000', // Chỉ cho phép file PDF với kích thước tối đa 10MB
        ]);

        // Tìm bài viết dựa trên ID
        $post = Post::findOrFail($request->id);

        // Cập nhật thông tin bài viết
        $post->name = $request->name;
        $post->desc = $request->desc;

        // Xử lý tài liệu mới nếu có
        if ($request->hasFile('doc')) {
            // Lưu tài liệu mới vào bảng docs
            $docPath = $request->file('doc')->store('docs', 'public');

            // Tạo hoặc cập nhật bản ghi tài liệu trong bảng docs
            $doc = Doc::updateOrCreate(
                ['id' => $post->docID], // Cập nhật tài liệu liên kết với bài viết nếu có
                ['docLink' => $docPath]
            );

            // Cập nhật ID tài liệu vào bài viết
            $post->docID = $doc->id;
        }

        // Lưu thay đổi vào cơ sở dữ liệu
        $post->save();

        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();

        // Trả về phản hồi sau khi cập nhật
        return redirect()->route('account-user', ['accountID' => $userId])->with('success', 'Bài Viết Đã Được Cập Nhật Thành Công.');
    }



    public function postForCategory($categoryID)
    {
        // Lấy danh sách bài viết theo categoryID và status là 'approved'
        $category = Category::findOrFail($categoryID);
        $posts = $category->posts()->where('status', 'approved')->orderBy('created_at', 'desc')->get();

        // Trả về view với danh sách bài viết
        return view('client.pages.post-list-default', compact('posts', 'category'));
    }
    public function postDetail($postID)
    {
        // Lấy thông tin bài viết và danh mục của bài viết
        $post = Post::findOrFail($postID);
        // Cập nhật số lượng view
        $post->view = $post->view + 1;
        $post->save(); // Lưu lại thay đổi
        $category = Category::findOrFail($post->categoryID);
        $pdfUrl = asset('storage/' . $post->doc->docLink); // Đường dẫn đến tài liệu PDF

        // Lấy 5 danh mục có số bài viết nhiều nhất
        $topCategories = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(5)
            ->get();

        // Lấy 3 bài viết mới nhất, loại trừ bài viết hiện tại
        $latestPosts = Post::where('id', '!=', $postID)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Trả về view với thông tin bài viết, danh mục, và dữ liệu bổ sung
        return view('client.pages.post-detail', compact('post', 'category', 'pdfUrl', 'topCategories', 'latestPosts'));
    }

    public function search(Request $request)
    {
        // Lấy giá trị tìm kiếm từ request
        $searchQuery = $request->input('query');

        // Tìm kiếm theo tên bài viết và tên danh mục
        $posts = Post::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhereHas('categories', function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        // Lấy danh sách danh mục để hiển thị
        $categories = Category::all();

        return view('client.pages.search-results', compact('posts', 'categories', 'searchQuery'));
    }
}