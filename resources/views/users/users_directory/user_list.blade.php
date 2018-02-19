<div class="card">
    <div class="card-image">
        <figure class="image is-4by3">
            <img class=""src="{{asset("storage/user/".$user->profile_image->path)}}" alt="Image">
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
                <footer class="card-footer column is-12">
                        <div class="columns">
                            <a href="#" class="card-footer-item column is-7">
                                    Followers: <button class="button is-small mb-1"> <span class="has-text-success is-link is-size-6">{{$user->followers->count()}}</span></button>
                                    Following: <button class="button is-small mb-1"> <span class="has-text-info is-link is-size-6">{{$user->following->count()}}</span></button>
                            </a>
                            <div class="card-footer-item column is-4 m-1">
                                    <followbutton following="{{$user->id}}" isfollowed="{{$currentUser->isFollowing($user->id)}}"></followbutton>
                            </div>
                        </div>
                        </footer>
        </div>
    </div>
</div>