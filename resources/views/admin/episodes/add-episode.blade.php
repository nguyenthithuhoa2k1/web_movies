@extends('admin.layout.Master')
@section('content')
    <x-errors/>
    <h1>Add Episodes</h1>
    <form id="formAddEpisodes" class="mb-3 form" method="post" action="{{url('admin/episodes/'.request()->route('id').'/add')}}" enctype="multipart/form-data">
        @csrf
        <label for="inputNameEpisodes" class="form-label">Episodes</label>
        <input type="text" class="form-control" id="inputNameEpisodes" name="episodes" value="{{ old('episodes') }}">
        <label for="inputNameEpisodes" class="form-label">Link</label>
        <input type="text" class="form-control" id="inputNameEpisodes" name="links" value="{{ old('links') }}">
        <input type="hidden" class="form-control" id="inputNameEpisodes" name="movie_id" value="{{request()->route('id')}}">
        <button type="submit" class="btn btn-success">Add Episodes</button>
    </form>
<script>
    $(document).ready(function(){
        $('#formAddEpisodes').validate({
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
