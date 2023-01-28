<li class="nav-item">
    <a href="{{ route('books.index') }}"
       class="nav-link {{ Request::is('books*') ? 'active' : '' }}">
        <p>Books</p>
    </a>
</li>

@can('manage_app')
    <li class="nav-item">
        <a href="{{ route('favourites.index') }}"
        class="nav-link {{ Request::is('favourites*') ? 'active' : '' }}">
            <p>Favourites</p>
        </a>
    </li>


    <li class="nav-item">
        <a href="{{ route('comments.index') }}"
        class="nav-link {{ Request::is('comments*') ? 'active' : '' }}">
            <p>Comments</p>
        </a>
    </li>


    <li class="nav-item">
        <a href="{{ route('users.index') }}"
        class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
            <p>Users</p>
        </a>
    </li>

@endcan


