@extends('admin.layouts.app')
@section('title', 'Thêm Danh Mục')

@section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Thêm Danh Mục</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.store') }}" data-toggle="validator">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên *</label>
                                        <input type="text" class="form-control" placeholder="Nhập Tên Danh Mục" name="name"
                                            required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Icon</label>
                                        <input type="text" class="form-control" placeholder="Nhập Mã Fontawesome" name="icon"
                                            required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mô Tả</label>
                                        <textarea type="text" class="form-control" name="desc" placeholder="Mô Tả"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                                Tạo Danh Mục
                            </button>
                            <button type="reset" class="btn btn-danger">Làm Mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
@endsection
