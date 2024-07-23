<!-- Start posts-entry -->
<section class="section posts-entry posts-entry-sm">
    <div class="container">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h2 class="posts-entry-title">Được Xem Nhiều Nhất</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($topPosts as $data)
                <div class="col-md-6 col-lg-3 box">
                    <div class="blog-entry">
                        <a href="{{ route('post-detail', ['postID' => $data->id]) }}"
                            class="img-link w-100 d-flex justify-content-center"
                            style="background-color: cornsilk; height: 150px;">
                            <x-pdf-thumbnail :pdfUrl="asset('storage/' . $data->doc->docLink)" id="{{ $data->id }}" width="150px" height="150px" />
                        </a>
                        <span class="date">{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</span>
                        <h2><a href="{{ route('post-detail', ['postID' => $data->id]) }}"
                                class="text-limit">{{ $data->name }}</a></h2>
                        <div class="view">
                            <p>{{$data->view}}&nbsp;<i class="fa-regular fa-eye"></i></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End posts-entry -->

