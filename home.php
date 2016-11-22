<?php require_once 'templates/data.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home - Electronic Mall</title>

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
  <div class="row">
    <div class="title-header" class="col-sm-12">
      <h1>Sales Report</h1>
    </div>
  </div>
</section>

<section id="features" class="container">
  <div class="row">
    <div class="col-lg-3">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <span class="label label-success pull-right">Daily</span>
          <h5>Total Orders</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <span class="label label-info pull-right">Annual</span>
          <h5>Pending Orders</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins">275,800</h1>
          <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
          <small>New orders</small>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <span class="label label-primary pull-right">Today</span>
          <h5>Complete Orders</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins">106,120</h1>
          <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
          <small>Complete Orders </small>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <span class="label label-danger pull-right">Low value</span>
          <h5>Refund Orders</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins">80,600</h1>
          <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
          <small>In first month</small>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="widget navy-bg p-lg text-center">
          <div class="m-b-md">
              <i class="fa fa-shield fa-4x"></i>
              <h1 class="m-xs">456</h1>
              <h3 class="font-bold no-margins">
                  Number of Products
              </h3>
              <small>number of product that you have</small>
          </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="widget navy-bg p-lg text-center">
          <div class="m-b-md">
              <i class="fa fa-shield fa-4x"></i>
              <h1 class="m-xs">456</h1>
              <h3 class="font-bold no-margins">
                  Stock Alert
              </h3>
              <small>you have stock of less than 5</small>
          </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="widget navy-bg p-lg text-center">
          <div class="m-b-md">
              <i class="fa fa-shield fa-4x"></i>
              <h1 class="m-xs">456</h1>
              <h3 class="font-bold no-margins">
                  View All Product
              </h3>
              <small>power</small>
          </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="widget navy-bg p-lg text-center">
          <div class="m-b-md">
              <i class="fa fa-shield fa-4x"></i>
              <h1 class="m-xs">Today</h1>
              <h3 class="font-bold no-margins">
                  <?php echo date("F j, Y");?>
              </h3>
              <small> <?php echo date("g:i a");?></small>
          </div>
      </div>
    </div>
  </div>
</section>


<section class="container">
    <div class="row">
        <div id="title-header" class="col-sm-12 distance-bottom">
            <h1>Populer Products</h1>
        </div>
    </div>
</section>

<section id="features" class="container wow fadeInRight">
    <div class="row">
        <div class="col-md-3">
            <div class="ibox">
                <div class="ibox-content product-box">
                    <div class="product-imitation">
                        <img src="https://placeimg.com/260/200/any">
                    </div>
                    <div class="product-desc">
                        <span class="product-price">
                                    $10
                        </span>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Product</a>
                        <div class="small m-t-xs">
                            Many desktop publishing packages and web page editors now.
                        </div>
                        <div class="m-t text-righ">
                            <a href="#" class="btn btn-xs btn-outline btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="ibox">
                <div class="ibox-content product-box">
                    <div class="product-imitation">
                      <img src="https://placeimg.com/260/200/any">
                    </div>
                    <div class="product-desc">
                        <span class="product-price">
                                    $10
                        </span>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Product</a>
                        <div class="small m-t-xs">
                            Many desktop publishing packages and web page editors now.
                        </div>
                        <div class="m-t text-righ">
                            <a href="#" class="btn btn-xs btn-outline btn-primary">Details </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="ibox">
                <div class="ibox-content product-box">
                    <div class="product-imitation">
                      <img src="https://placeimg.com/260/200/any">
                    </div>
                    <div class="product-desc">
                        <span class="product-price">
                                    $10
                        </span>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Product</a>
                        <div class="small m-t-xs">
                            Many desktop publishing packages and web page editors now.
                        </div>
                        <div class="m-t text-righ">
                            <a href="#" class="btn btn-xs btn-outline btn-primary">Details </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="ibox">
                <div class="ibox-content product-box">
                    <div class="product-imitation">
                      <img src="https://placeimg.com/260/200/any">
                    </div>
                    <div class="product-desc">
                        <span class="product-price">
                                    $10
                        </span>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Product</a>
                        <div class="small m-t-xs">
                            Many desktop publishing packages and web page editors now.
                        </div>
                        <div class="m-t text-righ">
                            <a href="#" class="btn btn-xs btn-outline btn-primary">Details </a>
                        </div>
                    </div>
                </div>
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

 <!-- ChartJS-->
 <script src="assets/js/plugins/chartJs/Chart.min.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom/custom.js"></script>
<script>
        $(document).ready(function() {

          var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: [48, 48, 60, 39, 56, 37, 30]
                    },
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(220,220,220,0.5)",
                        borderColor: "rgba(220,220,220,1)",
                        pointBackgroundColor: "rgba(220,220,220,1)",
                        pointBorderColor: "#fff",
                        data: [65, 59, 40, 51, 36, 25, 40]
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

        });
    </script>



</body>
</html>
