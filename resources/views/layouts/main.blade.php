@include('layouts.header')
            <div class="main">
                {{$slot}}
                @if(session('flash_notification'))
                <flash message="{{session()->pull('flash_notification')[0]->message}}"></flash>
                @endif
            </div>
        </div>    
</section>    
@include('layouts.footer')