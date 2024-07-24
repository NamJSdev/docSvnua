@extends('admin.layouts.app')

@section('title', 'Danh Mục')

@section('content')
    <div class="min-height-200px">
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20 d-flex flex-wrap align-items-center justify-content-between mb-4">
                <h4 class="text-blue h4">Danh Mục Tài Liệu</h4>
                <a href="{{ route('categories.create') }}" class="btn btn-primary add-list"><i class="las la-plus"></i>Thêm Danh Mục</a>
            </div>
            <div class="pb-20">
                <table class="table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Icon</th>
                            <th>Mô Tả</th>
                            <th>Số Bài Viết</th>
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
                                <td>{{ $data->name }}</td>
                                <td><i class="{{ $data->icon }}"></i></td>
                                <td>{{ $data->desc }}</td>
                                <td>{{ $data->posts_count }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item edit" href="#" href="#" title="Edit"
                                                data-toggle="modal" data-target="#editModal" data-id="{{ $data->id }}"
                                                data-name="{{ $data->name }}" data-icon="{{ $data->icon }}"
                                                data-desc="{{ $data->desc }}"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item delete" href="#" href="#" title="Delete"
                                                data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $data->id }}"><i class="dw dw-delete-3"></i> Delete</a>
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
    <!-- Edit Modal HTML -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" action="{{ route('categories.update') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Chỉnh Sửa Danh Mục</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="hidden" name="id">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control" name="icon" required>
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <textarea type="text" class="form-control" name="desc"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-info" value="Lưu">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" action="{{ route('categories.delete') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa Danh Mục</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa danh mục này, tất cả các bài viết trong danh mục cũng sẽ bị xóa?</p>
                        <input type="hidden" name="id" id="delete-id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-danger" value="Xóa">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            // Populate edit modal fields with existing data
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var icon = button.data('icon');
                var desc = button.data('desc');
                var modal = $(this);
                modal.find('input[name="id"]').val(id);
                modal.find('input[name="name"]').val(name);
                modal.find('input[name="icon"]').val(icon);
                modal.find('textarea[name="desc"]').val(desc);
            });

            // Populate delete modal with id
            $('.delete').click(function() {
                var id = $(this).data('id');
                console.log(id)
                $('#delete-id').val(id);
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
