<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps =false;

    protected $table ='comments';

    protected $fillable =[
        'id_blog',
        'id_user',
        'name',
        'comment',
        'level',
        'avatar',
    ];
   
    protected $primary_key = 'id';

    protected $hidden = [
        '_token',
    ];
}
