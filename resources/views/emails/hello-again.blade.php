@component('mail::message')
# Introduction

Thanks so much for registring to my Advanced Blogger application, {{ $name }}!

@component('mail::button', ['url' => 'http://laravel.app/'])
Start Browsing
@endcomponent

@component('mail::panel', ['url' => ''])
Carpe Diem!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
