<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public $timestamps =false;

    protected $table ='history';

    protected $fillable =[
        'email',
        'id_user',
        'name',
        'phone',
        'price',
    ];
   
    protected $primary_key = 'id_history';

    protected $hidden = [
        '_token',
    ];
}
