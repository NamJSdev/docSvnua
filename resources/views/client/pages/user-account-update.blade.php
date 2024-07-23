@extends('client.layouts.app-none')
@section('title', 'Cập nhật thông tin tài khoản')
@section('content')
    <div class="text-setting-account text-center" style="margin-right: 0px !important">
        <span class="text-center">Cập Nhật Thông Tin Cá Nhân</span>
    </div>
    <!-- Start posts-entry -->
    <nav class="center-settings-menu">
        <ul>
            <li class="tab-link active" data-tab="personal-details">Thông Tin Cá Nhân</li>
        </ul>
    </nav>
    <div class="settings-container">
        <form action="{{ route('account-edit.update') }}" method="POST" enctype="multipart/form-data">
            <section id="personal-details" class="tab-content active w-100">
                <span>Thông Tin Cá Nhân</span>
                <section class="profile-picture">
                    <div class="profile-pic-container">
                        @if ($user->info->image)
                            <img id="profile-pic" class="img-fluid rounded avatar-50 mr-3" src="{{ asset('storage/' . $user->info->image) }}" alt="Ảnh Đại Diện">
                        @else
                            <img id="profile-pic" src="https://via.placeholder.com/96" alt="Ảnh Đại Diện">
                        @endif

                        <input type="file" id="upload-image" accept="image/jpeg, image/png, image/gif" name="image">
                        <div class="text-profile-setting">
                            <p>Định dạng hỗ trợ: jpg, png, gif.<br>Kích thước tối đa: 500KB<br></p>
                            <label for="upload-image" class="upload-btn">Tải Ảnh Mới</label>
                        </div>
                    </div>
                </section>
                <hr>
                <section class="personal-info">
                    <h3>Cập Nhật Thông Tin Cá Nhân</h3>
                    @csrf
                    <label for="accounttype">Loại Tài Khoản: </label>

                    <select id="accounttype" name="role">
                        <option value="Giảng Viên" {{ $user->info->role == 'Giảng Viên' ? 'selected' : '' }}>Giảng viên
                        </option>
                        <option value="Sinh Viên" {{ $user->info->role == 'Sinh Viên' ? 'selected' : '' }}>Sinh Viên
                        </option>
                    </select>
                    <label for="name">Tên</label>
                    <input type="text" id="name" placeholder="Tên" name="name" value="{{ $user->info->name }}"
                        required>
                    <input type="hidden" placeholder="Tên" name="id" value="{{ $user->id }}" required>

                    <label for="about">Về Tôi</label>
                    <textarea id="about" placeholder="Giới thiệu về bản thân" name="desc">{{ $user->info->desc }}</textarea>
                    <p id="char-remaining">692 ký tự còn lại</p>

                    <button class="btn btn-primary" type="submit">Lưu</button>
                </section>
            </section>
        </form>
    </div>
    <script src="{{ asset('client/js/Account Settings.js') }}"></script>
@endsection
