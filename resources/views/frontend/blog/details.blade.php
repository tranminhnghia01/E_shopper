@extends('frontend.layouts.app')
@section('container')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">
            <h3>{{ $details->blog_title }}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <!-- <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </span> -->
            </div>
            <a href="">
                <img src="{{ asset('admin/upload/post/'.$details->blog_image) }}" alt="">
            </a>
            <p>
                {{ $details->blog_content }}
            </p>
            <div class="pager-area">
                <ul class="pager pull-right">
                    @if ($previous)
                        <li><a href="{{ route('blog-details',$previous) }}">Pre</a></li>
                    @endif

                    @if ($next)
                        <li><a href="{{ route('blog-details',$next ) }}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div><!--/blog-post-area-->

    <div class="rating-area">
        <ul class="ratings">
            <div class="rating_id" style="display: none">{{ $details->id }}</div>
            <div class="user_id" style="display: none">
            @if (Auth::check())
                {{ Auth::user()->id }}
            @else
            0
            @endif
            </div>
            <li class="rate-this">Rate this item:</li>
            <li>
                <div class="rate">
                    <div class="vote">
                        <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                        <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                        <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                        <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                        <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                <span class="rate-np">
                    @if ($sum_rate == 0)
                    @else
                        {{ round(($sum_rate/$count),0) }} 
                    @endif
                </span>
                    </div> 
                </div>
            </li>
            <li class="color person-rate">(@if ($count ==0)
                Chưa có bản đánh giá nào
            @else
                {{ $count }}
            @endif)</li>
        </ul>
        <ul class="tag">
            <li>TAG:</li>
            <li><a class="color" href="">Pink <span>/</span></a></li>
            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
            <li><a class="color" href="">Girls</a></li>
        </ul>
    </div><!--/rating-area-->

    <script>
        $(document).ready(function(){
            var get_rate =Number($(".rate-np").text());
            $(".star_"+get_rate).prevAll().andSelf().addClass('ratings_over');
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        //vote
        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_hover');
                // $(this).nextAll().removeClass('ratings_vote'); 
            },
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );
    
        $('.ratings_stars').click(function(){
      
            var rate =  $(this).find("input").val();
            var id_blog = $(this).closest('.ratings').find('.rating_id').text();
            var id_user = Number($(this).closest('.ratings').find('.user_id').text());
            // alert(id_user);
            if (id_user == 0) {
                alert("Vui lòng đăng nhập để đánh giá");
            }
            else{
                $.ajax({
                    type:'POST',
                    url:"{{ route('rate') }}",
                    data:{rate:rate,id_blog:id_blog,id_user:id_user},
                    success:function(data){                        
                        confirm(data);
                    }
                })
            }
            // alert(Values);
            // if ($(this).hasClass('ratings_over')) {
            //     $('.ratings_stars').removeClass('ratings_over');
            //     $(this).prevAll().andSelf().addClass('ratings_over');
            // } else {
            //     $(this).prevAll().andSelf().addClass('ratings_over');
            // }
        });
    });
    </script>
    
    

    <div class="socials-share">
        <a href=""><img src="{{ asset('frontend/images/blog/socials.png') }}" alt=""></a>
    </div><!--/socials-share-->

    @include('frontend.blog.comments')
</div>	

@endsection