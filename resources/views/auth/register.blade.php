<x-layout>
    <x-slot name="title">Register</x-slot>
    <div class="container bg-slate-300 mx-auto max-w-md p-8 rounded-lg shadow-md mt-10  outline-2 outline-blue-500">
        <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>
        <form class="flex flex-col" action="{{ url('register') }}" method="POST">
            @csrf
            <label for="name">Name</label>
            <input class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded" type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            <label for="email">Email</label>
            <input class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded" type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded">
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

            <!-- Confirm Password Field -->
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded">

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-10 rounded cursor-pointer" type="submit">Register</button>
        </form>
        <div>
            <p class="mt-4 text-center">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a></p>    
    </div>
</x-layout>