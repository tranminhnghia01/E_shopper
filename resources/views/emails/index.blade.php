<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  Người mua : {{$data['user']->name  }}
                  Số điện thoại : {{$data['user']->phone  }}
                  Email liên hệ : {{$data['user']->email  }}
                </ol>
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
                        @php
                            $total_cart =0;
                        @endphp
                        @foreach ($data['body'] as $key=>$value )
                            <tr>
                                <td class="cart_description">
                                    <h4><a href="">{{ $value['name'] }}</a></h4>
                                    <p>ID product: {{ $value['id'] }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ $value['price'] }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <p class="cart_quantity_input" name="quantity">{{ $value['qty'] }}</p>
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

                        <p>Tổng đơn hàng: {{$total_cart }}</p>
                </tbody>
            </table>
        </div>
    </div>
    </section> <!--/#cart_items-->
    
</body>
</html>