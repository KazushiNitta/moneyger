<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;

class IncomeController extends Controller
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
    public function index()
    {
        $incomes = Income::select('id', 'date', 'account', 'text', 'amount')->orderBy('date', 'asc')->get();

        return view('income.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('income.create');
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

        Income::create([
            'date' => $request->date,
            'account' => $request->account,
            'text' => $request->text,
            'amount' => $request->amount,
        ]);

        return redirect()->route('income.index')->with(['message' => '登録が完了しました', 'status' => 'info']);
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
        $income = Income::findOrFail($id);

        return view('income.edit', compact('income'));
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

        $income = Income::findOrFail($id);
        $income->date = $request->date;
        $income->account = $request->account;
        $income->text = $request->text;
        $income->amount = $request->amount;
        $income->save();

        return redirect()->route('income.index')->with(['message' => '編集が完了しました', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Income::findOrFail($id)->delete();

        return redirect()->route('income.index')->with(['message' => '削除が完了しました', 'status' => 'alert']);
    }
}
