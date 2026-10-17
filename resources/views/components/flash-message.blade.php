@if(session('success'))
    <div id="flash-message" class="hidden sm:block text-green-600 text-center text-xl absolute inset-5 pointer-events-none">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="flash-message" class="hidden sm:block text-red-600 text-center text-xl absolute inset-5 pointer-events-none">
        {{ session('error') }}
    </div>
@endif