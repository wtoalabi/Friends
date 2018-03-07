<nav id="navbar" class="navbar is-fixed-top">
    <div class="container is-fluid">
        <div class="navbar-brand ">
            <div class="navbar-item">
                <div class="field is-grouped">
                    @auth
                    <a href="/home" class="button is-primary">FOLLOWSBOOK</a>
                    @endauth
                    @guest
                    <a href="/" class="button is-primary">FOLLOWSBOOK</a>
                    @endguest
                </div>
            </div>
            <div id="navbarBurger" class="navbar-burger burger" data-target="navMenuDocumentation">
                <span></span>
                <span></span>
                <span></span>
          </div>
        </div>
        
        <div id="navMenuDocumentation" class="navbar-menu">
            <div class="navbar-start ">
                    @auth
                        <a class="navbar-item" href="/home">
                            <span class="icon"><i class="fa fa-book" aria-hidden="true"></i></span>Get in Touch
                        </a>
                    @endauth
                </div>
            <div class="navbar-end">    
                
                <div class="navbar-item">
                    <div class="field is-grouped">
                     @guest
                        <p class="control">
                            <a class="button is-info" href="/login">
                                <span class="icon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <span>Login</span>
                            </a>
                            <a class="button is-info" href="/register">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <span>Register</span>
                            </a>
                        </p>
                        @endguest
                        @auth
                        
                            <div class="navbar-item has-dropdown is-hoverable control">
                                <a class="button is-info" href="/user/{{$currentUser->usernameSlug()}}">
                                    <span class="icon">
                                        <img class="is-circle nav-image" src="{{asset("storage/user/".$currentUser->profile_image())}}" alt="Image">
                                    </span>
                                    <span>{{ $currentUser->first_name }}</span>
                                </a>
                            <div class="navbar-dropdown ">
                                <a class="navbar-item " href="/user/{{$currentUser->usernameSlug()}}">
                                    <p><strong>My Profile</strong></p>
                                </a>
                                <a class="navbar-item " href="/user/settings/{{$currentUser->usernameSlug()}}">
                                    <p><strong>My Settings</strong></p>
                                </a>
                            </div>
                        </div>
                        <p>
                            <a href="{{ route('logout') }}" class="button is-danger"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <span class="icon"><i class="fa fa-user"></i></span>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>        
                            </a>
                        </p>
                           @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>