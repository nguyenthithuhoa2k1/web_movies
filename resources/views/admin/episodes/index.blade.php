@extends('admin.layout.Master')
@section('content')
    <x-success/>
    <h1>Episodes</h1>
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Links</th>
            <th>Episodes</th>
            <th>Movie</th>
            <th>Active</th>
        </thead>
        <tbody>
        <?php
            $dataEpisodes = \App\Helpers\MyHelper::getAllEpisodesMovies(request()->route('id'));
         ?>
         @foreach($dataEpisodes as $episodes)
            <tr>
                <td>{{$episodes->id}}</td>
                <td>{{$episodes->links}}</td>
                <td>{{$episodes->episodes}}</td>
                <td>
                <img src="{{asset('storage/upload/movies_image/'.$episodes->image)}}" alt="image {{$episodes->title}}" width="50px" height="50px">
                <div>{{$episodes->title}}</div>
                </td>
                <td class="btn-group">
                    <form method="get" action="{{url('admin/movies')}}">
                        @csrf
                        <button class="btn btn-success me-2" type="submit">Movie</button>
                    </form>
                    <form method="get" action="{{url('admin/episodes/'.$episodes->id.'/edit')}}">
                        @csrf
                        <button class="btn btn-warning me-2" type="submit">edit</button>
                    </form>
                    <form method="post" action="{{url('admin/episodes/'.$episodes->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"> Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tr colspan = 2>
            <td><a class="btn btn-success" href="{{url('admin/episodes/'.request()->route('id').'/add')}}">Add Episodes</a></td>
        </tr>
    </table>

@endsection