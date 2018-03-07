@component('layouts.users.two-sidebars')

@slot('title')
My Stream
@endslot

@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$currentUser])
@endslot

@slot('user_left_column')
<div class="is-hidden-mobile">
    @include('users.partials.users-to-follow-card',['user'=>$currentUser])    
</div>
@endslot

  @include('users.partials.status-post',['profileID'=> $currentUser->id])
<statusstream 
              urlpath="{{asset("storage/user")}}"
              currentuserid= "{{$currentUser->id}}">
</statusstream>


        
@endcomponent