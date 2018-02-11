<nav id="navbar" class="navbar is-fixed-top">
    <div class="container is-fluid ">
        <div class="navbar-brand ">
            <div class="navbar-item">
                <div class="field is-grouped">
                    <p class="button is-primary">LARABOOK</p>
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
                    <a class="navbar-item" href="/home">
                        <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>Home
                    </a>
                {{--  <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link  is-active" href="#">Dropdown</a>
                        <div class="navbar-dropdown ">
                            <a class="navbar-item " href="#">Elements</a>
                            <a class="navbar-item is-active" href="#">Components</a>
                            <hr class="navbar-divider">
                            <div class="navbar-item">
                                <div>
                                    <p class="is-size-6-desktop"><strong>0.6.1</strong></p>            
                                    <small><a class="bd-view-all-versions" href="#">View all versions</a></small>
                                </div>
                            </div>
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="#">
                                <div class="navbar-content">
                                    <p><small class="has-text-link">14 Nov 2017</small></p>
                                    <p>Bulma is on Patreon!</p>
                                </div>
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item " href="#/">
                                <p>
                                <strong>Patreon backers</strong>
                                <br>
                                <small>Everyone who is supporting Bulma</small>
                                </p>
                            </a>
                            <hr class="navbar-divider">
                            <div class="navbar-item">
                                <div class="navbar-content">
                                <div class="level is-mobile">
                                    <div class="level-left">
                                    <div class="level-item">
                                        <strong>Stay up to date!</strong>
                                    </div>
                                    </div>
                                    <div class="level-right">
                                    <div class="level-item">
                                        <a class="button bd-is-rss is-small" href="#">
                                            <span class="icon is-small">
                                                <i class="fa fa-rss"></i>
                                            </span>
                                            <span>Subscribe</span>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>  --}}        
                    {{--  <a class="navbar-item " href="#">
                        <span class="icon"><i class="fa fa-weixin" aria-hidden="true"></i></span>
                        Channels Page
                    </a>  --}}
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
                          @else
                            <div class="navbar-item has-dropdown is-hoverable control">
                                <a class="button is-info " href="/dashboard">
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                            <div class="navbar-dropdown ">
                                <a class="navbar-item " href="#/">
                                    <p><strong>User Profile</strong></p>
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
                            @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>