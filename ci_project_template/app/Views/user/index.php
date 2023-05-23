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
            <div class="col-md-12 text-right">
                <a href="<?= USER_PATH ?>add" class="btn btn-primary">add</a>

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
                                <th>college Name
                                <!-- <th>Department Name</th> -->
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
                            <?php foreach ($secondResult as $records) { ?>
                                <tr>
                                    <th><?= $records['id'] ?></th>
                                    <th><?= $records['name'] ?></th>
                                    <th><?= $records['mobile'] ?></th>
                                    <th><?= $records['clg_name'] ?></th>
                                    <?php //<th><?= $records['department_name'] ?></th> 
                                    <th><?= $records['email'] ?></th>
                                    <th><?= $records['address'] ?></th>
                                    <th><a class="btn btn-primary" href="<?= USER_PATH ?>update/<?= $records['id'] ?>">Edit</a></th>
                                    <th><a class="btn btn-danger" onclick="deletedata(<?= $records['id'] ?>)">Delete</a></th>

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
        function deletedata(id) {
            // alert("hello");
            //     if (!$records['id']=="") {
            //     Swal.fire({
            //       icon: 'error',
            //       title: 'Error',
            //       text: 'Invalid ID. Unable to perform delete operation.',
            //     });
            //     return;
            //   }
            Swal.fire({
                icon: 'warning',
                title: 'Delete Data',
                text: 'Are you sure you want to delete the data?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= USER_PATH ?>deleteData",
                        data: {
                            "id": id,

                        }, // serializes the form's elements.
                        success: function(data) {
                            if (data == 1) {
                                // Display a message or show a screen

                                window.location.href = "<?= USER_PATH ?>";
                            } else {

                            }

                        },
                        error: function(data) {

                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Cancelled',
                        text: 'The data delete operation has been cancelled.',
                    });
                }
            });
        }

        // function deleteData() {

        //     Swal.fire({
        //         icon: 'warning',
        //         title: 'Delete Data',
        //         text: 'Are you sure you want to delete the data?',
        //         showCancelButton: true,
        //         confirmButtonText: 'Delete',
        //         cancelButtonText: 'Cancel',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // Perform the delete operation here
        //             deletedata();
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Data Deleted',
        //                 text: 'The data has been successfully deleted.',
        //             });
        //         } else if (result.dismiss === Swal.DismissReason.cancel) {
        //             Swal.fire({
        //                 icon: 'info',
        //                 title: 'Cancelled',
        //                 text: 'The data delete operation has been cancelled.',
        //             });
        //         }
        //     });
        // }
    </script>
</body>

</html>
<?php include(INCLUDESPATH . 'footer.php'); ?>