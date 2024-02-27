<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timestamps =false;

    protected $table ='brand';

    protected $fillable =[
        'brand_name',
        'brand_des',
    ];
   
    protected $primary_key = 'id';
    protected $hidden = [
        '_token',
    ];
}
