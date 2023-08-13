<div class="container col-md-12">
    <h1>Phim được yêu thích</h1>
    <div class="movie">
        <?php
            // Gọi hàm getAllMovies từ MyHelper
            $dataMovie = \App\Helpers\MyHelper::getMovies();
        ?>
        @foreach ($dataMovie as $moive)
        <div class="movie-item col-md-2">
            <img src="{{ asset('storage/upload/movies_image/'.$moive['image']) }}" class="movie-img-top" alt="" width="160px" height="227.2px">
            <div class="movie-body">
                <a href="{{url('movie/detail/'.$moive->id)}}" class="movie-title">{{$moive['title']}}</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
