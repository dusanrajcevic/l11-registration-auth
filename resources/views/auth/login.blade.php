@extends('templates.main')

@section('title', __('login.title'))

@section('main')
    <x-form action="{{ route('authenticate') }}" method="post">
        @csrf
        <x-h1>{{ __('login.title') }}</x-h1>
        <x-input :label="__('login.fields.login')"
                 type="text"
                 name="login"
                 :required="true"
                 id="login" />
        <x-input :label="__('login.fields.password')"
                 type="password"
                 name="password"
                 :required="true"
                 id="password" />
        <x-checkbox :label="__('login.fields.remember')"
                 type="checkbox"
                 name="remember"
                 value="1"
                 :required="false"
                 id="remember" />
        <x-errors :errors="$errors" />
        <x-button type="submit">{{ __('login.login') }}</x-button>
    </x-form>
@endsection
