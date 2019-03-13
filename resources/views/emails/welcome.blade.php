@component('mail::message')
# Introduction

Welcome to our blog!


@component('mail::button', ['url' => 'https://algebra.hr'])
Započnite sa edukacijom
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
