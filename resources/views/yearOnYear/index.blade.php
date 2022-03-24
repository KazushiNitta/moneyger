<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            前年比較
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
                                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">前年比率表</h1>
                            </div>
                            <div class="m-4">
                                <div class="w-2/3 mx-auto md:mb-4 overflow-auto">
                                    <table class="table-auto w-full text-center whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900">前年収支</th>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900"></th>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900">今年収支</th>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900"></th>
                                                <th class="md:text-2xl font-medium title-font mb-2 text-gray-900">増減比率</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900">¥{{ number_format($profit['lastYear']) }}</td>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900"></td>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900">¥{{ number_format($profit['thisYear']) }}</td>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900"></td>
                                                <td class="md:px-4 py-3 md:text-lg text-gray-900">{{ $profit['rate'] }}%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-4 w-3/4 md:w-2/3 mx-auto">
                                    <div class="h-full bg-gray-100 p-8 rounded">
                                        <div class="flex flex-col text-center w-full mb-10">
                                            <h2 class="text-2xl font-medium title-font mb-2 text-gray-900">収入合計</h2>
                                        </div>
                                        <div class="w-full mx-auto overflow-auto">
                                            <table class="table-auto w-full text-center whitespace-no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100"></th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">前年</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">今年</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">増減比率</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <tr>
                                                            <td class="px-4 py-3">{{$i}}月</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($incomes['lastYear'][$i]) }}</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($incomes['thisYear'][$i]) }}</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">{{ $incomes['rate'][$i] }}%</td>
                                                        </tr>
                                                    @endfor
                                                    <tr>
                                                        <td class="px-4 py-3">年間</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($incomes['lastYear']['sum']) }}</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($incomes['thisYear']['sum']) }}</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">{{ $incomes['rate']['sum'] }}%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 w-3/4 md:w-2/3 mx-auto">
                                    <div class="h-full bg-gray-100 p-8 rounded">
                                        <div class="flex flex-col text-center w-full mb-10">
                                            <h2 class="text-2xl font-medium title-font mb-2 text-gray-900">支出合計</h2>
                                        </div>
                                        <div class="w-full mx-auto overflow-auto">
                                            <table class="table-auto w-full text-center whitespace-no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100"></th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">前年</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">今年</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">増減比率</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <tr>
                                                            <td class="px-4 py-3">{{$i}}月</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($expenses['lastYear'][$i]) }}</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($expenses['thisYear'][$i]) }}</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">{{ $expenses['rate'][$i] }}%</td>
                                                        </tr>
                                                    @endfor
                                                    <tr>
                                                            <td class="px-4 py-3">年間</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($expenses['lastYear']['sum']) }}</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">¥{{ number_format($expenses['thisYear']['sum']) }}</td>
                                                            <td class="px-4 py-3 text-lg text-gray-900">{{ $expenses['rate']['sum'] }}%</td>
                                                        </tr>
                                                </tbody>
                                            </table>
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
</x-app-layout>
