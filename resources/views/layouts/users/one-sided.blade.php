@include('layouts.header')
<div class="main">
    <div class="row">
        <div class="strip hero is-light mb-1">
            <div class="has-text-centered columns">
                <span class="column">Friends</span>    
                <span class="column">My Profile</span>    
                <span class="column">My Pictures</span>    
                <span class="column">Messages</span>      
                <span class="column"><a href="{{route('users_directory')}}">Users Directory</a></span>      
            </div>
        </div>
        <div class="columns">
            <div class="column is-3">
                <div class="message is-link">
                    <div class="message-body">
                        <p class="title">Community</p>
                        Communuty Links
                    </div>
                </div>
            </div>
            <div class="column is-9">
                {{$slot}}
            </div>
        </div>
    </div>
</div>  
@include('layouts.footer')