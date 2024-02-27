@extends('frontend.layouts.app')
@section('container')
    
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Kết quả tìm kiếm</h2>
        <div class="signup-form">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <div class="col-md-3">
                        <input type="text" placeholder="" class="form-control form-control-line" name="keywords" value="{{ $keywords }}">
                    </div>
                </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <select class="form-control form-control-line" name="price">
                                    <option  value="">choose price</option>
                                    <option  value="1">0 - 100 $</option>
                                    <option  value="2">100 - 500 $</option>
                                    <option  value="3">500 - 1000 $</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <select class="form-control form-control-line" name="id_category">
                                <option value="" selected>Category</option>
                                @foreach ($category as $key )
                                    <option  value="{{  $key->id }}">{{ $key->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <select class="form-control form-control-line" name="id_brand">
                                <option value="" selected>Brand</option>
                                @foreach ($brand as $key )
                                    <option  value="{{  $key->id }}">{{ $key->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <select class="form-control form-control-line" name="status">
                                <option value="" selected>Status</option>
                                <option value="0">New</option>
                                <option value="1">Old</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-3">
                            <input type="submit"  class="btn btn-primary btn-success" value="Search">
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <div>
        @foreach ($search as $key=>$value )
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            @php
                            $get_image = json_decode($value->image);
                            @endphp
                            <input type="hidden" class="id" value="{{ $value->id }}">
                            <img src="{{ asset('frontend/images/product-details/medium'.$get_image[0] ) }}" alt="" />
                            <h2>{{ $value->price }}</h2>
                            <p>{{ $value->name }}</p>
                            <a class="btn btn-default add-to-cart" data-product_id="{{ $value->id }}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            <a href="{{ route('product-detail',$value->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Detail</a>
                        </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        
    </div><!--features_items-->

    <script>
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
                var id = $(this).data('product_id');
                $.ajax({
                    type:'GET',
                    url:"{{ route('add-to-cart') }}",
                    data:{id:id},
                    success:function(data){     
                        // console.log(session->get('cart'));
                    }
                })
            });
        })
    </script>
</div>
@endsection
