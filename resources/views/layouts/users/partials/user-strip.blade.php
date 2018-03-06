<div class="tabs is-centered">
    <ul>
        <li class="{{setActive(route('home'))}}">
        <a href="/home">
            <span class="icon is-small"><i class="fa fa-exchange"></i></span>
            <span>My Stream</span>
        </a>
        </li>
          <li class="{{setActive(route('friends-list',$currentUser->username))}}">
            <a href="/friends/list/{{$currentUser->usernameSlug()}}">
            <span class="icon is-small"><i class="fa fa-group"></i></span>
            <span>My Friends</span>
        </a>
        </li> 
        <li class="{{setActive(route('my-profile',$currentUser->username))}}">
        <a href="/user/{{$currentUser->usernameSlug()}}">
            <span class="icon is-small"><i class="fa fa-hashtag"></i></span>
            <span> My Profile</span>
        </a>
        </li>
        <li class="{{setActive(route('pictures',$currentUser->username))}}">
        <a href="/pictures/{{$currentUser->usernameSlug()}}">
            <span class="icon is-small"><i class="fa fa-camera"></i></span>
            <span>My Pictures</span>
        </a>
        </li>
      {{--    <li>
        <a>
            <span class="icon is-small"><i class="fa fa-comment"></i></span>
            <span>Messages</span>
        </a>
        </li>  --}}
        <li class="{{setActive(route('users_directory'))}}">
        <a href="/users">
            <span class="icon is-small"><i class="fa fa-file-text-o"></i></span>
            <span>Users Directory</span>
        </a>
    </li>
</ul>
</div>
