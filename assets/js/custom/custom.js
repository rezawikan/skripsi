$(document).ready(function() {

    loadcookies();
    $(document).on('click', '.add-to',function(e)
    {
        e.preventDefault(); /* prevent link address */
        var data = $(this).data('id'); /* get data id */
        console.log(data);
        var cookie = getCookie('cart');

          if( cookie == null){
            var firstArr = [data];
            setCookie('cart', fixedEncodeURIComponent(firstArr));
            loadcookies();
            $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>Successfully add to cart</div>");
            $('#message').fadeIn('slow', function(){
              $('#message').fadeOut(7000);
            });
            $('html,body').animate({
                scrollTop: 0
            }, 700);
          } else {
            var decodeCookie = decodeURIComponent(cookie);
            var secondArr   = [data];
            var temp        = [decodeCookie];
            var results     = secondArr.concat(temp);
            console.log(results);
            setCookie('cart', fixedEncodeURIComponent(results));
            loadcookies();
            $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>Successfully add to cart</div>");
            $('#message').fadeIn('slow', function(){
              $('#message').fadeOut(7000);
            });
            $('html,body').animate({
                scrollTop: 0
            }, 700);
          }
    });

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


    $(".dropdown-submenu").click(function(event) {
        // stop bootstrap.js to hide the parents
        event.stopPropagation();
        // hide the open children
        $(this).siblings(".dropdown-submenu").removeClass('open');

        // // add 'open' class to all parents with class 'dropdown-submenu'
        // $( this ).parents(".dropdown-submenu").addClass('open');
        // // this is also open (or was)
        $(this).toggleClass('open');
    });

    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 80
    });

    // Page scrolling feature
    $('a.page-scroll').bind('click', function(event) {
        var link = $(this);
        $('html, body').stop().animate({
            scrollTop: $(link.attr('href')).offset().top - 50
        }, 500);
        event.preventDefault();
        $("#navbar").collapse('hide');
    });
});

var cbpAnimatedHeader = (function() {
    var docElem = document.documentElement,
        header = document.querySelector('.navbar-default'),
        didScroll = false,
        changeHeaderOn = 200;

    function init() {
        window.addEventListener('scroll', function(event) {
            if (!didScroll) {
                didScroll = true;
                setTimeout(scrollPage, 250);
            }
        }, false);
    }

    function scrollPage() {
        var sy = scrollY();
        if (sy >= changeHeaderOn) {
            $(header).addClass('navbar-scroll')
        } else {
            $(header).removeClass('navbar-scroll')
        }
        didScroll = false;
    }

    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }
    init();

})();

// Activate WOW.js plugin for animation on scrol
new WOW().init();
