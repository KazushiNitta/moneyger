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

    // リレーション
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // ローカルスコープ
    public function scopeSearchDate($query, $start_date, $finish_date)
    {
        if (!is_null($start_date) && !is_null($finish_date)) {
            $query->whereBetween('incomes.date', [$start_date, $finish_date]);
            return $query;
        } elseif (!is_null($finish_date)) {
            $query->where('incomes.date', '<=', $finish_date);
            return $query;
        } elseif (!is_null($start_date)) {
            $query->where('incomes.date', '>=', $start_date);
        } else {
            return;
        }
    }

    public function scopeSearchAccount($query, $account_id)
    {
        if ($account_id !== '0') {
            $query->where('incomes.account_id', $account_id);
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
                $query->where('incomes.text', 'like', '%'. $text. '%');
            }
            return $query;
        } else {
            return;
        }
    }

    public function scopeSearchAmount($query, $amount)
    {
        if (!is_null($amount)) {
            $query->where('incomes.amount', $amount);
            return $query;
        } else {
            return;
        }
    }
}
