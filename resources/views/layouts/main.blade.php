@include('layouts.header')
            <div class="hero is-info">
                <div class="hero-body is-success columns">
                    <div class="column is-8">
                        <h1 class="title">{{$title}}</h1>
                    </div>
                    <div class="column is-3 is-offset-2">
                            @if(Auth::check())
                            <a href="/stream">My Stream</a> 
                            |
                            <a class="" href="/profile">
                                My Profile
                            </a>
                            @else
                                Other Link
                            @endif
                    </div>
                </div>
            </div>
            <div class="main">
                {{$slot}}
                @if(session('flash_notification'))
                <flash message="{{session()->pull('flash_notification')[0]->message}}"></flash>
                @endif
            </div>
        </div>    
</section>    
@include('layouts.footer')