<div class="response-area">
    <h2>3 RESPONSES</h2>
    <ul class="media-list">
        @foreach ($comments as $key)
        <li class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="{{ asset('admin/upload/user/avatar/'.$key->avatar) }}" alt="" style="width: 121px ; height: 86px;">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>{{ $key->name }}</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>{{ $key->comment }}</p>
                <a class="btn btn-primary btn-reply-comment"  data-comment_id="{{ $key->id }}"><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li>
            @foreach ($comments_reply as $key_reply )
                @if ($key_reply->level == $key->id)
                    <li class="media second-media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="{{ asset('admin/upload/user/avatar/'.$key_reply->avatar) }}" alt="" style="width: 121px ; height: 86px;">
                        </a>
                        <div class="media-body">
                            <ul class="sinlge-post-meta">
                                <li><i class="fa fa-user"></i>{{ $key_reply->name }}</li>
                                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                            </ul>
                            <p>{{ $key_reply->comment }}</p>
                            <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                        </div>
                    </li>
                    
                @endif
            @endforeach
        @endforeach
    </ul>		
</div><!--/Response-area-->
<div class="replay-box">
    <div class="row">
        <div class="col-sm-12">
            <h2>Leave a replay</h2>
            <div class="text-area">
                <form>
                    @csrf
                    <div class="blank-arrow">
                        @if (Auth::check())
                        <label class="name">{{ $user->name }}</label>
                    @else
                        <label class="name">Your name</label>
                    @endif
                    </div>
                    <span>*</span>
                    <input type="hidden" class="level" value="0">
                    <input type="hidden" class="id_blog" value="{{ $details->id }}">
                    @if (Auth::check())
                        <input type="hidden" class="id_user" value="{{ $user->id }}">
                    @else
                        <input type="hidden" class="id_user" value="0">
                    @endif
                    <textarea name="comment" class="comment" rows="11"></textarea>
                    <a class="btn btn-primary post-comment">post comment</a>
                </form>
                
            </div>
        </div>
    </div>
</div><!--/Repaly Box-->


<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        var id_blog = $(".id_blog").val();
        var id_user = $(".id_user").val();
        var _token= $('input[name="_token"]').val();
        $('.post-comment').click(function(){
            var level = $(this).closest('form').find('.level').val();
            var comment = $(this).closest('form').find('.comment').val();
            var name = $(this).closest('form').find('.name').text();
            // alert(comment);
            if (id_user == 0) {
                alert("Vui lòng đăng nhập để bình luận");
            }else{
                $.ajax({
                    type:'POST',
                    url:"{{ route('post-comments') }}",
                    data:{id_blog:id_blog,id_user:id_user,comment:comment,level:level,name:name,_token:_token},
                    success:function(data){     
                        $('.media-list').append(data);
                    }
                })
            }
        })


                  
        // $('.btn-reply-comment').click(function(){
        $(document).on('click','.btn-reply-comment', function(){
            var level = $(this).data('comment_id');
            if (id_user == 0) {
                alert("Vui lòng đăng nhập để bình luận");
            }
            else{
                $.ajax({
                    type:'GET',
                    url:"{{ route('get-level-replay') }}",
                    data:{id_blog:id_blog,id_user:id_user,level:level},
                    success:function(level){  
                        $(".level").val(level);
                    }
                })
            }
            
        });
    })
</script>