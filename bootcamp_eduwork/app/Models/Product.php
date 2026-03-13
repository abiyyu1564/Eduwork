<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'stock',
        'image',
        'category_id',
    ];

    /**
     * Relasi: Product belongsTo Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
