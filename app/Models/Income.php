<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'account_id',
        'text',
        'amount',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
