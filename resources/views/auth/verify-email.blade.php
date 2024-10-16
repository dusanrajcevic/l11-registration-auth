@extends('templates.main')

@section('title', __('registration.verify.notice.title'))

@section('main')
    <h1>{{ __('registration.verify.notice.title') }}</h1>
    <p>{{ __('registration.verify.notice.description') }}</p>
    <form method="post">
        @csrf
        <p>{{ __('registration.verify.notice.deleted') }}</p>
        <button type="submit">{{ __('registration.verify.notice.resend') }}</button>
    </form>
@endsection
