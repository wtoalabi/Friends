@component('layouts.users.main')
@slot('title')
My Stream
@endslot
        @include('users.statuses.post')
        @include('users.statuses.status')
@endcomponent