<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <div class="row g-0 align-items-center">
                    <div class="col-2">
                        <a href="{{ route('home-page') }}" class="logo m-0 float-start"><img
                                src="{{ asset('client/images/logo_vnua_02.png') }}" alt>&nbsp;DocSvnua<span
                                class="text-primary"></span></a>
                    </div>
                    <div class="col-lg-6 text-center">
                        @if (request()->is('upload') || request()->is('account-edit'))
                        @else
                            <form action="{{ route('search') }}" method="GET"
                                class="search-form d-none d-lg-inline-block">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control mt-0"
                                        placeholder="Tìm kiếm bài viết hoặc danh mục..."
                                        value="{{ request()->input('query') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary mt-0 d-flex align-items-center" type="submit"
                                            style="height: 80%">Tìm Kiếm</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="col-4 text-end">
                        @if (Auth::user() && Auth::user()->roleID === 2)
                            <!-- Auth -->
                            <button class="button-17" role="button">
                                <span><a href="{{ route('upload.form') }}">TẢI LÊN</a></span>
                            </button>
                            {{-- <button class="button-17" role="button"><span>DÙNG THỬ</span></button> --}}
                            <button class="button-17" role="button" onclick="toggle()" class="profile-dropdown-btn"><i
                                    class="fa-regular fa-user"></i></button>
                            <div class="profile-dropdown">
                                <ul class="profile-dropdown-list">
                                    <li class="profile-dropdown-list-item">
                                        <a href="{{ route('account-user', ['accountID' => Auth::user()->id]) }}">
                                            <i class="fa-regular fa-user"></i>
                                            Tài khoản
                                        </a>
                                    </li>

                                    <li class="profile-dropdown-list-item">
                                        <a href="{{ route('account-edit.form') }}">
                                            <i class="fa-solid fa-sliders"></i>
                                            Thiết lập
                                        </a>
                                    </li>
                                    <hr />

                                    <li class="profile-dropdown-list-item d-flex">
                                        <form method="POST" action="{{ route('logout-user') }}">
                                            @csrf
                                            <button type="submit">
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                                Đăng xuất
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <button class="button-17" role="button" onclick="toggle()" class="profile-dropdown-btn"><i
                                    class="fa-regular fa-user"></i></button>
                            <div class="profile-dropdown">
                                <ul class="profile-dropdown-list">
                                    <li class="profile-dropdown-list-item">
                                        <a href="{{ route('login-user') }}">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            Đăng Nhập
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
