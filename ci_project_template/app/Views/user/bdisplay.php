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
                    <label for="">Discount</label>
                    <input type="text" id="discount" onkeyup="fetchSubtotal()" placeholder="Enter discount">

                    <div class="card-body">
                       
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                                
                            </tr>
                           
                            <?php foreach ($second as $records) { ?>
                                <tr> 
                                    <th><?= $records['id'] ?></th>
                                    <th><?= $records['product'] ?></th>
                                    <th><input type="text" onkeyup="fetchItemtotal(<?= $records['id'] ?>)" id="quantity<?= $records['id'] ?>" name ="quantity<?= $records['id'] ?>" placeholder="Enter quantity"></th> 
                                    <th id="price<?= $records['id'] ?>"><?= $records['price'] ?></th>
                                    <th><input type="text" id="sub_total<?= $records['id'] ?>" readonly name="sub_total<?= $records['id'] ?>"></th>
                                </tr>

                            <?php } ?>
                        </table>
                    </div>
                    <label for="" >Grand Total</label>
                    <input type="text" id="grand_total" readonly>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mt-3" onclick="productdata()">Submit</button>


                </div>
            </div>
        </div>
    </div>
    <!-- <td>
                            <a href="" class="btn btn-primary btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm">Delete</a>
                            <script>                        </td> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

  
</body>

</html>

<script>
    function fetchSubtotal(){
        var discount = $('#discount').val();
        
        var itemArray = <?php echo json_encode($second); ?>;
        var total = 0;
        for (let i = 0; i < itemArray.length; i++) {
        var price = $('#price' + itemArray[i].id).text();
        var quantity = $('#quantity' + itemArray[i].id).val();
        var subtotal = (parseInt(price) * parseInt(quantity)) - (parseInt(price) * parseInt(quantity) * (parseInt(discount) / 100));
        $('#sub_total' + itemArray[i].id).val(parseInt(subtotal));
        total += subtotal;
    }
    $('#grand_total').val(total);

    }

    function fetchItemtotal(id){
        var discount = $('#discount').val();
        var price = $('#price' + id).text();
        var quantity = $('#quantity' + id).val();
        var subtotal = 0;
        subtotal = (parseInt(price) * parseInt(quantity)) - (parseInt(price) * parseInt(quantity) * (parseInt(discount) / 100));
        $('#sub_total'+ id).val(parseInt(subtotal));

        var itemArray = <?php echo json_encode($second); ?>;
        var total = 0;
        for(let i = 0; i < itemArray.length; i++){
            var subTotal = parseInt($('#sub_total'+ itemArray[i].id).val());
            total += subTotal;
        }
        $('#grand_total').val(total);
    }

          

        
 function productdata() {
    var discount = $('#discount').val();
    var itemArray = <?php echo json_encode($second); ?>;
    var data = []; // Define the data array
    console.log(discount);
    for (let i = 0; i < itemArray.length; i++) {
        var id = itemArray[i].id;
        var quantity = $('#quantity' + id).val();
        var price = $('#price' + id).text();
        var subtotal = (parseInt(price) * parseInt(quantity)) - (parseInt(price) * parseInt(quantity) * (parseInt(discount) / 100));
        var subTotal = parseInt($('#sub_total' + id).val());
        console.log(quantity);
        var rowObj = {
            quantity: quantity,
            sub_total: subTotal,
            grand_total: $('#grand_total').val(),
            pro_id: itemArray[i].id
        };

        data.push(rowObj);

    }
    console.log(data);
    $.ajax({
        url: "<?= USER_PATH ?>/productajaxdata",
        dataType: "json",
        type: 'POST',
        data: JSON.stringify(data),
        success: function(data) {
            if (data == "1") {
                Swal.fire({
                    title: 'Success',
                    text: 'Data added successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?= USER_PATH ?>bdisplay";
                    }
                });
            } else {
                console.log("ERROR");
            }
        },
        error: function(data) {
            console.log("ERROR");
        }
    });
}
   
    
    
</script>
<?php include(INCLUDESPATH . 'footer.php'); ?>