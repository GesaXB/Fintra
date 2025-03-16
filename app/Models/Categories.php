<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type'
    ];

    public function users(): BelongsTo
    {
        //1ctgry hanya untuk 1 user
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        //1 category memiliki banyak transactions
        return $this->hasMany(Transactions::class);
    }

    public function budgets(): HasMany
    {
        //1 category memiliki banyak budgets
        return $this->hasMany(Budgets::class);
    }
}
