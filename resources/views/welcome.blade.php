<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Job Backoffice') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 font-sans text-slate-950 antialiased">
        <main class="min-h-screen overflow-hidden bg-[linear-gradient(180deg,#ffffff_0%,#f7fbff_48%,#eef7f4_100%)]">
            <section class="mx-auto flex min-h-screen w-full max-w-7xl flex-col px-6 py-6 sm:px-8 lg:px-10">
                <nav class="flex items-center justify-between">
                    <a href="{{ route('welcome') }}" class="flex items-center gap-3" aria-label="Job Backoffice">
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-600 text-lg font-black text-white shadow-lg shadow-emerald-200">JB</span>
                        <span class="text-base font-bold tracking-tight text-slate-900">Job Backoffice</span>
                    </a>

                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-emerald-200 hover:text-emerald-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-emerald-100">
                        Login
                    </a>
                </nav>

                <div class="grid flex-1 items-center gap-10 py-10 lg:grid-cols-[0.94fr_1.06fr] lg:py-8">
                    <div class="max-w-2xl">
                        <p class="mb-5 inline-flex rounded-full border border-emerald-100 bg-white px-4 py-2 text-sm font-semibold text-emerald-700 shadow-sm">
                            TalentConnect admin workspace
                        </p>

                        <h1 class="max-w-3xl text-5xl font-extrabold leading-[1.02] tracking-normal text-slate-950 sm:text-6xl lg:text-7xl">
                            Run hiring operations with calm, clear control.
                        </h1>

                        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                            Manage companies, vacancies, applications, users, and analytics from one bright back-office built for focused daily work.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-7 py-3.5 text-base font-bold text-white shadow-xl shadow-emerald-200 transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                                Go to login
                            </a>
                            <a href="#overview" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-7 py-3.5 text-base font-bold text-slate-700 shadow-sm transition hover:border-sky-200 hover:text-sky-700 focus:outline-none focus:ring-4 focus:ring-sky-100">
                                Preview workspace
                            </a>
                        </div>
                    </div>

                    <div id="overview" class="relative">
                        <div class="rounded-[2rem] border border-white bg-white/85 p-4 shadow-2xl shadow-slate-200/80 backdrop-blur">
                            <div class="overflow-hidden rounded-[1.5rem] border border-slate-100 bg-slate-50">
                                <div class="flex items-center justify-between border-b border-slate-100 bg-white px-5 py-4">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-600">Live overview</p>
                                        <h2 class="mt-1 text-lg font-bold text-slate-900">Recruitment command center</h2>
                                    </div>
                                    <div class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">Online</div>
                                </div>

                                <div class="grid gap-4 p-5 sm:grid-cols-3">
                                    <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                                        <p class="text-sm font-semibold text-slate-500">Open jobs</p>
                                        <p class="mt-3 text-3xl font-extrabold text-slate-950">42</p>
                                        <p class="mt-2 text-xs font-semibold text-emerald-600">12 new this week</p>
                                    </div>
                                    <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                                        <p class="text-sm font-semibold text-slate-500">Applications</p>
                                        <p class="mt-3 text-3xl font-extrabold text-slate-950">318</p>
                                        <p class="mt-2 text-xs font-semibold text-sky-600">68 reviewed</p>
                                    </div>
                                    <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                                        <p class="text-sm font-semibold text-slate-500">Companies</p>
                                        <p class="mt-3 text-3xl font-extrabold text-slate-950">16</p>
                                        <p class="mt-2 text-xs font-semibold text-violet-600">4 active owners</p>
                                    </div>
                                </div>

                                <div class="grid gap-4 px-5 pb-5 lg:grid-cols-[1.1fr_0.9fr]">
                                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                                        <div class="mb-5 flex items-center justify-between">
                                            <h3 class="text-sm font-bold text-slate-900">Application pipeline</h3>
                                            <span class="text-xs font-semibold text-slate-500">Today</span>
                                        </div>
                                        <div class="space-y-4">
                                            <div>
                                                <div class="mb-2 flex justify-between text-xs font-semibold text-slate-500"><span>Pending review</span><span>54%</span></div>
                                                <div class="h-3 rounded-full bg-slate-100"><div class="h-3 rounded-full bg-emerald-500" style="width:54%"></div></div>
                                            </div>
                                            <div>
                                                <div class="mb-2 flex justify-between text-xs font-semibold text-slate-500"><span>Accepted</span><span>28%</span></div>
                                                <div class="h-3 rounded-full bg-slate-100"><div class="h-3 rounded-full bg-sky-500" style="width:28%"></div></div>
                                            </div>
                                            <div>
                                                <div class="mb-2 flex justify-between text-xs font-semibold text-slate-500"><span>Rejected</span><span>18%</span></div>
                                                <div class="h-3 rounded-full bg-slate-100"><div class="h-3 rounded-full bg-rose-400" style="width:18%"></div></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                                        <h3 class="text-sm font-bold text-slate-900">Fast actions</h3>
                                        <div class="mt-4 space-y-3">
                                            <div class="flex items-center justify-between rounded-xl bg-emerald-50 px-4 py-3">
                                                <span class="text-sm font-semibold text-emerald-900">Review candidates</span>
                                                <span class="text-xs font-bold text-emerald-700">24</span>
                                            </div>
                                            <div class="flex items-center justify-between rounded-xl bg-sky-50 px-4 py-3">
                                                <span class="text-sm font-semibold text-sky-900">Publish vacancies</span>
                                                <span class="text-xs font-bold text-sky-700">7</span>
                                            </div>
                                            <div class="flex items-center justify-between rounded-xl bg-violet-50 px-4 py-3">
                                                <span class="text-sm font-semibold text-violet-900">Manage users</span>
                                                <span class="text-xs font-bold text-violet-700">16</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
