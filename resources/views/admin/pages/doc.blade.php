@extends('admin.layouts.app')

@section('title', 'Tài Liệu')

@section('content')
    <div class="min-height-200px">
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20 d-flex flex-wrap align-items-center justify-content-between mb-4">
                <h4 class="text-blue h4">Quản Lý Tài Liệu</h4>
            </div>
            <div class="pb-20">
                <table class="table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên Tài Liệu</th>
                            <th>Người Chia Sẻ</th>
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
                                    <x-pdf-thumbnail :pdfUrl="asset('storage/' . $data->doc->docLink)" id="{{ $data->id }}" />
                                </td>
                                <td class="truncated-text">{{ $data->name }}</td>
                                <td class="truncated-text">{{ $data->account->info->name }}</td>
                                <td >
                                    <a class="ml-3" title="Xem Tài Liệu" href="{{ asset('storage/' . $data->doc->docLink) }}"
                                        target="_blank" data-id="{{ $data->id }}"><i class="fa fa-eye font-18"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Simple Datatable End -->
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
