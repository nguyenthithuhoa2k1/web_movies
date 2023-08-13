@extends('admin.layout.Master')
@section('content')
    <x-errors/>
    <form id="formAddCountry" class="mb-3 form" method="post" action="{{url('admin/countries')}}">
        @csrf
        <label for="inputNameCountry" class="form-label">Country</label>
        <input type="text" class="form-control" id="inputNameCountry" value="{{ old('country') }}" name="country">
        <button type="submit" class="btn btn-success">Add country</button>
    </form>
<script>
    $(document).ready(function(){
        $('#formAddCountry').validate({
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
