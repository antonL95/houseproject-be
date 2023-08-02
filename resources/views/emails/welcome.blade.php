<x-mail::message>
# @lang('Hi ') {{ $user->first_name }}

@lang('Welcome to ') {{ config('app.name') }}

@lang('Thank you')

{{ config('app.name') }}
</x-mail::message>
