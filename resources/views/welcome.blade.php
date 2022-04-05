<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Moneyger</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="flex items-center justify-center">
    <div>
        <div class="mb-4">
            <h1 class="text-center text-4xl text-orange-500">Moneyger</h1>
        </div>
        <div class="mb-4">
            <p class="text-center text-orange-500">お金(money)を管理してくれる(manager)サイトへようこそ</p>
        </div>
        <div>
            @if (Route::has('login'))
                <div class="text-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-center">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex text-white bg-orange-500 border-0 py-2 px-6 focus:outline-none hover:bg-orange-600 rounded text-lg">ログイン</a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</body>
</html>
