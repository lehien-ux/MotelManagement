$(document).ready(() => {
    $('#images').on("change", previewImages)

    function previewImages() {
        let $preview = $('#preview').empty();
        if (this.files) $.each(this.files, readAndPreview);

        function readAndPreview(i, file) {
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " is not an image");
            } // else...
            let reader = new FileReader();
            $(reader).on("load", function () {
                $preview.append($("<img/>", {src: this.result, height: 100}));
            });
            reader.readAsDataURL(file);
        }
    }

    $(".delete-image").click(function () {
        let result = confirm("Bạn chắc chắn muốn xóa?");
        if (result) {
            $.ajax({
                url: window.location.origin + "/admin/room/images/" + $(this).attr("data-id"),
                type: "GET",
                success: () => {
                    $(this).parent().remove()
                }
            })
        }

        return;
    })

    $("#room-update-images").on("change", function () {
        if (this.files) $.each(this.files, readAndPreview);
        $(".show-new-image").css("display", "block");

        function readAndPreview(i, file) {
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " is not an image");
            } // else...
            let reader = new FileReader();
            $(reader).on("load", function () {
                $('.new-room-images').append($("<img/>", {src: this.result, height: 120, width: 120}));
            });
            reader.readAsDataURL(file);
        }
    })

    $("#room_id").change(function () {
        $.ajax({
            url: "/admin/bills/rooms/" + $(this).val(),
            method: "get",
            success: (response) => {
                $("#room-price").empty();
                $("#room-price").append(response.room.price.toLocaleString() + 'vnd');
                $("#room_price").val(response.room.price);
                $("#customer-label").empty();
                $("#customer-label").append(response.customer.name);
                $(".bill-customer-id").val(response.customer.id);
            },
            error: (xhr, ajaxOptions, thrownError) => {
                alert("Lỗi");
            }
        });

        $.ajax({
            url: "/admin/bills/service-use/room/" + $(this).val(),
            method: "get",
            success: (response) => {
                $.each(response.services, function (index, service) {
                    $("input[name='" + service.id + "']").removeAttr("disabled");
                })
            },
            error: (xhr, ajaxOptions, thrownError) => {
                alert("Lỗi");
            }
        })
    });

    $("#room_id").select2();
    $("#customer-id").select2();
    $("#search-room-id").select2();

    let date = new Date();
    $("#month > option").each(function () {
        if ($(this).val() == date.getMonth()) {
            $(this).attr('selected', 'selected');
        }
    });

    $("#computed-bill").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            url: "/admin/bills/computed/",
            method: "post",
            data: $("#bills-form").serialize(),
            success: (response) => {
                $("#total-price").val(response);
                $(".total-price").empty();
                $(".total-price").append(parseInt(response).toLocaleString() + "vnd");
                $(".create-bill-btn").css("display", "block");
            },
            error: (xhr, ajaxOptions, thrownError) => {
                alert("Đã có lỗi xảy ra hãy nhập các trường");
            }
        })
    });

    // if ($("#total-price").val().length === 0) {
    //     $(".create-bill-btn").css("display", "none");
    // }
    // $(".services").keyup(function (e) {
    //     computed(e);
    // });
    //
    // function computed(e) {
    //     let total = 0;
    //     if (!$("#room_price").val()) {
    //         alert("hãy chọn phòng");
    //         return false;
    //     }
    //
    //     $(".services").each(function () {
    //         total += $(this).val() * $(this).attr("data-price");
    //     });
    //
    //     $(".check-service").each(function () {
    //         if ($(this).is(":checked")) {
    //             total += parseInt($(this).attr("data-price"));
    //         }
    //     });
    //
    //     total += parseInt($("#room_price").val());
    //     $("#total-price").val(total);
    //     $(".total-price").empty();
    //     $(".total-price").append(parseInt(total).toLocaleString() + "vnd");
    // }
    //
    // $(".check-service").click(function (e) {
    //     computed();
    // });
})
