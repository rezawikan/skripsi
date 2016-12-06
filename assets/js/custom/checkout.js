
$(document).ready(function(){

    // get id and code from address
    var checkout   = getParameterByName('checkout');
    var buyerID    = getCookie('id-buyer');
    loadData(checkout, buyerID);


    // $(document).on('click', '.selector', function(event) {
    //   event.preventDefault();
    //   /* Act on the event */
    //
    //
    // });

    $('.total-cart').hide();
    $('.delivery').hide();
    $('#service').change(function(){
  		var courier    = $('#service').val();
      var getWeight  = $('.weight').text();
      var weight     =  parseInt(getWeight) * 1000;
      console.log(weight);
  		loadCost(courier, weight, checkout, buyerID);
	  });

    $(document).on('click', '.submit-cost', function(event) {
      event.preventDefault();
      $('.submit-cost').text('Select');
      $(this).text('Selected');
      var deliveryCost    = $(this).val();
      var sub_total       = $('.sub-total-cost').text();
      var sub_totalParse  = sub_total.split('.').join("");
      var total_all       = parseInt(sub_totalParse)+parseInt(deliveryCost);
      $('.total-cost').text();
      $('.total-cost').text(number_format(total_all));
      $('.delivery').removeClass('col-md-12');
      $('.delivery').addClass('col-md-6');
      $('.total-cart').fadeIn('slow');

      var costID    = $(this).closest('tr').find('td:eq(3)').data('id');
      var courier  = $(this).closest('tr').find('td:eq(1)').data('id');
      $('.link-submit-order').attr('href','result.php?checkout='+checkout+'&courier='+courier+'&costid='+costID);

    });


    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0)==' ') {
              c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
              return c.substring(name.length,c.length);
          }
      }
      return null;
    }


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

    function loadCost(courier, weight, checkout, buyerID) {

      $.ajax({
        url: 'function/Shipment/Cost.php',
        type: 'POST',
        data: {
          courier : courier,
          weight : weight,
          checkout: checkout,
          buyerID : buyerID
        },
        success: function(result){
          var resultObjt = JSON.parse(result);
          // console.log(resultObjt);
          var number      = 1;
          var dataHandler = $('.table-cost');
          dataHandler.html("");
          $.each(resultObjt['rajaongkir']['results'],function(first, result) {
            // console.log(result.code); // code, name
            $.each(result['costs'], function(second, costs) {
              // console.log(index); // description n service
              $.each(costs['cost'], function(third, data) {
                  var newRow = $('<tr>');
                  newRow.html("<td>"+number+"</td><td data-id='"+result.code+"'>"+costs.description+"</td><td class='etd'>"+data.etd+"</td><td data-id='"+second+"'>"+number_format(data.value)+"</td><td><button class='btn btn-primary submit-cost'  value='"+data.value+"'>Select</button></td>")
                  dataHandler.append(newRow);
                  number++;
              });
            });
          });
        }
      })
    }


    // load data from table bank
    function loadData(checkout, buyerID) {

        $.ajax({
            url: 'function/Cart/Checkout.php',
            type: 'POST',
            data: {
              checkout:checkout,
              buyerID : buyerID
            },
            success: function(result) {
                var resultObj   = JSON.parse(result);
                console.log(resultObj);
                var dataHandler = $('.cart');
                  var i = 1 ;
                  $.each(resultObj, function(key, val) { // looping data
                    var newRow = $("<div class='col-md-12 distance-top cart-to-"+i+"'>");
                    newRow.html("<span class='pull-right'>(<strong>"+val['total_qty']+"</strong>) items</span><h5>Items in your cart</h5><div class='ibox-content'><div class='table-responsive'><table class='table shoping-cart-table'><tbody class='data-cart-"+i+"'>");
                    dataHandler.append(newRow);
                    $.each(val['order'],function(index, el) {
                      var content = ("<tr><td width='90'><div class='cart-product-imitation'></div></td><td class='desc'><h3><a class='text-navy'>"+el.productName+"</a></h3><p class='small'>"+el.shortDesc+"</p></td><td class='pull-right'>IDR "+number_format(el.price)+"</td><td width='65'><input type='text' class='form-control' placeholder='1' value="+el.quantity+" disabled></td><td><h4>IDR "+number_format(el.total)+"</h4></td></tr>");
                      $('.data-cart-'+i).append(content);
                    }); // end second each
                    $(".cart-to-"+i).after("<div class='col-md-12 distance-top'><h5>Summary - not include delivery cost</h5><div class='ibox-content'><span>Total</span><h2 class='font-bold'>IDR <span class='sub-total-cost'>"+number_format(val['sub_total'])+"</span></h2><table class='table'><tr><td>Total Quantity </td><td>"+val['total_qty']+"</td></tr><tr><td>Total Weight </td><td class='weight'>"+val['total_weight']+"</td></tr></table></div></div>");
                      i++;
                  }) // end first each
                  $('.delivery').show();
            } // end result
        })
    }
});
