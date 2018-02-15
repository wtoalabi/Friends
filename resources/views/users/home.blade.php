@component('layouts.users.main')
@slot('title')
My Stream
@endslot
        @include('users.statuses.post',['profileID'=>$user->id])
        @include('users.statuses.status')
@endcomponent