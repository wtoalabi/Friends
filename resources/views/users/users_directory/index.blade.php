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
    {{--  <nav class="pagination" role="navigation" aria-label="pagination">
            <a class="pagination-previous" title="This is the first page" disabled>Previous</a>
            <a class="pagination-next">Next page</a>
            <ul class="pagination-list">
              <li>
                <a class="pagination-link is-current" aria-label="Page 1" aria-current="page">1</a>
              </li>
              <li>
                <a class="pagination-link" aria-label="Goto page 2">2</a>
              </li>
              <li>
                <a class="pagination-link" aria-label="Goto page 3">3</a>
              </li>
            </ul>
          </nav>  --}}
@endcomponent