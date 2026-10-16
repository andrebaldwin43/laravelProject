
@vite('resources/js/dashboard.js')
<nav class="bg-[#dbe6eb] text-[#133644] h-16 flex items-center px-6 mb-6 relative">
    <h1 class="text-xl font-bold mr-auto">My Fitness Goals</h1>
    <x-flash-message></x-flash-message>

    <button id="menu-toggle"
            class="sm:hidden p-2 rounded hover:bg-[#c5d5dc]"
            aria-label="Toggle menu"
            aria-expanded="false"
            type="button">
        ☰
    </button>

    <ul id="mobile-menu"
        class="hidden absolute text-center top-16 left-0 right-0 bg-[#dbe6eb] shadow-mdflex-col gap-3 p-4
               sm:static sm:flex sm:flex-row sm:gap-4 sm:p-0 sm:shadow-none sm:bg-transparent">
        @if (!request()->routeIs('dashboard'))
            <li class="hover:text-blue-800"><x-link href="/dashboard">Dashboard</x-link></li>
        @endif

        @if (!request()->routeIs('fitness'))
            <li class="hover:text-blue-800"><x-link href="/fitness">Fitness</x-link></li>
        @endif

        @if (!request()->routeIs('nutrition'))
            <li class="hover:text-blue-800"><x-link href="/nutrition">Nutrition</x-link></li>
        @endif

        @if (!request()->routeIs('account'))
            <li class="hover:text-blue-800"><x-link href="/account">Account</x-link></li>
        @endif

        <li class="text-red-600 hover:text-red-400">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </li>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</nav>