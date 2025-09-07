<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $user->name }} - User Profile</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @filamentStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" 
                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                            ← Back to Users
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $user->name }}
                            </h1>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Member since</div>
                            <div class="font-semibold">{{ $user->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl font-bold">
                                {{ $user->initials() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            @livewire('user-tasks', ['user' => $user])
        </main>

        @filamentScripts
    </body>
</html>