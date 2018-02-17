<p class="title has-text-centered mb-1">Users To Follow</p>
<userstofollow following="{{$user->id}}" userstofollow="{{$usersToFollow}}" imagepath="{{asset("storage/user/")}}"></userstofollow>
{{--  @foreach($usersToFollow->chunk(3) as $chunkedUsers)
<div class="columns">
    @foreach($chunkedUsers as $user)
    <div class="column is-4">
        <a href="/user/{{$user->usernameSlug()}}">
            <img class=" image is-64x64 is-circle"src="{{asset("storage/user/".$user->profile_image->path)}}" alt="Image"> 
        </a>
        <a href="/user/{{$user->usernameSlug()}}">
            {{str_limit($user->name, 15)}}
        </a> 
        {{--  <followbutton currentUser="{{$currentUser}}" following="{{$user->id}}"></followbutton>  --}}
        {{--  <upload currentpage="{{url()->current()}}"csrftoken="{{csrf_token()}}" url="{{$snippet->slug}}/photos"></upload>  --}}
        {{--  @include('users.profile.follow-button') 
    </div>
    @endforeach
</div>
@endforeach  



  <vote-for-link 
:votedfor= {{$link->votedFor() ? 'true' : 'false'}}
:link={{$link->id}}
:totalscore= {{$link->totalScore()}}>
</vote-for-link>  --}}