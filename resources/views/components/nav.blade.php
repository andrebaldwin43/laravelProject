<nav class="bg-[#dbe6eb] text-[#133644] h-16 flex items-center justify-end text-right px-6 mb-6">
    <h1 class="text-xl font-bold mr-auto">My Fitness Goals</h1>
    <ul class="flex space-x-4">
        @if (!request()->routeIs('dashboard'))
            <li class="hover:text-blue-800 transition-colors duration-300"><x-link href="/dashboard">Dashboard</x-link></li>
        @endif
        <li class="hover:text-slate-500 transition-colors duration-300"><x-link href="/account">Account</x-link></li>
        <li class="text-red-600 hover:text-red-400 transition-colors duration-300"><a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout</a>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</nav>