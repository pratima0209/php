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
                        <div class="card-header-title">Add Student</div>
                    </div>
                    <div class="card-body">
                    <?php /* <form action="<?=USER_PATH?>submitFormdata" name="Add" method="post">    */?>
                    <div class="form-group">
                        <lable>Name</lable>
                        <input type="text" name="name" id="name" class="form-control <?php echo (isset($validation)&& $validation->hasError('name'))  ? 'is-invalid':'';?>" value="">
                        <?php
                        if (isset($validation) && $validation->hasError('name')){
                            echo $validation->getError('name');
                        }
                        ?>
                    
                    </div>   
                    <div class="form-group">
                        <lable>Mobile</lable>
                        <input type="text" name="mobile" id="mobile" class="form-control" value="">
                    </div>   
                    <div class="form-group">
                        <lable>Email</lable>
                        <input type="text" name="email" id="email" class="form-control" value="">
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

        function submitData(){
            var email = document.getElementById("email").value;
            var mobile = document.getElementById("mobile").value;
            var name = document.getElementById("name").value;
            var address = document.getElementById("address").value;


            $.ajax({
                type: "POST",
                url: "<?= USER_PATH ?>/submitAjaxdata",
                data: {
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
                        window.location.href="<?= USER_PATH ?>add";
                    }
                },
                error: function(data){

                }
            });
        }
        // $("#idForm").onclick(function(e) {

        //     e.preventDefault(); // avoid to execute the actual submit of the form.

        //     var form = $(this);
        //     var actionUrl = form.attr('action');

        //     $.ajax({
        //         type: "POST",
        //         url: /add,
        //         data: form.serialize(), // serializes the form's elements.
        //         success: function(data)
        //         {
        //         alert(data); // show response from the php script.
        //         }
        //     });

        //     });
    </script>
    
</body>
</html>
<?php include(INCLUDESPATH . 'footer.php'); ?>