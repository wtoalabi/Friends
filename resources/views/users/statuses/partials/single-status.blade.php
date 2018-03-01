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
                <nameandtimeheader :user="{{$status->user}}" time="{{$status->created_at}}"></nameandtimeheader>
                <br>
            @if($count = $status->status_images->count())
            <imagegallery 
                :images="{{$status->status_images}}"
                path="{{asset('storage/user/')}}"
                title="{{str_limit($status->body, 20)}}"
                :lightbox="true">
            </imagegallery>
            @endif
        {{$status->body}}
    </div>
<nav class="level is-mobile">
    <div class="level-left">
       <div class="field is-grouped is-grouped-multiline">
            {{--  <postcomment count="{{$status->comments_count}}" 
                         statusid="{{$status->id}}"> 
            </postcomment>  --}}
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
    <div class="level-right">
        <button class="button" type="submit">Delete Status</button>
    </div>
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

