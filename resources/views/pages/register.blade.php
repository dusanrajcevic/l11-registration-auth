@extends('templates.main')

@section('title', __('registration.register.title'))

@section('main')
    <x-form action="{{ action([\App\Http\Controllers\RegistrationController::class, 'store']) }}" method="post">
        @csrf
        <x-h1>{{ __('registration.register.title') }}</x-h1>
        <x-input :label="__('registration.register.username')"
                 type="text"
                 name="username"
                 :required="true"
                 id="username" />
        <x-input :label="__('registration.register.email')"
                 type="email"
                 name="email"
                 :required="true"
                 id="email" />
        <x-input :label="__('registration.register.password.password')"
                 type="password"
                 name="password"
                 :required="true"
                 id="password" />
        <x-input :label="__('registration.register.password.confirmation')"
                 type="password"
                 name="password_confirmation"
                 :required="true"
                 id="password_confirmation" />
        <x-checkbox
            :label="__('registration.register.agreement')"
            name="agreement"
            :required="true"
            value="1"
            id="agreement" />
        <x-errors :errors="$errors" />

        <x-button type="submit">{{ __('registration.register.register') }}</x-button>
    </x-form>
@endsection
