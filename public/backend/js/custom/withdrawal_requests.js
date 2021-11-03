var request_ids = [];



var getBankProof = function(th){
	
	var id = th.data('id');
	var type = th.data('type');
	$.post(detail_url,{wrid:id,type:type},function(response){
        if(response.status == 'success'){
            $('.remark-decline').html(response.html);
            $("#remark_decline").modal('show');
        }else{
        	alert('Bank Proofs are not available');
        }
    });
}

/* fund wallet approve disapprove code*/
$('.btn-status').on('click',function(e){
	e.preventDefault();
	var th = $(this);
	var value = $(this).data('value');
	var type = $(this).data('original-title').toLowerCase();

	var username = $(this).parent().find('input[name="username"]').val()
	var withdraw_request_id = $(this).parent().find('input[name="withdraw_request_id"]').val()
	if(value=='1'){
		var status = "approve";
		$('#open_remark_model').find('input[name="transaction_id"]').removeAttr('disabled');
		$('#open_remark_model').find('input[name="transaction_id"]').removeClass('disabled');
		$('#open_remark_model').find('input[name="transaction_id"]').parent().removeClass('hidden');
		$('#open_remark_model').find('input[name="transaction_id"]').rules( "add", {
		  required: true,
		  messages:{
		  	required:"Transaction id must be required to approve withdrawal request"
		  }
		});
	}else{
		$('#open_remark_model').find('input[name="transaction_id"]').rules('remove');
		$('#open_remark_model').find('input[name="transaction_id"]').attr('disabled','disabled')
		$('#open_remark_model').find('input[name="transaction_id"]').parent().addClass('hidden')
		var status = "reject";		
	}
	$('#open_remark_model').find('input[name="status"]').val(value);
	$('#open_remark_model').find('input[name="request_id"]').val(withdraw_request_id);
	$('#open_remark_model').find('.status').text(status);
	$('#open_remark_model').find('.username').text(username);
	// var action_url = update_url;
	action_url = update_url+'/'+withdraw_request_id;
	// $('#open_remark_model').attr('action',action_url);
	$('.open-remark-model').modal('show');
});
var exportBankRequests = function(thi){
	var data = $( "form#filter_request" ).serialize()
	export_url = export_url+'?'+data
	window.location.href=export_url;
}

$(document).ready(function(){
    $('.date').attr('readonly',true);
    $('.input-daterange').attr('readonly',true);
})
$('.date').datepicker({
    // startView: 1,
    todayBtn: "linked",
    endDate:new Date(),
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: "dd-mm-yyyy"
})
$("#open_remark_model").validate({
     rules: {
         remark: {
            required: true,           
            maxlength:500
         }
     },
     messages:{
        remark: {
            required: 'Please enter remark for withdrawal request',
            
        }
    }
});

 

$('#open_remark_modal').on('hidden.bs.modal', function() {
    $('#open_remark_modal form')[0].reset();
    $("label.error").hide();
});

// $('#remark_decline').on('hidden.bs.modal', function() {
//     $('#remark_decline form')[0].reset();
//     $("label.error").hide();
// });


$('input[name="checkall"]').click(function(){
	if($(this).is(":checked")){
		$("input[name='request_ids[]']").each(function(){
			$(this).prop('checked',true);
			request_ids.push($(this).val());
		});
	}else{
		$("input[name='request_ids[]']").each(function(){
			$(this).prop('checked',false);
		});
		request_ids = [];
	}

});

$('.bulk-apply').click(function(){
	if($('select[name=bulk_action]').val()==undefined || $('select[name=bulk_action]').val()==''){
		alert("Please select bulk action");
		return false;
	}
	console.log($('select[name=bulk_action]').val());
	if($("input[name='request_ids[]']:checked").length <= 0){
		alert("Please select the transaction to process");
		return false;
	}else{
		
		if(confirm('Are you sure want to update withdrawal requests?')){
			$("#update_withdrawal_requests input[name=status]").val($('select[name=bulk_action]').val());
			$("input[name='request_ids[]']:checked").each(function(){
				var imgArry = $(this).val();
				var html = "<input name='withdraw_request_id[]' value='"+imgArry+"'>";
				$("#update_withdrawal_requests").append(html);
			});
			$("#update_withdrawal_requests").submit()
		}
	}
});

var opFundWallet = function(th){
	var request_id = $(th).data('id');
	var amount = $(th).data('amount');
	var username = $(th).data('username');
	var form_url = $('#credit_request_form').attr('action');
	form_url = form_url+'/'+request_id;
	$('#credit_request_form').attr('action',form_url);
 	$('#credit_request_form').find('span.username').text(username)
 	$('#credit_request_form').find('input[name=request_id]').val(request_id)
 	$('#credit_request_form').find('input[name=amount]').val(amount)
	$('#edit_credit_request').modal('show');

}



/* MT4 Withdrawal Request Javascript  */
$('.mt4-btn-status').on('click',function(e){
	e.preventDefault();
	var th = $(this);
	var value = $(this).data('value');
	var type = $(this).data('original-title').toLowerCase();

	var username = $(this).parent().find('input[name="username"]').val()
	var withdraw_request_id = $(this).parent().find('input[name="withdraw_request_id"]').val()
	var amount = $(this).parent().find('input[name="approved_amount"]').val()
	if(value=='1'){
		var status = "approve";
		var amount = th.parent().parent().find('td:eq(1)').text()
		$('#mt4_withdrawal_request_form').find('input[name="transaction_id"]').removeAttr('disabled');
		$('#mt4_withdrawal_request_form').find('input[name="transaction_id"]').parent().removeClass('hidden');
		$('#mt4_withdrawal_request_form').find('input[name="approved_amount"]').removeAttr('disabled');
		$('#mt4_withdrawal_request_form').find('input[name="approved_amount"]').parent().removeClass('hidden');
		$('#mt4_withdrawal_request_form').find('.col-lg-12').removeClass('col-lg-12').addClass('col-lg-6');
		$('#mt4_withdrawal_request_form').find('input[name="approved_amount"]').rules( "add", {
		  required: true,
		  number:true,
		  max:amount,
		  messages:{
		  	required:"Please enter approved amount"
		  }
		});
		$('#mt4_withdrawal_request_form').find('input[name="transaction_id"]').rules( "add", {
		  required: true,
		  messages:{
		  	required:"Transaction id must be required to approve withdrawal request"
		  }
		});
	}else{
		$('#mt4_withdrawal_request_form').find('input[name="transaction_id"]').rules('remove');
		$('#mt4_withdrawal_request_form').find('input[name="transaction_id"]').attr('disabled','disabled');
		$('#mt4_withdrawal_request_form').find('input[name="transaction_id"]').parent().addClass('hidden');
		$('#mt4_withdrawal_request_form').find('input[name="approved_amount"]').rules('remove');
		$('#mt4_withdrawal_request_form').find('input[name="approved_amount"]').attr('disabled','disabled');
		$('#mt4_withdrawal_request_form').find('input[name="approved_amount"]').parent().addClass('hidden');
		$('#mt4_withdrawal_request_form').find('.col-lg-6').removeClass('col-lg-6').addClass('col-lg-12');
		var status = "reject";		
	}
	$('#mt4_withdrawal_request_form').find('input[name="status"]').val(value);
	$('#mt4_withdrawal_request_form').find('input[name="approved_amount"]').val(amount);
	$('#mt4_withdrawal_request_form').find('input[name="request_id"]').val(withdraw_request_id);
	$('#mt4_withdrawal_request_form').find('.status').text(status);
	$('#mt4_withdrawal_request_form').find('.username').text(username);
	var action_url = mt4_withdrawal;
	action_url = action_url+'/'+withdraw_request_id;
	$('#mt4_withdrawal_request_form').attr('action',action_url);
	$('.open-remark-model').modal('show');
});
$("#mt4_withdrawal_request_form").validate({
     rules: {
         remark: {
            required: true,           
            maxlength:500
         }
     },
     messages:{
        remark: {
            required: 'Please enter remark for withdrawal request',
            
        }
    }
});
var exportMt4equests = function(thi){
	var data = $( "form#mt4_withdrawal_requests" ).serialize()
	mt4_export_url = mt4_export_url+'?'+data
	window.location.href=mt4_export_url;
}
/* MT4 Withdrawal Request Javascript  */


/* MT4 Topup Withdrawal Request Javascript  */
$('.mt4-topup-btn-status').on('click',function(e){
	e.preventDefault();
	var th = $(this);
	var value = $(this).data('value');
	var type = $(this).data('original-title').toLowerCase();
	var username = $(this).parent().find('input[name="username"]').val()
	var withdraw_request_id = $(this).parent().find('input[name="withdraw_request_id"]').val()
	var amount = $(this).parent().find('input[name="approved_amount"]').val();
	if(parseInt(value) == 1){
		var status = "approve";
		var amount = th.parent().parent().find('td:eq(1)').text()
		$('#mt4_topup_request_form').find('input[name="transaction_id"]').removeAttr('disabled');
		$('#mt4_topup_request_form').find('input[name="transaction_id"]').parent().removeClass('hidden');
		$('#mt4_topup_request_form').find('input[name="approved_amount"]').removeAttr('disabled');
		$('#mt4_topup_request_form').find('input[name="approved_amount"]').parent().removeClass('hidden');
		$('#mt4_topup_request_form').find('input[name="approved_amount"]').rules( "add", {
		  required: true,
		  number:true,
		  max:amount,
		  messages:{
		  	required:"Please enter approved amount"
		  }
		});
		$('#mt4_topup_request_form').find('input[name="transaction_id"]').rules( "add", {
		  required: true,
		  messages:{
		  	required:"Transaction id must be required to approve withdrawal request"
		  }
		});
		$('#mt4_topup_withdrawal_request').find('.modal-sm').removeClass('modal-sm').addClass('modal-md');
		$('#mt4_topup_withdrawal_request').find('textarea[name="remark"]').parent().parent().removeClass('col-lg-12').addClass('col-lg-6')
	}else{
		$('#mt4_topup_request_form').find('input[name="transaction_id"]').rules('remove');
		$('#mt4_topup_request_form').find('input[name="transaction_id"]').attr('disabled','disabled');
		$('#mt4_topup_request_form').find('input[name="transaction_id"]').parent().addClass('hidden');
		$('#mt4_topup_request_form').find('input[name="approved_amount"]').rules('remove');
		$('#mt4_topup_request_form').find('input[name="approved_amount"]').attr('disabled','disabled');
		$('#mt4_topup_request_form').find('input[name="approved_amount"]').parent().addClass('hidden');
		var status = "reject";		
		$('#mt4_topup_withdrawal_request').find('.modal-md').removeClass('modal-md').addClass('modal-sm')
		$('#mt4_topup_withdrawal_request').find('textarea[name="remark"]').parent().parent().removeClass('col-lg-6').addClass('col-lg-12')
	}
	$('#mt4_topup_request_form').find('input[name="status"]').val(value);
	$('#mt4_topup_request_form').find('input[name="approved_amount"]').val(amount);
	$('#mt4_topup_request_form').find('input[name="request_id"]').val(withdraw_request_id);
	$('#mt4_topup_request_form').find('.status').text(status);
	$('#mt4_topup_request_form').find('.username').text(username);
	var action_url = mt4_topup_withdrawal;
	action_url = action_url+'/'+withdraw_request_id;

	$('#mt4_topup_request_form').attr('action',action_url);
	$('#mt4_topup_withdrawal_request').modal('show');
});
$("#mt4_topup_request_form").validate({
     rules: {
         remark: {
            required: true,           
            maxlength:500
         }
     },
     messages:{
        remark: {
            required: 'Please enter remark for withdrawal request',
            
        }
    }
});
var exportMt4TopupRequests = function(thi){
	var data = $( "form#mt4_withdrawal_requests" ).serialize()
	mt4_export_url = mt4_export_url+'?'+data
	window.location.href=mt4_export_url;
}
/* MT4 Topup Withdrawal Request Javascript  */


$("#pips_rebate").validate({
     rules: {
         importFile: {
			required: true,           
			extension: "csv"
            // extension:'html|htm'
         }
     },
     messages:{
        importFile: {
            required: 'Please select file for update commission',
            extension: 'Please select only csv file',
        }
    }
});
$("#profit_sharing").validate({
     rules: {
         profit_sharing: {
            required: true,           
            extension: "csv"
         }
     },
     messages:{
        remark: {
            required: 'Please select file for update commission',
            extension: 'Please select only csv file',
            
        }
    }
});

/*00*/
var self_trade_ids = [];

$('.bulk-request-apply').click(function(){
	if($('select[name=bulk_action]').val()==undefined || $('select[name=bulk_action]').val()==''){
		alert("Please select bulk action");
		return false;
	}
	console.log($('select[name=bulk_action]').val());
	if($("input[name='self_trade_ids[]']:checked").length <= 0){
		alert("Please select the transaction to process");
		return false;
	}else{
		
		if(confirm('Are you sure want to update account requests?')){
			$("#update_self_trade_requests input[name=status]").val($('select[name=bulk_action]').val());
			$("input[name='self_trade_ids[]']:checked").each(function(){
				var imgArry = $(this).val();
				var html = "<input name='withdraw_request_id[]' value='"+imgArry+"'>";
				$("#update_self_trade_requests").append(html);
			});
			$("#update_self_trade_requests").submit()
		}
	}
});
$('.self-request-change').on('click',function(e){
	e.preventDefault();
	var th = $(this);
	var value = $(this).data('value');
	var type = $(this).data('original-title').toLowerCase();
	th.parent().find('input[name=status]').val(value);
	if(value=='1'){
		var message = 'Are you sure want to approve this request ?';
	}else{
		var message = 'Are you sure want to reject  this request ?';

	}
	if(confirm(message)){
		th.parent().submit();
	}	
});
$('input[name="self_request"]').click(function(){
	if($(this).is(":checked")){
		$("input[name='self_trade_ids[]']").each(function(){
			$(this).prop('checked',true);
			self_trade_ids.push($(this).val());
		});
	}else{
		$("input[name='self_trade_ids[]']").each(function(){
			$(this).prop('checked',false);
		});
		self_trade_ids = [];
	}

});
var exportBankRequests = function(thi){
	var data = $( "form#filter_request" ).serialize()
	export_url = export_url+'?'+data
	window.location.href=export_url;
}
/*00*/