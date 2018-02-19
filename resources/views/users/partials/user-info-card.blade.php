<userinfocard 
            propuserid="{{$user->id}}" 
            propimagepath="{{asset("storage/user")}}" 
            propcurrentuserid="{{$currentUser->id}}" 
            propisfollowed="{{$currentUser->isFollowing($user->id)}}">
</userinfocard>