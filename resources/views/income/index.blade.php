<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            収入管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <x-flash-message status="session('status')" />
                    </div>
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-20">
                                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">収入一覧</h1>
                            </div>
                            <div class="mb-8 flex justify-end">
                                <button type="button" onclick="location.href='{{ route('income.create') }}'" class="inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">新規登録</button>
                            </div>
                            <div class="mb-4">
                                <form method="get" action="{{ route('income.index') }}">
                                    <div class="mb-1">
                                        <input type="date" name="start_date" value="{{ \Request::get('start_date') }}" class="w-2/12 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <span>から</span>
                                        <input type="date" name="finish_date" value="{{ \Request::get('finish_date') }}" class="w-2/12 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <span>まで</span>
                                    </div>
                                    <div class="flex">
                                        <select name="account_id" class="w-2/12 mr-1 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <option value="0"
                                                @if (\Request::get('account_id') == 0)
                                                    selected
                                                @endif>全ての科目
                                            </option>
                                            @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}"
                                                    @if (\Request::get('account_id') == $account->id)
                                                        selected
                                                    @endif>{{ $account->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="text" value="{{ \Request::get('text') }}" placeholder="摘要" class="grow mr-1 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <input type="number" name="amount" value="{{ \Request::get('amount') }}" placeholder="金額" class="w-2/12 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <button type="submit" class="inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded ml-4">検索</button>
                                    </div>
                                </form>
                            </div>
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">日付</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">科目</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">摘要</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">金額</th>
                                            <th class="md:px-2 md:py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                            <th class="md:px-2 md:py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($incomes))
                                            @foreach ($incomes as $income)
                                            <tr>
                                                <td class="px-4 py-3">{{ $income->date }}</td>
                                                <td class="px-4 py-3">{{ $income->account->name }}</td>
                                                <td class="px-4 py-3">{{ $income->text }}</td>
                                                <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($income->amount) }}</td>
                                                <td class="md:px-2 md:py-3 text-center">
                                                    <button type="button" onclick="location.href='{{ route('income.edit', ['income' => $income->id]) }}'" class="inline-flex text-white bg-blue-500 border-0 py-2 px-2 lg:px-4 focus:outline-none hover:bg-blue-600 rounded text-xs md:text-sm">編集</button>
                                                </td>
                                                <form id="delete_{{ $income->id }}" method="post" action="{{ route('income.destroy', ['income' => $income->id]) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <td class="md:px-2 md:py-3 text-center">
                                                        <a href="#" data-id="{{ $income->id }}" onclick="deletePost(this)" class="inline-flex text-white bg-red-500 border-0 py-2 px-2 lg:px-4 focus:outline-none hover:bg-red-600 rounded text-xs md:text-sm">削除</a>
                                                    </td>
                                                </form>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="6" align="center">データがありません</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-8">
                                    {{ $incomes->appends([
                                        'start_date' => \Request::get('start_date'),
                                        'finish_date' => \Request::get('finish_date'),
                                        'account_id' => \Request::get('account_id'),
                                        'text' => \Request::get('text'),
                                        'amount' => \Request::get('amount'),
                                    ])->links() }}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除しますか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
