<x-layout>
    <x-slot name="title">Login</x-slot>
    <div class="container bg-slate-300 mx-auto max-w-md p-8 rounded-lg shadow-md mt-10  outline-2 outline-blue-500">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
        <form class="flex flex-col" action="{{ url('login') }}" method="POST">
        @csrf
                <label for="email">Email</label>
                <input class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            
                <label for="password">Password</label>
                <input class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded" type="password" name="password" id="password" required>
                @error('password')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

            <!-- Remember Me Checkbox -->
            <div>
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-10 rounded cursor-pointer" type="submit">Login</button>
            <div>
                <p class="mt-4 text-center">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a></p>
            </div>
        </form>
    </div>
</x-layout>
