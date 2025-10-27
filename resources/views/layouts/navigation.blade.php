<script src="https://cdn.tailwindcss.com"></script>
<script>
    // Configuration Tailwind para usar a fonte Inter (preferida)
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
            },
        },
    }
</script>

<style>
    /* Usando a fonte Inter e reset de estilo */
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f1f5f9; /* Slate 100 para o fundo */
    }
    
    .nav-link {
        position: relative;
        transition: color 0.3s ease;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: transparent;
        transition: background-color 0.3s ease;
        transform: scaleX(0); /* Começa invisível */
        transform-origin: bottom left;
    }
    .nav-link:hover::after {
        background-color: #3b82f6; /* Blue 500 */
        transform: scaleX(1); /* Expande no hover */
    }
    .nav-link.active {
        color: #60a5fa; /* Blue 400 */
    }
    .nav-link.active::after {
        background-color: #3b82f6; /* Blue 500 */
        transform: scaleX(1);
    }
</style>


<nav class="bg-slate-900 shadow-2xl border-b border-slate-700/50 fixed top-0 w-full z-50" x-data="{ open: false }" id="mainNavigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center flex-shrink-0">
                <a href="#" class="text-2xl font-extrabold text-blue-400 hover:text-blue-300 transition duration-300 tracking-wider">
                    MerceariaC&C
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                
                <div class="relative z-50" @click.away="openProfile = false" x-data="{ openProfile: false }">
                    <button @click="openProfile = ! openProfile" class="flex items-center px-2 py-1 text-sm font-medium rounded-full text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out shadow-lg">
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-xs font-bold ring-2 ring-white/30 me-2">
                            @if (Auth::check()) {{ substr(Auth::user()->name, 0, 1) }} @else UN @endif
                        </div>
                        <div class="me-2 hidden lg:block font-semibold">
                            @if (Auth::check()) {{ Auth::user()->name }} @else Convidado @endif
                        </div>
                        <svg class="h-4 w-4 fill-current text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="openProfile" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 rounded-xl shadow-2xl bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none origin-top-right">
                        
                        <div class="px-4 py-3">
                            <p class="text-xs text-gray-500">Logado como</p>
                            <p class="text-sm font-medium text-gray-900 truncate">@if (Auth::check()) {{ Auth::user()->email }} @else Convidado @endif</p>
                        </div>

                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition duration-150 ease-in-out">
                                    Sair
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-800 focus:outline-none focus:bg-slate-800 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path x-show="!open" d="M4 6h16M4 12h16M4 18h16" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        <path x-show="open" d="M6 18L18 6M6 6l12 12" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-y-90" x-transition:enter-end="opacity-100 scale-y-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-90" class="sm:hidden origin-top bg-slate-800 pb-2">
        
        <div class="pt-2 pb-3 space-y-1 border-b border-slate-700/50">
            </div>

        <div class="pt-4 pb-1">
            <div class="flex items-center px-4">
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-sm font-bold text-white me-3">@if (Auth::check()) {{ substr(Auth::user()->name, 0, 1) }} @else UN @endif</div>
                <div>
                    <div class="font-medium text-base text-white">@if (Auth::check()) {{ Auth::user()->name }} @else Convidado @endif</div>
                    <div class="font-medium text-sm text-slate-400">@if (Auth::check()) {{ Auth::user()->email }} @else user@example.com @endif</div>
                </div>
            </div>
            
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block ps-3 pe-4 py-2 text-base font-medium text-red-400 hover:text-red-300 hover:bg-slate-700/50 transition duration-150 ease-in-out">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
