<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $guarded = [];

    # Аттрибут для вывода цены в рублях
    public function getPriceRubAttribute(): string
    {
        return $this->price . ' ₽';
    }

    public function order():HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(ProductCategories::class);
    }
}
