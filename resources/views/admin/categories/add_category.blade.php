@extends('admin.layout.Master')
@section('content')
    <x-errors/>
    <form class="form" id="formAddCategory" method="post" action="{{url('admin/categories')}}">
        @csrf
        <label for="exampleFormControlInput1" class="form-label">Category</label>
        <input type="text" class="form-control" id="inputNameCategory" name="category" value="{{ old('category') }}">
        <button type="submit" class="btn btn-success">Add Category</button>
    </form>
    <script>
        $(document).ready(function(){
            $('#formAddCategory').validate({
                rules: {
                    category: {
                        required: true,
                        maxlength : 255,
                    },
                },
                messages: {
                    category: {
                        required: "Bạn chưa nhập category",
                        maxlength: "vượt quá max kí tự",
                    },
                },
                errorClass: 'error', // Áp dụng lớp error cho các thông báo lỗi
            });
        });
    </script>
@endsection
