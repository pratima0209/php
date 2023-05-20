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
            <div class="col-md-12 text-right">
                <a href="<?= USER_PATH?>add" class="btn btn-primary">add</a>

            </div>
        </div>
    </div>



    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Student</div>
                    </div>
                
                    <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        <!-- <tr>
                            <th>1</th>
                            <th>Pratima</th>
                            <th>978963</th>
                            <th>pratima@gmail.com</th>
                            <th>Pune</th>
                            <th><a class="btn btn-warning" href="#">Edit</a></th>
                        </tr> -->
                        <?php foreach($secondResult as $records) { ?>
                        <tr>
                            <th><?= $records['id'] ?></th>
                            <th><?= $records['name'] ?></th>
                            <th><?= $records['mobile'] ?></th>
                            <th><?= $records['email'] ?></th>
                            <th><?= $records['address'] ?></th>
                            <th><a class="btn btn-primary" href="<?= USER_PATH?>update/<?= $records['id'] ?>">Edit</a></th>
                            <th><a class="btn btn-danger" href="<?= USER_PATH?>delete/<?= $records['id'] ?>">Delete</a></th>

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
                        </td> -->
    
</body>
</html>
<?php include(INCLUDESPATH . 'footer.php'); ?>