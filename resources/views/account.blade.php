<x-nav></x-nav>
<x-header title="Account Details"></x-header>
<x-layout> 
    <div class="container px-4">
        <div class="bg-slate-300 mb-4 flex flex-col lg:flex-row gap-4 rounded-lg shadow-md mt-10
                    [&_div]:items-center [&_input]:mb-0">

            <form class="w-full lg:w-1/2 p-4 border-b lg:border-b-0 lg:border-r border-gray-500"
                action="{{ route('account.update') }}" method="POST">
                <h2 class="text-xl text-center font-bold mb-4">Update Account</h2>
                @csrf
                <div class="flex flex-col gap-4">
                    <div>
                        <x-form.input label="Name:" name="name" id="name" value="{{ old('name', $user->name) }}" />
                    </div>
                    <div>
                        <x-form.input label="Email:" name="email" id="email" value="{{ old('email', $user->email) }}" />
                    </div>
                </div>

                <div class="flex flex-col justify-center mt-6">
                    <x-form.button class="py-1! px-4!" title="Update Account"></x-form.button>
                    <span class="text-gray-600 mt-4 text-sm text-center block">
                        Account last updated on: {{ $user->updated_at ? $user->updated_at->format('F j, Y, g:i a') : 'N/A' }}
                    </span>
                </div>
            </form>

            <form class="w-full lg:w-1/2 p-4"
                action="{{ route('account.password.update') }}" method="POST">
                <h2 class="text-xl text-center font-bold mb-4">Change Password</h2>
                @csrf
                <div class="flex flex-col gap-4">
                    <div>
                        <x-form.input label="Current Password:" name="current_password" id="current_password" type="password" />
                    </div>
                    <div>
                        <x-form.input label="New Password:" name="password" id="password" type="password" />
                    </div>
                    <div>
                        <x-form.input label="Confirm New Password:" name="password_confirmation" id="password_confirmation" type="password" />
                    </div>

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                </div>

                <div class="flex flex-col justify-center mt-6">
                    <x-form.button class="py-1! px-4!" title="Change Password"></x-form.button>
                    <span class="text-gray-600 mt-4 text-sm text-center block">
                        Password last updated on: {{ $user->password_last_updated ? $user->password_last_updated->format('F j, Y, g:i a') : 'N/A' }}
                    </span>
                </div>
            </form>

        </div>
    </div>
</x-layout>