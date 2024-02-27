<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FEUserController extends Controller
{
    public function index(Request $request)
    {
        $country = Country::all();
        $id_user = Auth::id();
        $user = User::findOrFail($id_user);
        return view('frontend.account.user_update')->with(compact('country','user'));
    }
    public function update_account(Request $request)
    {
        $userid= Auth::id();
        $user = User::findOrFail($userid);
        $data = $request->all();
        // dd($data);
        
        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
            
        }

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('admin/upload/user/avatar',$file->getClientOriginalName());
            }
            $msg = "Cập nhật thành công";
            $style ="success";
        }
        else{
            $msg = "Cập nhật không thành công";
            $style ="danger";
        }
        return redirect()->back()->with(compact('msg','style'));
        
    }
}
