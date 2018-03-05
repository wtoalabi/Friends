@component('layouts.users.one-sidebar')

@slot('title')
 {{$user->pageTitle()}} Pictures...
@endslot

@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$user])    
@endslot

<picturesdashboard
    :user="{{$user}}"
    imagepath="{{asset("storage/user")}}">
</picturesdashboard>


@endcomponent