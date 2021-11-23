var exportnftpurchasehistoryFunction = function(thi) {
    var data = $("form#filter_nft_data_ajax").serialize()
    exportnfth_url = exportnfth_url + '?' + data
    window.location.href = exportnfth_url;
}


var exportnftpRequests = function(thi) {
    var data = $("form#filter_data_ajax").serialize()
    export_url = export_url + '?' + data
    window.location.href = export_url;
}

$(document).ready(function() {
    $('.date').attr('readonly', true);
    $('.input-daterange').attr('readonly', true);
})
if ($(".date").length > 0) {
    $('.date').datepicker({

        // startView: 1,
        todayBtn: "linked",
        endDate: new Date(),
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    })
}

/* fund wallet approve disapprove code*/
$('.nftreq').on('click', function(e) {
    e.preventDefault();
    var th = $(this);
    if (th.hasClass('disabled')) {
        return;
    }
    // alert();
    var type = $(this).data('type');
    var trans_id = $(this).data('id');
    var value = $(this).data('value');
    if (confirmDelete(this, 'Are you sure to want to ' + type + ' this fund amount?')) {
        th.addClass('disabled');
        if (th.hasClass('btn-success')) {
            th.next('a').addClass('disabled');
        } else {
            th.prev('a').addClass('disabled');
        }

        $.post(nft_url + '/' + trans_id, { _method: "patch", "status": value, 'status_type': type }, function(response) {
            if (response.status == 'success') {
                th.removeClass('disabled');

                if (type == 'approve') {
                    var text = '<label class="label label-primary" >Approved</label>';
                    $('#statusproduct').html(" ");
                    $('#statusproduct').html('<label class="label label-success">On Sale</label>');
                } else {
                    $('#statusproduct').html(" ");
                    $('#statusproduct').html('<label class="label label-danger">Declined</label>');
                    var text = '<label class="label label-danger" >Rejected</label>';
                }
                th.parent().html(text);
                // th.parent().parent().html(text);
            } else {
                alert(response.message);
            }

        })
    }
});



$('.counterofferbtn').on('click', function(e) {
    e.preventDefault();
    var th = $(this);
    var type = $(this).data('type');
    var username = $(this).parent().find('input[name="username"]').val();
    var nft_purchase_request_id = $(this).parent().find('input[name="nft_purchase_request"]').val();
    var user_sale_amount = $(this).parent().find('input[name="user_sale_amount"]').val();
    
    $('#open_counter_offer_modal').find('input[name="request_id"]').val(nft_purchase_request_id);
    $('#open_counter_offer_modal').find('.username').text(username);
    $('#open_counter_offer_modal').find('input[name="type"]').val(type);
    $('#open_counter_offer_modal').find('input[name="counter_offer_amount"]').val(user_sale_amount);
    // var action_url = nft_url;
    action_url = nft_url + '/' + nft_purchase_request_id;
    $('#counter_offer_form').attr('action', action_url);
    $('#open_counter_offer_modal').modal('show');
});



$("#counter_offer_form").validate({
    rules: {
        counter_offer_amount: {
            required: true,
        },
        remark: {
            required: true,
            maxlength: 50,
        }
    },
    messages: {
        counter_offer_amount: {
            required: 'Please Enter amount.',
        },
        remark: {
            required: 'Please enter remark.',
        }
    }
});


/* fund wallet approve disapprove code*/
$('.nftonsalereq').on('click', function(e) {
    e.preventDefault();
    var th = $(this);
    if (th.hasClass('disabled')) {
        return;
    }
    // alert();
    var type = $(this).data('type');
    var trans_id = $(this).data('id');
    var value = $(this).data('value');
    if (confirmDelete(this, 'Are you sure to want to ' + type + ' this request?')) {
        th.addClass('disabled');
        if (th.hasClass('btn-success')) {
            th.next('a').addClass('disabled');
        } else {
            th.prev('a').addClass('disabled');
        }

        $.post(nft_on_url + '/' + trans_id, { _method: "patch", "status": value, 'status_type': type }, function(response) {
            if (response.status == 'success') {
                th.removeClass('disabled');
                
                if (type == 'approve') {
                    var text = '<label class="label label-primary" >Approved</label>';
                    $('#onsaleproduct').html(" ");
                    $('#onsaleproduct').html('<label class="label label-success">Processing</label>');
                    setTimeout(function () {
                        location.reload(); 
                    }, 1000);
                    
                } else {
                    $('#onsaleproduct').html(" ");
                    $('#onsaleproduct').html('<label class="label label-danger">Declined</label>');
                    var text = '<label class="label label-danger" >Rejected</label>';
                    setTimeout(function () {
                        location.reload(); 
                    }, 1000);
                }
                th.parent().html(text);
                // th.parent().parent().html(text);
            } else {
                alert(response.message);
            }
        })
    }
});
