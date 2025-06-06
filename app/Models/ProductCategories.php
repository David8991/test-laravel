<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategories extends Model
{
    protected $guarded = [];

    public function order():HasMany
    {
        return $this->hasMany(Product::class);
    }
}
