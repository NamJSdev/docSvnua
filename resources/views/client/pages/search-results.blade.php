@extends('client.layouts.app-none-banner')

@section('title', 'Tìm Kiếm Tài Liệu')

@section('content')
    <div class="text_content">
        <h2 class="text-center">Kết quả tìm kiếm cho: "{{ $searchQuery }}"</h2>
    </div>
    @if ($posts->where('status', 'approved')->count() > 0)
        <!-- Start posts-entry -->
        <section class="section posts-entry posts-entry-sm">
            <div class="container">
                <div class="row" id="document-list">
                    @foreach ($posts as $post)
                        <div class="document col-md-6 col-lg-3 box" data-type="pdf" data-language="english">
                            <div class="blog-entry">
                                <a href="{{ route('post-detail', ['postID' => $post->id]) }}" class="img-link w-100 d-flex justify-content-center"
                                    style="background-color: cornsilk; height: 150px;">
                                    <x-pdf-thumbnail :pdfUrl="asset('storage/' . $post->doc->docLink)" id="{{ $post->id }}" width="150px"
                                        height="150px" />
                                </a>
                                <span class="date">{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y H:i') }}</span>
                                <h2><a href="{{ route('post-detail', ['postID' => $post->id]) }}" class="text-limit">{{ $post->name }}</a></h2>
                                <p class="text-limit">{{ $post->desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <div class="mb-3">
            @include('client.components.empty')
        </div>
    @endif
@endsection