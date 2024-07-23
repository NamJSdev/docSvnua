@extends('client.layouts.app-none')
@section('title', 'Upload')
@section('content')
    <div class="container_upload">
        <h1>Upload tài liệu</h1>
        <p>Presentations, Documents, Infographics, and more</p>
        <form class="w-100" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="upload-section" class="w-100">
                <input name="doc" type="file" id="file-input" accept=".ppt,.pptx,.ppsx,.potx,.pdf,.doc,.docx" hidden>
                <button id="upload-button">Chọn Tài Liệu Tải lên</button>
                <div id="drag-drop-area">hoặc thả tài liệu tại đây</div>
            </div>
            <div id="form-section" class="w-100" style="display:none;">
                <div id="document-form">
                    <div class="file-info d-flex flex-column align-items-center justify-content-center" style="margin-left: 0px !important">
                        <div class="file-name">File name: <span id="file-name"></span></div>
                        <div class="file-size">File size: <span id="file-size"></span></div>
                    </div>
                    <div class="form-group">
                        <label for="doc-title">Tiêu Đề*</label>
                        <input type="text" id="doc-title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="doc-category">Danh Mục*</label>
                        <select id="doc-category" name="category" required>
                            <option value="">Chọn Danh Mục</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="doc-description">Mô Tả*</label>
                        <textarea id="doc-description" name="desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="doc-status">Privacy</label>
                        <div style="display: flex;margin-left: 35%;">
                            <label><input type="radio" name="privacy" value="public" checked> Public</label>
                            <label><input type="radio" name="privacy" value="private"> Private</label>
                        </div>
                    </div>
                    <div class="form-buttons d-flex justify-content-end">
                        <button type="submit">Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="text_upload mb-3">
        <span>Hỗ trợ các định dạng: Powerpoint (ppt, pptx, ppsx, potx), PDF, Word (doc, docx)</span>
    </div>
@endsection
