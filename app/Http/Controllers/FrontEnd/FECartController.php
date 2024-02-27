<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\History;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

session_start();

class FECartController extends Controller
{
    public function add_Cart(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);

        $array['id'] = $product->id;
        $array['name'] = $product->name;
        $array['price'] = $product->price;
        $array['image'] = $product->image;
        $array['qty'] = 1;
        $x=1;
        $cart = Session::get('cart');
        if ($cart) {
            foreach ($cart as $key => $value) {
                if ($value['id'] == $id) {
                    $cart[$key]['qty']++;
                    $x=2;
                    Session::put('cart',$cart);
                    Session::save();
                }
            }
        }

        if ($x==1) {
            $cart[]=$array;
            Session::put('cart',$cart);
            Session::save();
        }
        echo (count($cart));

    }

    public function show_Cart()
    {
        $category= Category::all();
        $brand= Brand::all();
        return view('frontend.cart.cart')->with(compact('category','brand'));
    }

    public function edit_cart_quantity_up(Request $request)
    {
        $quantity_up = $request->up;
        $cart = Session::get('cart');

        // dd($quantity_down);

            foreach ($cart as $key => $value) {
                if ($value['id']== $request->id) {
                    $cart[$key]['qty'] = $quantity_up;
                }
            }
       
        
        Session::put('cart',$cart);
        Session::save();
    }
    public function edit_cart_quantity_down(Request $request)
    {
        $quantity_down = $request->down;
        $cart = Session::get('cart');

       
            foreach ($cart as $key => $value) {
                if ($value['id']== $request->id) {
                    if ($quantity_down == 0) {
                        unset($cart[$key]);
                    }else{
                        $cart[$key]['qty'] = $quantity_down;
                    }
                }
            }
        
        Session::put('cart',$cart);
        Session::save();
        dd($cart);
    }

    public function checkout()
    {
        $country = Country::all();
        $id_user = Auth::id();
        $user = User::find($id_user);
        return view('frontend.cart.checkout')->with(compact('country','user'));
    }
}
