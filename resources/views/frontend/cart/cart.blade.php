@extends('frontend.layouts.app')
@section('container')

@php
    $cart =(Session::get('cart'));
    if ($cart) {
        $total_cart =0;
    }
@endphp
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        @if (session('msg'))
					<div class="alert alert-{{session('style')}}">
						{{ session('msg') }}
					</div>
				@endif
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                @if (Session::get('cart'))
                    @foreach ($cart as $key=>$value )
                        @php
                            $image_product = json_decode($value['image'])
                        @endphp

                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="{{ asset('frontend/images/product-details/medium'.$image_product[0] )  }}" alt=""></a>
                                <input type="hidden" value="{{ $value['id'] }}">
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $value['name'] }}</a></h4>
                                <p>Web ID: {{ $value['id'] }}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{ $value['price'] }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{ $value['qty'] }}" autocomplete="off" size="2">
                                    <a class="cart_quantity_down"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                @php
                                    $total_product =  $value['price']* $value['qty'];
                                    $total_cart+=$total_product;
                                @endphp
                                <p class="cart_total_price">{{ $total_product  }}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                <td>
                    <h4 class="cart_description">Không có mặt hàng nào trong giỏ hàng</h4>
                </td>
                @endif
            </tbody>
        </table>
    </div>
</div>
</section> <!--/#cart_items-->


<script>
$(document).ready(function(){
        $(".cart_quantity_up").click(function(){

    var total_Cart = Number($(".total-cart").text());
    var up = Number($(this).closest(".cart_quantity_button").find("input").val());
    var price = $(this).closest("tr").find(".cart_price p").text();
    var price = Number(price.replace(/[^0-9]/g, ''));
    up+=1;   
    var total = up*price;
    total_Cart+=price;

    var down = 0;
    
    $(".total-cart").text(total_Cart);
    $(this).closest(".cart_quantity_button").find("input").val(up);
    $(this).closest("tr").find(".cart_total p").text(total);
    $(".total-cart").text();
    $("span.total").text(total);
    var id = $(this).closest("tr").find(".cart_product input").val();
        $.ajax({
            method:"GET",
            url: "{{ route('edit-cart-quantity-up') }}",
            data:{
                up:up,
                id:id,
                // down:down,
            },
            success : function(html){
                // console.log(html);
            },
        });
    });

    // //edit number quantity down
    $(".cart_quantity_down").click(function(){
        var total_Cart = Number($(".total-cart").text());
        var up = 0;
        var down = Number($(this).closest(".cart_quantity_button").find("input").val());
         down-=1;
        var price = $(this).closest("tr").find(".cart_price p").text();
        var price = Number(price.replace(/[^0-9]/g, ''));
        var total = down*price; 
        total_Cart-=price; 
         if (down <= 0) {
            $(this).closest("tr").remove();
         }else{
            $(this).closest(".cart_quantity_button").find("input").val(down);
            $(this).closest("tr").find(".cart_total p").text(total);
            $("span.total").text(total);
         }
         $(".total-cart").text(total_Cart);

         var id = $(this).closest("tr").find(".cart_product input").val();
            $.ajax({
                method:"GET",
                url: "{{ route('edit-cart-quantity-down') }}",
                data:{
                    down:down,
                    id:id,
                    // up:up,
                },
                success : function(html){
                    console.log(html);
                },
            });
        });
    });
</script>
   
@if (Session::get('cart'))
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span class="total-product"></span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span class="total-cart"> <?php echo $total_cart ?></span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endif
@endsection