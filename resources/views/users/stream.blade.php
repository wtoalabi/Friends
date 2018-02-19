@component('layouts.users.two-sidebars')

@slot('title')
My Stream
@endslot

@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$currentUser])
@endslot

@slot('user_left_column')
@include('users.partials.users-to-follow-card',['user'=>$currentUser])
@endslot

  @include('users.partials.status-post',['profileID'=> $currentUser->id])
@include('users.partials.status-stream',['user'=>$currentUser])

{{--  <form action="post-comment/4" method="post">
    {{csrf_field()}}
    <div class="field">
        <label class="label">Post A Comment</label>
            <div class="control">
                <textarea class="textarea" name="body" placeholder="Post a Comment..." required></textarea>
            </div>
    </div>
    <div class="control">
        <button class="button is-primary">Submit</button>
    </div>
</form>  --}}
        
@endcomponent