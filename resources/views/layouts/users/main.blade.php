@include('layouts.header')
            <div class="hero is-info">
                <div class="hero-body is-success columns">
                    <div class="column is-8">
                        <h1 class="title">{{$title}}</h1>
                    </div>
                    <div class="column is-3 is-offset-2">
                        
                        <a class="" href="/profile">
                            My Profile
                        </a>
                        |
                            <a href="/stream">My Dashboard</a>     
                    </div>
                </div>
            </div>
            <div class="main">
                <div class="row">
                    <div class="strip hero is-light mb-1">
                        <div class="has-text-centered columns">
                            <span class="column">Friends</span>    
                            <span class="column">My Profile</span>    
                            <span class="column">My Pictures</span>    
                            <span class="column">Messages</span>      
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
                        <div class="column">
                            {{$slot}}
                        </div>
                        <div class="column is-3">
                                <div class="message is-link">
                                    <div class="message-body">
                                        <p class="title">Your Links</p>
                                        Links
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>    
</section>    
@include('layouts.footer')