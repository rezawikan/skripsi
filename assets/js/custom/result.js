
$(document).ready(function(){

    // get id and code from address
    var sellerID   = getParameterByName('checkout');
    var courier    = getParameterByName('courier');
    var costid     = getParameterByName('costid');


    resultOrder(sellerID, courier, costid);


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

    function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires="+ d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function fixedEncodeURIComponent (str) {
      return encodeURIComponent(str).replace(/[!'()*]/g, function(c) {
        return '%' + c.charCodeAt(0).toString(16);
      });
    }

    function loadcookies(){
      $.ajax({
        url: 'function/Product/HandleCookies.php',
        type: 'GET',
        success: function(result){
          console.log(result);
          $('.cookie').text(result);
        }
      })
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

    function resultOrder(sellerID, courier, costid) {

      $.ajax({
        url: 'function/Order/DetailCost.php',
        type: 'POST',
        data: {
          sellerID : sellerID,
          courier  : courier,
          costid   : costid
        },
        success: function(result){
          console.log(result);

          
          if(result != 'string'){
          var resultObj = JSON.parse(result);
          console.log( fixedEncodeURIComponent(resultObj));
          setCookie('cart', fixedEncodeURIComponent(resultObj));
          loadcookies();
          } else {
              // document.cookie = "cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
              setCookie('cart', '', -1);
              loadcookies();
          }

        }
      })
    }

});
