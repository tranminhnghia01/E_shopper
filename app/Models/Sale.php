<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    
    public $timestamps =true;

    protected $table ='sale';

    protected $fillable =[
        'method',
    ];
   
    protected $primary_key = 'id';
}
