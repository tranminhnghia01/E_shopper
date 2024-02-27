<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $list=Brand::all();
        return view('admin.brand.list')->with(compact('list'));
    }

    public function add()
    {
        return view('admin.brand.add');
    }
    
    public function post_Add(BrandRequest $request)
    {
       
        $data = $request->all();
        
        // dd($data);
        if (Brand::create($data)) {
            $msg = "Thêm thương hiệu thành công";
            $style ="success";
        }
        else{
            $msg = "Thêm thương hiệu không thành công";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
        
    }
    public function edit($id)
    {
        $detail=brand::find($id);
        return view('admin.brand.edit')->with(compact('detail'));
    }

    public function post_Edit(brandRequest $request,$id)
    {
        $data=$request->all();
        $detail=brand::find($id);


        if ($detail->update($data)) {
            $msg = "Cập nhật thương hiệu thành công";
            $style ="success";
        }
        else{
            $msg = "Cập nhật thương hiệu không thành công";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
        
    }

    public function delete($id)
    {   
        if (Brand::find($id)->delete()) {
            $msg = "Xóa thương hiệu thành công";
            $style ="success";
        }
        else{
            $msg = "Xóa thương hiệu không thành công";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
    }
}
