@extends('admin.layout.Master')
@section('content')
    <x-errors/>
    @foreach($dataCountry as $country)
    <form id="formEditCountry"  class="mb-3 country form" method="post" action="{{url('admin/countries/'.$country->id)}}">
        @csrf
        @method('PUT')
        <label for="exampleFormControlInput1" class="form-label">Country</label>
        <input type="text" class="form-control" id="inputNameCountry" name="country" value="{{ old('country', $country->country) }}">
        <input type="hidden" class="form-control" id="inputNameCountry" name="version" value="{{$country->version}}">
        <button type="submit" class="btn btn-success">Edit country</button>
    </form>
    @endforeach
<script>
    $(document).ready(function(){
        $('#formEditCountry').validate({
            rules: {
                country: {
                    required: true,
                    maxlength : 255,
                },
            },
            messages: {
                country: {
                    required: "Bạn chưa nhập Country",
                    maxlength: "vượt quá max kí tự",
                },
            },
            errorClass: 'error', // Áp dụng lớp error cho các thông báo lỗi
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endsection
