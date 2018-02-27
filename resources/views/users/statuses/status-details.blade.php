@component('layouts.users.two-sidebars')

@slot('title')
{{$status->user->first_name}} Post....
@endslot

@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$status->user])
@endslot

@slot('user_left_column')
@include('users.partials.users-to-follow-card',['user'=>$currentUser])
@endslot

@include('users.statuses.partials.single-status')

@endcomponent