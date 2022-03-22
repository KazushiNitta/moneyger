<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            支出管理
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
                                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">支出一覧</h1>
                            </div>
                            <div class="mb-8 flex justify-end">
                                <button type="button" onclick="location.href='{{ route('expense.create') }}'" class="inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">新規登録</button>
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
                                        @if (count($expenses))
                                            @foreach ($expenses as $expense)
                                            <tr>
                                                <td class="px-4 py-3">{{ $expense->date }}</td>
                                                <td class="px-4 py-3">{{ $expense->account->name }}</td>
                                                <td class="px-4 py-3">{{ $expense->text }}</td>
                                                <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($expense->amount) }}</td>
                                                <td class="md:px-2 md:py-3 text-center">
                                                    <button type="button" onclick="location.href='{{ route('expense.edit', ['expense' => $expense->id]) }}'" class="inline-flex text-white bg-blue-500 border-0 py-2 px-2 lg:px-4 focus:outline-none hover:bg-blue-600 rounded text-xs md:text-sm">編集</button>
                                                </td>
                                                <form id="delete_{{ $expense->id }}" method="post" action="{{ route('expense.destroy', ['expense' => $expense->id]) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <td class="md:px-2 md:py-3 text-center">
                                                        <a href="#" data-id="{{ $expense->id }}" onclick="deletePost(this)" class="inline-flex text-white bg-red-500 border-0 py-2 px-2 lg:px-4 focus:outline-none hover:bg-red-600 rounded text-xs md:text-sm">削除</a>
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
                                    {{ $expenses->links() }}
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
