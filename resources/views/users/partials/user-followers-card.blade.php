<p class="title is-3 has-text-centered mb-1">People Following {{$user->name}}</p>
@foreach($user->followers->take(6)->chunk(3) as $chunkedUsers)
<div class="columns">
    @foreach($chunkedUsers as $user)
    <div class="column is-4">
        <a href="/user/{{$user->usernameSlug()}}">
        <img class=" image is-64x64 is-circle"src="{{asset("storage/user/".$user->profile_thumb())}}" alt="Image"> 
            {{$user->name}}
        </a>
    </div>
    @endforeach
</div>
@endforeach
@if($count > 6)
<div class="title is-5">
    <a href="http://">Click here to view more {{$user->name}} followers...</a> 
</div>
@endif      

    