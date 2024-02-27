<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name',
        'id_user',
        'price',
        'id_category',
        'id_brand',
        'status',
        'company',
        'image',
        'detail',
        'sale',
        'created_at',
        'updated_at'
    ];
    protected $primary_key ='id';

    protected $hidden = [
        '_token',
    ];

    public $timestamps = false;
}
