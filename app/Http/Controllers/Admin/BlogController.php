<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        

    }
    public function index()
    {
        $blog_list=Blog::all();
        return view('admin.blog.list')->with(compact('blog_list'));
    }

    public function add()
    {
        return view('admin.blog.add');
    }
    public function post_Add(BlogRequest $request)
    {
       
        $data = $request->all();
        $file = $request->blog_image;

        if(!empty($file)){
            $data['blog_image'] = $file->getClientOriginalName();

        }

        
        $rs=Blog::create([
            'blog_title'=>$request->blog_title,
            'blog_des'=>$request->blog_des,
            'blog_content'=>$request->blog_content,
            'blog_image'=>$data['blog_image'],
        ]);
        if ($rs) {
            if (!empty($file)) {
                $file->move('admin/upload/post',$file->getClientOriginalName());
                
            }
            return redirect()->back()->with('msg',__('Add post success!'));
        }
        else{
            return redirect()->back()->with('msg','Add post errors.');
        }
        // return view('admin.blog.list')->with(compact('blog_list'));
    }
    public function edit($id)
    {
        $data=Blog::find($id);
        return view('admin.blog.edit')->with(compact('data'));
    }

    public function post_Edit(BlogRequest $request,$id)
    {
        $data=$request->all();
        $dataBlog=Blog::find($id);
        $file = $request->blog_image;

        if(!empty($file)){
            $data['blog_image'] = $file->getClientOriginalName();
        }


        if ($dataBlog->update($data)) {
            $msg = "Sửa thành công";
            if(!empty($file)){
                $file->move('admin/upload/post',$file->getClientOriginalName());
            }
            return  redirect()->route('admin.blog')->with(compact('msg'));
        }
        else{
            $msg = "Sửa không thành công";
            return back()->with(compact('msg'));
        }
    }

    public function delete($id)
    {   
        
    }
}
