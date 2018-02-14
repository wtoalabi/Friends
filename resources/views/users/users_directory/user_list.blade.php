<div class="media-left">
    <figure class="image is-65x65">
        <img class="avatar is-circle"src="{{asset("storage/user/".$user->profile_thumb())}}" alt="Image">
    </figure>
</div>
<div class="media-content">
        <div class="content">
                <p>
                    <a href="/user/{{$user->usernameSlug()}}"><strong class="title is-size-4">{{$user->name}}</strong></a> 
                    <small>{!!$user->usernameTag()!!}</small>
                    <br>
                </p>
                <p>            
                   @if($user->latestStatus())
                   <small>{{$user->latestStatus()->collapsed()}}</small>
                   <small class="tag">{{$user->latestStatus()->createdAt()}}</small>
                        @else
                            Not Posted Yet...
                        @endif
                    <br>
                </p>
            </div>
    <nav class="level is-mobile">
        <div class="level-left columns">
            <a class="level-item column">
                <button class="button is-small">Followers:</button>
            </a>
            <a class="level-item column">
                <button class="button is-small">Follow</button>
            </a>
            <a class="level-item column">
                <button class="button is-small">Following:</button>
            </a>
        </div>
    </nav>
</div>