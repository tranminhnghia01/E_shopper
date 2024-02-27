@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Default Table</h4>
                        <h6 class="card-subtitle">Using the most basic table markup, here’s how <code>.table</code>-based tables look in Bootstrap. All table styles are inherited in Bootstrap 4, meaning any nested tables will be styled in the same manner as the parent.</h6>
                        <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Table With Outside Padding</h6>
                        @if (session('msg'))
                            <div class="alert alert-success">
                                {{ session('msg') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Images</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blog_list as $key )
                                        <tr>
                                            <th scope="row">{{ $key->id }}</th>
                                            <td>{{ $key->blog_title }}</td>
                                            <td><img src="{{ asset('admin/upload/post/'.$key->blog_image) }}" alt="" style="width: 50px;"></td>
                                            <td>{{ $key->blog_des }}</td>
                                            <td>
                                                <a href="{{ route('admin.blog-edit',$key->id) }}">Edit</a><br/>
                                                <a href="{{ route('admin.blog-delete',$key->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="{{ route('admin.blog-add') }}" class="btn btn-success">Add Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection