<x-nav></x-nav>
<x-header title="Account Details"></x-header>
<x-layout> 
    <div class="container"> 
        <div class=" bg-slate-300 h-3/4 mb-4 flex gap-4 rounded-lg shadow-md mt-10 outline-2 outline-blue-500 [&_div]:flex [&_div]:items-center [&_div]:space-x-4 ">
            <form class="border-r border-gray-500 h-3/4 p-4" action="{{ route('account.update') }}" method="POST">
                <h2 class="text-xl text-center font-bold mb-4">Update Account</h2>
                @csrf
                <div>
                    <x-form.input class="p-2! mb-2! ml-auto" label="Name:" name="name" id="name" value="{{ old('name', $user->name) }}"></x-input>
                </div>
                <div>
                    <x-form.input class="p-2! mb-2! ml-auto" label="Email:" name="email" id="email" value="{{ old('email', $user->email) }}"></x-input>
                </div>
                <div class="flex flex-col h-1/2 justify-center">
                    <x-button class="mt-auto py-1! px-4! " title="Update Account"></x-button>
                </div>
                <span class="text-gray-600 text-sm mt-4 text-center block">Account last updated on: {{ $user->updated_at ? $user->updated_at->format('F j, Y, g:i a') : 'N/A' }}</span>
            </form>

            <form class="border-r border-gray-500 h-3/4 p-4" action="{{ route('account.password.update') }}" method="POST">
                <h2 class="text-xl text-center font-bold mb-4">Change Password</h2>
                @csrf
                <div>
                    <x-form.input class="p-2! mb-2! ml-auto" label="Current Password:" name="current_password" id="current_password" type="password"></x-input>
                </div>
                <div>
                    <x-form.input class="p-2! mb-2! ml-auto" label="New Password:" name="password" id="password" type="password"></x-input>
                </div>
                <div>
                    <x-form.input class="p-2! mb-2! ml-auto" label="Confirm New Password:" name="password_confirmation" id="password_confirmation" type="password"></x-input>
                </div>

                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <div class="flex flex-col h-1/2 justify-center">
                    <x-button class="mt-auto py-1! px-4! " title="Change Password"></x-button>
                </div>

                <span class="text-gray-600 text-sm mt-4 text-center block">Password last updated on: {{ $user->password_last_updated ? $user->password_last_updated->format('F j, Y, g:i a') : 'N/A' }}</span>
            </form>

        </div>
    </div>
</x-layout>