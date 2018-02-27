<div class="box message mb-1 {{$status->mood->color}}">
    <article class="media message-body">
        <div class="media-left">
            <a href="/{{$status->user->username}}">
                <figure class="image is-65x65">
                    <img class="avatar is-circle" src="{{asset("storage/user/".$status->user->profile_image())}}" alt="Image">
                </figure>
            </a>
        </div>
        <div class="media-content">
            <div class="content">          
                <strong><a href="/{{$status->user->username}}"> {{$status->user->first_name}} {{$status->user->last_name}}</a></strong> 
                <small>{{$status->user->username}}</small> <small>{{$status->created_at->diffForHumans()}}</small>
                <br>
            @if($count = $status->status_images->count())
            @foreach($status->status_images->chunk($status->getSize($count)) as $chunked)
            <div class="columns is-centered">
                @foreach($chunked as $image)                    
                        <div class="column">
                                <img class="" src="{{asset("storage/user/".$image->thumb)}}" alt="Image">
                            </div>
                            @endforeach
            </div>
            @endforeach
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
<statusdetailedcomments 
    statusid = {{$status->id}}
    avatar="{{asset("storage/user/" . $status->user->profile_image())}}">
</statusdetailedcomments>