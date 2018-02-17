@component('layouts.users.two-sidebars')

@slot('title')
My Stream
@endslot

@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$currentUser])
@endslot

@slot('user_left_column')
@include('users.partials.users-to-follow-card',['user'=>$currentUser])
@endslot

@include('users.partials.status-post',['profileID'=> $currentUser->id])
@include('users.partials.status-stream',['user'=>$currentUser])
        
@endcomponent