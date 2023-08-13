@extends('admin.layout.Master')
@section('content')
    <x-errors/>
    @foreach($dataGenres as $genres)
    <form id="formEditGenres" class="mb-3 form" method="post" action="{{url('admin/genres/'.$genres->id)}}">
        @csrf
        @method('PUT')
        <label for="exampleFormControlInput1" class="form-label">Genres</label>
        <input type="text" class="form-control" id="inputNameGenres" name="genres" value="{{ old('genres',$genres->genres) }}">
        <input type="hidden" class="form-control" id="inputNameGenres" name="version" value="{{$genres->version}}">
        <button type="submit" class="btn btn-success">Edit genres</button>
    </form>
    @endforeach
<script>
    $(document).ready(function(){
        $('#formEditGenres').validate({
            rules: {
                genres: {
                    required: true,
                    maxlength : 255,
                },
            },
            messages: {
                genres: {
                    required: "Bạn chưa nhập genres",
                    maxlength: "vượt quá max kí tự",
                },
            },
            errorClass: 'error', // Áp dụng lớp error cho các thông báo lỗi
        });
    });
</script>
@endsection
