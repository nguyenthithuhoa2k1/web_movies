@extends('admin.layout.Master')
@section('content')
    <x-errors/>
    <h1>Edit Category</h1>
    @foreach($dataCategory as $category)
    <form id="formEditCategory" class="form" method="post" action="{{url('admin/categories/'.$category->id)}}">
        @csrf
        @method('PUT')
        <label for="exampleFormControlInput1" class="form-label">Category</label>
        <input type="hidden" name="version" value="{{$category->version}}">
        <input type="text" class="form-control" id="inputNameCategory" name="category" value="{{ old('category', $category->category) }}">
        <button type="submit" class="btn btn-success">Edit Category</button>
    </form>
    @endforeach
    <script>
        $(document).ready(function(){
            $('#formEditCategory').validate({
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
