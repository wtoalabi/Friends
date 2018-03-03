<div class="tabs is-centered">
    <ul>
        <li class="is-active">
        <a href="/home">
            <span class="icon is-small"><i class="fa fa-exchange"></i></span>
            <span>My Stream</span>
        </a>
        </li>
        <li class="">
        <a href="/friends/list">
            <span class="icon is-small"><i class="fa fa-group"></i></span>
            <span>Friends</span>
        </a>
        </li>
        <li>
        <a href="/user/{{$currentUser->usernameSlug()}}">
            <span class="icon is-small"><i class="fa fa-hashtag"></i></span>
            <span> My Profile</span>
        </a>
        </li>
        <li>
        <a>
            <span class="icon is-small"><i class="fa fa-camera"></i></span>
            <span>My Pictures</span>
        </a>
        </li>
        <li>
        <a>
            <span class="icon is-small"><i class="fa fa-comment"></i></span>
            <span>Messages</span>
        </a>
        </li>
        <li>
        <a>
            <span class="icon is-small"><i class="fa fa-file-text-o"></i></span>
            <span>Users Directory</span>
        </a>
    </li>
</ul>
</div>
