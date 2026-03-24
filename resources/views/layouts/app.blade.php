<!DOCTYPE html>
<html>

<head>
    <title>Inventaris</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    @include('components.navbar')

    <div class="flex">
        @yield('sidebar')

        <main class="flex-1 p-6">
            @include('components.flash')
            @yield('content')
        </main>
    </div>

</body>

</html>