@include('layouts.header')
            <div class="hero is-primary">
                <div class="hero-body is-success columns">
                    <div class="column is-8">
                        <h1 class="title">{{$title}}</h1>
                    </div>
                    <div class="column is-3 is-offset-2">
                        Other Link
                    </div>
                </div>
            </div>
            <div class="main">
                {{$slot}}
            </div>
        </div>    
</section>    
@include('layouts.footer')