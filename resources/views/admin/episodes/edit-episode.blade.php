@extends('admin.layout.Master')
@section('content')
    <x-errors/>
    <h1>Edit Episodes</h1>
     @foreach($dataEpisodes as $episodes)
    <form id="formEditEpisodes" class="mb-3 form" method="post" action="{{url('admin/episodes/'.$episodes->id.'/edit')}}" enctype="multipart/form-data">
        @csrf
        <label for="inputNameEpisodes" class="form-label">Episodes</label>
        <input type="text" class="form-control" id="inputNameEpisodes" name="episodes" value="{{ old('episodes',$episodes->episodes) }}">
        <label for="inputNameEpisodes" class="form-label">Link</label>
        <input type="text" class="form-control" id="inputNameEpisodes" name="links" value="{{ old('episodes',$episodes->links) }}">
        <input type="hidden" class="form-control" id="inputNameEpisodes" name="movie_id" value="{{$episodes->movie_id}}">
        <input type="hidden" class="form-control" id="inputNameEpisodes" name="version" value="{{$episodes->version}}">
        <button type="submit" class="btn btn-success">Edit Episodes</button>
    </form>
    @endforeach
<script>
    $(document).ready(function(){
        $('#formEditEpisodes').validate({
            rules: {
                episodes: {
                    required: true,
                    maxlength : 255,
                },
                links: {
                    required: true,
                },
            },
            messages: {
                episodes: {
                    required: "Bạn chưa nhập episodes",
                    maxlength: "vượt quá max kí tự",
                },
                links: {
                    required: "Bạn chưa nhập links",
                },
            },
            errorClass: 'error', // Áp dụng lớp error cho các thông báo lỗi
        });
    });
</script>
@endsection
