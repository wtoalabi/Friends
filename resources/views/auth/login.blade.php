@component('layouts.main')
@slot('title')
 Login Page
@endslot
<div class="columns">
    <div class="mt-5 column is-8 is-offset-2">
        @include('users.partials.login-form')
    </div>    
</div>    
    
@endcomponent