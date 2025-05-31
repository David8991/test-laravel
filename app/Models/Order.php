<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    # Аттрибут получения итоговой суммы
    public function getTotalPriceAttribute(): string
    {
        $total = $this->product->price * $this->product_amount;
        return $total . ' ₽';
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
