@extends('admin.layout.Master')
@section('content')
    <x-success/>
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Genres</th>
            <th>Active</th>
        </thead>
        <tbody>
            <?php
                $dataGenres = \App\Helpers\MyHelper::getAllGenres();
            ?>
            @foreach($dataGenres as $genres)
            <tr>
                <td>{{$genres->id}}</td>
                <td>{{$genres->genres}}</td>
                <td class="btn-group">
                    <form method="get" action="{{url('admin/genres/'.$genres->id.'/edit')}}">
                        @csrf
                        <button class="btn btn-warning me-2" type="submit">edit</button>
                    </form>
                    <form method="post" action="{{url('admin/genres/'.$genres->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tr colspan = 2>
            <td><a class="btn btn-success" href="{{url('admin/genres/create')}}">Add Genres</a></td>
        </tr>
    </table>

{{ $dataGenres->links("pagination::bootstrap-4") }}
@endsection