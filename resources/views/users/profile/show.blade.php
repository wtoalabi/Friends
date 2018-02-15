@component('layouts.users.main')
@slot('title')
 {{$user->pageTitle()}} Profile Page
@endslot

@include('users.statuses.post',['profileID'=>$user->id])
@include('users.statuses.status',['sharedBy'=>"Posted By:"])


@endcomponent