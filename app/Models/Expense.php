<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'account',
        'text',
        'amount',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
