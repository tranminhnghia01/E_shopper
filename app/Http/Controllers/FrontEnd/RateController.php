<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        

    }

    public function index(Request $request)
    {
        $data = $request->all();
        $rate = $request->rate;
        // dd($data);

        if (Auth::check()) {
            // "SELECT * FROM `rate` WHERE (`id_blog` = $id_blog AND `id_user`= $id_user)"
            $rs= Rate::where('id_blog',$data['id_blog'])->where('id_user',$data['id_user'])->first();
            if ($rs) {
                echo 'đã đánh giá';
            }else{
                Rate::create($data);
                echo 'Đánh giá thành công';
            }
        }else{
            echo 'Vui lòng đăng nhập để đánh giá';
        }
        $sum_rate = Rate::where('id_blog',$data['id_blog'])->sum('rate');
        $count = Rate::where('id_blog',$data['id_blog'])->count('id_blog');

    }
}
