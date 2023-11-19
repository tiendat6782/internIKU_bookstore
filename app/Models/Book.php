<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'books';
    protected $fillable =
    [
        'id_cate',
        'name',
        'image',
        'price',
        'soLuong',
        'description',
        'author'
    ];
}
