<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;

class ProfitAndLossController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 収入の小計を取得
        $incomeAccounts = Account::where('id', '<', 8)->select('id', 'name')->get();
        $incomes = [];
        foreach ($incomeAccounts as $account) {
            $incomes["$account->name"] = Income::SearchMonth($request->month)->where('account_id', $account->id)->sum('amount');
        }

        // 支出の小計を取得
        $expenseAccounts = Account::where('id', '>', 7)->select('id', 'name')->get();
        $expenses = [];
        foreach ($expenseAccounts as $account) {
            $expenses["$account->name"] = Expense::SearchMonth($request->month)->where('account_id', $account->id)->sum('amount');
        }

        $date = Carbon::now();

        return view('profitAndLoss.index', compact('incomes', 'expenses', 'date'));
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
