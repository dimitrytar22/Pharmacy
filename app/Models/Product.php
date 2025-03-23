<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'price',
        'instruction',
        'category_id',
        'count',
        'image',
    ];

    public static $imageDir =  "images/products/";

    public function getImageAttribute($value)
    {

        $baseDirectory = 'storage/'. self::$imageDir;
        return !$value ? null : asset($baseDirectory . $value);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'product_features');
    }


}
