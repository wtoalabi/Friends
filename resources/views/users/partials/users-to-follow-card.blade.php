<p class="title has-text-centered mb-1">Users To Follow</p>
<userstofollow 
    following="{{$user->id}}" 
    :userstofollow="{{$usersToFollow}}" 
    imagepath="{{asset("storage/user/")}}" 
    isfollowed="{{$currentUser->isFollowing($user->id)}}">
</userstofollow>