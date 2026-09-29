<form action="{{ url('login') }}" method="POST">
    @csrf

    <!-- Email Field -->
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Password Field -->
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        @error('password')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Remember Me Checkbox -->
    <div>
        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>
    </div>

    <button type="submit">Login</button>
</form>
