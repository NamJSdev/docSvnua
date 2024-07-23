<div class="wrapper">
    <div class="icon">
        <i id="left" class="fa-solid fa-angle-left"></i>
    </div>
    <ul class="tabsBox">
        <li class="tab {{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home-page') }}">Đề xuất</a></li>
        @foreach ($datas as $data)
            @php
                $currentCategoryID = request()->route('categoryID');
            @endphp

            <li class="tab {{ $currentCategoryID == $data->id ? 'active' : '' }}">
                <a href="{{ route('post-client.category', ['categoryID' => $data->id]) }}">
                    <i class="{{ $data->icon }}"></i>
                    {{ $data->name }}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="icon">
        <i id="right" class="fa-solid fa-angle-right"></i>
    </div>
</div>
