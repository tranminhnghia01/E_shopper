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
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        @if (Auth::check())
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form>
                            <input type="text" placeholder="User Name" value="{{ $user->name }}">
                            <input type="text" placeholder="Email"  value="{{ $user->email }}">
                            <input type="text" placeholder="Phone"  value="{{ $user->phone }}">
                            <input type="text" placeholder="Phone"  value="{{ $user->address }}">
                        </form>
                        <a class="btn btn-primary" href="">Get Quotes</a>
                        <a class="btn btn-primary" href="">Continue</a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-sm-8">
            <div class="signup-form"><!--sign up form-->
                <h2>New User Signup!</h2>
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" name="name">
                                @error('name')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="email" id="example-email">
                                @error('email')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control form-control-line" name="password"  value="" placeholder="..........">
                                @error('password')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-12">Avatar</label>
                            <div class="col-md-12">
                                <input type="file" class="form-control form-control-line" name="avatar">
                                @error('avatar')
                                <span style="color: red"></span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="123 456 7890" class="form-control form-control-line" name="phone">
                                @error('phone')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Message</label>
                            <div class="col-md-12">
                                <textarea rows="5" class="form-control form-control-line"  name="address"></textarea>
                                @error('address')
                                <span style="color: red"></span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control-line" name="id_country">
                                    @foreach ($country as $key )
                                        <option  value="{{  $key->id }}">{{ $key->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Create Profile</button>
                            </div>
                        </div>
                </form>
            </div><!--/sign up form-->
        </div>
        @endif
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

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
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <form method="GET" action="{{ route('index-mails') }}">
                                    @csrf
                                    <input type="hidden" name="price" value="{{ $total_cart }}">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>$59</td>
                                    </tr>
                                    <tr>
                                        <td>Exo Tax</td>
                                        <td>$2</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>Free</td>										
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><span class="total-cart"> <?php echo $total_cart ?></span></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <button type="submit" class="btn btn-primary" >Order</button></td>
                                    </tr>
                                </form>
                                
                            </table>
                        </td>
                    </tr>
                @else
                <td>
                    <h4 class="cart_description">Không có mặt hàng nào trong giỏ hàng</h4>
                </td>
                @endif
            </tbody>


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
            </table>
        </div>

        {{-- <div class="table-responsive cart_info">
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
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/one.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/two.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/three.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>$59</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$2</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>$61</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->

@endsection

