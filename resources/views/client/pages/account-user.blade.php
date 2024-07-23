@extends('client.layouts.app-detail')

@section('title', '')

@section('content')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Poppins&display=swap");
        @import url("https://fonts.googleapis.com/css?family=Bree+Serif&display=swap");

        .profile-header {
            background: #fff;
            width: 100%;
            display: flex;
            height: 190px;
            position: relative;
            box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.2);
        }

        .profile-img {
            float: left;
            width: 340px;
            height: 200px;
        }

        .profile-img img {
            border-radius: 50%;
            height: 230px;
            width: 230px;
            border: 5px solid #fff;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            position: absolute;
            left: 50px;
            top: 20px;
            z-index: 5;
            background: #fff;
        }

        .profile-nav-info {
            float: left;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-top: 60px;
        }

        .profile-nav-info h3 {
            font-variant: small-caps;
            font-size: 2rem;
            font-family: sans-serif;
            font-weight: bold;
        }

        .profile-nav-info .address {
            display: flex;
            font-weight: bold;
            color: #777;
        }

        .profile-nav-info .address p {
            margin-right: 5px;
        }

        .profile-option {
            width: 40px;
            height: 40px;
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.5s ease-in-out;
            outline: none;
            background: #e40046;
        }

        .profile-option:hover {
            background: #fff;
            border: 1px solid #e40046;
        }

        .profile-option:hover .notification i {
            color: #e40046;
        }

        .profile-option:hover span {
            background: #e40046;
        }

        .profile-option .notification i {
            color: #fff;
            font-size: 1.2rem;
            transition: all 0.5s ease-in-out;
        }

        .profile-option .notification .alert-message {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #fff;
            color: #e40046;
            border: 1px solid #e40046;
            padding: 5px;
            border-radius: 50%;
            height: 20px;
            width: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .main-bd {
            width: 100%;
            display: flex;
            padding-right: 15px;
        }

        .profile-side {
            width: 300px;
            background: #fff;
            box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
            padding: 90px 30px 20px;
            font-family: "Bree Serif", serif;
            margin-left: 10px;
            z-index: 99;
        }

        .profile-side p {
            margin-bottom: 7px;
            color: #333;
            font-size: 14px;
        }

        .profile-side p i {
            color: #e40046;
            margin-right: 10px;
        }

        .mobile-no i {
            transform: rotateY(180deg);
            color: #e40046;
        }

        .profile-btn {
            display: flex;
        }

        button.chatbtn,
        button.createbtn {
            border: 0;
            padding: 10px;
            width: 100%;
            border-radius: 3px;
            background: #e40046;
            color: #fff;
            font-family: "Bree Serif";
            font-size: 1rem;
            margin: 5px 2px;
            cursor: pointer;
            outline: none;
            margin-bottom: 10px;
            transition: background 0.3s ease-in-out;
            box-shadow: 0px 5px 7px 0px rgba(0, 0, 0, 0.3);
        }

        button.chatbtn:hover,
        button.createbtn:hover {
            background: rgba(288, 0, 70, 0.9);
        }

        button.chatbtn i,
        button.createbtn i {
            margin-right: 5px;
        }

        .user-rating {
            display: flex;
        }

        .user-rating h3 {
            font-size: 2.5rem;
            font-weight: 200;
            margin-right: 5px;
            letter-spacing: 1px;
            color: #666;
        }

        .user-rating .no-of-user-rate {
            font-size: 0.9rem;
        }

        .rate {
            padding-top: 6px;
        }

        .rate i {
            font-size: 0.9rem;
            color: rgba(228, 0, 70, 1);
        }

        .nav {
            width: 100%;
            z-index: -1;
        }

        .nav ul {
            display: flex;
            justify-content: space-around;
            list-style-type: none;
            height: 40px;
            background: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .nav ul li {
            padding: 10px;
            width: 100%;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s ease-in-out;
        }

        .nav ul li:hover,
        .nav ul li.active {
            box-shadow: 0px -3px 0px rgba(288, 0, 70, 0.9) inset;
        }

        .profile-body {
            width: 100%;
            z-index: -1;
        }

        .tab {
            display: none;
        }

        .tab {
            padding: 20px;
            width: 100%;
            text-align: center;
        }

        @media (max-width: 1100px) {
            .profile-side {
                width: 250px;
                padding: 90px 15px 20px;
            }

            .profile-img img {
                height: 200px;
                width: 200px;
                left: 50px;
                top: 50px;
            }
        }

        @media (max-width: 900px) {
            .profile-header {
                display: flex;
                height: 100%;
                flex-direction: column;
                text-align: center;
                padding-bottom: 20px;
            }

            .profile-img {
                float: left;
                width: 100%;
                height: 200px;
            }

            .profile-img img {
                position: relative;
                height: 200px;
                width: 200px;
                left: 0px;
            }

            .profile-nav-info {
                text-align: center;
            }

            .profile-option {
                right: 20px;
                top: 75%;
                transform: translateY(50%);
            }

            .main-bd {
                flex-direction: column;
                padding-right: 0;
            }

            .profile-side {
                width: 100%;
                text-align: center;
                padding: 20px;
                margin: 5px 0;
            }

            .profile-nav-info .address {
                justify-content: center;
            }

            .user-rating {
                justify-content: center;
            }
        }

        @media (max-width: 400px) {
            .profile-header h3 {}

            .profile-option {
                width: 30px;
                height: 30px;
                position: absolute;
                right: 15px;
                top: 83%;
            }

            .profile-option .notification .alert-message {
                top: -3px;
                right: -4px;
                padding: 4px;
                height: 15px;
                width: 15px;
                font-size: 0.7rem;
            }

            .profile-nav-info h3 {
                font-size: 1.9rem;
            }

            .profile-nav-info .address p,
            .profile-nav-info .address span {
                font-size: 0.7rem;
            }
        }

        #see-more-bio,
        #see-less-bio {
            color: blue;
            cursor: pointer;
            text-transform: lowercase;
        }

        .tab h1 {
            font-family: "Bree Serif", sans-serif;
            display: flex;
            justify-content: center;
            margin: 20px auto;
        }
    </style>
    <div class="container mt-3">
        <div class="profile-header">
            <div class="profile-img">
                @if ($account->info->image)
                    <img src="{{ asset('storage/' . $account->info->image) }}" width="200" alt="Profile Image">
                @else
                    <img src="{{ asset('client/images/user.png') }}" width="200" alt="Profile Image">
                @endif

            </div>
            <div class="profile-nav-info">
                <h3 class="user-name">{{ $account->info->name }}</h3>
                <div class="address">
                    <p id="state" class="state">{{ $account->info->role }}</p>
                </div>

            </div>
        </div>

        <div class="main-bd">
            <div class="left-side">
                <div class="profile-side">
                    <p class="user-mail"><i class="fa fa-envelope"></i> {{ $account->email }}</p>
                    <div class="user-bio">
                        <h3>Bio</h3>
                        <p class="bio">{{ $account->info->desc }}</p>
                    </div>
                    {{-- <div class="profile-btn">
                        <button class="chatbtn" id="chatBtn"><i class="fa fa-comment"></i> Chat</button>
                        <button class="createbtn" id="Create-post"><i class="fa fa-plus"></i> Create</button>
                    </div> --}}
                    {{-- <div class="user-rating">
                        <h3 class="rating">4.5</h3>
                        <div class="rate">
                            <div class="star-outer">
                                <div class="star-inner">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <span class="no-of-user-rate"><span>123</span>&nbsp;&nbsp;reviews</span>
                        </div>

                    </div> --}}
                </div>

            </div>
            <div class="right-side">

                <div class="nav">
                    <ul>
                        <li onclick="tabs(0)" class="user-post active" style="width: 20em">Bài Đăng</li>
                        @if ($account->id == Auth::user()->id)
                            <li onclick="tabs(1)" class="user-review">Chờ duyệt</li>
                            <li onclick="tabs(2)" class="user-reject">Từ Chối</li>
                            <li onclick="tabs(3)" class="user-setting">Yêu Thích</li>
                        @endif
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="profile-posts tab">
                        @if ($datas->where('status', 'approved')->count() > 0)
                            <div class="row">
                                @foreach ($datas as $data)
                                    <div class="col-md-6 col-lg-3 box">
                                        <div class="blog-entry">
                                            <a href="{{ route('post-detail', ['postID' => $data->id]) }}"
                                                class="img-link w-100 d-flex justify-content-center"
                                                style="background-color: cornsilk; height: 150px;">
                                                <x-pdf-thumbnail :pdfUrl="asset('storage/' . $data->doc->docLink)" id="{{ $data->id }}" width="150px"
                                                    height="150px" />
                                            </a>
                                            <span
                                                class="date">{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</span>
                                            <p><a href="{{ route('post-detail', ['postID' => $data->id]) }}"
                                                    class="text-limit">{{ $data->name }}</a></p>
                                            <div class="view">
                                                <p>{{ $data->view }}&nbsp;<i class="fa-regular fa-eye"></i></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Hiển thị phân trang -->
                            @if ($datas->lastPage() > 1)
                                <nav class="d-flex justify-content-center">
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($datas->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">&laquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $datas->previousPageUrl() }}"
                                                    rel="prev">&laquo;</a>
                                            </li>
                                        @endif

                                        {{-- Numbered Page Links --}}
                                        @php
                                            $currentPage = $datas->currentPage();
                                            $lastPage = $datas->lastPage();
                                            $maxPages = 5; // Số lượng trang tối đa hiển thị
                                            $halfMaxPages = floor($maxPages / 2);
                                            $startPage = max($currentPage - $halfMaxPages, 1);
                                            $endPage = min($currentPage + $halfMaxPages, $lastPage);
                                        @endphp

                                        @if ($startPage > 1)
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $datas->url(1) }}">1</a>
                                            </li>
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif

                                        @for ($i = $startPage; $i <= $endPage; $i++)
                                            <li class="page-item {{ $datas->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $datas->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($endPage < $lastPage)
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $datas->url($lastPage) }}">{{ $lastPage }}</a>
                                            </li>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($datas->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $datas->nextPageUrl() }}"
                                                    rel="next">&raquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">&raquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        @else
                            <div class="mb-3">
                                @include('client.components.empty')
                            </div>
                        @endif
                    </div>
                    @if ($account->id == Auth::user()->id)
                        <div class="profile-reviews tab">
                            @if ($dataPendings->where('status', 'pending')->count() > 0)
                                <div class="row">
                                    @foreach ($dataPendings as $data)
                                        <div class="col-md-6 col-lg-3 box">
                                            <div class="blog-entry">
                                                <a href="{{ route('post-detail', ['postID' => $data->id]) }}"
                                                    class="img-link w-100 d-flex justify-content-center"
                                                    style="background-color: cornsilk; height: 150px;">
                                                    <x-pdf-thumbnail :pdfUrl="asset('storage/' . $data->doc->docLink)" id="{{ $data->id }}"
                                                        width="150px" height="150px" />
                                                </a>
                                                <span
                                                    class="date">{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</span>
                                                <p><a href="{{ route('post-detail', ['postID' => $data->id]) }}"
                                                        class="text-limit">{{ $data->name }}</a></p>
                                                <div class="view">
                                                    <p>{{ $data->view }}&nbsp;<i class="fa-regular fa-eye"></i></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="mb-3">
                                    @include('client.components.empty')
                                </div>
                            @endif
                        </div>
                        <div class="profile-reject tab">
                            @if ($dataRejects->where('status', 'rejected')->count() > 0)
                                <div class="row">
                                    @foreach ($dataRejects as $data)
                                        <div class="col-md-6 col-lg-3 box">
                                            <div class="blog-entry">
                                                <a href="{{ route('post-detail', ['postID' => $data->id]) }}"
                                                    class="img-link w-100 d-flex justify-content-center"
                                                    style="background-color: cornsilk; height: 150px;">
                                                    <x-pdf-thumbnail :pdfUrl="asset('storage/' . $data->doc->docLink)" id="{{ $data->id }}"
                                                        width="150px" height="150px" />
                                                </a>
                                                <span
                                                    class="date">{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</span>
                                                <p><a href="{{ route('post-detail', ['postID' => $data->id]) }}"
                                                        class="text-limit">{{ $data->name }}</a></p>
                                                <div class="view">
                                                    <p>{{ $data->view }}&nbsp;<i class="fa-regular fa-eye"></i></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="mb-3">
                                    @include('client.components.empty')
                                </div>
                            @endif
                        </div>
                        <div class="profile-settings tab">
                            <div class="mb-3">
                                @include('client.components.empty')
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(".nav ul li").click(function() {
            $(this)
                .addClass("active")
                .siblings()
                .removeClass("active");
        });

        const tabBtn = document.querySelectorAll(".nav ul li");
        const tab = document.querySelectorAll(".tab");

        function tabs(panelIndex) {
            tab.forEach(function(node) {
                node.style.display = "none";
            });
            tab[panelIndex].style.display = "block";
        }
        tabs(0);

        let bio = document.querySelector(".bio");
        const bioMore = document.querySelector("#see-more-bio");
        const bioLength = bio.innerText.length;

        function bioText() {
            bio.oldText = bio.innerText;

            bio.innerText = bio.innerText.substring(0, 100) + "...";
            bio.innerHTML += `<span onclick='addLength()' id='see-more-bio'>See More</span>`;
        }
        //        console.log(bio.innerText)

        bioText();

        function addLength() {
            bio.innerText = bio.oldText;
            bio.innerHTML +=
                "&nbsp;" + `<span onclick='bioText()' id='see-less-bio'>See Less</span>`;
            document.getElementById("see-less-bio").addEventListener("click", () => {
                document.getElementById("see-less-bio").style.display = "none";
            });
        }
        if (document.querySelector(".alert-message").innerText > 9) {
            document.querySelector(".alert-message").style.fontSize = ".7rem";
        }
    </script>
@endsection
