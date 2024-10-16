@extends('templates.main')

@section('title', __('login.title'))

@section('main')
    <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <h1>{{ __('login.title') }}</h1>
        <div>
            <label for="login">{{ __('login.fields.login') }}</label>
            <input type="text" name="login" required id="login">
        </div>
        <div>
            <label for="password">{{ __('login.fields.password') }}</label>
            <input type="password" name="password" required id="password">
        </div>

        <div>
            <label for="remember">{{ __('login.fields.remember') }}</label>
            <input type="checkbox" name="remember" value="1" id="remember">
        </div>

        <x-errors :errors="$errors" />

        <button type="submit">{{ __('login.login') }}</button>
    </form>
@endsection
