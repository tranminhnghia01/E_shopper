<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\History;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FELoginController extends Controller
{
    public function index()
    {
        $list_product = Product::orderBy('id','desc')->limit(6)->get();
        $brand =Brand::all();
        $category =Category::all();
        return view('frontend.dashboard')->with(compact('list_product','brand','category'));
    }

    public function show_Login()
    {
        $brand =Brand::all();
        $category =Category::all();
        $country = Country::all();
        return view('frontend.user.login')->with(compact('country','category','brand'));
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $login = [
            'email'=>$request->email,
            'password'=>$request->password,
            'level' => 0,
        ];

        if (Auth::attempt($login)) {
            $msg = "Đăng nhập thành công";
            $style ="success";
        }
        else{
            $msg = "Đăng nhập không thành công";
            $style ="danger";
        }
        return redirect()->route('trang-chu')->with(compact('msg','style'));
    }

    public function register(ProfileRequest $request)
    {
        $data = $request->all();
        $data['level'] = 0;
        // dd($data);
        $file =  $data['avatar'];
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        if ($data['password']) {
            $data['password']=bcrypt($request->password);
        }

        $user = User::create($data);
        if ($user) {
            if (!empty($file)) {
                $file->move('admin/upload/user/avatar',$file->getClientOriginalName());
                
            }
            // ------------------
            $login = [
                'email'=>$request->email,
                'password'=>$request->password,
                'level' => 0,
            ];
            // dd($login);
            
            // luu vao history va gui sendmail

            if (Auth::attempt($login)) {
                $msg = "Đăng ký người dùng thành công";
                $style ="success";
            }

        }else{
            $msg = "Đăng ký người dùng không thành công";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
