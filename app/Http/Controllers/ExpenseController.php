<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::select('id', 'date', 'account', 'text', 'amount')->orderBy('date', 'asc')->paginate(10);

        return view('expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense.create');
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
            'account' => ['required', 'string'],
            'text' => ['required', 'max:100'],
            'amount' => ['required', 'integer'],
        ]);

        Expense::create([
            'date' => $request->date,
            'account' => $request->account,
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

        return view('expense.edit', compact('expense'));
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
            'account' => ['required', 'string'],
            'text' => ['required', 'max:100'],
            'amount' => ['required', 'integer'],
        ]);

        $expense = Expense::findOrFail($id);
        $expense->date = $request->date;
        $expense->account = $request->account;
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
        //
    }
}
