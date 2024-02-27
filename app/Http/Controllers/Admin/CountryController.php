<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $country;
    public function __construct()
    {
        $this->middleware('auth');
        $this->country = new Country();
    }

    public function index()
    {
        $country_list=$this->country::all();
        return view('admin.country.list')->with(compact('country_list'));
    }

    public function get_Edit($id)
    {
        $data=$this->country::find($id);
        return view('admin.country.edit')->with(compact('data'));
    }

    public function post_Edit(CountryRequest $request,$id)
    {
            $data=$request->all();

            $edit_country=$this->country::where('id',$id)->update([
                'country_name' =>$request->country_name,
                'country_des' =>$request->country_des,
            ]);
            if ($edit_country) {
                $msg = "Sửa thành công";
                return  redirect()->route('admin.country')->with(compact('msg'));
            }
            else{
                $msg = "Sửa không thành công";
                return back()->with(compact('msg'));
            }
    }

    public function add()
    {
        return view('admin.country.add');
    }

    public function post_Add(CountryRequest $request)
    {
            $data=$request->all();
            // dd($data);
            $result = $this->country::create([
                'country_name'=>$request->country_name,
                'country_des'=>$request->country_des,
            ]);

            if ($result) {
                $msg = "thêm thành công";
                return redirect()->route('admin.country')->with(compact('msg'));
            }
            else{
                $msg = "thêm không thành công";
                return back()->with(compact('msg'));
            }
    }

    public function delete($id)
    {
        $result=$this->country::where('id',$id)->delete();
        if ($result) {
            $msg = "Xóa thành công";
            return back()->with(compact('msg'));
        }
        else{
            $msg = "Xóa không thành công";
            return back()->with(compact('msg'));
        }
    }
}
