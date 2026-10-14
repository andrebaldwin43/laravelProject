<x-layout>
<div class="container mx-auto max-w-md p-8 rounded-lg shadow-md text-center mt-10 bg-slate-300">
    <h1>Forgot Password</h1>
    <form class="flex flex-col" method="POST" action="{{ route('password.request') }}">
        @csrf
        <div>
            <x-form.input name="email" label="Email" type="email" value="{{ old('email') }}" required autofocus></x-form.input>
        </div>
        <x-button title="Send Password Reset Link"></x-button>
    </form>
</div>
</x-layout>