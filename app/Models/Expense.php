<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use Carbon\Carbon;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'account_id',
        'text',
        'amount',
    ];

    // リレーション
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // ローカルスコープ
    public function scopeSearchDate($query, $start_date, $finish_date)
    {
        if (!is_null($start_date) && !is_null($finish_date)) {
            $query->whereBetween('expenses.date', [$start_date, $finish_date]);
            return $query;
        } elseif (!is_null($finish_date)) {
            $query->where('expenses.date', '<=', $finish_date);
            return $query;
        } elseif (!is_null($start_date)) {
            $query->where('expenses.date', '>=', $start_date);
        } else {
            return;
        }
    }

    public function scopeSearchAccount($query, $account_id)
    {
        if ($account_id !== '0') {
            $query->where('expenses.account_id', $account_id);
            return $query;
        } else {
            return;
        }
    }

    public function scopeSearchText($query, $text)
    {
        if (!is_null($text)) {
            $spaceConvert = mb_convert_kana($text, 's');
            $texts = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($texts as $text) {
                $query->where('expenses.text', 'like', '%' . $text . '%');
            }
            return $query;
        } else {
            return;
        }
    }

    public function scopeSearchAmount($query, $amount)
    {
        if (!is_null($amount)) {
            $query->where('expenses.amount', $amount);
            return $query;
        } else {
            return;
        }
    }

    public function scopeSearchMonth($query, $month)
    {
        $date = Carbon::now();
        if (!is_null($month)) {
            $query->where('expenses.date', 'like', $month . '%');
            return $query;
        } else {
            $query->where('expenses.date', 'like', $date->format('Y-m') . '%');
            return $query;
        }
    }
}
