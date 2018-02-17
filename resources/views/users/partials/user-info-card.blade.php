<a href="/user/{{$user->usernameSlug()}}">
    <p class="title has-text-centered mb-1">{{$user->name}}</p>
</a> 
<div class="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <img class=""src="{{asset("storage/user/". $user->profile_image->path)}}" alt="Image">
            </figure>
        </div>
        <div class="card-content">
            <div class="media">        
                <div class="media-content">
                    <p class="subtitle has-text-centered">{!!$user->usernameTag()!!}</p>
                </div>
            </div>
            <div class="content columns mt-2">
                  
            </div>
        </div>
        @unless(auth()->user()->id == $user->id)
        <div class="card-footer column is-centered">
            <div class="columns is-centered">
                <div class="column has-text-centered">
                    @include('users.profile.follow-button')
                </div>
            </div>
        </div>
        @endif
        <div class="column is-centered card-footer">
            <div class="columns">
                <span class="column is-8 title is-size-4">{{str_plural("Status", $user->statuses->count())}} </span> 
                <span class="column is-4"> <span class="button mb-1"> <span class="has-text-success is-link is-size-6">{{$user->statuses->count()}}</span></span> 
            </div>
        </div>
        <div class="column is-centered card-footer">
            <div class="columns">
                <span class="column is-8 title is-size-4"> Followers: </span> 
                <span class="column is-4"> <span class="button mb-1"> <span class="has-text-success is-link is-size-6">{{$user->followers->count()}}</span></span> 
            </div>
        </div>
        <div class="column is-centered card-footer">
            <div class="columns">
                <span class="column is-8 title is-size-4"> Following: </span> 
                <span class="column is-4"> <span class="button mb-1"><span class="has-text-info is-link is-size-6">{{$user->following->count()}}</span></span> 
            </div>
        </div>
    </div>