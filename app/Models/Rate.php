<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_blog',
        'id_user',
        'rate'
    ];
    
    protected $table = 'rate';
    protected $primary_key = 'id';
    public $timestamps = false;
}
