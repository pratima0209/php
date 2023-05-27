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
        <h4>Product Details</h4>
        <hr>
        <div class="form-group">
          <label for="discount">Discount</label>
          <input type="number" class="form-control" id="discount" placeholder="Discount">
        </div>
        <table class="table table-bordered" id="productTable">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
              <th>Sub-Total</th>
              <th><button type="button" class="btn btn-primary" id="addRowButton">Add Row</button></th>

            </tr>
          </thead>
          <tbody>
            <?php for ($i = 1; $i <= 1; $i++) { ?>
              <tr>

                <td>
                  <input type="text" class="form-control product" name="product[]" placeholder="Product" value="">
                </td>
                <td>
                  <input type="number" class="form-control quantity" name="quantity[]" placeholder="Quantity" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </td>
                <td>
                  <input type="number" class="form-control price" name="price[]" placeholder="Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="">
                </td>
                <td>
                  <input type="text" class="form-control total" name="total[]" readonly>
                </td>
                <td>
                  <input type="text" class="form-control subtotal" name="subtotal[]" readonly>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <div class="form-group">
          <label for="grandTotal">Grand Total</label>
          <input type="text" class="form-control" id="grandTotal" readonly>
        </div>
        <button type="submit" class="btn btn-primary mt-3" onclick="productdata()">Submit</button>

      </div>
    </div>
  </div>
</body>

<script>
  $(document).ready(function() {
   var discount = 0;

    // Calculate total for each row when price or quantity changes
    $(document).on('keyup', '.quantity, .price', function() {
      var $row = $(this).closest('tr');
      var quantity = parseFloat($row.find('.quantity').val());
      var price = parseFloat($row.find('.price').val());
      var total = quantity * price;
      $row.find('.total').val(total.toFixed(2));
      calculateSubTotal($row);
      calculateGrandTotal();
    });

    // Calculate sub-total for each row when discount changes
    $('#discount').keyup(function() {
      //var discount = 0;
       discount = parseFloat($(this).val());
      $('#productTable tbody tr').each(function() {
        var $row = $(this);
        calculateSubTotal($row);
      });
      calculateGrandTotal();
    });

    // Calculate sub-total for a specific row
    function calculateSubTotal($row) {
      var product = $row.find('.product').val().trim();
      var quantity = parseFloat($row.find('.quantity').val());
      var price = parseFloat($row.find('.price').val());

      if (product !== '' && !isNaN(quantity) && !isNaN(price)) {
        var total = quantity * price;
        var subTotal = total - (total * discount);
        $row.find('.total').val(total.toFixed(2));
        $row.find('.subtotal').val(subTotal.toFixed(2));
      } else {
        $row.find('.total').val('');
        $row.find('.subtotal').val('');
      }
    }

    // Calculate and update the grand total
    function calculateGrandTotal() {
      var grandTotal = 0;
      $('#productTable tbody tr').each(function() {
        var $row = $(this);
        var subTotal = parseFloat($row.find('.subtotal').val());

        if (!isNaN(subTotal)) {
          grandTotal += subTotal;
        }
      });
      $('#grandTotal').val(grandTotal.toFixed(2));
    }
    $('#addRowButton').click(function() {
      var newRow = $('<tr>');
      newRow.append('<td><input type="text" class="form-control product" name="product[]" placeholder="Product"></td>');
      newRow.append('<td><input type="text" class="form-control quantity" name="quantity[]" placeholder="Quantity"></td>');
      newRow.append('<td><input type="text" class="form-control price" name="price[]" placeholder="Price"></td>');
      newRow.append('<td><input type="text" class="form-control total" name="total[]" readonly></td>');
      newRow.append('<td><input type="text" class="form-control subtotal" name="subtotal[]" readonly></td>');

      $('#productTable tbody').append(newRow);
    });
  });


function productdata()
{
  var discount = parseFloat($('#discount').val());
        var data = [];

        $('#productTable tbody tr').each(function() {
          var $row = $(this);
          var product = $row.find('.product').val().trim();
          var quantity = parseFloat($row.find('.quantity').val());
          var price = parseFloat($row.find('.price').val());
          var total = quantity * price;
          var subTotal = total - (total * discount);
          
          var rowObj = {
            "discount": discount,
            "product": product,
            "quantity": quantity,
            "price": price,
            "total": total,
            "subtotal": subTotal,
            "gtotal": $('#grandTotal').val()
          };

          data.push(rowObj);
        });

        $.ajax({
          url: "<?= USER_PATH ?>/productajaxdata",
          dataType: "json",
          type: 'POST',
          data: JSON.stringify(data),
          success: function(data) {
           // console.log(data);
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

</html>

<?php include(INCLUDESPATH . 'footer.php'); ?>
