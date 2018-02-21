
<statusstream 
              urlpath="{{asset("storage/user")}}"
              currentuserid= "{{$currentUser->id}}">
</statusstream>
{{--  @foreach($statuses as $status) 
<div class="box message {{$status->mood->color}} mb-1">
    <article class="media message-body">
        <div class="media-left">
            <figure class="image is-65x65">
                <img class="avatar is-circle"src="{{asset("storage/user/".$user->profile_image->path)}}" alt="Image">
            </figure>
        </div>
        <div class="media-content">
            <div class="content">
                <p>
                    @if(isset($sharedBy) && $status->profile_id !=$status->user_id)
                    {{$sharedBy}}
                    @endif
                    <strong><a href="/user/{{$status->user->usernameSlug()}}">{{$status->user->name}}</a></strong> 
                        <small>{!!$status->user->usernameTag()!!}</small> <small>{{$status->createdAt()}}</small>
                        <br>
                {{$status->body}}
                </p>
            </div>
        <nav class="level is-mobile">
            <div class="level-left">
                <a class="level-item">
                    <span class="icon is-small"><i class="fa fa-reply"></i></span>
                </a>
                <a class="level-item">
                    <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                </a>
                <a class="level-item">
                    <span class="icon is-small"><i class="fa fa-heart"></i></span>
                </a>
            </div>
        </nav>
        </div>
    </article>
</div>
@endforeach
{{ $statuses->links() }} 
 --}}