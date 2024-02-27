<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FEHomeController extends Controller
{

    //show product detail
    public function product_Detail($id)
    {
        $brand =Brand::all();
        $category =Category::all();
        $detail=Product::findOrFail($id);
        return view('frontend.product.product-details')->with(compact('detail','brand','category'));
    }

    public function search(Request $request)
    {
        $brand =Brand::all();
        $category =Category::all();
        $keywords = $request->keywords;

        $search = Product::where('name','LIKE', '%'.$keywords.'%')->get();
        
        return view('frontend.product.search')->with(compact('brand','category','search','keywords'));
    }

    public function search_handle(Request $request)
    {
        $brand =Brand::all();
        $category =Category::all();
        // dd($request->all());

        $keywords = $request->keywords;
        $price = $request->price;
        $id_category = $request->id_category;
        $id_brand = $request->id_brand;
        $status = $request->status;

        $rs = Product::query();
        if ($keywords)
        {
            $rs->where('name','like','%'.$keywords.'%');
        }

        if ($id_category)
        {
            $rs->where('id_category',$id_category);
        }

        if ($id_brand)
        {
            $rs->where('id_brand',$id_brand);
        }

        if ($price)
        {
            $rs->where('id_brand',$price);
        }

        if ($status)
        {
            $rs->where('status',$status);
        }


        $search = $rs->paginate(6);
        
        return view('frontend.product.search')->with(compact('search','keywords','brand','category'));
    }


    public function search_home(Request $request)
    {
        $price =$request->price_val;
        $rs = explode (',',$price);
        if ($rs) {
            $search = Product::where('price','>',$rs[0])->where('price','<',$rs[1])->get();
        }
        return $search;
    }
}
