@extends('frontend.layouts.app')
@section('container')
    <section id="cart_items">
        <div class="col-sm-9">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="id">ID</td>
                            <td class="name">Name</td>
                            <td class="image">Image</td>
                            <td class="price">Price</td>
                            <td class="total">Action</td>
                            <td class=""></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key)
                       
                        @php
                            $image_product = json_decode($key->image);
                        @endphp 
                        <tr>
                            <td class="cart_id">
                                <p>{{ $key->id }}</p>
                            </td>
                            <td class="cart_name">
                                <h4><a href="">{{ $key->name }}</a></h4>
                            </td>
                            <td class="cart_product">
                                <a href=""><img src="{{ asset('frontend/images/product-details/medium'.$image_product[0] ) }}" alt=""></a>
                            </td>
                            <td class="cart_price">
                                <p>{{ $key->price }}</p>
                            </td>
                            <td class="cart_edit">
                                <a class="cart_quantity_edit" href="{{ route('my-product-edit',$key->id) }}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{ route('my-product-delete',$key->id) }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="form-group col-md-12">
                    <a href="{{ route('my-product-add') }}" class="btn btn-primary pull-right" value="Add new">Add new</a>
                </div>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection