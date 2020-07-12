/*price range*/

$("#sl2").slider();

var RGBChange = function () {
    $("#RGB").css(
        "background",
        "rgb(" + r.getValue() + "," + g.getValue() + "," + b.getValue() + ")"
    );
};

/*scroll to top*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: "scrollUp", // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: "top", // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: "linear", // Scroll to top easing (see http://easings.net/)
            animation: "fade", // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});
$(document).ready(function () {
    $("#sizeSelector").change(function () {
        const sizeId = $(this).val();
        $.ajax({
            type: "get",
            url: "/get-product-price",
            data: {
                sizeId
            },
            success: function (res) {
                $("#optionPrice").html(`$${res}`);
                $("#price").val(res);
            },
            error: function (err) {
                alert("err", err);
            }
        });
    });
});
$(document).ready(function (params) {
    $(".changeImage").click(function () {
        const image = $(this).attr("src");
        $("#mainImage").attr("src", image);
    });
});
$(document).ready(function () {
    // alert("test");
    $("#registerForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
                // lettersonly: true
            },
            password: {
                required: true,
                minlength: 6
            },
            email: {
                required: true,
                email: true
                // remote: {
                //     url: "/check-email",
                //     data: {
                //         action: "isUserExist"
                //     }
                // }
            }
        },
        messages: {
            name: {
                required: "Please enter your name"
                // lettersonly: "Only letter acceptable"
            },
            password: {
                minlength: "Your password must be at least 6 character",
                required: "Please provide your password"
            },
            email: {
                required: "Enter your email",
                email: "Not a valid email",
                remote: "Email has already existed"
            }
        }
    });

    //test
    $("#loginForm").validate({
        rules: {
            password: {
                required: true,
                minlength: 6
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            password: {
                minlength: "Your password must be at least 6 character",
                required: "Please provide your password"
            },
            email: {
                required: "Enter your email",
                email: "Not a valid email"
            }
        }
    });
});
