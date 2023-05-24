<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <title>student marks</title>
    <h1>Calculation</h1>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
               
                                <div class="form-group">
                                    <lable> Amount</lable>
                                    <input type="number" name="amt" id="amt" class="form-control" >
                                </div>
                                
                                <div class="form-group">
                                    <lable>GST</lable>
                                    <input type="text" name="gst" id="gst" class="form-control" readonly="">
                                </div>

                                <div class="form-group">
                                    <lable>CGST</lable>
                                    <input type="text" name="cgst" id="cgst" class="form-control" readonly="">
                                </div>
                                
                                <div class="form-group">
                                    <lable>total of gst and cgst:</lable>
                                    <input type="text" name="tot" id="tot" class="form-control" readonly="" >
                                </div>
                              <br>
                                
                            <!-- <button type="submit" class="btn btn-primary" onclick="cal()">Submit</button>-->

                            
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            
    

</body>
<script>
// var amt=$("#a1").val();
// console.log(amt);
// function cal()
// {
$('#amt').keyup(function(){
    var amt=$('#amt').val();
    

      var gst = amt*0.1 ;
      $('#gst').val(gst.toFixed(2));
      var cgst = amt*0.15 ;
      $('#cgst').val(cgst.toFixed(2));
    var tot=gst+cgst;
    $('#tot').val(tot.toFixed(2));

    // $.ajax({
    //                 type: "POST",
    //                 url: "<?= USER_PATH ?>/calculation",
    //                 data: {
    //                     amt:amt,
    //                     gst: gst,
    //                     cgst:cgst,
    //                     tot: tot,
    //                 }, // serializes the form's elements.
    //                 success: function(data) {
    //                     if (data == '1') {
    //                                Swal.fire({
    //                             title: 'Success',
    //                             text: 'Data added successful!',
    //                             icon: 'success',
    //                             confirmButtonText: 'OK',
    //                         }).then((result) => {
    //                             if (result.isConfirmed) {
    //                                 window.location.href = "<?= USER_PATH ?>";
    //                             }
    //                         });
    //                     } else {

    //                         window.location.href = "<?= USER_PATH ?>calculation";
    //                     }
    //                 },
    //                 error: function(data) {

    //                 }
    //             });
    //         }

    }
)


        

         
</script>
</html>