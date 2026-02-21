<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="button" onclick="confirmLogout()" class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form id="logoutFormResponsive" method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="button" onclick="confirmLogout()" class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function confirmLogout() {
        document.getElementById('logoutModal').classList.remove('hidden');
        document.getElementById('logoutModal').classList.add('flex');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.add('hidden');
        document.getElementById('logoutModal').classList.remove('flex');
    }

    function submitLogout() {
        // Try to find either logout form
        const form = document.getElementById('logoutForm') || document.getElementById('logoutFormResponsive');
        if (form) {
            form.submit();
        }
    }

    // Close modal when clicking outside
    document.getElementById('logoutModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeLogoutModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLogoutModal();
        }
    });
</script>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/40">
    <div class="glass p-10 rounded-[3rem] border border-white/5 max-w-md w-full mx-4 relative overflow-hidden shadow-2xl" style="background: rgba(15, 15, 35, 0.7); backdrop-filter: blur(10px);">
        <div class="absolute top-0 right-0 w-40 h-40 bg-cyan-500/10 blur-[100px] -z-10"></div>
        
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">End Session</h2>
            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-cyan-400">Session termination</p>
        </div>

        <div class="mb-8">
            <p class="text-white/60 text-sm leading-relaxed">
                Are you sure you want to log out of your account?
            </p>
            <p class="text-white/40 text-xs mt-3">You will need to log in again to access your account.</p>
        </div>

        <div class="flex flex-col gap-3">
            <button type="button" onclick="submitLogout()" class="w-full bg-cyan-500 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-cyan-600 transition transform hover:scale-[1.02] active:scale-95">
                Confirm Logout
            </button>
            <button type="button" onclick="closeLogoutModal()" class="w-full bg-white/5 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-white/10 transition border border-white/5">
                Cancel
            </button>
        </div>
    </div>
</div>
