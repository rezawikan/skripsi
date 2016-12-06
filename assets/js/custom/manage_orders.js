$(document).ready(function() {

    $('.table').footable({
        "paging": {
            "enabled": true
        }
    });

    loadData();

    // cancel button form add
    $('#form-data-add #cancel-btn-add').on('click', function(e) {
        e.preventDefault();
        $('#modal-form-add').modal('hide');
    });

    // hide the first option select
    $("#form-data-update #bankID").on('click', function(e) {
        e.preventDefault();
        $("#form-data-update select option:first-child").hide();
    });

    // hide the first option select
    $("#form-data-update #bankID").on('click', function(e) {
        e.preventDefault();
        $("#form-data-update select option:first-child").hide();
    });

    // global hide
    $("#form-data-update #sellerID").hide();
    $("#form-data-add #sellerID").hide();
    $("#form-data-update #seller_bankID").hide();

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
        return "";
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
        var dataID = getCookie('id-buyer');
        console.log(dataID);

        $.ajax({
            url: 'function/Order/ManageOrder.php',
            type: 'POST',
            data: {
                buyerID: dataID
            },
            success: function(result) {
                console.log(result);
                var resultObj = JSON.parse(result);
                var number = 0;
                var dataHandler = $('#table-manage-order');
                dataHandler.html("");

                if (resultObj.empty) {
                    var emptyRow = $("<tr>");
                    emptyRow.html("<td colspan='6' style=' height:100px; padding-top:50px; text-align:center;'>You don't have data order</td>");
                    dataHandler.append(emptyRow);
                } else {
                    $.each(resultObj, function(key, val) { // looping data
                        number++;
                        var newRow = $("<tr>");
                        newRow.html("<td>" + val.orderID + "</td><td>" + val.status + "</td><td>" + val.cost + "</td><td>" + val.weight + " Kg</td><td>" + val.estimation + " Day</td><td>" + val.update_at + "</td><td><a data-toggle='modal' class='edit_bank' id='" + val.orderID + "' href='#modal-form-update'><i title='Order Details' class='fa fa-eye'></i></a></td>");
                        dataHandler.append(newRow).trigger('footable_redraw');
                    })
                }
            }
        });
    }

    /// create a new instance for loading
    // var l = Ladda.create(document.querySelector('button[name=submit-btn-add]'));
    // Form Validation add
    $('#form-data-add').formValidation({
            framework: 'bootstrap',
            fields: {
                bankID: {
                    validators: {
                        notEmpty: {
                            message: 'Bank is required'
                        }
                    }
                },
                accountNumber: {
                    validators: {
                        notEmpty: {
                            message: 'Account Number is required'
                        },
                        integer: {
                            message: "Account Number isn't valid"
                        }
                    }
                },
                ownerName: {
                    validators: {
                        notEmpty: {
                            message: 'Owner Name is required'
                        }
                    }
                },
                branch: {
                    validators: {
                        notEmpty: {
                            message: 'Branch is required'
                        }
                    }
                }
            } // end fields
        }) // end form validation
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Some instances you can use are
            var $form = $(e.target), // The form instance
                fv = $(e.target).data('formValidation'); // FormValidation instance

            // start loading animation
            l.start();

            $.ajax({
                url: 'function/bank/AddDataBank.php',
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                        console.log(result);
                        var resultObj = JSON.parse(result);
                        console.log(resultObj);

                        l.stop();
                        $form.formValidation('resetForm', true);
                        $('#form-data-add')[0].reset(); // reset all fields
                        $('#form-data-add').children().removeClass('has-success'); // remove class has-success
                        $('button').removeAttr('disabled'); // remove atrribute disabled
                        $('button').removeClass('disabled'); // remove class disabled
                        $('#modal-form-add').modal('hide'); // hide modal form add
                        loadData(); // load data

                        if (resultObj.valid) {
                            $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" + resultObj.valid + "</div>");
                            $('#message').fadeIn('slow', function() {
                                $('#message').fadeOut(7000);
                            });
                        } else if (resultObj.error) {
                            $('#message').html("<div class='alert alert-danger alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" + resultObj.error + "</div>");
                            $('#message').fadeIn('slow', function() {
                                $('#message').fadeOut(7000);
                            });
                        }
                    } // end success
            }); // end ajax
        });

    // edit bank show when click action edit
    $(document).on('click', '.edit_bank', function(e) {
        e.preventDefault();

        var dataID = $(this).attr('id'); // get data from attribute id

        $.ajax({
            url: 'function/Order/ViewOrderDetails.php',
            type: 'POST',
            data: {
                orderID: dataID
            },
            success: function(result) {
                var resultObj = JSON.parse(result);
                console.log(resultObj);
                var tbody  = $('.table-view-details');
                var tfoot  = $('.table-view-shipment');
                tbody.html("");
                tfoot.html("");
                $.each(resultObj['details'], function(index, el) {
                  console.log(el.productName);
                  var newRow = $("<tr>");
                  newRow.html("<td width='90'><div class='cart-product-imitation'></div></td><td class='desc'><h3><a href='#' class='text-navy'>"+ el.productName +"</a></h3><p class='small'>Page when looking at its layout. The point of using Lorem Ipsum is</p></td><td width='65'><input type='text' class='form-control' placeholder='"+ el.quantity +"' disabled></td><td><h4>"+ number_format((el.quantity*el.productPrice))+"</h4></td>");
                  tbody.append(newRow);
                });

                $.each(resultObj['shipment'], function(index, el) {
                  var secondRow   = $("<tr>");
                  var thirdRow    = $("<tr>");
                  var fourthRow   = $("<tr>");
                  var fifthhRow   = $("<tr>");
                  var sixthRow    = $("<tr>");
                  var seventhRow  = $("<tr>");
                  secondRow.html("<td width='90'>Courier Name</td><td width='90'>:</td><td colspan='2'>"+ el.name +"</td>");
                  thirdRow.html("<td width='90'>Cost Delivery</td><td width='90'>:</td><td colspan='2'>"+ el.cost +"</td>");
                  fourthRow.html("<td width='90'>Weight</td><td width='90'>:</td><td colspan='2'>"+ el.weight +"</td>");
                  fifthhRow.html("<td width='90'>Estimation</td><td width='90'>:</td><td colspan='2'>"+ el.estimation +"</td>");
                  sixthRow.html("<td width='90'>Status</td><td width='90'>:</td><td colspan='2'>"+ el.status +"</td>");
                  seventhRow.html("<td width='90'>last Update</td><td width='90'>:</td><td colspan='2'>"+ el.update_at +"</td>");
                  tfoot.append(secondRow,thirdRow,fourthRow,fifthhRow,sixthRow,seventhRow);
                });



            }
        })
    });

    // create a new instance for loading
    // var u = Ladda.create(document.querySelector('button[name=submit-btn-update]'));
    // form validation update
    $('#form-data-update').formValidation({
            framework: 'bootstrap',
            fields: {
                bankID: {
                    validators: {
                        notEmpty: {
                            message: 'Bank is required'
                        }
                    }
                },
                accountNumber: {
                    validators: {
                        notEmpty: {
                            message: 'Account Number is required'
                        },
                        integer: {
                            message: "Account Number is'nt valid"
                        }
                    }
                },
                ownerName: {
                    validators: {
                        notEmpty: {
                            message: 'Owner Name is required'
                        }
                    }
                },
                branch: {
                    validators: {
                        notEmpty: {
                            message: 'Branch is required'
                        }
                    }
                }
            } // fields
        }) // form validation
        .on('success.form.fv', function(e) {
            e.preventDefault(); // prevent form submission

            u.start();

            var $form = $(e.target), // The form instance
                fv = $(e.target).data('formValidation'); // FormValidation instance

            $.ajax({
                url: 'function/bank/UpdateDataBank.php',
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                        console.log(result);
                        var resultObj = JSON.parse(result);
                        console.log(resultObj);
                        u.stop();
                        $form.formValidation('resetForm', true);
                        $('#form-data-update')[0].reset(); // reset all fields
                        $('#form-data-update').children().removeClass('has-success'); // remove class has-success
                        $('button').removeAttr('disabled'); // remove atrribute disabled
                        $('button').removeClass('disabled'); // remove class disabled
                        loadData(); // load data
                        $('#modal-form-update').modal('hide'); // hide modal form add

                        if (resultObj.valid) {
                            $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" + resultObj.valid + "</div>");
                            $('#message').fadeIn('slow', function() {
                                $('#message').fadeOut(7000);
                            });
                        }
                    } // end success
            }); // end ajax
        });

    // delete data bank
    $(document).on('click', '.delete_bank', function(e) {
        e.preventDefault(); /* prevent link address */
        var dataID = $(this).attr('id'); /* get data id */

        $("#confirm").html("Are you sure want to delete?"); /* pop up modals confirmation */
        $('#modal-form-delete').modal('show');
        $('#cancel').click(function() {

            $('#modal-form-delete').modal('hide');
        });

        $('#sure').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'function/bank/DeleteDataBank.php',
                type: 'POST',
                data: {
                    seller_bankID: dataID
                },
                success: function(result) {
                    var resultObj = JSON.parse(result);
                    console.log(result);
                    $('#modal-form-delete').modal('hide'); // hide modal form add
                    if (resultObj.valid) {
                        $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" + resultObj.valid + "</div>");
                        $('#message').fadeIn('slow', function() {
                            $('#message').fadeOut(7000);
                        });
                        loadData();
                    }
                }
            }); // end ajax
        }); // end sure
    }); // end delete
});
