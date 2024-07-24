<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('admin-dashboard') }}">
            <img src="{{ asset('admin/vendors/images/logo-no-background.png') }}" alt class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('admin-dashboard') }}"
                        class="dropdown-toggle no-arrow {{ request()->is('dashboard') ? 'active' : '' }}">
                        <span class="micon bi bi-house"></span></span><span class="mtext">Thống Kê</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-table"></span><span class="mtext">Quản Lý Bài Đăng</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a class="{{ request()->is('post-pending') ? 'active' : '' }}"
                                href="{{ route('posts.active') }}">Duyệt Bài
                                @if ($countPendingPost > 0)
                                    <span class="badge badge-danger badge-counter float-right">{{$countPendingPost}} +</span>
                                @endif
                            </a>
                        </li>
                        <li><a class="{{ request()->is('post-admin') ? 'active' : '' }}"
                                href="{{ route('posts.index') }}">Bài Đăng</a></li>
                        <li><a class="{{ request()->is('danh-muc/danh-sach-danh-muc') ? 'active' : '' }}"
                                href="{{ route('categories.index') }}">Danh mục</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('posts.doc') }}"
                        class="dropdown-toggle no-arrow {{ request()->is('post-doc') ? 'active' : '' }}">
                        <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Quản Lý Tài Liệu</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{route('admin-dashboard')}}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-gear"></span></span><span
                            class="mtext">Cấu Hình Web</span>
                    </a>
                </li> --}}
                <li class="dropdown {{ request()->is('tai-khoan-he-thong') ? 'show' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-check-fill"></span><span class="mtext">Quản Lý Tài Khoản</span>
                    </a>
                    <ul class="submenu">
                        <li><a class="{{ request()->is('tai-khoan-nguoi-dung') ? 'active' : '' }}"
                                href="{{ route('taikhoannguoidung') }}">Tài Khoản Người Dùng</a></li>
                        <li><a class="{{ request()->is('tai-khoan-he-thong') ? 'active' : '' }}"
                                href="{{ route('taikhoanhethong') }}">Tài Khoản Hệ Thống</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
