@extends('layouts.main')

@section('content')
    
    <form action="{{ route('resetPassword.store'), $user}}" method="post">
        @csrf
        <h1>Reset Password</h1>
        <label for="password">Password</label>
        <input type="password" name="password">
        <span class="errorMessage">
            @error('password')
                {{$message}}
            @enderror
        </span>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" name="confirm-password">
        <span class="errorMessage">
            @error('confirm-password')
                {{$message}}
            @enderror
        </span>
        
            <input type="submit" value="Reset" name="submit">
    </form>
@endsection