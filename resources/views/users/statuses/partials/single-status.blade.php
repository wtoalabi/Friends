<div class="box message mb-1 {{$status->mood->color}}">
    <article class="media message-body">
        <div class="media-left">
            <a href="/user/{{$status->user->usernameSlug()}}">
                <figure class="image is-65x65">
                    <img class="avatar is-circle" src="{{asset("storage/user/".$status->user->profile_image())}}" alt="Image">
                </figure>
            </a>
        </div>
        <div class="media-content">
            <div class="content">          
                <nameandtimeheader 
                    time="{{$status->created_at}}"
                    :statusowner="{{$status->user}}" 
                    statusoriginalid="{{$status->original_id}}">
                </nameandtimeheader>
            @if($count = $status->status_images->count())
            <imagegallery 
                :images="{{$status->status_images}}"
                path="{{asset('storage/user/')}}"
                title="{{str_limit($status->body, 20)}}"
                :lightbox="true">
            </imagegallery>
            @endif
        <div>
            @if($status->reshared_comment)
                <div class="mt-2 mb-1">
                    <em> <strong>{{$status->reshared_comment}}</strong></em>
                </div>
                @endif
            {{$status->body}}
        </div>
    </div>
<nav class="level is-mobile">
    <div class="level-left">
       <div class="field is-grouped is-grouped-multiline">
            <likestatus 
                statusid="{{$status->id}}" 
                count="{{$status->likes_count}}" 
                currentuser="{{$currentUser->id}}" ></likestatus>
            <resharestatus 
                count="{{$status->reshares_count}}" 
                :status="{{ $status}}">                
            </resharestatus>
        </div>
        </div>
        @if($currentUser->id == $status->user->id)
            <div class="level-right">
                <form action="{{route('statuses.destroy', $status->id)}}"
                        method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="button is-danger" type="submit"
                    onclick="return confirm('Are you sure?')">
                    Delete Status</button>
                </form>
            </div>
        @endif
</nav>
</div>
</article>
</div>
<hr>

<commentssection
        statusid = {{$status->id}}
        avatar="{{$status->user->profile_image()}}"
        path="{{asset("storage/user/")}}"
        commentscount="{{$status->comments_count}}"
        currentuser="{{$currentUser->id}}"
        >
</commentssection>

