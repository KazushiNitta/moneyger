<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Account;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::select('id', 'date', 'account_id', 'text', 'amount')->orderBy('date', 'asc')->paginate(10);

        return view('expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::where('id', '>', 7)->select('id', 'name')->get();

        return view('expense.create', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'account_id' => ['required', 'integer'],
            'text' => ['required', 'max:100'],
            'amount' => ['required', 'integer'],
        ]);

        Expense::create([
            'date' => $request->date,
            'account_id' => $request->account_id,
            'text' => $request->text,
            'amount' => $request->amount,
        ]);

        return redirect()->route('expense.index')->with(['message' => '登録が完了しました', 'status' => 'info']);
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
        $expense = Expense::findOrFail($id);
        $accounts = Account::where('id', '>', 7)->where('id', '<>', $expense->account_id)->select('id', 'name')->get();

        return view('expense.edit', compact('expense', 'accounts'));
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
        $request->validate([
            'date' => ['required', 'date'],
            'account_id' => ['required', 'integer'],
            'text' => ['required', 'max:100'],
            'amount' => ['required', 'integer'],
        ]);

        $expense = Expense::findOrFail($id);
        $expense->date = $request->date;
        $expense->account_id = $request->account_id;
        $expense->text = $request->text;
        $expense->amount = $request->amount;
        $expense->save();

        return redirect()->route('expense.index')->with(['message' => '編集が完了しました', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::findOrFail($id)->delete();

        return redirect()->route('expense.index')->with(['message' => '削除が完了しました', 'status' => 'alert']);
    }
}
