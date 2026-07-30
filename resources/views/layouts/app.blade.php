<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Kost Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #18181b; }
        ::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 3px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-200 antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <!-- Overlay mobile -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/60 z-30 lg:hidden"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-zinc-900 border-r border-zinc-800 flex flex-col transition-transform duration-200 lg:translate-x-0">

            <div class="h-16 flex items-center gap-2 px-5 border-b border-zinc-800">
                <div class="w-8 h-8 rounded-md bg-amber-500 flex items-center justify-center text-zinc-950 font-bold text-sm">K</div>
                <span class="font-semibold text-white tracking-tight">Kost Manager</span>
            </div>

            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-6">

                <div>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->routeIs('dashboard') ? 'bg-amber-500/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        Dashboard
                    </a>
                </div>

                <div>
                    <p class="px-3 text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-2">Master Data</p>
                    <div class="space-y-1">
                        <a href="{{ route('gedung.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('gedung.*') ? 'bg-amber-500/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2M5 21H3m4-14h2m-2 4h2m4-4h2m-2 4h2m-6 8h4" /></svg>
                            Gedung
                        </a>
                        <a href="{{ route('kamar.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('kamar.*') ? 'bg-amber-500/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                            Kamar
                        </a>
                        <a href="{{ route('penyewa.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('penyewa.*') ? 'bg-amber-500/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6-4a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            Penyewa
                        </a>
                    </div>
                </div>

                <div>
                    <p class="px-3 text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-2">Transaksi</p>
                    <div class="space-y-1">
                        <a href="{{ route('pembayaran.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('pembayaran.*') ? 'bg-amber-500/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
                            Pembayaran
                        </a>
                    </div>
                </div>

                <div>
                    <p class="px-3 text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-2">Kwitansi</p>
                    <div class="space-y-1">
                        <a href="{{ route('kwitansi.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('kwitansi.index') ? 'bg-amber-500/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Semua Kwitansi
                        </a>
                        <a href="{{ route('kwitansi.banyak.form') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('kwitansi.banyak.*') ? 'bg-amber-500/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            Cetak Banyak Kwitansi
                        </a>
                    </div>
                </div>

                <div>
                    <p class="px-3 text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-2">Laporan</p>
                    <div class="space-y-1">
                        <a href="{{ route('laporan.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('laporan.*') ? 'bg-amber-500/10 text-amber-400' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                            Laporan Pembayaran
                        </a>
                    </div>
                </div>

            </nav>

            <div class="p-3 border-t border-zinc-800">
                <div class="flex items-center gap-3 px-2 py-2 rounded-lg mb-1">
                    <div class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-semibold text-zinc-300">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm text-white font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-zinc-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-zinc-400 hover:text-red-400 hover:bg-zinc-800 transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Topbar -->
            <header class="h-16 bg-zinc-900 border-b border-zinc-800 flex items-center justify-between px-4 lg:px-6 shrink-0">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden text-zinc-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>
                    <h1 class="text-lg font-semibold text-white">@yield('title', 'Dashboard')</h1>
                </div>
                <a href="{{ route('profile.edit') }}" class="text-zinc-400 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </a>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-4 px-4 py-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>