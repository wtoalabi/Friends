@component('layouts.users.two-sidebars')
@slot('title')
 {{$profileUser->pageTitle()}} Profile Page
@endslot
@slot('user_right_column')
@include('users.partials.user-info-card',['user'=>$profileUser])
@endslot

@slot('user_left_column')
@include('users.partials.user-followers-card',['user'=>$profileUser])
@endslot
  
@include('users.partials.status-post',['profileID'=> $profileUser->id])
<statusstream 
    urlpath="{{asset("storage/user")}}"
    currentuserid= "{{$currentUser->id}}"
    profileuser={{$profileUser->id}}>
</statusstream>
@endcomponent