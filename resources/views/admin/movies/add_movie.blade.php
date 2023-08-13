@extends('admin.layout.Master')
@section('content')
    <x-errors/>
    <form id="formAddMovie" class="form" method="post" action="{{url('/admin/movies')}}" enctype="multipart/form-data">
        @csrf
        <h1>Add Movies</h1>
        <div>
            <label for="exampleFormControlInput1" class="form-label">Image</label>
            <input type="file" class="form-control" id="fileMovie" name="image">
        </div>
        <div>
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="titleMovie" name="title" value="{{ old('title') }}">
        </div>
        <label for="exampleFormControlTextarea1" class="form-label">Descriptions</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descriptions">{{ old('descriptions') }}</textarea>
        <label for="exampleFormControlInput1" class="form-label">Status</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="status" {{ old('status') }}>
        <label for="exampleFormControlInput1" class="form-label">Country</label>
        <select name="country_id" id="" class="form-control" id="exampleFormControlInput1">
            <option value="">vui lòng chọn country</option>
            <?php
                $dataCountry = \App\Helpers\MyHelper::getAllCountries();
            ?>
            @foreach($dataCountry as $country)
            <option value="{{$country->id}}">{{$country->country}}</option>
            @endforeach
        </select>
        <label for="exampleFormControlInput1" class="form-label">Genres</label>
        <select name="genres_id" id="" class="form-control" id="exampleFormControlInput1">
            <option value="">vui lòng chọn genres</option>
            <?php
                $dataGenres = \App\Helpers\MyHelper::getAllGenres();
            ?>
            @foreach($dataGenres as $genres)
            <option value="{{$genres->id}}">{{$genres->genres}}</option>
            @endforeach
        </select>
        <label for="exampleFormControlInput1" class="form-label">Category</label>
        <select name="category_id" id="" class="form-control" id="exampleFormControlInput1">
            <option value="">vui lòng chọn category</option>
            <?php
                $dataCategory = \App\Helpers\MyHelper::getAllCategories();
            ?>
            @foreach($dataCategory as $category)
            <option value="{{$category->id}}">{{$category->category}}</option>
            @endforeach
        </select>
        <label for="exampleFormControlInput1" class="form-label">Performers</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="perfomer" {{ old('perfomer') }}>
        <label for="exampleFormControlInput1" class="form-label">Year</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="year" {{ old('year') }}>
        <button class="btn btn-success" stype="submit">Add Movie</button>
    </form>
    <script>
        $(document).ready(function(){
            $('#formAddMovie').validate({
                rules: {
                    title: {
                        required: true,
                        maxlength : 255,
                    },
                    image: {
                        required: true,
                    },
                    year: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    title: {
                        required: "Bạn chưa nhập tiêu đề",
                        maxlength: "vượt quá max kí tự",
                    },
                    image: {
                        required: "Bạn chưa nhập hình ảnh",
                    },
                    year:{
                        digits: "Vui lòng nhập một số nguyên",
                    }
                },
                errorClass: 'error', // Áp dụng lớp error cho các thông báo lỗi
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
