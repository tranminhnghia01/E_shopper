<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public $timestamps =true;

    protected $table ='blog';

    protected $fillable =[
        'blog_title',
        'blog_image',
        'blog_des',
        'blog_content'
    ];
   
    protected $primary_key = 'id';
    
    protected $hidden = [
        '_token',
    ];
}
