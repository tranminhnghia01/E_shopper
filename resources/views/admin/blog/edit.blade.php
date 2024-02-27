@extends('admin.layouts.app')
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">blog</h4>
                @if (session('msg'))
                            <div class="alert alert-success">
                                {{ session('msg') }}
                            </div>
                        @endif
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material" enctype="multipart/form-data" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Blog Title <span style="color: red">(*)</span></label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="blog_title" value="{{ $data->blog_title }}">
                                    @error('blog_title')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Image</label>
                                <div class="col-md-12">
                                    <input type="file" class="form-control form-control-line" name="blog_image">
                                    @error('blog_image')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Descriptions</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control form-control-line"  name="blog_des">{{ $data->blog_des }}</textarea>
                                    @error('blog_des')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Content</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control form-control-line" id="content_blog"  name="blog_content">{{ $data->blog_content }}</textarea>
                                    @error('blog_content')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Edit blog</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
    <footer class="footer text-center">
        All Rights Reserved by Nice admin. Designed and Developed by
        <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>
@endsection