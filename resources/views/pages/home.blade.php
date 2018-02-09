@component('layouts.main')
@slot('title')
 Home Page
@endslot
<div class="hero is-light">
    <div class="hero-body">
        <div class="container has-text-centered">
            @if(Auth::check())
            <p class="title">
                Hello, {{auth::user()->name}}
            </p>
            <p>
                STATS
            </p>
            @else
                <p class="title">Welcome to Larabook</p>   
                <button class="button is-primary">Sgnup!</button>            
            @endif
            
            
        </div> 
    </div>
</div>
@endcomponent