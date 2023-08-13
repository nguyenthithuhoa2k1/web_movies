<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark col-sm-2" style="min-height: 92vh">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-house pe-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('movies.index') }}" class="nav-link text-white {{ request()->routeIs('movies.index') ? 'active' : '' }}">
                <i class="fa-solid fa-film"></i> Movies
            </a>
        </li>
        <li>
            <a href="{{ route('countries.index') }}" class="nav-link text-white {{ request()->routeIs('countries.index') ? 'active' : '' }}">
                <i class="fa-sharp fa-solid fa-earth-americas"></i> Country
            </a>
        </li>
        <li>
            <a href="{{ route('categories.index')}}" class="nav-link text-white {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                <i class="fa-solid fa-tag"></i> Category
            </a>
        </li>
        <li>
            <a href="{{ route('genres.index') }}" class="nav-link text-white {{ request()->routeIs('genres.index') ? 'active' : '' }}">
                <i class="fa-solid fa-tag"></i> Genres
            </a>
        </li>
    </ul>
</div>