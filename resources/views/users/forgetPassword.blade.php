<form action="{{ route('forgetPassword') }}" method="post">
    @csrf
    @if (session('success'))
        <p class="succesmessage"> {{ session('success') }} </p>
    @endif
    @if (session('error'))
        <p class="succesmessage"> {{ session('error') }} </p>
    @endif
    <label for="email">Email</label>
    <input type="email" name="email">
    <span class="errorMessage">
        @error('email')
            {{$message}}
        @enderror
    </span>
        <input type="submit" value="Send Email" name="submit">
</form>