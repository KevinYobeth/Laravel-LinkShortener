<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body class="antialiased">
    <div class="relative flex justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
        <div>
            <div>
                @if(Session::has('link'))
                <div class="flex bg-white h-10 w-full items-center mb-5">
                    <div class="bg-green-400 h-10 w-2"></div>
                    <p class="ml-2">
                        <a href="{{ Session::get('link') }}">{{ Session::get('link') }}</a>
                    </p>
                </div>
                @endif
                <form action="{{ route('addLink') }}" method="POST">
                    @csrf
                    <div class="flex w-full mb-3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow-300 transition ease-out duration-300"
                            id="urlToShorten" name="urlToShorten" type="url">
                        <button
                            class="shadow bg-yellow-300 hover:bg-yellow-400 focus:shadow-outline focus:outline-none text-gray-700 font-bold py-2 px-4 rounded"
                            type="submit">
                            Shorten!
                        </button>
                    </div>
                </form>
            </div>


            @if (Route::has('login'))
            <div class="flex justify-center">
                @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-900">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="text-sm text-gray-900 hover:underline mr-3">Sign
                    In</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-sm text-gray-900 hover:underline">Register</a>
                @endif
                @endif
            </div>
            @endif
        </div>

    </div>
    @include('sweetalert::alert')
</body>

</html>