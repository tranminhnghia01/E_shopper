<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $country;
    public function __construct()
    {
        $this->middleware('auth');
        $this->country =new Country();

    }
    
    public function profile()
    {
        $user=Auth::user();
        $country = $this->country::all();
        return view('admin.user.user')->with(compact('user','country'));
    }

    public function edit_Profile(ProfileRequest $request)
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
            return redirect()->back()->with('msg',__('Update profile success!'));
        }
        else{
            return redirect()->withErrors('Update profile errors.');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
