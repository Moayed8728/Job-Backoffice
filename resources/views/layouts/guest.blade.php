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
        <div class="min-h-screen bg-[radial-gradient(circle_at_16%_18%,rgba(125,211,252,0.24),transparent_28rem),radial-gradient(circle_at_84%_14%,rgba(52,211,153,0.18),transparent_24rem),linear-gradient(180deg,#ffffff_0%,#f7fbff_54%,#eefaf5_100%)] px-6 py-8">
            <div class="mx-auto flex min-h-[calc(100vh-4rem)] w-full max-w-6xl items-center justify-center">
                <div class="grid w-full items-center gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                    <div class="hidden lg:block">
                        <a href="{{ route('welcome') }}" class="inline-flex items-center gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-[1.15rem] bg-slate-950 text-lg font-black text-white shadow-lg shadow-slate-300/70">JB</span>
                            <span class="text-base font-bold text-slate-900">Job Backoffice</span>
                        </a>
                        <h1 class="mt-8 max-w-md text-5xl font-black leading-tight tracking-normal text-slate-950">Welcome back to your hiring workspace.</h1>
                        <p class="mt-5 max-w-md text-lg leading-8 text-slate-600">Sign in to manage vacancies, companies, users, and candidate decisions with a brighter daily workflow.</p>

                        <div class="mt-8 grid max-w-md grid-cols-3 gap-3">
                            <div class="rounded-2xl border border-white bg-white/80 p-4 shadow-sm">
                                <p class="text-2xl font-black text-slate-950">42</p>
                                <p class="mt-1 text-xs font-bold text-slate-500">Open jobs</p>
                            </div>
                            <div class="rounded-2xl border border-white bg-white/80 p-4 shadow-sm">
                                <p class="text-2xl font-black text-slate-950">318</p>
                                <p class="mt-1 text-xs font-bold text-slate-500">Applications</p>
                            </div>
                            <div class="rounded-2xl border border-white bg-white/80 p-4 shadow-sm">
                                <p class="text-2xl font-black text-slate-950">16</p>
                                <p class="mt-1 text-xs font-bold text-slate-500">Companies</p>
                            </div>
                        </div>
                    </div>

                    <div class="mx-auto w-full max-w-md">
                        <div class="mb-6 text-center lg:hidden">
                            <a href="{{ route('welcome') }}" class="inline-flex items-center gap-3">
                                <span class="flex h-11 w-11 items-center justify-center rounded-[1.15rem] bg-slate-950 text-lg font-black text-white shadow-lg shadow-slate-300/70">JB</span>
                                <span class="text-base font-bold text-slate-900">Job Backoffice</span>
                            </a>
                        </div>

                        <div class="rounded-[1.75rem] border border-white bg-white/95 px-7 py-8 shadow-2xl shadow-slate-200/80 backdrop-blur sm:px-8">
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
