<nav x-data="{ open: false }" class="bg-[#1E40AF] border-b border-blue-900/60 text-white shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-6">
                <!-- Logo SRI -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-blue-800 font-black text-sm shadow group-hover:scale-105 transition">
                        S
                    </div>
                    <div class="flex items-center tracking-tight text-left">
                        <span class="text-xl font-black text-white">SRI</span>
                        <div class="ml-2 pl-2 border-l border-blue-300/40 flex flex-col leading-none">
                            <span class="text-[9px] font-bold text-blue-100 uppercase tracking-wider">SME</span>
                            <span class="text-[9px] font-bold text-blue-100 uppercase tracking-wider">Rating</span>
                            <span class="text-[7px] text-blue-200">Indonesia</span>
                        </div>
                    </div>
                </a>

                <!-- Breadcrumb / Section Title & Nav Links -->
                <span class="hidden md:inline-block text-blue-300/50">/</span>
                <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-blue-100 hover:text-white transition">
                    Dashboard
                </a>
                <span class="hidden md:inline-block text-blue-300/50">/</span>
                <a href="{{ route('scoring.summary') }}" class="text-xs font-semibold text-blue-100 hover:text-white transition">
                    Hasil Penilaian
                </a>
                <span class="hidden md:inline-block text-blue-300/50">/</span>
                <a href="{{ route('scoring.certificate') }}" class="text-xs font-semibold text-blue-100 hover:text-white transition">
                    Sertifikat
                </a>
                <span class="hidden md:inline-block text-blue-300/50">/</span>
                <a href="{{ route('apply.choose') }}" class="text-xs font-semibold text-blue-100 hover:text-white transition">
                    Pengajuan
                </a>
                <span class="hidden md:inline-block text-blue-300/50">/</span>
                <a href="{{ route('partners.index') }}" class="text-xs font-semibold text-blue-100 hover:text-white transition">
                    Direktori Mitra
                </a>
                <span class="hidden md:inline-block text-blue-300/50">/</span>
                <a href="{{ route('apply.history') }}" class="text-xs font-semibold text-blue-100 hover:text-white transition">
                    Histori
                </a>
            </div>

            <!-- Right user status: "Selamat datang, Ibu/Bapak [Nama] | Sign Out" -->
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <div class="flex items-center gap-2 text-xs text-blue-100">
                    <div class="w-6 h-6 rounded-full bg-blue-700 border border-blue-400/30 flex items-center justify-center text-[10px] font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span>Selamat datang, <strong class="text-white">{{ Auth::user()->name }}</strong></span>
                </div>
                <span class="text-blue-300/40">|</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-semibold text-blue-200 hover:text-white transition px-2 py-1 rounded hover:bg-blue-800/60">
                        Sign Out
                    </button>
                </form>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-blue-200 hover:text-white hover:bg-blue-800 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-900 border-t border-blue-800">
        <div class="pt-3 pb-3 px-4 space-y-2">
            <div class="font-medium text-sm text-white">Selamat datang, {{ Auth::user()->name }}</div>
            <div class="font-medium text-xs text-blue-200">{{ Auth::user()->email }}</div>
            <div class="pt-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-xs font-semibold text-rose-300 py-1">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>


