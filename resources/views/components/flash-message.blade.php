@if(session('success'))
    <div id="flash-message" class=" text-green-600 text-center text-xl absolute inset-5">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="flash-message" class=" text-red-600 text-center text-xl absolute inset-5">
        {{ session('error') }}
    </div>
@endif