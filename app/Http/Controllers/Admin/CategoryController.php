<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $list=Category::all();
        return view('admin.category.list')->with(compact('list'));
    }

    public function add()
    {
        return view('admin.category.add');
    }
    public function post_Add(CategoryRequest $request)
    {
        $data = $request->all();

        // dd($data);
        if (Category::create($data)) {
            $msg = "Thêm danh mục thành công";
            $style ="success";
        }
        else{
            $msg = "Thêm danh mục không thành công";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
        
    }
    public function edit($id)
    {
        $detail=Category::find($id);
        return view('admin.category.edit')->with(compact('detail'));
    }

    public function post_Edit(CategoryRequest $request,$id)
    {
        $data=$request->all();
        $detail=Category::find($id);


        if ($detail->update($data)) {
            $msg = "Cập nhật danh mục thành công";
            $style ="success";
        }
        else{
            $msg = "Cập nhật danh mục không thành công";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
        
    }

    public function delete($id)
    {   
        if (Category::find($id)->delete()) {
            $msg = "Xóa danh mục thành công";
            $style ="success";
        }
        else{
            $msg = "Xóa danh mục không thành công";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
    }
}
