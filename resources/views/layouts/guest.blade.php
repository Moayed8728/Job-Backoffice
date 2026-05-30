<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="min-h-screen bg-[linear-gradient(180deg,#ffffff_0%,#f6fbff_52%,#eef7f4_100%)] px-6 py-8">
            <div class="mx-auto flex min-h-[calc(100vh-4rem)] w-full max-w-6xl items-center justify-center">
                <div class="grid w-full items-center gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                    <div class="hidden lg:block">
                        <a href="{{ route('welcome') }}" class="inline-flex items-center gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-600 text-lg font-black text-white shadow-lg shadow-emerald-200">JB</span>
                            <span class="text-base font-bold text-slate-900">Job Backoffice</span>
                        </a>
                        <h1 class="mt-8 max-w-md text-5xl font-extrabold leading-tight tracking-normal text-slate-950">Welcome back to your hiring workspace.</h1>
                        <p class="mt-5 max-w-md text-lg leading-8 text-slate-600">Sign in to manage vacancies, companies, users, and candidate decisions with a cleaner daily workflow.</p>
                    </div>

                    <div class="mx-auto w-full max-w-md">
                        <div class="mb-6 text-center lg:hidden">
                            <a href="{{ route('welcome') }}" class="inline-flex items-center gap-3">
                                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-600 text-lg font-black text-white shadow-lg shadow-emerald-200">JB</span>
                                <span class="text-base font-bold text-slate-900">Job Backoffice</span>
                            </a>
                        </div>

                        <div class="rounded-[1.75rem] border border-white bg-white/90 px-7 py-8 shadow-2xl shadow-slate-200/80 backdrop-blur sm:px-8">
                            {{ $slot }}
                        </div>

                        <p class="mt-6 text-center text-sm font-medium text-slate-500">
                            <a href="{{ route('welcome') }}" class="text-emerald-700 hover:text-emerald-800">Back to welcome</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
