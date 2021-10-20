/* fund wallet approve disapprove code*/
$('.maestro').on('click',function(e){
	e.preventDefault();
	var th = $(this);
	var type = $(this).data('type');
	var trans_id = $(this).data('id');
	var value = $(this).data('value');
	if(confirmDelete(this,'Are you sure to want to '+type+' this fund amount?')){
		$.post(route_url+'/'+trans_id,{_method:"patch","status":value,'status_type':type},function(response){
			if(response.status=='success'){
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
$('.date').datepicker({
    // startView: 1,
    todayBtn: "linked",
    endDate:new Date(),
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: "dd-mm-yyyy"
})
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
    form_url = url_remark+'/'+request_id;
    $('#credit_remark_form').attr('action',form_url);
    $('#credit_remark_form').find('span.username').text(username)
    $('#credit_remark_form').find('input[name=request_id]').val(request_id)
    $('#credit_remark_form').find('textarea[name=remark]').val(remark)
    $('#update_remark').modal('show');

}
/* fund wallet approve disapprove code*/
/* Withdrawal Requests*/
$("#self_withdrawal_request").validate({
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
$('.btn-withdrawal-request').on('click',function(e){
    e.preventDefault();
    var th = $(this);
    var value = $(this).data('value');
    var id = $(this).data('id');

    var username = $('.form-request'+id).find('input[name="username"]').val()
    var withdraw_request_id = $('.form-request'+id).find('input[name="withdraw_request_id"]').val()
    if(value=='1'){
        var status = "approve";
        $('#self_withdrawal_request').find('input[name="transaction_id"]').removeClass('disabled');
        $('#self_withdrawal_request').find('input[name="transaction_id"]').parent().removeClass('hidden');
        $('#self_withdrawal_request').find('input[name="transaction_id"]').rules( "add", {
          required: true,
          messages:{
            required:"Transaction id must be required to approve withdrawal request"
          }
        });
    }else{
        $('#self_withdrawal_request').find('input[name="transaction_id"]').rules('remove');
        $('#self_withdrawal_request').find('input[name="transaction_id"]').attr('disabled','disabled')
        $('#self_withdrawal_request').find('input[name="transaction_id"]').parent().addClass('hidden')
        var status = "reject";      
    }
    $('#self_withdrawal_request').find('input[name="status"]').val(value);
    $('#self_withdrawal_request').find('input[name="request_id"]').val(withdraw_request_id);
    $('#self_withdrawal_request').find('.status').text(status);
    $('#self_withdrawal_request').find('.username').text(username);
    var action_url = route_url;
    action_url = action_url+'/'+withdraw_request_id;
    $('#self_withdrawal_request').attr('action',action_url);
    $('.open-remark-model').modal('show');
});
$('.get-bank-detail').click(function(){
   $user_Id = $(this).data('id') 
   bank_detail_url = bank_detail_url;
   $.post(bank_detail_url,{'user_id':$user_Id},function(response){
        console.log(response.status);
        if(response.status == 'success'){
            $('.bank-detail-model').find('.modal-body').html(response.html);
            $('.bank-detail-model').modal('show');
        }else{

        }
   });
});
$('.withdrawal-bulk-apply').click(function(){
    if($('select[name=withdrawal_bulk_action]').val()==undefined || $('select[name=withdrawal_bulk_action]').val()==''){
        alert("Please select bulk action");
        return false;
    }
    console.log($('select[name=withdrawal_bulk_action]').val());
    if($("input[name='request_ids[]']:checked").length <= 0){
        alert("Please select the transaction to process");
        return false;
    }else{
        
        if(confirm('Are you sure want to update withdrawal requests?')){
            $("#update_withdrawal_requests input[name=status]").val($('select[name=withdrawal_bulk_action]').val());
            $("input[name='request_ids[]']:checked").each(function(){
                var imgArry = $(this).val();
                var html = "<input name='withdraw_request_id[]' value='"+imgArry+"'>";
                $("#update_withdrawal_requests").append(html);
            });
            $("#update_withdrawal_requests").submit()
        }
    }
});
var request_ids  =[];
$('input[name="withdrawal_all"]').click(function(){
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
/* Withdrawal Requests*/
/*Self withdrawal Requests*/

$("#self_withdrawal_request_form").validate({
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
$('.btn-self-request').on('click',function(e){
    e.preventDefault();
    var th = $(this);
    var value = $(this).data('value');
    var id = $(this).data('id');
    var username = $('.form-self-'+id).find('input[name="username"]').val()
    var withdraw_request_id = $('.form-self-'+id).find('input[name="withdraw_request_id"]').val()
    var amount = $('.form-self-'+id).find('input[name="approved_amount"]').val();
    if(parseInt(value) == 1){
        var status = "approve";
        // var amount = th.parent().parent().find('td:eq(1)').text()
        $('#self_withdrawal_request_form').find('input[name="transaction_id"]').removeAttr('disabled');
        $('#self_withdrawal_request_form').find('input[name="transaction_id"]').parent().removeClass('hidden');
        $('#self_withdrawal_request_form').find('input[name="approved_amount"]').removeAttr('disabled');
        $('#self_withdrawal_request_form').find('input[name="approved_amount"]').parent().removeClass('hidden');
        $('#self_withdrawal_request_form').find('input[name="approved_amount"]').rules( "add", {
          required: true,
          number:true,
          max:amount,
          messages:{
            required:"Please enter approved amount"
          }
        });
        $('#self_withdrawal_request_form').find('input[name="transaction_id"]').rules( "add", {
          required: true,
          messages:{
            required:"Transaction id must be required to approve withdrawal request"
          }
        });
        $('#selftrad_withdrawal_request').find('.modal-sm').removeClass('modal-sm').addClass('modal-md');
        $('#selftrad_withdrawal_request').find('textarea[name="remark"]').parent().parent().removeClass('col-lg-12').addClass('col-lg-6')
    }else{
        $('#self_withdrawal_request_form').find('input[name="transaction_id"]').rules('remove');
        $('#self_withdrawal_request_form').find('input[name="transaction_id"]').attr('disabled','disabled');
        $('#self_withdrawal_request_form').find('input[name="transaction_id"]').parent().addClass('hidden');
        $('#self_withdrawal_request_form').find('input[name="approved_amount"]').rules('remove');
        $('#self_withdrawal_request_form').find('input[name="approved_amount"]').attr('disabled','disabled');
        $('#self_withdrawal_request_form').find('input[name="approved_amount"]').parent().addClass('hidden');
        var status = "reject";      
        $('#selftrad_withdrawal_request').find('.modal-md').removeClass('modal-md').addClass('modal-sm')
        $('#selftrad_withdrawal_request').find('textarea[name="remark"]').parent().parent().removeClass('col-lg-6').addClass('col-lg-12')
    }
    $('#self_withdrawal_request_form').find('input[name="status"]').val(value);
    $('#self_withdrawal_request_form').find('input[name="approved_amount"]').val(amount);
    $('#self_withdrawal_request_form').find('input[name="request_id"]').val(withdraw_request_id);
    $('#self_withdrawal_request_form').find('.status').text(status);
    $('#self_withdrawal_request_form').find('.username').text(username);
    var action_url = self_withdrawal;
    action_url = action_url+'/'+withdraw_request_id;

    $('#self_withdrawal_request_form').attr('action',action_url);
    $('#selftrad_withdrawal_request').modal('show');
});
/*Self Withdrawal Requests*/



