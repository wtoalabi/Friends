<div class="message is-link">
    <div class="message-body">
        @if(route('home') == url()->current())
            @include('layouts.users.partials.profile-card')
            @else
            @include('layouts.users.partials.profile-card',['user'=>$profileUser])
        @endif
    </div>
</div>