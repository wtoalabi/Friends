@component('layouts.main')
@slot('title')
 Signup Page
@endslot
<div class="columns">
    <div class="column is-8 is-offset-2">
        @include('users.partials.registration-form')
    </div>
</div>
@endcomponent