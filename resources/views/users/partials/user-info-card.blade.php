<userinfocard 
            propuserid="{{$user->id}}" 
            propusername="{{$user->username}}" 
            propimagepath="{{asset("storage/user")}}" 
            propcurrentuserid="{{$currentUser->id}}" 
            propisfollowed="{{$currentUser->isFollowing($user->id)}}">
</userinfocard>