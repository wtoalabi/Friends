@component('layouts.users.one-sidebar')
@slot('title')
 All Users Directory
@endslot
@slot('user_right_column')
    @include('users.partials.user-info-card',['user'=>$currentUser])
    
@endslot

@foreach($users->chunk(3) as $usersChunked)
    <div class="message is-primary mb-1 column">
        <div class="columns">
            @foreach($usersChunked as $user)
            <div class="message is-primary mb-1 column is-4">
                @include('users.users_directory.user_list')
            </div>
            @endforeach
        </div>
    </div>
        @endforeach



    {{ $users->links() }}
@endcomponent