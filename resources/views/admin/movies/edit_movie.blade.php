@extends('admin.layout.Master')
@section('content')
    <x-errors/>
    @foreach($dataMovie as $movie)
    <form class="mb-3 form" id="formEditMovie" method="post" enctype="multipart/form-data" action="{{url('admin/movies/'.$movie->id)}}">
        @csrf
        @method('PUT')
        <h1>Edit Movies</h1>
        <div class="hide" id="editImage">
            <label for="exampleFormControlInput1" class="form-label">Image</label>
            <input type="file" class="form-control" id="exampleFormControlInput1" name="image">
        </div>
        <img id="image" src="{{asset('storage/upload/movies_image/'.$movie->image)}}" alt="" width='50px' height='50px'>
        <span id="btnEditImage">Edit image</span>
        <div>
            <label for="exampleFormControlInput2" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput2" name="title" value="{{ old('title', $movie->title) }}">
        </div>
        <label for="exampleFormControlTextarea1" class="form-label">Descriptions</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descriptions">{{ old('descriptions', $movie->descriptions) }}</textarea>
        <label for="exampleFormControlInput3" class="form-label">Status</label>
        <input type="text" class="form-control" id="exampleFormControlInput3" name="status" value="{{ old('status', $movie->status) }}">
        <label for="exampleFormControlInput4" class="form-label">Country</label>
        <select name="country_id" id="" class="form-control" id="exampleFormControlInput4">
            <option value="">vui lòng chọn country</option>
            <?php
                $dataCountry = \App\Helpers\MyHelper::getAllCountries();
            ?>
            @foreach($dataCountry as $country)
                @if($country->id == $movie->country_id)
                    <option value="{{$country->id}}" selected>{{$country->country}}</option>
                @else
                    <option value="{{$country->id}}" >{{ $country->country}}</option>
                @endif
            @endforeach
        </select>
        <label for="exampleFormControlInput5" class="form-label">Genres</label>
        <select name="genres_id" id="" class="form-control" id="exampleFormControlInput5">
            <option value="">vui lòng chọn genres</option>
            <?php
                $dataGenres = \App\Helpers\MyHelper::getAllGenres();
            ?>
            @foreach($dataGenres as $genres)
                @if($genres->id == $movie->genres_id)
                    <option value="{{$genres->id}}" selected>{{$genres->genres}}</option>
                @else
                    <option value="{{$genres->id}}" >{{$genres->genres}}</option>
                @endif
            @endforeach
        </select>
        <label for="exampleFormControlInput6" class="form-label">Category</label>
        <select name="category_id" id="" class="form-control" id="exampleFormControlInput6">
            <option value="">vui lòng chọn category</option>
            <?php
                $dataCategory = \App\Helpers\MyHelper::getAllCategories();
            ?>
            @foreach($dataCategory as $category)
                @if($category->id == $movie->category_id)
                    <option value="{{$category->id}}" selected>{{$category->category}}</option>
                @else
                    <option value="{{$category->id}}" >{{$category->category}}</option>
                @endif
            @endforeach
        </select>
        <label for="exampleFormControlInput7" class="form-label">Perfomer</label>
        <input type="text" class="form-control" id="exampleFormControlInput7" name="perfomer" value="{{ old('perfomer', $movie->perfomer) }}">
        <label for="exampleFormControlInput8" class="form-label">Year</label>
        <input type="text" class="form-control" id="exampleFormControlInput8" name="year" value="{{ old('year', $movie->year) }}">
        <span class="error-message"></span>
        <input type="hidden" class="form-control" id="exampleFormControlInput9" name="version" value="{{$movie->version}}">
        <button class="btn btn-success" stype="submit">Edit Movie</button>
    </form>
    @endforeach
    <script>
        $(document).ready(function(){
            $('#formEditMovie').validate({
                rules: {
                    title: {
                        required: true,
                        maxlength : 255,
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
                    year:{
                        digits: "Vui lòng nhập một số nguyên",
                    }
                },
                errorClass: 'error', // Áp dụng lớp error cho các thông báo lỗi
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $('#btnEditImage').hover(function(){
                $('#btnEditImage').css("color","blue");
            }, function() {
                $('#btnEditImage').css("color","black");
            });

            $('#btnEditImage').click(function(){
                $('#editImage').removeClass('hide');
                $('#btnEditImage').addClass('hide');
            });
            $('#image').click(function(){
                $('#editImage').addClass('hide');
                $('#btnEditImage').removeClass('hide');
            });
        });
    </script>
@endsection
