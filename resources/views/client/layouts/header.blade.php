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
                        <a href="index.html" class="logo m-0 float-start"><img src="{{asset('client/images/logo_vnua_02.png')}}"
                                alt>&nbsp;DocSvnua<span class="text-primary"></span></a>
                    </div>
                    <div class="col-lg-6 text-center">
                        <a href="#"
                            class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                            <span></span>
                        </a>
                        <form action="#" class="search-form d-none d-lg-inline-block">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bi-search"></span>
                        </form>
                    </div>
                    <div class="col-4 text-end">
                        <button class="button-17" role="button"><span><a href="upload.html">TẢI
                                    LÊN</a></span></button>
                        {{-- <button class="button-17" role="button"><span>DÙNG THỬ</span></button> --}}
                        <button class="button-17" role="button" onclick="toggle()" class="profile-dropdown-btn"><i
                                class="fa-regular fa-user"></i></button>
                        <div class="profile-dropdown">
                            <ul class="profile-dropdown-list">
                                <li class="profile-dropdown-list-item">
                                    <a href="Edit Profile.html">
                                        <i class="fa-regular fa-user"></i>
                                        Tài khoản
                                    </a>
                                </li>

                                <li class="profile-dropdown-list-item">
                                    <a href="my-upload.html">
                                        <i class="fa-regular fa-envelope"></i>
                                        Tài tiệu
                                    </a>
                                </li>

                                <li class="profile-dropdown-list-item">
                                    <a href="#">
                                        <i class="fa-solid fa-chart-line"></i>
                                        Thông kê
                                    </a>
                                </li>

                                <li class="profile-dropdown-list-item">
                                    <a href="Account Settings.html">
                                        <i class="fa-solid fa-sliders"></i>
                                        Thiết lập
                                    </a>
                                </li>
                                <li class="profile-dropdown-list-item">
                                    <a href="#">
                                        <i class="fa-regular fa-circle-question"></i>
                                        Hỗ trợ
                                    </a>
                                </li>
                                <hr />

                                <li class="profile-dropdown-list-item">
                                    <a href="#">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
