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
      <!-- <div class="col-md-9 distance-top">
      <span class="pull-right">(<strong>5</strong>) items</span>
      <h5>Items in your cart</h5>
      <div class="ibox-content">
        <div class="table-responsive">
          <table class="table shoping-cart-table">
            <tbody>
            <tr>
              <td width="90">
                  <div class="cart-product-imitation"></div>
              </td>
              <td class="desc">
                <h3>
                <a href="#" class="text-navy">Description</a>
                </h3>
                <p class="small">shortDescription</p>
                <div class="m-t-sm">
                  <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                </div>
              </td>
              <td>IDR 50.000/pcs</td>
              <td width="20">
                <a href="#">add</a>
                <a href="#">minus</a>
              </td>
              <td width="65">
                  <input type="text" class="form-control" placeholder="1">
              </td>
              <td><h4>  IDR 100.000 Total</h4></td>
            </tr>
            </tbody>
            </table>
        </div>
      </div>

      </div> -->



      <!-- <div class="col-md-3 distance-top">
        <div class="">
          <div class="">
            <h5>Cart Summary</h5>
          </div>
          <div class="ibox-content">
            <span>Total</span>
            <h2 class="font-bold">
              $390,00
            </h2>
            <hr>
            <span class="text-muted small">*For United States, France and Germany applicable sales tax will be applied</span>
            <div class="m-t-sm">
              <div class="btn-group">
                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
                <a href="#" class="btn btn-white btn-sm"> Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </div> -->
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
<script src="assets/js/custom/cart.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom/custom.js"></script>

</body>
</html>
