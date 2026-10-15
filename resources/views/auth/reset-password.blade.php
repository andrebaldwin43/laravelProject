
    <x-layout>
        <div class="container bg-slate-300 mx-auto max-w-md p-8 rounded-lg shadow-md mt-10  outline-2 outline-blue-500">
        <h1 class="text-2xl font-bold mb-6 text-center">Reset Password</h1>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="text-2xl font-bold mb-6 text-center" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <x-form.input label="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-form.input label="Password" id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <div class="mt-4">
                <x-form.input label="Confirm Password" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>

    </div>
    </x-layout>