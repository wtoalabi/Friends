@component('layouts.users.one-sidebar')
@slot('title')
 {{$currentUser->pageTitle()}} Settings Page
@endslot
@slot('user_right_column')
@include('users.partials.user-info-card',['user'=>$currentUser])
@endslot
<settingspage
    loggedinuserid="{{$currentUser->id}}">
</settingspage>

@endcomponent