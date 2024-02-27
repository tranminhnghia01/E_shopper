@extends('frontend.layouts.app')
@section('container')
<div class="col-sm-9">
    @foreach ($data as $value)
        <form action="{{ route('blog-details',$value->id) }}" method="get">
            <div class="blog-post-area">
                <h2 class="title text-center">Latest From our Blog</h2>
                <div class="single-blog-post">
                    <h3>{{ $value->blog_title }}</h3>
                    <div class="post-meta">
                        <ul>
                            <li><i class="fa fa-user"></i> Mac Doe</li>
                            <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                            <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                        </ul>
                        <span>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                        </span>
                    </div>
                    <a href="">
                        <img src="{{ asset('admin/upload/post/'.$value->blog_image) }}" alt="">
                    </a>
                    <input type="submit" class="btn btn-primary" value="Read More" href="">
                </div>
            </form>
            @endforeach
                <div class="pagination-area">
                    <ul class="pagination">
                        {{ $data->links('pagination::bootstrap-4') }}
                        {{-- <li><a href="" class="active">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href=""><i class="fa fa-angle-double-right"></i></a></li> --}}
                    </ul>
                </div>
            </div>

</div>
@endsection