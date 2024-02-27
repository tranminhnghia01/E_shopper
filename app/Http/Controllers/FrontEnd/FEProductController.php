<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Image;

class FEProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function my_product()
    {
        $list = Product::all();
        return view('frontend.account.product')->with(compact('list'));
    }

    public function my_product_add(Request $request)
    {
        $category= Category::all();
        $brand= Brand::all();
        return view('frontend.account.add-product')->with(compact('category','brand'));
    }

    public function post_Add(ProductRequest $request)
    {
        $data = $request->all();
        $id_user = Auth::id();
        $user = User::findOrFail($id_user);
        $data['id_user'] = $user->id;

        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $image)
            {
                $name = $image->getClientOriginalName();
                $file_images[] = $name;
            }
        }
        $data['image']=json_encode($file_images);
        $data['created_at'] = date('Y-m-d H:i:s');

        // // dd($data);
        if (Product::create($data)) {
            if($request->hasfile('image'))
                {
                    foreach($request->file('image') as $image)
                    {

                        $name = $image->getClientOriginalName();
                        $name_2 = "small".$image->getClientOriginalName();
                        $name_3 = "medium".$image->getClientOriginalName();
                        $name_4 = "large".$image->getClientOriginalName();
                        //$image->move('upload/product/', $name);
                        $path = public_path('frontend/images/product-details/' . $name);
                        $path2 = public_path('frontend/images/product-details/' . $name_2);
                        $path3 = public_path('frontend/images/product-details/' . $name_3);
                        $path4 = public_path('frontend/images/product-details/' . $name_4);

                        Image::make($image->getRealPath())->save($path);
                        Image::make($image->getRealPath())->resize(70, 70)->save($path2);
                        Image::make($image->getRealPath())->resize(110, 110)->save($path3);
                        Image::make($image->getRealPath())->resize(280, 380)->save($path4);
                        // $file_images[] = $name;
                        
                    }
                }
           
            $msg = 'Thêm sản phẩm thành công';
            $style = 'success';
        }else{
            $msg = 'Thêm sản phẩm không thành công';
            $style = 'danger';
        }
        
        return redirect()->back()->with(compact('msg','style'));
    }

    public function my_product_edit(Request $request,$id)
    { 
        $category= Category::all();
        $brand= Brand::all();
        $product = Product::find($id);

        return view('frontend.account.edit-product')->with(compact('category','brand','product'));
    }

    public function post_Edit(Request $request,$id)
    {
        $data = $request->all();
        $product = Product::find($id);
        $images_delete = $request->hinhxoa;  
        // dd($images_delete);

        $image_old =json_decode($product->image);
        if (!empty($images_delete)) {
            foreach ($image_old as $key => $value) {
                if (in_array($value,$images_delete)) {
                 unset($image_old[$key]);
                }
             }
        }
        
        $image_new = $image_old;

        //hinh them
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $image)
            {
                $name = $image->getClientOriginalName();
                $file_images[] = $name;
            }
            $image_new = array_merge($file_images ,$image_old);
        }

        if (count($image_new)<=4 && count($image_new)> 0) {
            $data['image']=json_encode($image_new);
            // dd($data);
            if ($product->update($data)) {
                if($request->hasfile('image'))
                {
                    foreach($request->file('image') as $image)
                    {

                        $name = $image->getClientOriginalName();
                        $name_2 = "small".$image->getClientOriginalName();
                        $name_3 = "medium".$image->getClientOriginalName();
                        $name_4 = "large".$image->getClientOriginalName();
                        //$image->move('upload/product/', $name);
                        $path = public_path('frontend/images/product-details/' . $name);
                        $path2 = public_path('frontend/images/product-details/' . $name_2);
                        $path3 = public_path('frontend/images/product-details/' . $name_3);
                        $path4 = public_path('frontend/images/product-details/' . $name_4);

                        Image::make($image->getRealPath())->save($path);
                        Image::make($image->getRealPath())->resize(70, 70)->save($path2);
                        Image::make($image->getRealPath())->resize(110, 110)->save($path3);
                        Image::make($image->getRealPath())->resize(280, 380)->save($path4);
                        
                    }
                }
                $msg = 'Cập nhật sản phẩm thành công';
                $style = 'success';
            }else{
                $msg = 'Cập nhật sản phẩm không thành công';
                $style = 'danger';

            }
        }
        else{
            $msg = 'Lỗi hình ảnh';
            $style = 'danger';

        }
        return redirect()->back()->with(compact('msg','style'));

       
    }

    public function my_product_delete(Request $request)
    {
        
    }

}
