<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Relasi: Category hasMany Products
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
