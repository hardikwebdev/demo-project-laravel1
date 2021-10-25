/* fund wallet approve disapprove code*/
$('.maestro').on('click',function(e){
	e.preventDefault();
	var th = $(this);
    if(th.hasClass('disabled')){
        return;
    }
    // alert();
	var type = $(this).data('type');
	var trans_id = $(this).data('id');
	var value = $(this).data('value');
	if(confirmDelete(this,'Are you sure to want to '+type+' this fund amount?')){
        th.addClass('disabled');
       if(th.hasClass('btn-success')){
         th.next('a').addClass('disabled');
       }else{
         th.prev('a').addClass('disabled');
       }

		$.post(route_url+'/'+trans_id,{_method:"patch","status":value,'status_type':type},function(response){
			if(response.status=='success'){
                    th.removeClass('disabled');

				if(type == 'approve'){
					var text = '<label class="label label-primary" >Approved</label>';
				}else{
					var text = '<label class="label label-danger" >Rejected</label>';
				}
				th.parent().html(text);
				// th.parent().parent().html(text);
			}else{
				alert(response.message);
			}

		})
	}
});
var exportBankRequests = function(thi){
	var data = $( "form#filter_data_ajax" ).serialize()
	export_url = export_url+'?'+data
	window.location.href=export_url;
}
$(document).ready(function(){
    $('.date').attr('readonly',true);
    $('.input-daterange').attr('readonly',true);
})
if ($(".date").length > 0) {
    $('.date').datepicker({
        
        // startView: 1,
        todayBtn: "linked",
        endDate:new Date(),
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    })
}
$("#credit_request_form").validate({
     rules: {
         amount: {
            required: true,
            number: true
         },
         trans_slip: {
            // required: true,
            extension: "jpg|png|gif|jpeg|pdf"
         }
     },
     messages:{
     	amount: {
            required: 'Please Enter amount.',
            number: 'Please enter valid amount'
        },
        trans_slip: {
            required: 'Please select payment proof',
            extension: 'Only jpg,png and jpeg files are allowed to select.',
            
        }
    }
});
$("#credit_remark_form").validate({
    rules: {
        remark:{
            required:true,
            maxlength: 500
        }
    },
    messages:{
        remark: {
            required: 'Please enter remark',
            number: 'Please enter valid amount'
        }
    }
});


$("#fund_wallets").validate({
     rules: {
         amount: {
            required: true,
            number: true
         },
         description: {
            required: true,
            maxlength: 500
         }
     },
     messages:{
     	amount: {
            required: 'Please Enter amount.',
            number: 'Please enter valid amount'
        },
        description: {
            required: 'Please enter description',
            
        }
    }
});

var opFundWallet = function(th){
	var request_id = $(th).data('id');
	var amount = $(th).data('amount');
	var username = $(th).data('username');
	var form_url = $('#credit_request_form').attr('action');
	form_url = route_url+'/'+request_id;
	$('#credit_request_form').attr('action',form_url);
 	$('#credit_request_form').find('span.username').text(username)
 	$('#credit_request_form').find('input[name=request_id]').val(request_id)
 	$('#credit_request_form').find('input[name=amount]').val(amount)
	$('#edit_credit_request').modal('show');

}
var updateRemark = function(th){
    var request_id = $(th).data('id');
    var amount = $(th).data('amount');
    var username = $(th).data('username');
    var remark = $('.txt-remark-'+request_id).text();
    var form_url = $('#credit_request_form').attr('action');
    // alert(url_remark);
    form_url = url_remark+'/'+request_id;
    $('#credit_remark_form').attr('action',form_url);
    $('#credit_remark_form').find('span.username').text(username)
    $('#credit_remark_form').find('input[name=request_id]').val(request_id)
    $('#credit_remark_form').find('textarea[name=remark]').val(remark)
    $('#update_remark').modal('show');

}

var bank_request_ids = [];
$('.bank-credit-request input[name="checkall"]').click(function(){
    if($(this).is(":checked")){
        $("input[name='request_ids[]']").each(function(){
            if($(this).prop('disabled') !== true){
                $(this).prop('checked',true);
                bank_request_ids.push($(this).val());
            }
        });
    }else{
        $("input[name='request_ids[]']").each(function(){
            if($(this).prop('disabled') !== true){
                $(this).prop('checked',false);
            }
        });
        bank_request_ids = [];
    }

});

$('.bank-credit-request .bulk-apply').click(function(){
    if($('select[name=bulk_action]').val()==undefined || $('select[name=bulk_action]').val()==''){
        alert("Please select bulk action");
        return false;
    }
    console.log($('select[name=bulk_action]').val());
    if($("input[name='request_ids[]']:checked").length <= 0){
        alert("Please select the transaction to process");
        return false;
    }else{
        
        if(confirm('Are you sure want to update credit requests?')){
            $("#update_withdrawal_requests input[name=status]").val($('select[name=bulk_action]').val());
            $("input[name='request_ids[]']:checked").each(function(){
                var imgArry = $(this).val();
                var html = "<input name='bank_credit_request[]' value='"+imgArry+"'>";
                $("#update_withdrawal_requests").append(html);
            });
            $("#update_withdrawal_requests").submit()
        }
    }
});
