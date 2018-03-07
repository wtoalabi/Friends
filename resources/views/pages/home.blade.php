@component('layouts.main')
@slot('title')
Welcome... to FRIENDS BOOK!
@endslot
<div class="hero is-light">
    <div class="hero-body columns">
        <div class="column is-5">
            <div class="">
                    <article class="message is-success">
                            <div class="message-body content">
                                <h1 class="title is-3 has-text-black">Few things to Note: </h1>
                                <ul>
                                    <li>This is a personal training project & its never finished</li>
                                    <li>As I learn few more things...they are added.</li>
                                    <li>Dummy Contents are auto renewed every day.</li>
                                    <li>I'm SURE more than a few coding rules were broken.</li>
                                    <li>Please can you let me know through the <a class="has-text-danger" href="https://github.com/wtoalabi/Friends">github</a> repo?</li>
                                    <li>Here are default login details: </li>
                                        <div>
                                            <strong>Email: </strong><em> test@test.com</em>
                                            <br>
                                            <strong>Password: </strong><em> testing</em>
                                            <p class="title is-5">THANKS!!!</p>
                                        </div>
                                </ul>
                            </div>
                        </article>    
            </div> 
        </div>
        <div class="column is-7">
            @include('users.partials.login-form')
        </div>       
    </div>
</div>
@endcomponent