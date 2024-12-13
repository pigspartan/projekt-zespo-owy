<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <header class="bg-slate-950">
        <nav class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4" aria-label="Global">
            <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{URL::asset('/img/glorp.jpg')}}" alt="glorp logo" class="h-12"/>
                <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white">GlorpCorp©™</span>
            </a>
            @guest
                <div class="flex items-end space-x-3 rtl:space-x-reverse">
                    <a class="text-xl border-r border-l rounded-lg ml-2 mr-2 p-1  hover:bg-slate-800" href="{{ route('login') }}">Logowanie</a>
                    <a class="text-xl border-r border-l rounded-lg ml-2 mr-2 p-1  hover:bg-slate-800" href="{{ route('register') }}">Rejestracja</a>
                </div>
            @endguest
            @auth
                <div class="flex items-start">
                    <button class="m-2 p-1 hover:bg-slate-800 border-r border-l rounded-xl" onclick="location.href='{{route('index')}}'">Ogłoszenia</button>
                    <button class="m-2 p-1 hover:bg-slate-800 border-r border-l rounded-xl" onclick="location.href='{{route('listItem')}}'">Dodaj ogłoszenie</button>
                    <form action="{{ route('paypal.payout') }}" method="POST">
                        @csrf
                        <button type="submit" class="m-2 p-1 hover:bg-slate-800 border-r border-l rounded-xl">Wypłata</button>
                    </form>
                    @role('Admin')
                        <button class="m-2 p-1 hover:bg-slate-800 border-r border-l rounded-xl" onclick="location.href='{{route('admin.dashboard')}}'">Admin dashboard</button>
                    @endrole
                    <button class="m-2 p-1 hover:bg-sky-800 border-r border-l rounded-xl" onclick="location.href='{{route('message')}}'">message</button>
                </div>
                <div class="flex items-end space-x-3 rtl:space-x-reverse">
                    <p class="username text-2xl hover:bg-slate-800 p-1 border-r border-l rounded-lg"><a href="{{route('dashboard')}}">{{auth()->user()->name}}</a></p>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="border-r border-l rounded-lg ml-2 mr-2 p-1 hover:bg-slate-800 text-xs">Logout</button>
                    </form>
                    @role('Suspended')
                    <a class="text-red-600 text-sm" href="{{route('suspended')}}">Suspended</a>
                    @endrole
                </div>
            @endauth
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="mt-8 bg-red-500">
        <nav class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4" aria-label="Global">
            <h1 class="animate-bounce bg-pink-600">LINK DO CS'A:</h1>
            <h1 class="animate-pulse bg-pink-600">157.165.175.1.65</h1>
            @guest
            @endguest
            @auth
            @endauth
        </nav>
    </footer>
</body>

</html>
