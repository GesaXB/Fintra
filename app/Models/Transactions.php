<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transactions extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'transaction_date',
        'description',
        'type'
    ];

    public function Category(): BelongsTo
    {
        //1 trx hanya dapat memiliki 1 category
        return $this->belongsTo(Categories::class);
    }

    public function Users(): BelongsTo
    {
        //1trx hanya dapat di lakukan 1 user
        return $this->belongsTo(User::class);
    }
}
