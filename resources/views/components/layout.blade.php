<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'My Fitness Goals' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-[#a1d7ec] dark:bg-[#657475] text-[#1b1b18] lg:justify-center ">
    <main class="w-full grow lg:max-w-6xl max-w-83.75 m-auto">
        {{ $slot }}
    </main>

    <footer class="bg-[#86a2ad] w-full m-auto text-center mt-6">
        <p class="text-sm text-[#1b1b18] p-2">&copy; {{ date('Y') }} My Fitness Goals</p>
    </footer>
</body>
</html>
