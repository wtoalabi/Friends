<div class="message is-link">
    <div class="message-body">
        <p class="title">Followers</p>
            @if(route('home') == url()->current())
                @include('layouts.users.partials.following-card')
            @else
                @include('layouts.users.partials.following-card',['user'=>$profileUser])
            @endif                                              
        <p class="title">Following</p>
            View More...
    </div>
</div>