<p class="title has-text-centered mb-1">Users To Follow</p>
<userstofollow following="{{$user->id}}" userstofollow="{{$usersToFollow}}" imagepath="{{asset("storage/user/")}}" isfollowed="{{$currentUser->isFollowing($user->id)}}"></userstofollow>
{{--  <div class="title is-5 has-text-centered mb-1"> WAO!!!!! <p>You must be a Ninja or something!</p> <p>Do you know that you are now following every single registered user on the platform</p> <p> Thanks for the commitment!</p>
</div>  --}}