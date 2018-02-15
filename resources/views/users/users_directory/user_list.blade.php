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
                    <p class="title is-4">{{$user->name}}</p>
                </a> 
                <p class="subtitle is-6">{!!$user->usernameTag()!!}</p>
            </div>
        </div>
        <div class="content columns mt-2">
                <footer class="card-footer column is-12">
                        <div class="columns">
                            <a href="#" class="card-footer-item column">Followers: 1230</a>
                            <a href="#" class="card-footer-item column is-4 ">
                              <button class="button is-primary"> Follow</button>
                            </a>
                        </div>
                        </footer>
        </div>
    </div>
</div>