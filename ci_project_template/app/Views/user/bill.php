<?php include(INCLUDESPATH . 'header.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <title>Billing Form</title>


</head>

<body>
  <div class="container">
    <h2>Billing Information</h2>

      <div class="form-row">
        <div class="col">
          <label for="product">Product:</label>
          <input type="text" class="form-control" id="product" placeholder="Enter your product" class="required">
        </div>
        <div class="col">
          <label for="quantity">Quantity:</label>
          <input type="number" class="form-control" id="quantity" placeholder="Enter your quantity" class="required">
        </div>
        <div class="col">
          <label for="amount">Amount:</label>
          <input type="number" class="form-control" id="amount" placeholder="Enter your amount" class="required">
        </div>
      </div>

      <div class="row">
        <label for="total">Total:</label>
        <input type="number" class="form-control" id="total" placeholder="total" readonly="" >
      </div>

      <div class="row">
        <label for="discount">Discount</label>
        <input type="number" class="form-control" id="discount" placeholder="discount" class="required">
      </div>
      <div class="row">
        <label for="subtot">Subtot:</label>
        <input type="text" class="form-control" id="subtot" placeholder="subtot" readonly="" >
      </div>
      <div class="row">
        <label for="tax">Tax:</label>
        <input type="text" class="form-control" id="tax" placeholder="tax" readonly="">
      </div>
      <div class="row">
        <label for="gtotal">Gtotal</label>
        <input type="text" class="form-control" id="gtotal" placeholder="gtotal" readonly="">
      </div>

      <button type="submit" class="btn btn-primary mt-3" onclick="billData()">Submit</button>
   
  </div>
</body>s

<script>
  $(document).ready(function() {

    $('#amount').keyup(function() {
      var product = $('#product').val();
      var quantity = $('#quantity').val();
      var amount = $('#amount').val();

      var total = quantity * amount
      $('#total').val(total.toFixed(2));

      $('#discount').keyup(function() {

        var discount = $('#discount').val();
        var subtot = total - (total * discount);
        $('#subtot').val(subtot.toFixed(2));
        var tax = subtot * 0.05;
        $('#tax').val(tax.toFixed(2));
        var gtotal = subtot + tax;
        $('#gtotal').val(gtotal.toFixed(2));

      });
    });
  });



  function billData() {
    var product = $('#product').val();
    var quantity = $('#quantity').val();

    var amount = $('#amount').val();
    var total = $('#total').val();

    var discount = $('#discount').val();
    var subtot = $('#subtot').val();
    var tax = $('#tax').val();

    var gtotal = $('#gtotal').val();
    if (product.trim() === '') {
                $('#product').text("name is required");
            } else
           

    $.ajax({

      url: "<?= USER_PATH ?>/billajaxdata",
      datatype: "json",
      type: 'POST',
      data: JSON.stringify({
        "product": product,
        "quantity": quantity,
        "amount": amount,
        "total": total,
        "discount": discount,
        "subtot": subtot,
        "tax": tax,
        "gtotal": gtotal
      }), // serializes the form's elements.
      success: function(data) {
        console.log(data);
        if (data == "1") {
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
              window.location.href = "<?= USER_PATH ?>bdisplay";
            }
          });
        } else {

        console.log("ERROR");
        }
      },
      error: function(data) {

      }
    });




  }

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>


</html>
<?php include(INCLUDESPATH . 'footer.php'); ?>