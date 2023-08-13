<div class='header'>
    <div class="logo">
        <h1><img src="{{ asset('logo/logo3.jpg') }}" alt="" width="50px" height="50px">XEM FIM HAY</h1>
        <form method="get" action="{{ url('search') }}" class="seach d-flex justify-content-center mb-2">
            @csrf
            <input type="text" name="search" placeholder="Tên phim....">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        @if (Auth::check())
            <div class="logout"><a href="{{ url('member/logout') }}">Logout</a></div>
        @else
            <div class="register"><a href="{{ url('member/register') }}">Đăng kí</a></div>
            <div class="login"><a href="{{ url('member/login') }}">Đăng nhập</a></div>
        @endif
    </div>
    <ul class="nav nav-tabs pt-2 justify-content-center">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('movies') }}">HOME</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                aria-expanded="false">THỂ LOẠI</a>
            <ul class="dropdown-menu">
                <?php
                $category = \App\Helpers\MyHelper::getAllCategories();
                ?>
                @foreach ($category as $category)
                    <li><a class="dropdown-item"
                            href="{{ url('search/category/' . $category['id']) }}">{{ $category['category'] }}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                aria-expanded="false">QUỐC GIA</a>
            <ul class="dropdown-menu">
                <?php
                $country = \App\Helpers\MyHelper::getAllCountries();
                ?>
                @foreach ($country as $country)
                    <li><a class="dropdown-item"
                            href="{{ url('search/country/' . $country['id']) }}">{{ $country['country'] }}</a></li>
                @endforeach
            </ul>
        </li>
        <?php
        $dataGenres = \App\Helpers\MyHelper::getAllGenres();
        ?>
        @foreach ($dataGenres as $genres)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('search/movies/genres/' . $genres->id) }}">{{ $genres->genres }}</a>
            </li>
        @endforeach
        <li class="nav-item">
            <a class="nav-link" href="{{ url('search/movies/news') }}">PHIM MỚI</a>
        </li>
    </ul>
</div>
