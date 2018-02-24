<div class="card">
    <div class="card-image">
        <figure class="image is-4by3">
            <img class=""src="{{asset("storage/user/".$user->profile_image())}}" alt="Image">
        </figure>
    </div>
    <div class="card-content">
        <div class="media">        
            <div class="media-content">
                <a href="/user/{{$user->usernameSlug()}}">
                    <p class="title is-5">{{$user->first_name}} {{$user->last_name}}</p>
                </a> 
                <p class="subtitle is-">{!!$user->usernameTag()!!}</p>
            </div>
        </div>
        <div class="content columns mt-2">
                
        </div>
    </div>
</div>