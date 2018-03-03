@component('layouts.users.one-sidebar')

@slot('title')
 {{$currentUser->pageTitle()}} Friends List
@endslot

@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$currentUser])
    
@endslot

@include('users.friends.partials.list')

@endcomponent