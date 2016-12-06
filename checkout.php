<?php require_once 'templates/data.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Mall - Cart List</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="assets/css/style.css">


    <!-- FormValidation CSS file -->
    <link rel="stylesheet" href="assets/css/formValidation.min.css">

    <!-- Ladda style -->
    <link rel="stylesheet" href="assets/css/plugins/ladda/ladda-themeless.min.css">

    <!-- FooTable -->
    <link rel="stylesheet" href="assets/css/plugins/footable/footable.core.css">

</head>

<?php require_once 'templates/header.php'; ?>

<section class="container top-container">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Cart List</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li class="active">
                    <a><strong>Cart List</strong></a>
                </li>
            </ol>
        </div>
    </div>
</section>
<section id="features" class="container bank">
  <div class="row cart">

  </div>
  <div class="row">
    <div class="col-md-12 distance-top delivery">
      <h5>Delivery</h5>
      <div class="ibox-content">
        <div class="table-responsive">
          <div class="form-group">
            <label for="">Shipment</label>
            <select name="service" id="service" class="form-control">
              <option>Select</option>
              <option value="jne">JNE</option>
  					  <option value="pos">POS</option>
  					  <option value="tiki">TIKI</option>
            </select>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Estimation</th>
                <th>Price</th>
                <th>Select</th>
              </tr>
            </thead>
            <tbody class="table-cost">

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class='col-md-6 distance-top total-cart'>
      <h5>Total Cost</h5>
      <div class='ibox-content'>
        <span>Total</span>
        <h2 class='font-bold'>IDR <span class='total-cost'>0</span></h2>
        <a class="btn btn-primary link-submit-order" href="">Submit Order Now</a>
      </div>
    </div>


  </div>
</section>

<?php require_once 'templates/footer.php'; ?>

<!-- Mainly scripts -->
<script src="assets/js/jquery-3.1.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>
<script src="assets/js/plugins/wow/wow.min.js"></script>

<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="assets/js/formValidation.min.js"></script>
<script src="assets/js/framework/bootstrap.min.js"></script>

<!-- Ladda -->
<script src="assets/js/plugins/ladda/spin.min.js"></script>
<script src="assets/js/plugins/ladda/ladda.min.js"></script>
<script src="assets/js/plugins/ladda/ladda.jquery.min.js"></script>

<!-- FooTable -->
<script src="assets/js/plugins/footable/footable.all.min.js"></script>

<!-- Handle CRUD Data Bank -->
<script src="assets/js/custom/checkout.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom/custom.js"></script>

</body>
</html>
