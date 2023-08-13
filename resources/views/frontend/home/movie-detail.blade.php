@extends('frontend.layout.Master')
<x-frontend.header />
@section('content')
    <x-frontend.slide />
    <x-errors />
    <div class="container py-5">
        <div class="row text-light">
            <!-- Cột 1 -->
            <div class="col-lg-8">
                <!-- Row 1: Hình và Thông tin phim -->
                @foreach ($dataMovie as $movie)
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('storage/upload/movies_image/' . $movie->image) }}" class="img-fluid"
                                alt="Tên phim">
                            <?php
                            $dataFirsfEpisode = \App\Helpers\MyHelper::getFirsfEpisodes($movie->id);
                            ?>
                            @if (!empty($dataFirsfEpisode->links))
                                <a href="{{ url('watch/' . $dataFirsfEpisode->id) }}" class="btn btn-danger mt-2">Xem phim</a>
                            @endif
                            <input id="movie_id" type="hidden" value="{{ $movie->id }}">
                        </div>
                        <div class="col-md-6">
                            <h2 class="capitalize-words">{{ $movie->title }}</h2>
                            <p class="movie-year">Divine Destiny ({{ $movie->year }})</p>
                            <h4>Thông tin phim</h4>
                            <div class="movie-information movie-bg">
                                <p class="text">Trạng thái: {{ $movie->status }}</p>
                                <p class="text">Thời lượng: {{ $movie->year }}</p>
                                <p class="text">Năm sản xuất: {{ $movie->year }}</p>
                                <p class="text">Quốc gia: {{ $movie->country_id }}</p>
                                <p class="text">Thể loại: {{ $movie->category }}</p>
                                <p class="text">Diễn viên: {{ $movie->perfomer }}</p>
                            </div>
                            <div class="movie-rate my-2">
                                <?php
                                    $rateAverage = \App\Helpers\MyHelper::getRate($movie->id);
                                ?>
                                @csrf
                                @for($i=1;$i<6;$i++)
                                    <i rate-id="{{$i}}" id="rate-{{$i}}" movie-id="{{$movie->id}}" class="fa-sharp fa-solid fa-star rate ratings_stars {{$i <= $rateAverage ? 'ratings_hover' : "" }}"></i>
                                @endfor
                               <span class="rateAverage">{{$rateAverage}}/5</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 mb-5">
                        <div class="col-md-12 movie-bg px-3 py-3">
                            <h3 class="pb-2"><b>NỘI DUNG PHIM</b></h3>
                            <p>{{ $movie->descriptions }}</p>
                        </div>
                    </div>
                @endforeach

                <!-- Row 2: Các comment -->
                <x-frontend.movie-comment />
            </div>

            <!-- Cột 2 -->
            <div class="col-lg-4">
                <h3>Phim sắp chiếu</h3>
                <ul class="list-group">
                    <?php
                    // Gọi hàm để hiển thị danh sách phim sắp chiếu
                    $getMoviesNew = \App\Helpers\MyHelper::getMoviesNew();
                    ?>
                    @foreach ($getMoviesNew as $movie)
                        <li class="list-group-item d-flex justify-content-start align-items-center fs-6">
                            <img src="{{ asset('storage/upload/movies_image/'.$movie->image) }}" class="img-thumbnail"
                                alt="{{ $movie->title }}" style="max-height: 60px;">
                            <div class="ms-3">
                                <a href="{{ url('movie/detail/' . $movie->id) }}" class="text-decoration-none text-light">
                                    <h6 class="capitalize-words">{{ $movie->title }}</h6>
                                </a>
                                <div class="movie-rate my-2">
                                    <?php
                                        $rateAverage = \App\Helpers\MyHelper::getRate($movie->id);
                                    ?>
                                    @csrf
                                    @for($i=1;$i<6;$i++)
                                        <i rate-id="{{$i}}" movie-id="{{$movie->id}}" class="fa-sharp fa-solid fa-star rate {{$i <= $rateAverage ? 'ratings_hover' : "" }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <h3 class="mt-5">Phim yêu thích</h3>
                <ul class="list-group">

                    <?php
                        $averageRates = \App\Helpers\MyHelper::getMoviesfavourite();

                    ?>
                    @foreach ($averageRates as $movie)
                        <li class="list-group-item d-flex justify-content-start align-items-center fs-6">
                            <img src="{{ asset('storage/upload/movies_image/'.$movie->image) }}" class="img-thumbnail"
                                alt="{{ $movie->title }}" style="max-height: 60px;">
                            <div class="ms-3">
                                <a href="{{ url('movie/detail/'.$movie->id) }}" class="text-decoration-none text-light">
                                    <h6 class="capitalize-words">{{ $movie->title }}</h6>
                                </a>
                                <div class="movie-rate my-2">
                                    <?php
                                        $rateAverage = \App\Helpers\MyHelper::getRate($movie->id);
                                    ?>
                                    @csrf
                                    @for($i=1;$i<6;$i++)
                                        <i rate-id="{{$i}}" movie-id="{{$movie->id}}" class="fa-sharp fa-solid fa-star rate {{$i <= $rateAverage ? 'ratings_hover' : "" }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <h3 class="mt-5">Phim gợi ý</h3>
                <ul class="list-group">

                    <?php
                        $getMoviesSuggest = \App\Helpers\MyHelper::getMoviesSuggest();

                    ?>
                    @foreach ($getMoviesSuggest as $movie)
                        <li class="list-group-item d-flex justify-content-start align-items-center fs-6">
                            <img src="{{ asset('storage/upload/movies_image/'.$movie->image) }}" class="img-thumbnail"
                                alt="{{ $movie->title }}" style="max-height: 60px;">
                            <div class="ms-3">
                                <a href="{{ url('movie/detail/'.$movie->id) }}" class="text-decoration-none text-light">
                                    <h6 class="capitalize-words">{{ $movie->title }}</h6>
                                </a>
                                <div class="movie-rate my-2">
                                    <?php
                                        $rateAverage = \App\Helpers\MyHelper::getRate($movie->id);
                                    ?>
                                    @csrf
                                    @for($i=1;$i<6;$i++)
                                        <i rate-id="{{$i}}" movie-id="{{$movie->id}}" class="fa-sharp fa-solid fa-star rate {{$i <= $rateAverage ? 'ratings_hover' : "" }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.ratings_stars').click(function(e){
                e.preventDefault();
                let checkLogin = {{ Auth::check() ? 'true' : 'false' }};
                let rate = $(this).attr('rate-id');
                let movie_id = $(this).attr('movie-id');
                if(checkLogin===true){
                    $.ajax({
                        method:'POST',
                        headers:{'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")},
                        url: '{{url("/movie/rate")}}',
                        dataType: 'json',
                        data: {
                            'rate':rate,
                            'movie_id':movie_id,
                        },
                        success: function(res){
                            $('.rateAverage').text(res.rateAverage.toFixed(2) + "/5");
                            $('.ratings_stars').removeClass('ratings_hover');
                            $('#rate-'+parseInt(res.rateAverage)).prevAll().addBack().addClass('ratings_hover');
                        },
                    });
                }
            });
        });
    </script>
@endsection
