@extends('admin.layout.Master')
@section('content')
    <x-success/>
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Descriptions</th>
            <th>Status</th>
            <th>Country</th>
            <th>Category</th>
            <th>Genres</th>
            <th>Performers</th>
            <th>Year</th>
            <th>Episodes</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
                $dataMovies = \App\Helpers\MyHelper::getMovies();
            ?>
            @foreach($dataMovies as $movie)
                <tr>
                    <td>{{$movie->id}}</td>
                    <td>
                        <img src="{{asset('storage/upload/movies_image/'.$movie->image)}}" alt="" width="50px" height="50px">

                    </td>
                    <td>{{$movie->title}}</td>
                    <td>{{$movie->descriptions}}</td>
                    <td>{{$movie->status}}</td>
                    <td>{{$movie->country}}</td>
                    <td>{{$movie->category}}</td>
                    <td>{{$movie->genres}}</td>
                    <td>{{$movie->perfomer}}</td>
                    <td>{{$movie->year}}</td>
                    <td>
                        <a class="btn btn-success" href="{{url('/admin/episodes/'.$movie->id)}}">Episodes</a>
                    </td>
                    <td class="btn-group">
                        <form method="get" action="{{url('admin/movies/'.$movie->id.'/edit')}}">
                            @csrf
                            <button class="btn btn-warning me-2" type="submit">edit</button>
                        </form>
                        <form method="post" action="{{url('admin/movies/'.$movie->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="{{url('/admin/movies/create')}}">Add Movie</a>
@endsection
