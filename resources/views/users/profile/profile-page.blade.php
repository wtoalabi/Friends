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
@include('users.partials.status-stream',['statuses'=>$profileStatuses, 'user'=>$profileUser,'sharedBy'=> 'Shared By: '])
@endcomponent