import './bootstrap';
import 'jquery-validation';

$(document).ready(function() {
        // $('#formAddMovie').validate({
        //     rules: {
        //         title: {
        //             required: true,
        //         },
        //         image: {
        //             required: true,
        //         },
        //     },
        //     messages: {
        //         title: {
        //             required: "Bạn chưa nhập tiêu đề",
        //         },
        //         image: {
        //             required: "Bạn chưa nhập hình ảnh",
        //         },
        //     },
        //     errorClass: 'error', // Áp dụng lớp error cho các thông báo lỗi
        // });

    // var csrfToken = $("meta[name='csrf-token']").attr("content");
    // // Sử dụng jQuery để bắt sự kiện submit form
    // $("#formAddCountry").submit(function(event) {
    //     // Ngăn chặn hành động mặc định khi submit form
    //     event.preventDefault();

    //     // Lấy giá trị từ các trường nhập liệu
    //     var country = $("#inputNameCountry").val();

    //     // Kiểm tra các trường nhập liệu có rỗng không
    //     if (country === "") {
    //         alert("Vui lòng nhập country.");
    //         return;
    //     }

    //     // Nếu các trường nhập liệu đều hợp lệ, thực hiện submit form
    //     $("#formAddCountry")[0].submit();
    // });
    // $("#formEditCountry").submit(function(event) {
    //     event.preventDefault();
    //     var country = $("#inputNameCountry").val();
    //     if (country === "") {
    //         alert("Vui lòng nhập country.");
    //         return;
    //     }
    //     $("#formEditCountry")[0].submit();
    // });
    // $("#formAddCategory").submit(function(event) {
    //     event.preventDefault();
    //     var category = $("#inputNameCategory").val();
    //     if (category === "") {
    //         alert("Vui lòng nhập category.");
    //         return;
    //     }
    //     $("#formAddCategory")[0].submit();
    // });
    // $("#formEditCategory").submit(function(event) {
    //     event.preventDefault();
    //     var category = $("#inputNameCategory").val();
    //     if (category === "") {
    //         alert("Vui lòng nhập category.");
    //         return;
    //     }
    //     $("#formEditCategory")[0].submit();
    // });
    // $("#formCategoryDetail").submit(function(event) {
    //     event.preventDefault();
    //     var category = $("#inputNameCategory").val();
    //     if (category === "") {
    //         alert("Vui lòng nhập category.");
    //         return;
    //     }
    //     $("#formCategoryDetail")[0].submit();
    // });
    // $("#formAddGenres").submit(function(event) {
    //     event.preventDefault();
    //     var genres = $("#inputNameGenres").val();
    //     if (genres === "") {
    //         alert("Vui lòng nhập genres.");
    //         return;
    //     }
    //     $("#formAddGenres")[0].submit();
    // });
    // $("#formEditGenres").submit(function(event) {
    //     event.preventDefault();
    //     var genres = $("#inputNameGenres").val();
    //     if (genres === "") {
    //         alert("Vui lòng nhập genres.");
    //         return;
    //     }
    //     $("#formEditGenres")[0].submit();
    // });
    // $("#formAddMovie").submit(function(event) {
    //     event.preventDefault();
    //     var fileMovie = $("#fileMovie").val();
    //     var titleMovie = $("#titleMovie").val();
    //     if (fileMovie === "") {
    //         alert("File và title không được trống.");
    //         return;
    //     }
    //     if (titleMovie === "") {
    //         alert("File và title không được trống.");
    //         return;
    //     }
    //     $("#formAddMovie")[0].submit();
    // });
});
