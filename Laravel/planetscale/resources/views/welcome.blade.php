<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">

            <div class="p-6 bg-white rounded-lg shadow-2xl shadow-gray-500/20">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Users</h2>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                   There are currently {{ $users->count() }} users registered:
                </p>
                <ul class="mt-2 text-gray-500 text-sm ml-2">
                    @foreach ($users as $user)
                        <li class="mt-2">{{ $user->name }}</li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</body>
</html>
