@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'mb-4 text-sm text-red-600']) }}>
        <ul class="list-none pl-5 ">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif