$(document).ready(function () {
    save_record();
    save_user_record();
    login_user_record();
    // add_cart();
})

// save record fun
function save_record() {
    $(document).on('click', '#btn_cnt', function () {
        var name = $('#name').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var msg = $('#msg').val();


        if (name == "" || email == "" || subject == "" || msg == "") {
            $('#error_msg').html('Please Fill in the Blanks');
        } else {
            $.ajax(
                {
                    url: 'ajax/cnt.php',
                    method: 'post',
                    data: { Name: name, Email: email, Subject: subject, Msg: msg },
                    success: function (data) {
                        $('#success_msg').html(data);
                        $('form').trigger('reset');
                        $('#error_msg').html('');

                    }
                }
            )
        }
    })
}

function isValidEmail(email) {
    // Sử dụng biểu thức chính quy để kiểm tra định dạng email
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

// save user record fun
function save_user_record() {
    $(document).on('click', '#btn_register', function () {
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();

        if (name == "" || email == "" || password == "" || cpassword == "") {
            $('#error').html('Please Fill in the Blanks');
            return;
        }

        if (!isValidEmail(email)) {
            $('#error').html('Invalid Email Format');
            return;
        }

        if (password != cpassword) {
            $('#error').html('Password Not Matched');
            return;
        } else {
            $.ajax(
                {
                    url: 'ajax/user_register.php',
                    method: 'post',
                    data: { Name: name, Email: email, Password: password, Cpassword: cpassword },
                    success: function (data) {
                        $('#success').html(data);
                        $('form').trigger('reset');
                        $('#error').html('');
                    }
                }
            )
        }
    })
}


// login user record fun
function login_user_record() {
    $(document).on('click', '#btn_login', function () {
        var email = $('#email').val();
        var password = $('#password').val();
        if (email == "" || password == "") {
            $('#error').html('Please Fill in the Blanks');
        }
        else {
            $.ajax(
                {
                    url: 'ajax/login_user.php',
                    method: 'post',
                    data: { Email: email, Password: password },
                    success: function (data) {

                        if (data == "Valid") {
                            $('form').trigger('reset');
                            $('#error').html('');
                            window.location.href = 'index.php';
                        }

                        if (data == "Invalid") {
                            $('#error').html('Please check the password or username!');
                        }
                    }
                }
            )
        }

    })
}

// add cart
// function add_cart() {
//     $(document).on('click', '.site-btn', function () {
//         var qty = $('#qty').val();
//         var pid = $('#p_id').val();

//         $.ajax({
//             url: 'ajax/manage_cart.php',
//             method: 'post',
//             data: { Qty: qty, P_ID: pid, type:'add'},
//             success: function (data) {

//                 $('#cart_counter').html(data);

//             }
//         })
//     })
// }


//update qty
function update_qty_product_cart() {
    $(document).on('click', '', function () {
        alert('working');
        // var email = $('#email').val();
        // var password = $('#password').val();
        // if (email == "" || password == "") {
        //     $('#error').html('Please Fill in the Blanks');
        // }
        // else {
        //     $.ajax(
        //         {
        //             url: 'ajax/login_user.php',
        //             method: 'post',
        //             data: { Email: email, Password: password },
        //             success: function (data) {

        //                 if (data == 'Valid') {
        //                     $('form').trigger('reset');
        //                     $('#error').html('');
        //                     window.location.href = 'index.php';
        //                 }

        //                 if (data == 'Invalid') {
        //                     $('#error').html('Please Enter Correct Password');

        //                 }
        //             }
        //         }
        //     )
        // }

    })
}


function toggleUserDropdown() {
    var userDropdown = document.getElementById('userDropdown');
    if (userDropdown.style.display === 'none' || userDropdown.style.display === '') {
        userDropdown.style.display = 'block';
    } else {
        userDropdown.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    var userDropdownToggle = document.getElementById('userDropdownToggle');
    if (userDropdownToggle) {
        userDropdownToggle.addEventListener('click', function (e) {
            e.preventDefault();
            toggleUserDropdown();
        });
    }
});
