@extends('admin.layout.Master')
@section('content')
   <x-errors/>
    <form id="formAddGenres" class="form" method="POST" action="{{url('admin/genres')}}">
        @csrf
        <label for="exampleFormControlInput1" class="form-label">Genres</label>
        <input type="text" class="form-control name" id="inputNameGenres" name="genres" value="{{ old('genres') }}">
        <button type="submit" class="btn btn-success">Add Genres</button>
    </form>
<script>
    $(document).ready(function(){
        $('#formAddGenres').validate({
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
