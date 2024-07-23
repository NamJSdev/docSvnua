@extends('client.layouts.app-detail')

@section('title', 'Chi Tiết Bài Đăng')

@section('content')
    <div class="container">
        <div class="text_theme"></div>
        <h1>{{ $post->name }}</h1>
        <p>Ngày tải lên:
            {{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}
            |&nbsp;&nbsp;{{ $post->view }}&nbsp;<i class="fa-regular fa-eye"></i></p>
        </p>
    </div>
    </div>
    </div>

    <section class="section">
        <div class="container">

            <div class="row blog-entries element-animate">

                <div class="col-md-12 col-lg-8 main-content box">

                    <div class="post-content-body">
                        <p>{{ $post->desc }}</p>
                    </div>
                    <div id="pdf-viewer">
                        <!-- Nhúng PDF vào iframe -->
                        <iframe src="{{ $pdfUrl }}#page=1" style="width: 100%; height: 100%; border: none;"
                            id="pdf-frame"></iframe>
                    </div>
                    <div class="pt-5">
                        <p>Chủ đề: &nbsp;<a
                                href="{{ route('post-client.category', ['categoryID' => $category->id]) }}">{{ $category->name }}</a>
                    </div>

                    <div class="pt-5 comment-wrap">
                        <div class="comment-form-wrap pt-5"> </div>
                    </div>

                </div>

                <!-- END main-content -->

                <div class="col-md-12 col-lg-4 sidebar">

                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <div class="bio text-center">
                            @if ($post->account->info->image)
                                <img id="profile-pic" class="img-fluid mb-3"
                                    src="{{ asset('storage/' . $post->account->info->image) }}" alt="Ảnh Đại Diện">
                            @else
                                <img id="profile-pic" class="img-fluid mb-3" src="https://via.placeholder.com/96"
                                    alt="Ảnh Đại Diện">
                            @endif
                            <div class="bio-body">
                                <h2>{{ $post->account->info->name }} <span
                                        style="font-size: 16px !important">({{ $post->account->info->role }})</span></h2>
                                <p class="mb-4">{{ $post->account->info->desc }}</p>
                                <p><a href="{{ route('account-user', ['accountID' => $post->account->id]) }}"
                                        class="btn btn-primary btn-sm rounded px-2 py-2">Xem Profile</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <h3 class="heading">Bài Viết Mới Nhất</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @foreach ($latestPosts as $post)
                                    <li>
                                        <a href="{{ route('post-detail', ['postID' => $post->id]) }}">
                                            <x-pdf-thumbnail :pdfUrl="asset('storage/' . $post->doc->docLink)" id="{{ $post->id }}" />
                                            <div class="text">
                                                <h4 class="text-limit" title="{{ $post->name }}">{{ $post->name }}
                                                </h4>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <h3 class="heading">CHỦ ĐỀ NỔI BẬT</h3>
                        <ul class="categories">
                            @foreach ($topCategories as $category)
                                <li><a
                                        href="{{ route('post-client.category', ['categoryID' => $category->id]) }}">{{ $category->name }}<span>({{ $category->posts_count }})</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- END sidebar-box -->
                </div>
            </div>
        </div>
    </section>
    <style>
        /* CSS để thêm scroll bar cho iframe nếu cần */
        #pdf-viewer {
            height: 100vh;
            /* Chiều cao của khu vực PDF Viewer */
            overflow: hidden;
        }

        #pdf-frame {
            width: 100%;
            height: 100%;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pdfFrame = document.getElementById('pdf-frame');
            pdfFrame.addEventListener('load', function() {
                // Đặt tham số #page=3 để chỉ hiển thị ba trang đầu tiên
                // Nếu không có tham số nào, trình duyệt sẽ hiển thị toàn bộ tài liệu PDF.
                pdfFrame.contentWindow.location.hash = 'page=3';
            });
        });
    </script>
@endsection
