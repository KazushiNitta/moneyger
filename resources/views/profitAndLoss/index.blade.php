<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            損益分析
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                    </div>
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-20">
                                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">収支一覧</h1>
                            </div>
                            <div class="mx-auto mb-6 text-center">
                                <form method="get" action="{{ route('profit-and-loss.index') }}">
                                    <input type="month" id="month" name="month" value="{{ \Request::get('month') ?? $date->format('Y-m') }}" class="w-1/2 md:w-3/12 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </form>
                            </div>
                            <div class="m-4">
                                <div class="w-2/3 mx-auto md:mb-4 overflow-auto">
                                    <table class="table-auto w-full text-center whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900">収入</th>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900">-</th>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900">支出</th>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900">=</th>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900">収支</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900">¥{{ number_format(array_sum($incomes)) }}</td>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900">-</td>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900">¥{{ number_format(array_sum($expenses)) }}</td>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900">=</td>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900">¥{{ number_format(array_sum($incomes) - array_sum($expenses)) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-4 w-3/4 md:w-2/3 mx-auto">
                                    <div class="h-full bg-gray-100 p-8 rounded">
                                        <div class="flex flex-col text-center w-full mb-10">
                                            <h2 class="text-2xl font-medium title-font mb-2 text-gray-900">収入詳細</h2>
                                        </div>
                                        <div class="w-full mx-auto overflow-auto">
                                            <table class="table-auto w-full text-center whitespace-no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">科目</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">小計</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($incomes as $name => $amount)
                                                    <tr>
                                                        <td class="px-4 py-3">{{ $name }}</td>
                                                        <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($amount) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-6 flex justify-center">
                                            <div class="mr-4"><h2 class="text-2xl font-medium title-font mb-2 text-gray-900">合計</h2></div>
                                            <div><h2 class="text-2xl font-medium title-font mb-2 text-gray-900">¥{{ number_format(array_sum($incomes)) }}</h2></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 w-3/4 md:w-2/3 mx-auto">
                                    <div class="h-full bg-gray-100 p-8 rounded">
                                        <div class="flex flex-col text-center w-full mb-10">
                                            <h2 class="text-2xl font-medium title-font mb-2 text-gray-900">支出詳細</h2>
                                        </div>
                                        <div class="w-full mx-auto overflow-auto">
                                            <table class="table-auto w-full text-center whitespace-no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">科目</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">小計</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($expenses as $name => $amount)
                                                    <tr>
                                                        <td class="px-4 py-3">{{ $name }}</td>
                                                        <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($amount) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-6 flex justify-center">
                                            <div class="mr-4"><h2 class="text-2xl font-medium title-font mb-2 text-gray-900">合計</h2></div>
                                            <div><h2 class="text-2xl font-medium title-font mb-2 text-gray-900">¥{{ number_format(array_sum($expenses)) }}</h2></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        const select = document.getElementById('month')
        select.addEventListener('change', function() {
            this.form.submit()
        })
    </script>
</x-app-layout>
