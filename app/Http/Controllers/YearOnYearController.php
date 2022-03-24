<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;

class YearOnYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thisYear = Carbon::now();
        $lastYear = new Carbon('last year');

        // 収入
        $incomes = [];
        for ($i = 1; $i <= 12; $i++) {
            // 今年の毎月の合計を取得
            $incomes['thisYear'][$i] = Income::where('date', 'like', $thisYear->format('Y-'. sprintf('%02d', $i)) . '%')->where('account_id', '<', 8)->sum('amount');

            // 前年の毎月の合計を取得
            $incomes['lastYear'][$i] = Income::where('date', 'like', $lastYear->format('Y-'. sprintf('%02d', $i)) . '%')->where('account_id', '<', 8)->sum('amount');

            // 毎月の増減率を取得
            if ($incomes['lastYear'][$i] !== 0) {
                $incomes['rate'][$i] = round(($incomes['thisYear'][$i] / $incomes['lastYear'][$i] - 1) * 100);
            } else {
                $incomes['rate'][$i] = '-';
            }
        }
        // 今年の合計を取得
        $incomes['thisYear']['sum'] = array_sum($incomes['thisYear']);
        // 前年の合計を取得
        $incomes['lastYear']['sum'] = array_sum($incomes['lastYear']);
        // 増減率を取得
        if ($incomes['lastYear']['sum'] !== 0) {
            $incomes['rate']['sum'] = round(($incomes['thisYear']['sum'] / $incomes['lastYear']['sum'] - 1) * 100);
        } else {
            $incomes['rate']['sum'] = '-';
        }

        // 支出
        $expenses = [];
        for ($i = 1; $i <= 12; $i++) {
            // 今年の毎月の合計を取得
            $expenses['thisYear'][$i] = Expense::where('date', 'like', $thisYear->format('Y-' . sprintf('%02d', $i)) . '%')->where('account_id', '>', 7)->sum('amount');

            // 前年の毎月の合計を取得
            $expenses['lastYear'][$i] = Expense::where('date', 'like', $lastYear->format('Y-' . sprintf('%02d', $i)) . '%')->where('account_id', '>', 7)->sum('amount');

            // 毎月の増減率を取得
            if ($expenses['lastYear'][$i] !== 0) {
                $expenses['rate'][$i] = round(($expenses['thisYear'][$i] / $expenses['lastYear'][$i] - 1) * 100);
            } else {
                $expenses['rate'][$i] = '-';
            }
        }
        // 今年の合計を取得
        $expenses['thisYear']['sum'] = array_sum($expenses['thisYear']);
        // 前年の合計を取得
        $expenses['lastYear']['sum'] = array_sum($expenses['lastYear']);
        // 増減率を取得
        if ($expenses['lastYear']['sum'] !== 0) {
            $expenses['rate']['sum'] = round(($expenses['thisYear']['sum'] / $expenses['lastYear']['sum'] - 1) * 100);
        } else {
            $expenses['rate']['sum'] = '-';
        }

        $profit = [];
        $profit['thisYear'] = $incomes['thisYear']['sum'] - $expenses['thisYear']['sum'];
        $profit['lastYear'] = $incomes['lastYear']['sum'] - $expenses['lastYear']['sum'];
        if ($profit['lastYear'] !== 0) {
            $profit['rate'] = round(($profit['thisYear'] / $profit['lastYear'] - 1) * 100);
        } else {
            $profit['rate'] = '-';
        }

        return view('yearOnYear.index', compact('incomes', 'expenses', 'profit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
