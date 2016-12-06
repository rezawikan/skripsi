
$(document).ready(function(){

    loadData();


    // function get value from adrress
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    // format number
    function number_format(user_input){
      var input = String(user_input);
      var filtered_number = input.replace(/[^0-9]/gi, '');
      var length = filtered_number.length;
      var breakpoint = 1;
      var formated_number = '';

      for(i = 1; i <= length; i++){
          if(breakpoint > 3){
              breakpoint = 1;
              formated_number = '.' + formated_number;
          }
          var next_letter = i + 1;
          formated_number = filtered_number.substring(length - i, length - (i - 1)) + formated_number;

          breakpoint++;
      }

      return formated_number;
  	}



    // load data from table bank
    function loadData() {

        $.ajax({
            url: 'function/Cart/Cart.php',
            type: 'GET',
            success: function(result) {
                var resultObj   = JSON.parse(result);
                console.log(resultObj);
                var dataHandler = $('.cart');
                  var i = 1 ;
                  $.each(resultObj, function(key, val) { // looping data
                    // console.log(key);

                    var newRow = $("<div class='col-md-9 distance-top cart-to-"+i+"'>");
                    var title = ("<div class='ibox-content'><button class='btn btn-primary pull-right'><i class='fa fa fa-shopping-cart'></i> Checkout</button><button class='btn btn-white'><i class='fa fa-arrow-left'></i> Continue shopping</button></div>");
                    newRow.html("<span class='pull-right'>(<strong>"+val['total_qty']+"</strong>) items</span><h5>Items in your cart</h5><div class='ibox-content'><div class='table-responsive'><table class='table shoping-cart-table'><tbody class='data-cart-"+i+"'>");
                    dataHandler.append(newRow, title);

                    // console.log(val['total_qty']);

                    $.each(val['order'],function(index, el) {
                      var content = ("<tr><td width='90'><div class='cart-product-imitation'></div></td><td class='desc'><h3><a class='text-navy'>"+el.productName+"</a></h3><p class='small'>"+el.shortDesc+"</p><div class='m-t-sm'><a href='#' class='text-muted'><i class='fa fa-trash'></i> Remove item</a></div></td><td class='pull-right'>IDR "+number_format(el.price)+"</td><td width='65'><input type='text' class='form-control' placeholder='1' value="+el.quantity+" disabled></td><td><h4>IDR "+number_format(el.total)+"</h4></td></tr>");
                      $('.data-cart-'+i).append(content);
                      console.log(el);

                    }); // end second each
                    console.log(val['sub_total']);
                    $(".cart-to-"+i).after("<div class='col-md-3 distance-top'><div class=''><div class=''><h5>Car Summary</h5></div><div class='ibox-content'><span>Total</span><h2 class='font-bold'>IDR "+number_format(val['sub_total'])+"</h2><hr><span class='text-muted small'>*For United States, France and Germany applicable sales tax will be applied</span><div class='m-t-sm'><div class='btn-group'><a href='checkout.php?checkout="+key+"' class='btn btn-primary btn-sm'><i class='fa fa-shopping-cart'></i> Checkout</a><a href='#' class='btn btn-white btn-sm'> Cancel</a></div></div></div></div></div>");
                      i++;
                  }) // end first each

            } // end result
        })
    }
});
