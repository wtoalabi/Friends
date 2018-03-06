@component('layouts.users.one-sidebar')
@slot('title')
 All Users Directory
@endslot
@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$currentUser])
    
@endslot

<userslist
    loggedinuserid="{{$currentUser->id}}"
    imagepath="{{asset("storage/user/")}}">
</userslist> 


@endcomponent