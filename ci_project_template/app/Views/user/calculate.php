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
          <input type="text" class="form-control" id="discount" placeholder="Discount">
        </div>
        <table class="table table-bordered" id="productTable">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
              <th>Sub-Total</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i = 1; $i <= 5; $i++) { ?>
              <tr>
                <td>
                  <input type="text" class="form-control product" name="product[]" placeholder="Product">
                </td>
                <td>
                  <input type="text" class="form-control quantity" name="quantity[]" placeholder="Quantity">
                </td>
                <td>
                  <input type="text" class="form-control price" name="price[]" placeholder="Price">
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
      discount = parseFloat($(this).val());
      $('#productTable tbody tr').each(function() {
        var $row = $(this);
        calculateSubTotal($row);
      });
      calculateGrandTotal();
    });

    // Calculate sub-total for a specific row
    function calculateSubTotal($row) {
      var total = parseFloat($row.find('.total').val());
      var subTotal = total - (total * discount);
      $row.find('.subtotal').val(subTotal.toFixed(2));
    }

    // Calculate and update the grand total
    function calculateGrandTotal() {
      var grandTotal = 0;
      $('#productTable tbody tr').each(function() {
        var $row = $(this);
        var subTotal = parseFloat($row.find('.subtotal').val());
        grandTotal += subTotal;
      });
      $('#grandTotal').val(grandTotal.toFixed(2));
    }
  });
</script>

</html>

<?php include(INCLUDESPATH . 'footer.php'); ?>
