<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Categories;
use App\Models\Budgets;
use App\Models\Transactions;
;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $primaryKey = 'report_id';

    protected $fillable = [
        'user_id',
        'category_id',
        'budget_id',
        'transaction_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'category_id');
    }

    public function budget()
    {
        return $this->belongsTo(Budgets::class, 'budget_id', 'budget_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'transaction_id', 'transaction_id');
    }
}
