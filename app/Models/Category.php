<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected  $fillable = [
        'title',
        'image'
    ];


    public function getImageAttribute($value)
    {
        $baseDirectory = 'storage/images/categories/';
        return !$value ? null : asset($baseDirectory . $value);
    }
}
