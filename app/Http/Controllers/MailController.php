<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\History;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
session_start();

class MailController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $id_user = Auth::id();
        $user = User::find($id_user);
        
        $total = $request->price;
       
            $data=[
                'subject'=>'Xác nhận đơn hàng',
                'body' => Session::get('cart'),
                'user' =>$user,

            ];
            $history = [
                'email'=>$user->email,
                'phone'=>$user->phone,
                'name'=>$user->name,
                'id_user'=>$user->id,
                'price'=>$total,
            ];
            // dd($data);
            try {
                Mail::to('minhnghia11a1@gmail.com')->send(new MailNotify($data));
                if (History::create($history)) {
                    return response()->json(['Great check your mail box']);
                }
            } catch (Exception $th) {
                return response()->json(['sorry']);
            }
        // }


        // // dd($request->all());
        // $id_user = Auth::id();
        // $user = User::find($id_user);

       
        // $total = $request->price;
        // // $history =History::create($info);
        // // if($history){
        //     $data=[
        //         'subject'=>'Xác nhận đơn hàng',
        //         'price' => $total,
        //     ];
        //     try {
        //         Mail::to('minhnghia11a1@gmail.com')->send(new MailNotify($data));
        //         return response()->json(['Great check your mail box']);
            
        //     } catch (Exception $th) {
        //         return response()->json(['sorry']);
        //     }
    }
}
