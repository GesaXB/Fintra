<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budgets extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'budget_amount',
        'month',
    ];

    public function user(): BelongsTo
    {
        //1 budgets hanya dimiliki 1 user
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        //1budget hanya memiliki 1 category
        return $this->belongsTo(Categories::class);
    }
}
