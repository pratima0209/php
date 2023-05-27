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


</head>

<body>
   

   


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Calculation</div>
                    </div>

                    <div class="card-body">
                       
                        <table class="table table-striped">
                            <tr>
                                <th>Discount</th> 
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Sub Total</th>
                                <th>Gtotal</th>
                                
                            </tr>
                           
                            <?php foreach ($second as $records) { ?>
                                <tr>
                                    <th></th> 
                                    <th><?= $records['product'] ?></th>
                                    <th></th> 
                                    <th><?= $records['price'] ?></th>
                                    

                                   
                                </tr>

                            <?php } ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- <td>
                            <a href="" class="btn btn-primary btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm">Delete</a>
                            <script>                        </td> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <script>
       
            </script>
</body>

</html>
<?php include(INCLUDESPATH . 'footer.php'); ?>