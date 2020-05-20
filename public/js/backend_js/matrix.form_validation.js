$(document).ready(function () {
    $("#new_password").click(() => {
        const currentPassword = $("#current_password").val();
        // console.log({ currentPassword });
        $.ajax({
            type: "get",
            url: "/admin/check-password",
            data: { currentPassword: currentPassword },
            success: res => {
                if (res == "false") {
                    $("#pwd_check").html("<font color='red'> Current password is incorrect</font>");
                } else {
                    $("#pwd_check").html("<font color='green'>Updated  successfully</font>");
                }
            },
            error: error => {
                alert("error", error);
            }
        });
    });

    $("input[type=checkbox],input[type=radio],input[type=file]").uniform();

    $("select").select2();

    // Form Validation
    $("#basic_validate").validate({
        rules: {
            required: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            date: {
                required: true,
                date: true
            },
            url: {
                required: true,
                url: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").addClass("error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").removeClass("error");
            $(element).parents(".control-group").addClass("success");
        }
    });
    // Add Category Validation
    $("#add_category").validate({
        rules: {
            category_name: {
                required: true
            },
            description: {
                required: true
            },
            url: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").addClass("error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").removeClass("error");
            $(element).parents(".control-group").addClass("success");
        }
    });
    // Edit Category Validation
    $("#edit_category").validate({
        rules: {
            category_name: {
                required: true
            },
            description: {
                required: true
            },
            url: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").addClass("error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").removeClass("error");
            $(element).parents(".control-group").addClass("success");
        }
    });
    // Add Product Validation
    $("#add_product").validate({
        rules: {
            category_id: {
                required: true
            },

            product_name: {
                required: true
            },
            product_code: {
                required: true
            },
            product_color: {
                required: true
            },
            price: {
                required: true,
                number: true
            },
            image: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").addClass("error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").removeClass("error");
            $(element).parents(".control-group").addClass("success");
        }
    });
    // edit Product Validation
    $("#edit_product").validate({
        rules: {
            category_id: {
                required: true
            },

            product_name: {
                required: true
            },
            product_code: {
                required: true
            },
            product_color: {
                required: true
            },
            price: {
                required: true,
                number: true
            },
            image: {
                // required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").addClass("error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").removeClass("error");
            $(element).parents(".control-group").addClass("success");
        }
    });
    $("#number_validate").validate({
        rules: {
            min: {
                required: true,
                min: 10
            },
            max: {
                required: true,
                max: 24
            },
            number: {
                required: true,
                number: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").addClass("error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").removeClass("error");
            $(element).parents(".control-group").addClass("success");
        }
    });

    $("#password_validate").validate({
        rules: {
            current_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirm_password: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_password"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").addClass("error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".control-group").removeClass("error");
            $(element).parents(".control-group").addClass("success");
        }
    });
    $(".btn_delete_cat").click(function () {
        const id = $(this).attr("rel");
        const deleteFunction = $(this).attr("rel1");
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record again!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: false,
                    className: "",
                    closeModal: true,
                    visible: true
                },
                confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }

                // className: "btn-danger"
            }
        }).then(function (confirm) {
            if (confirm) {
                window.location.href = "/admin/" + deleteFunction + "/" + id;
            }
        });
    });
    // $(".btn_delete_prod").click(function () {
    //     if (confirm("Are you sure to delete this product")) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // });

    $(".btn_delete_prod").click(function (e) {
        const id = $(this).attr("rel");
        const deleteFunction = $(this).attr("rel1");
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record again!",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: "Yes"
                // className: "btn-danger"
            }
        }).then(function (confirm) {
            if (confirm) {
                console.log({ confirm });
                window.location.href = "/admin/" + deleteFunction + "/" + id;
            }
        });
    });

    $(document).ready(function () {
        var maxField = 10; //Input fields increment limitation
        var addButton = $(".add_button"); //Add button selector
        var wrapper = $(".field_wrapper"); //Input field wrapper
        var fieldHTML = `
            <div style="margin-left:180px;">
                <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px; margin:5px 0px 0 0;" />
                <input type="text" name="size[]" id="size" placeholder="Size" style="width: 120px; margin:5px 0px 0 0;" />
                <input type="text" name="price[]" id="price" placeholder="Price" style="width: 120px; margin:5px 0px 0 0;" />
                <input type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px; margin:5px 0px 0 0;" />
                
                <a href="javascript:void(0);" class="remove_button">Remove</a>
            </div>
            `; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function () {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on("click", ".remove_button", function (e) {
            e.preventDefault();
            $(this).parent("div").remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
});
