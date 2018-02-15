@component('layouts.users.main')
@slot('title')
 {{$user->pageTitle()}} Profile Page
@endslot

@include('users.statuses.post',['profileOwner'=>$user->id])
@include('users.statuses.status')


@endcomponent