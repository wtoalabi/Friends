@component('layouts.main')
@slot('title')
 Home Page
@endslot
<div class="hero is-light">
    <div class="hero-body">
        <div class="container has-text-centered">
            @user
            <p class="title">
                Hello, {{$user->name}}
            </p>
            
            <p>
                STATS
            </p>
            @enduser
            @guest
            <p class="title">Welcome to Larabook</p>   
            <button class="button is-primary">Signup!</button>            
            @endguest 
            
            
            
        </div> 
    </div>
</div>
@endcomponent