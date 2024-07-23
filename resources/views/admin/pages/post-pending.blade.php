@extends('admin.layouts.app')

@section('title', 'Duyệt Tài Liệu')

@section('content')
    <div class="min-height-200px">
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20 d-flex flex-wrap align-items-center justify-content-between mb-4">
                <h4 class="text-blue h4">Duyệt Tài Liệu</h4>
            </div>
            <div class="pb-20">
                <table class="table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tiêu Đề</th>
                            <th>Danh Mục</th>
                            <th>Người Đăng</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Tính số thứ tự bắt đầu của bản ghi đầu tiên trên trang hiện tại
                            $startIndex = ($datas->currentPage() - 1) * $datas->perPage() + 1;
                        @endphp
                        @foreach ($datas as $index => $data)
                            <tr data-id="{{ $data->id }}">
                                <td>{{ $startIndex + $index }}</td>
                                <td>
                                    <!-- Sử dụng component PdfThumbnail với kích thước tùy chỉnh -->
                                    <x-pdf-thumbnail :pdfUrl="asset('storage/' . $data->doc->docLink)" id="{{ $data->id }}"/>
                                </td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    @foreach ($data->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </td>
                                <td>{{ $data->account->info->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="{{asset('storage/' . $data->doc->docLink)}}" target="_blank"
                                                data-id="{{ $data->id }}"><i class="fa fa-eye"></i> Xem Tài Liệu</a>
                                            <a class="dropdown-item approved" href="#" href="#" title="Approved"
                                                data-toggle="modal" data-target="#approvedModal"
                                                data-id="{{ $data->id }}"><i class="fa fa-check-circle"></i> Duyệt</a>
                                            <a class="dropdown-item delete" href="#" href="#" title="Delete"
                                                data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $data->id }}"><i class="fa fa-times-circle"></i> Từ Chối</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Simple Datatable End -->
    </div>
    <!-- Approved Modal HTML -->
    <div id="approvedModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="apoprvedForm" method="POST" action="{{route('posts.approved')}}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Duyệt Tài Liệu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn duyệt tài liệu này?</p>
                        <input type="hidden" name="id" id="approved-id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-primary" value="Duyệt">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" method="POST" action="{{route('posts.rejected')}}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Từ Chối Duyệt</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn bỏ qua tài liệu này?</p>
                        <input type="hidden" name="id" id="delete-id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-danger" value="Từ Chối Duyệt">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            // Populate delete modal with id
            $('.delete').click(function() {
                var id = $(this).data('id');
                $('#delete-id').val(id);
            });
            $('.approved').click(function() {
                var id = $(this).data('id');
                $('#approved-id').val(id);
            });
        });
    </script>
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
                        <a class="page-link" href="{{ $datas->previousPageUrl() }}" rel="prev">&laquo;</a>
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
                        <a class="page-link" href="{{ $datas->url($lastPage) }}">{{ $lastPage }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($datas->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
@endsection
