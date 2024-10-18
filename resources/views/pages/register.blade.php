@extends('templates.main')

@section('title', __('registration.register.title'))

@section('main')
    <form action="{{ action([\App\Http\Controllers\RegistrationController::class, 'store']) }}" method="post">
        @csrf
        <h1>{{ __('registration.register.title') }}</h1>
        <div>
            <label for="username">{{ __('registration.register.username') }}</label>
            <input type="text" name="username" required id="username">
        </div>
        <div>
            <label for="email">{{ __('registration.register.email') }}</label>
            <input type="email" name="email" required id="email">
        </div>
        <div>
            <label for="password">{{ __('registration.register.password.password') }}</label>
            <input type="password" name="password" required id="password">
        </div>
        <div>
            <label for="password_confirmation">{{ __('registration.register.password.confirmation') }}</label>
            <input type="password" name="password_confirmation" required id="password_confirmation">
        </div>
        <div>
            <label for="agreement">{{ __('registration.register.agreement') }}</label>
            <input type="checkbox" name="agreement" required value="1" id="agreement">
        </div>

        <x-errors :errors="$errors" />

        <button type="submit">{{ __('registration.register.register') }}</button>
    </form>
@endsection
