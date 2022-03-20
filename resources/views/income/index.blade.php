<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            収入一覧
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
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">日付</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">科目</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">摘要</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">金額</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($incomes as $income)
                                        <tr>
                                            <td class="px-4 py-3">{{ $income->date }}</td>
                                            <td class="px-4 py-3">{{ $income->account }}</td>
                                            <td class="px-4 py-3">{{ $income->text }}</td>
                                            <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($income->amount) }}</td>
                                            <td class="px-2 py-3 text-center">
                                                <button type="button" onclick="location.href='{{ route('income.edit', ['income' => $income->id]) }}'" class="inline-flex text-white bg-blue-500 border-0 py-2 px-4 focus:outline-none hover:bg-blue-600 rounded text-sm">編集</button>
                                            </td>
                                            <form id="delete_{{ $income->id }}" method="post" action="{{ route('income.destroy', ['income' => $income->id]) }}">
                                                @method('delete')
                                                @csrf
                                                <td class="px-2 py-3 text-center">
                                                    <a href="#" data-id="{{ $income->id }}" onclick="deletePost(this)" class="inline-flex text-white bg-red-500 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded text-sm">削除</a>
                                                </td>
                                            </form>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
