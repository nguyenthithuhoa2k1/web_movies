@extends('frontend.layout.Master')
<x-frontend.header/>
@section('content')
<x-frontend.slide/>
<h1>{{$errors}}</h1>
<div class="container movies-home mt-5">
    <h2 class="text-light">Danh sách phim</h2>
    <div class="row row-cols-1 row-cols-md-5 g-4 mx-2 my-2">
        @foreach ($dataMovies as $movie)
            <div class="col movie movie-height-400">
                <a href="{{url('movie/detail/'.$movie['id'])}}">
                <div class="movie bg-movie">
                    <img src="{{asset('storage/upload/movies_image/'.$movie['image'])}}" class="movie-img-top">
                    <div class="movie-body py-4">
                        <h5 class="movie-title">{{ $movie['title'] }}</h5>
                    </div>
                    <i class="play-icon fa fa-play-circle"></i>
                </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection