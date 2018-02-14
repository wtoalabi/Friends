@component('layouts.users.main')
@slot('title')
 All Users Directory
@endslot
<div class="box message is-primary mb-1">
    @foreach($users as $user)
        <article class="media message-body mb-1">
            @include('users.users_directory.user_list')
        </article>
        @endforeach
    </div>
    {{ $users->links() }}
@endcomponent