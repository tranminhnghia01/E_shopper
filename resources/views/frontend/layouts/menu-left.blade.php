<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach ($category as $value)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="#">{{ $value->category_name }}</a></h4>
                    </div>
                </div>
            @endforeach
        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach ($brand as $val)
                        <li><a href="#"> <span class="pull-right">(4)</span>{{ $val->brand_name }}</a></li>
                    @endforeach
                </ul>
            </div>
           
        </div><!--/brands_products-->
        
        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                 <input type="text" class="span2 price-val" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->
        
        <div class="shipping text-center"><!--shipping-->
            <img src="images/home/shipping.jpg" alt="" />
        </div><!--/shipping-->
        
        <script>
            $(document).ready(function(){
                var html ='';
                $('.price-range').click(function(){
                    var price_val= $(this).find('input').val();
                    $.ajax({
                        type:'GET',
                        url:"{{ route('search-home') }}",
                        data:{price_val:price_val},
                        success:function(data){  
                           Object.keys(data).map((key,value)=>{
                            var get_image = JSON.parse(data[key]['image']);
                            console.log(get_image[0]);
                            var url_img = "{{ asset('frontend/images/product-details/large/') }}"+get_image[0];

                            var href = "{{ url('/member/product/details/') }}" +"/"+ data[key]['id'];


                            console.log(href);
                            html+="<div class='col-sm-4'>"+
                                "<div class='product-image-wrapper'>"+
                                    "<div class='single-products'>"+
                                            "<div class='productinfo text-center'>"+
                                                "<input type='hidden' class='id' value='"+data[key]['id']+"'>"+
                                                "<img src='"+url_img+"' alt='' />"+
                                                "<h2>"+data[key]['price']+"</h2>"+
                                                "<p>"+data[key]['name']+"</p>"+
                                                "<a class='btn btn-default add-to-cart' data-product_id='"+data[key]['id']+"'><i class='fa fa-shopping-cart'></i>Add to cart</a>"+
                                                "<a href='"+href+"' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Detail</a>"+
                                            "</div>"+
                                    "</div>"+
                                    "<div class='choose'>"+
                                        "<ul class='nav nav-pills nav-justified'>"+
                                            "<li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li>"+
                                            "<li><a href='#'><i class='fa fa-plus-square'></i>Add to compare</a></li>"+
                                        "</ul>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"
                           });
                        $('.features_items').html(html);
                        html = '';

                        }

                    });


                })

            })
        </script>
    </div>
</div>