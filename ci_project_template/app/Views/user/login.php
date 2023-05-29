<?php include(INCLUDESPATH . 'header.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <title>Calculate</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h4>Login</h4>
        <hr>
        <div class="form-group">
          <label for="user name">User Name</label>
          <input type="text" class="form-control" id="uname" placeholder="username">
        </div>
             

        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" class="form-control" id="password" placeholder="password">
        </div>
        <button type="submit" class="btn btn-primary mt-3" onclick="logindata()" >Submit</button>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

</body>
</html>
<script>
  function logindata(){
    var uname = $('#uname').val();
    var password = $('#password').val();
    $.ajax({
            dataType: "json",
            type: 'POST',
      
            url: "<?= USER_PATH ?>/loginAjaxdata",
                    data: JSON.stringify({
                        'uname': uname,
                        'password': password,
                         }), // serializes the form's elements.
                    success: function(data) {
                      console.log(data);
                        if (data == '1') {
                                 Swal.fire({
                                title: 'Success',
                                text: 'Data added successful!',
                                icon: 'success',
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // window.location.href = "<?= USER_PATH ?>";
                                }
                            });
                        } else {

                            // window.location.href = "<?= USER_PATH ?>login";
                        }
                    },
                    error: function(data) {

                    }
                });
            }



  
</script>
<?php include(INCLUDESPATH . 'footer.php'); ?>
