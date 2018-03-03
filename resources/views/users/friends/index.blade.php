@component('layouts.users.one-sidebar')

@slot('title')
 {{$user->pageTitle()}} Friends List
@endslot

@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$user])
    
@endslot

<friendslist
    userid="{{$user->id}}"
    imagepath="{{asset('storage/user')}}">
</friendslist>

@endcomponent