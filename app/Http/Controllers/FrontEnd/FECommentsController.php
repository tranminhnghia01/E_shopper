<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FECommentsController extends Controller
{
    public function post_Comments(CommentRequest $request)
    {
        $data = $request->all();

        $id_user = $data['id_user'];
        $user = User::find($id_user);
        $data['avatar'] = $user->avatar;
        $rs=Comment::create($data);
        $output='';
        $output.= '
                    <li class="media" >
                        <a class="pull-left" href="#">
                            <img class="media-object" src="'.url('admin/upload/user/avatar/'.$user->avatar).'"  style="width:121px; height: 86px;" alt="">
                        </a>
                        <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>'.$user->name.'</li>
                                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                </ul>
                                <p>'.$rs->comment.'</p>
                                <a class="btn btn-primary btn-reply-comment" data-comment_id="'.$rs->id.'"><i class="fa fa-reply"></i>Replay</a>
                        </div>
                    </li>
           ';
        echo($output);
    }
    public function get_level_replay(Request $request)
    {
        $level = $request->level;
        echo $level;
    }
}