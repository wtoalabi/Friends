@component('layouts.users.two-sidebars')

@slot('title')
{{$status->user->first_name}} Post....
@endslot

@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$status->user])
@endslot

@slot('user_left_column')
<div class="is-hidden-mobile">
    @include('users.partials.users-to-follow-card',['user'=>$currentUser])
</div>
@endslot

@include('users.statuses.partials.single-status')

@endcomponent