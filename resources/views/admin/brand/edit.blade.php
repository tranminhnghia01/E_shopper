@extends('admin.layouts.app')
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">brand</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">brand</li>
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
                                <label class="col-md-12">brand Title <span style="color: red">(*)</span></label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="brand_name" value="{{ $detail->brand_name }}">
                                    @error('brand_name')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Descriptions</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control form-control-line"  name="brand_des">{{ $detail->brand_des }}</textarea>
                                    @error('brand_des')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Edit brand</button>
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