<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FEBlogController extends Controller
{
    //

    public function index()
    {
        $category = Category::all();
        $brand = Brand::all();
        $data = Blog::paginate(3);
        return view('frontend.blog.list')->with(compact('data','category','brand'));
    }

    public function get_Details($id)
    {
        $category = Category::all();
        $brand = Brand::all();

        if (Auth::check()) {
            $userid= Auth::id();
            $user = User::findOrFail($userid) ;
        }else{
            $user = 0 ;
        }
        $rate = Rate::find($id);
        $details = Blog::find($id);
        //Show comments
        $comments = Comment::where('level',0)->where('id_blog',$id)->get();
        $comments_reply = Comment::where('level','!=',0)->where('id_blog',$id)->get();
        
    // get previous user id
        $previous = Blog::where('id', '<', $details->id)->max('id');

        // get next user id
        $next = Blog::where('id', '>', $details->id)->min('id');
        // dd($getId);

        
        //Tinh rate
       
        $sum_rate = Rate::where('id_blog',$id)->sum('rate');
        $count = Rate::where('id_blog',$id)->count('id_blog');

        return view('frontend.blog.details')->with(compact('category','brand','details','previous','next','sum_rate','count','user','comments','comments_reply')); 
    }
}
