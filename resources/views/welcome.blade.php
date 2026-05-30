<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Job Backoffice') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            window.setTimeout(() => {
                window.location.href = @json(route('login'));
            }, 4000);
        </script>
    </head>
    <body class="font-sans text-slate-950 antialiased">
        <main class="welcome-stage min-h-screen overflow-hidden bg-[#f7fbff]">
            <section class="relative mx-auto flex min-h-screen w-full max-w-7xl flex-col px-5 py-5 sm:px-8 lg:px-10">
                <div class="absolute inset-x-8 top-8 h-32 rounded-full bg-white/70 blur-3xl"></div>

                <nav class="relative z-10 flex items-center justify-between">
                    <div class="welcome-rise flex items-center gap-3">
                        <span class="flex h-12 w-12 items-center justify-center rounded-[1.25rem] bg-slate-950 text-lg font-black text-white shadow-xl shadow-slate-300/70">JB</span>
                        <div>
                            <p class="text-base font-black text-slate-950">Job Backoffice</p>
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-emerald-600">TalentConnect</p>
                        </div>
                    </div>

                    <a href="{{ route('login') }}" class="welcome-rise inline-flex items-center justify-center rounded-full border border-slate-200 bg-white/90 px-5 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:border-emerald-300 hover:text-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100" style="animation-delay: 140ms">
                        Skip
                    </a>
                </nav>

                <div class="relative z-10 grid flex-1 items-center gap-8 py-8 lg:grid-cols-[0.92fr_1.08fr]">
                    <div class="welcome-rise max-w-2xl" style="animation-delay: 220ms">
                        <p class="mb-5 inline-flex rounded-full border border-emerald-100 bg-white/85 px-4 py-2 text-sm font-bold text-emerald-700 shadow-sm">
                            Preparing your admin workspace
                        </p>

                        <h1 class="max-w-3xl text-5xl font-black leading-[1.02] tracking-normal text-slate-950 sm:text-6xl lg:text-7xl">
                            Welcome to a brighter way to manage hiring.
                        </h1>

                        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                            Companies, vacancies, applications, users, and analytics are coming into focus.
                        </p>

                        <div class="mt-9 max-w-md">
                            <div class="mb-3 flex items-center justify-between text-sm font-bold text-slate-500">
                                <span>Opening secure login</span>
                                <span>4s</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-white shadow-inner shadow-slate-200">
                                <div class="welcome-progress h-full rounded-full bg-emerald-500"></div>
                            </div>
                        </div>
                    </div>

                    <div class="welcome-rise" style="animation-delay: 420ms">
                        <div class="relative mx-auto max-w-2xl">
                            <div class="absolute -left-4 top-12 hidden h-20 w-20 rounded-[1.5rem] border border-sky-100 bg-white/75 shadow-xl shadow-sky-100 lg:block"></div>
                            <div class="absolute -right-2 bottom-12 hidden h-24 w-24 rounded-full border border-emerald-100 bg-white/80 shadow-xl shadow-emerald-100 lg:block"></div>

                            <div class="relative overflow-hidden rounded-[2rem] border border-white bg-white/90 p-4 shadow-2xl shadow-slate-200/80 backdrop-blur">
                                <div class="rounded-[1.5rem] border border-slate-100 bg-[#fbfdff] p-5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-emerald-600">Live overview</p>
                                            <h2 class="mt-1 text-xl font-black text-slate-950">Command center</h2>
                                        </div>
                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-black text-emerald-700">Ready</span>
                                    </div>

                                    <div class="mt-5 grid gap-3 sm:grid-cols-3">
                                        <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                                            <p class="text-sm font-bold text-slate-500">Open jobs</p>
                                            <p class="mt-3 text-3xl font-black text-slate-950">42</p>
                                            <p class="mt-1 text-xs font-bold text-emerald-600">+12 this week</p>
                                        </div>
                                        <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                                            <p class="text-sm font-bold text-slate-500">Applications</p>
                                            <p class="mt-3 text-3xl font-black text-slate-950">318</p>
                                            <p class="mt-1 text-xs font-bold text-sky-600">68 reviewed</p>
                                        </div>
                                        <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                                            <p class="text-sm font-bold text-slate-500">Companies</p>
                                            <p class="mt-3 text-3xl font-black text-slate-950">16</p>
                                            <p class="mt-1 text-xs font-bold text-violet-600">4 owners</p>
                                        </div>
                                    </div>

                                    <div class="mt-4 grid gap-4 lg:grid-cols-[1.12fr_0.88fr]">
                                        <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                                            <div class="mb-5 flex items-center justify-between">
                                                <h3 class="text-sm font-black text-slate-900">Pipeline</h3>
                                                <span class="text-xs font-bold text-slate-500">Today</span>
                                            </div>
                                            <div class="space-y-4">
                                                <div>
                                                    <div class="mb-2 flex justify-between text-xs font-bold text-slate-500"><span>Pending review</span><span>54%</span></div>
                                                    <div class="h-3 rounded-full bg-slate-100"><div class="welcome-meter h-3 rounded-full bg-emerald-500" style="--meter-width: 54%"></div></div>
                                                </div>
                                                <div>
                                                    <div class="mb-2 flex justify-between text-xs font-bold text-slate-500"><span>Accepted</span><span>28%</span></div>
                                                    <div class="h-3 rounded-full bg-slate-100"><div class="welcome-meter h-3 rounded-full bg-sky-500" style="--meter-width: 28%"></div></div>
                                                </div>
                                                <div>
                                                    <div class="mb-2 flex justify-between text-xs font-bold text-slate-500"><span>Rejected</span><span>18%</span></div>
                                                    <div class="h-3 rounded-full bg-slate-100"><div class="welcome-meter h-3 rounded-full bg-rose-400" style="--meter-width: 18%"></div></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                                            <h3 class="text-sm font-black text-slate-900">Next actions</h3>
                                            <div class="mt-4 space-y-3">
                                                <div class="flex items-center justify-between rounded-xl bg-emerald-50 px-4 py-3">
                                                    <span class="text-sm font-bold text-emerald-900">Review candidates</span>
                                                    <span class="text-xs font-black text-emerald-700">24</span>
                                                </div>
                                                <div class="flex items-center justify-between rounded-xl bg-sky-50 px-4 py-3">
                                                    <span class="text-sm font-bold text-sky-900">Publish vacancies</span>
                                                    <span class="text-xs font-black text-sky-700">7</span>
                                                </div>
                                                <div class="flex items-center justify-between rounded-xl bg-violet-50 px-4 py-3">
                                                    <span class="text-sm font-bold text-violet-900">Manage users</span>
                                                    <span class="text-xs font-black text-violet-700">16</span>
                                                </div>
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
