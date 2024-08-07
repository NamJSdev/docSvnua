<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
        <div
            class="search-toggle-icon bi bi-search"
            data-toggle="header_search"></div>
        {{-- <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input
                        type="text"
                        class="form-control search-input"
                        placeholder="Tìm Kiếm..." />
                    <div class="dropdown">
                    </div>
                </div>
            </form>
        </div> --}}
    </div>
    <div class="header-right">
        {{-- <div class="user-notification">
            <div class="dropdown">
                <a
                    class="dropdown-toggle no-arrow"
                    href="#"
                    role="button"
                    data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="vendors/images/img.jpg" alt />
                                    <h3>John Doe</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="vendors/images/photo1.jpg" alt />
                                    <h3>Lea R. Frith</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a
                    class="dropdown-toggle"
                    href="#"
                    role="button"
                    data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{asset('admin/vendors/images/photo1.jpg')}}" alt />
                    </span>
                    <span class="user-name">{{ Auth::user()->info->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <button class="dropdown-item" type="submit"><i class="dw dw-logout"></i>
                        Đăng Xuất</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>