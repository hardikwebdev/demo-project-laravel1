var request_ids = [];
$.validator.addMethod('mindate',function(v,el){
    // if (this.optional(el)){
    //     return true;
    // }
    if($("input[name=end]").val() == ''){
    	return true;
    }
    var endDate = $("input[name=end]").datepicker('getDate');

    var startDate = $(el).datepicker('getDate');
    return endDate > startDate;
}, 'Start Date must be less then end date');

$.validator.addMethod('maxdate',function(v,el){
    if (this.optional(el)){
        return true;
    }
    if($("input[name=start]").val() == ''){
    	return false;
    }
    var endDate = $("input[name=end]").datepicker('getDate');

    var startDate = $("input[name=start]").datepicker('getDate');
    return endDate > startDate;
}, 'End date must be greater then start date');

$('#filter_request').validate({
    rules: {
        start: {
            mindate: true,
        },
        end: {
            maxdate: true,
        },
        //the rest of your rules
    },
    //rest of validate options
});

$('#filter_nft_data_ajax').validate({
    rules: {
        start: {
            mindate: true,
        },
        end: {
            maxdate: true,
        },
        //the rest of your rules
    },
    //rest of validate options
});
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
	var action_url = $('#open_remark_model').attr('action');
	action_url = action_url+'/'+withdraw_request_id;
	$('#open_remark_model').attr('action',action_url);
	$('.open-remark-model').modal('show');
});
var exportBankRequests = function(thi){
	var data = $( "form#filter_user_report" ).serialize()
	report_export1 = report_export+'?'+data
	window.location.href=report_export;
}
$(document).ready(function(){
    $('.input-daterange').attr('readonly',true);    
})
$('.input-daterange').datepicker();

var exportReportFunction = function(thi){
	var data = $( "form#filter_user_report" ).serialize()
	report_export = report_export+'?'+data
	window.location.href=report_export;
}

var exportPaymentHistoryFunction = function(thi){
	var data = $( "form#filter_request").serialize()
	report_export = report_export+'?'+data
	window.location.href=report_export;
}

var exportnftPaymentHistoryFunction = function(thi){
	var data = $( "form#filter_request").serialize()
	report_export = report_export+'?'+data
	window.location.href=report_export;
}

var exportstackingpollhistoryFunction = function(thi){
	var data = $( "form#filter_request").serialize()
	report_export = report_export+'?'+data
	window.location.href=report_export;
}


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
		alert("Please select the fund transferred to process");
		return false;
	}else{
		
		if(confirm('Are you sure want to update Fund Transferred requests?')){
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