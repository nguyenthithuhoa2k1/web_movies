@extends('frontend.layout.Master')
@section('content')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="movie-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                    <x-errors/>
                                    <form id="registerMember" class="mx-1 mx-md-4" method="post" action="{{url('member/register')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Your Name</label>
                                                <input type="text" id="form3Example1c" class="form-control" name="name"/>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Image</label>
                                                <input type="file" id="form3Example1c" class="form-control" name="image"/>
                                                <input type="hidden" id="form3Example1c" class="form-control" name="image_default" value="avatar-default.jpg"/>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Your Email</label>
                                                <input type="email" id="form3Example3c" class="form-control" name="email"/>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Password</label>
                                                <input type="password" id="form3Example4c" class="form-control" name="password"/>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex justify-content-evenly mb-5">
                                            <label class="form-check-label" for="form2Example3">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" name="remember_me"/>
                                            remember <a href="#!">Terms of service</a>
                                            </label>
                                            <a href="{{url('member/login')}}">Login</a>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $('form#registerMember').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength : 20,
                    },
                    image: {
                        required: true,
                    },
                    email: {
                        required: true,
                        maxlength : 20,
                        email: true,
                    },
                    password: {
                        required: true,
                        maxlength : 20,
                    },
                },
                messages: {
                    name: {
                        required: "Bạn chưa nhập name.",
                        maxlength: "vượt quá max kí tự.",
                    },
                    image: {
                        required: "Bạn chưa nhập image.",
                        maxlength: "vượt quá max kí tự.",
                    },
                    email: {
                        required: "Bạn chưa nhập email.",
                        maxlength: "vượt quá max kí tự.",
                        email: "Vui lòng nhập một địa chỉ email hợp lệ.",
                    },
                    password: {
                        required: "Bạn chưa nhập password.",
                        maxlength: "vượt quá max kí tự.",
                    },
                },
                errorClass: 'error',
            });
        });
    </script>
@endsection
