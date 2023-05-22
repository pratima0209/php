<?php include(INCLUDESPATH . 'header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Operation</title>
    <link rel="stylesheet" type=text/css href="<?php echo base_url('assets/css/bootstrap.min.css');?>"> 
    <link rel="stylesheet" type=text/css href="<?php echo base_url ('assets/css/style.css');?>"> 


</head>
<body>
    <div class ="container-flude">
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
                        <div class="card-header-title">update Student</div>
                    </div>
                    <div class="card-body">
                    <?php /* <form action="<?=USER_PATH?>submitFormdata" name="Add" method="post">    */?>
                    <div class="form-group">
                        <lable>Name</lable>
                        <input type="text" name="name" id="name"  class="form-control"  onkeyup="nameValidate()" value="<?=$results['name']?>">
                        <span id="name_error" style="color:red;"></span>

                        <input type="text" id="id" name="id" hidden value="<?=$results['id']?>">
                    
                    </div>   
                    <div class="form-group">
                        <lable>Mobile</lable>
                        <input type="text" name="mobile" id="mobile" onkeyup="mobileValidate()" class="form-control" value="<?=$results['mobile']?>">
                        <span id="mobile_error" style="color:red;"></span>

                    </div>   
                    <div class="form-group">
                        <lable>Email</lable>
                        <input type="text" name="email" id="email" onkeyup="emailValidate()" class="form-control" value="<?=$results['email']?>">
                        <span id="email_error" style="color:red;"></span>


                    </div>   
                    <div class="form-group">
                        <lable>Address</lable>
                        <input type="text" name="address" id="address" class="form-control" value="<?=$results['address']?>">
                    </div>   
                    <br>
                    <button type="submit" class="btn btn-primary" onclick="showUpdateAlert()" >Update</button>
                    <!-- </form>                    -->
                       </div>
            
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

        <script>



        function mobileValidate(){  
            var mobile = document.getElementById("mobile").value;
            if(mobile.length < 10 || mobile.length > 10){
                $('#mobile_error').text("Please enter valid phone number");
            }else{
                $('#mobile_error').text("");
            }
        }


                 -
        function nameValidate(){
            var name = document.getElementById("name").value;
            if(name.trim()===''){
                $('#name_error').text("name is required");
            }
            else
            {
                $('#name_error').text("");


            }    
        }


         
        function emailValidate(){
            var email = document.getElementById("email").value;
            if (!isValidEmail(email)){
                $('#email_error').text("invalid email ");
            }
            else
            {
                $('#email_error').text("");


            }    
        }

        









            function updateData(){
                //console.log("hii");
                var email = document.getElementById("email").value;
                var mobile = document.getElementById("mobile").value;
                var name = document.getElementById("name").value;
                var address = document.getElementById("address").value;
                var id = document.getElementById("id").value;
                

                if(name.trim()===''){
                $('#name_error').text("name is required");
            }else
            if (!isValidEmail(email) || email=='' ){
                $('#email_error').text("invalid email ");
            }else
            if(mobile.length < 10 || mobile.length > 10){
                $('#mobile_error').text("Please enter valid phone number");
            }else{
                    $('#mobile_error').text("");
                    $('#name_error').text("");
                    $('#email_error').text("");
                    $.ajax({
                    type: "POST",
                    url: "<?= USER_PATH ?>updateAjaxdata",
                    data: {
                       id: id, 
                       name: name, 
                       email: email, 
                       mobile: mobile, 
                       address: address, 
                    }, // serializes the form's elements.
                    success: function(data)
                    {
                        if(data == '1'){
                         
                            window.location.href="<?= USER_PATH ?>";
                        }else{
                            window.location.reload();
                          
                        }
                    },
                    error: function(data){
    
                    }
                });
            }

                
        }
        function isValidEmail(email) {
                 // Regular expression for email validation
            var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return emailRegex.test(email);
        }

function showUpdateAlert() {

    console.log("Working")
  Swal.fire({
    icon: 'info',
    title: 'Update Data',
    text: 'Are you sure you want to update the data?',
    showCancelButton: true,
    confirmButtonText: 'Update',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      // Perform the update operation here
      updateData()
      Swal.fire({
        icon: 'success',
        title: 'Data Updated',
        text: 'The data has been successfully updated.',
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
        
      Swal.fire({
        icon: 'warning',
        title: 'Cancelled',
        text: 'The data update operation has been cancelled.',
      });
      window.location.href="<?= USER_PATH ?>";
    }
  });
}

        

</script>


    
</body>
</html>
<?php include(INCLUDESPATH . 'footer.php'); ?>