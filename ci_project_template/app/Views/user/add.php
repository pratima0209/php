<?php include(INCLUDESPATH . 'header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Operation</title>
    <link rel="stylesheet" type=text/css href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type=text/css href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">


</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <div class="container-flude">
        <div class="container pb-2 pt-2">
            <div>Crud Operation</div>
        </div>
    </div>
    <div class="bg-white shadwo-sm">
        <div class="container">
            <div class="row">
                <nav class="nav nav-underline">
                    <div class="nav-link">user/view</div>
                </nav>
            </div>
        </div>
    </div>



    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Add Student</div>
                    </div>
                    <div class="card-body">
                        <?php /* <form action="<?=USER_PATH?>submitFormdata" name="Add" method="post">    */ ?>
                        <div class="form-group">
                            <lable>Name</lable>
                            <input type="text" name="name" id="name" onkeyup="nameValidate()" class="form-control" value="">
                            <span id="name_error" style="color:red;"></span>


                        </div>
                        <div class="form-group">
                            <lable>Mobile</lable>
                            <input type="text" name="mobile" id="mobile" onkeyup="mobileValidate()" class="form-control" value="">
                            <span id="mobile_error" style="color:red;"></span>
                        </div>
                        <div class="form-group">
                            <lable>Email</lable>
                            <input type="text" name="email" id="email" onkeyup="emailValidate()" class="form-control" value="">
                            <span id="email_error" style="color:red;"></span>

                        </div>
                        <div class="form-group">
                            <lable>Address</lable>
                            <input type="text" name="address" id="address" class="form-control" value="">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" onclick="submitData()">Submit</button>
                        <!-- </form>                    -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function mobileValidate() {
            var mobile = document.getElementById("mobile").value;
            if (mobile.length < 10 || mobile.length > 10) {
                $('#mobile_error').text("Please enter valid phone number");
            } else {
                $('#mobile_error').text("");
            }
        }



        function nameValidate() {
            var name = document.getElementById("name").value;
            if (name.trim() === '') {
                $('#name_error').text("name is required");
            } else {
                $('#name_error').text("");


            }
        }



        function emailValidate() {
            var email = document.getElementById("email").value;
            if (!isValidEmail(email)) {
                $('#email_error').text("invalid email ");
            } else {
                $('#email_error').text("");


            }
        }







        function submitData() {
            var email = document.getElementById("email").value;
            var mobile = document.getElementById("mobile").value;
            var name = document.getElementById("name").value;
            console.log(mobile.length)
            var address = document.getElementById("address").value;
            if (name.trim() === '') {
                $('#name_error').text("name is required");
            } else
            if (!isValidEmail(email) || email == '') {
                $('#email_error').text("invalid email ");
            } else
            if (mobile.length < 10 || mobile.length > 10) {
                $('#mobile_error').text("Please enter valid phone number");
            } else {
                $('#mobile_error').text("");
                $('#name_error').text("");
                $('#email_error').text("");

                $.ajax({
                    type: "POST",
                    url: "<?= USER_PATH ?>/submitAjaxdata",
                    data: {
                        name: name,
                        email: email,
                        mobile: mobile,
                        address: address,
                    }, // serializes the form's elements.
                    success: function(data) {
                        if (data == '1') {
                            // setTimeout(function() {
                            //     swal.closeModal();
                            // }, 20000);
                            Swal.fire({
                                title: 'Success',
                                text: 'Data added successful!',
                                icon: 'success',
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= USER_PATH ?>";
                                }
                            });
                        } else {

                            window.location.href = "<?= USER_PATH ?>add";
                        }
                    },
                    error: function(data) {

                    }
                });
            }


            //     if(name.trim()===''){
            //         $('#name_error').text("name is required");
            //     }
            //     else
            //     {
            //         $('#name_error').text("");
            //         $.ajax({
            //             type: "POST",
            //             url: "<?= USER_PATH ?>/submitAjaxdata",
            //             data: {
            //                name: name, 
            //                email: email, 
            //                mobile: mobile, 
            //                address: address, 
            //             }, // serializes the form's elements.
            //             success: function(data)
            //             {
            //                 if(data == '1'){
            //                     window.location.href="<?= USER_PATH ?>";
            //                 }else{
            //                     window.location.href="<?= USER_PATH ?>add";
            //                 }
            //             },
            //             error: function(data){

            //             }
            //         });

            // }
            // if (!isValidEmail(email)){
            //     $('#email_error').text("invalid email ");
            // }
            // else
            // {
            //     $('#email_error').text("");

            //     $.ajax({
            //         type: "POST",
            //         url: "<?= USER_PATH ?>/submitAjaxdata",
            //         data: {
            //            name: name, 
            //            email: email, 
            //            mobile: mobile, 
            //            address: address, 
            //         }, // serializes the form's elements.
            //         success: function(data)
            //         {
            //             if(data == '1'){
            //                 window.location.href="<?= USER_PATH ?>";
            //             }else{
            //                 window.location.href="<?= USER_PATH ?>add";
            //             }
            //         },
            //         error: function(data){

            //         }
            //     });

            // }    


        }

        function isValidEmail(email) {
            // Regular expression for email validation
            var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return emailRegex.test(email);
        }
    </script>

</body>

</html>
<?php include(INCLUDESPATH . 'footer.php'); ?>