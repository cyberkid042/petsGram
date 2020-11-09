@component('mail::message')
# Welcome to PetsGram

A community for Pets and their owners..
We are looking forward to following you to see what awesome pets you have.

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Get started!
@endcomponent

Reagards,<br>
PetsGram Inc.
@endcomponent