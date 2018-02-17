@include('layouts.header')
@include('layouts.users.partials.user-strip')
<div class="columns">
    <div class="column is-3">
        {{$user_right_column}}
    </div>
    <div class="column is-6">
        {{$slot}}
    </div>
    <div class="column is-3">
        {{$user_left_column}}
    </div>
</div>
@include('layouts.footer')