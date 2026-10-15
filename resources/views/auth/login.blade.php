<x-layout>
    <div class="container bg-slate-300 mx-auto max-w-md p-8 rounded-lg shadow-md mt-10  outline-2 outline-blue-500">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
        <form class="flex flex-col" action="{{ url('login') }}" method="POST">
        @csrf
            <x-form.input name="email" label="Email" type="email" value="{{ old('email') }}" required autofocus></x-form.input>
            <x-form.input name="password" label="Password" type="password" required></x-form.input>
            
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <!-- Remember Me Checkbox -->
            <div>
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>

            <x-button title="Login"></x-button>
            
            <div>
                <p class="mt-4 text-center">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a></p>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Forgot your password?</a>
            </div>
        </form>
    </div>
</x-layout>
