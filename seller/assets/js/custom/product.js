$(document).ready(function(){

    loadTitle();
    loadData();

    var psort         = getParameterByName('psort');
    var dsort         = getParameterByName('dsort');

    if (dsort == "ASC") {
        $('select[name=sorting]').val("dsort-asc").attr( "selected", "selected" );
    } else if (dsort == "DESC") {
        $('select[name=sorting]').val("dsort-desc").attr( "selected", "selected" );
    } else if (psort == "ASC") {
        $('select[name=sorting]').val("psort-asc").attr( "selected", "selected" );
    } else if (psort == "DESC") {
        $('select[name=sorting]').val("psort-desc").attr( "selected", "selected" );
    }

    $('select[name=sorting]').change(function() {
        var page_number   = getParameterByName('page');
        var subcategories = getParameterByName('subcategories');
        var psort         = getParameterByName('psort');
        var dsort         = getParameterByName('dsort');
        var value         = this.options[this.selectedIndex].value;


        if (value == "dsort-asc" && typeof subcategories == "string" && typeof page_number == "string") {
                    window.location = "http://localhost/emall/product.php"+"?page="+page_number+"&subcategories="+subcategories+"&dsort=ASC";
        } else if (value == "dsort-desc" && typeof subcategories == "string" && typeof page_number == "string") {
                    window.location = "http://localhost/emall/product.php"+"?page="+page_number+"&subcategories="+subcategories+"&dsort=DESC";
        } else if (value == "dsort-asc" && typeof subcategories == "string") {
                    window.location = "http://localhost/emall/product.php"+"?subcategories="+subcategories+"&dsort=ASC";
        } else if (value == "dsort-desc" && typeof subcategories == "string") {
                    window.location = "http://localhost/emall/product.php"+"?subcategories="+subcategories+"&dsort=DESC";
        } else if (value == "dsort-asc" && typeof page_number == "string") {
                    window.location = "http://localhost/emall/product.php"+"?page="+page_number+"&dsort=ASC";
        } else if (value == "dsort-desc" && typeof page_number == "string") {
                    window.location = "http://localhost/emall/product.php"+"?page="+page_number+"&dsort=DESC";
        } else if (value == "dsort-asc") {
                    window.location = "http://localhost/emall/product.php?dsort=ASC";
        } else if (value == "dsort-desc") {
                    window.location = "http://localhost/emall/product.php?dsort=DESC";
                    // limit
        } else if (value == "psort-asc" && typeof subcategories == "string" && typeof page_number == "string") {
                    window.location = "http://localhost/emall/product.php"+"?page="+page_number+"&subcategories="+subcategories+"&psort=ASC";
        } else if (value == "psort-desc" && typeof subcategories == "string" && typeof page_number == "string") {
                    window.location = "http://localhost/emall/product.php"+"?page="+page_number+"&subcategories="+subcategories+"&psort=DESC";
        } else if (value == "psort-asc" && typeof subcategories == "string") {
                    window.location = "http://localhost/emall/product.php"+"?subcategories="+subcategories+"&psort=ASC";
        } else if (value == "psort-desc" && typeof subcategories == "string") {
                    window.location = "http://localhost/emall/product.php"+"?subcategories="+subcategories+"&psort=DESC";
        } else if (value == "psort-asc" && typeof page_number == "string") {
                    window.location = "http://localhost/emall/product.php"+"?page="+page_number+"&psort=ASC";
        } else if (value == "psort-desc" && typeof page_number == "string") {
                    window.location = "http://localhost/emall/product.php"+"?page="+page_number+"&psort=DESC";
        } else if (value == "psort-asc") {
                    window.location = "http://localhost/emall/product.php?psort=ASC";
        } else if (value == "psort-desc") {
                    window.location = "http://localhost/emall/product.php?psort=DESC";
        }
    });

    // get data cookie
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
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

    function number_format(user_input) {
        var filtered_number = user_input.replace(/[^0-9]/gi, '');
        var length = filtered_number.length;
        var breakpoint = 1;
        var formated_number = '';

        for (i = 1; i <= length; i++) {
            if (breakpoint > 3) {
                breakpoint = 1;
                formated_number = '.' + formated_number;
            }
            var next_letter = i + 1;
            formated_number = filtered_number.substring(length - i, length - (i - 1)) + formated_number;

            breakpoint++;
        }

        return formated_number;
    }

    function loadTitle(){
        var subcategories = getParameterByName('subcategories');

        if (subcategories != null ){
          console.log(subcategories);
          $.ajax({
            url: 'function/Product/SetTitle.php',
            type: 'POST',
            data: {subcategoriesID: subcategories},
            success: function(result){
              console.log(result);
              $("#title-category").append(result);
            }
          });
        }
    }


    // load data from table bank
    function loadData() {
        var dataID = getCookie('id');
        // get id and code from address
        var page_number   = getParameterByName('page');
        var limit         = getParameterByName('limit');
        var subcategories = getParameterByName('subcategories');
        var psort         = getParameterByName('psort');
        var dsort         = getParameterByName('dsort');

        $.ajax({
            url: 'function/Pagination/Paginator.php',
            type: 'POST',
            data: {
                page: page_number,
                limit : limit,
                subcategories : subcategories,
                psort : psort,
                dsort : dsort
            },
            success: function(result) {
                console.log(result);
                var resultObj = JSON.parse(result);
                var number = 0;
                var dataHandler = $('.products');
                dataHandler.html("");
                $('#loading-svg').hide();

                if(resultObj.empty){
                    var emptyRow = $("<tr>");
                    emptyRow.html("<td colspan='8' style=' height:100px; padding-top:50px; text-align:center;'>Your product is empty</td>");
                    dataHandler.append(emptyRow);
                }else{
                    $.each(resultObj, function(key, val) { // looping data
                        number++;
                        var newRow = $("<div class='col-lg-3 col-md-3 col-xs-12'>");
                        newRow.html("<div class='ibox'><div class='ibox-content product-box'><div class='product-imitation'><img class='img-responsive' src='uploads/product/1_1478870412.jpg'></div><div class='product-desc'><span class='product-price'>IDR "+number_format(val.productPrice)+"</span><small class='text-muted'>Category</small><a href='#' class='product-name'> "+val.productName+"</a><div class='small m-t-xs'>"+val.shortDescription+"</div><div class='m-t text-righ'><a href='product_details.php?productID="+val.productID+"' class='btn btn-primary details'>Details</a></div></div></div></div>");
                        dataHandler.append(newRow);
                    })
                }
            }
        })
    }
});
