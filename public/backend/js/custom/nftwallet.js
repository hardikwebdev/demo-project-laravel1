var exportnftwalletRequests = function(thi){
	var data = $( "form#filter_data_ajax" ).serialize()
	exportnft_url = exportnft_url+'?'+data
	window.location.href=exportnft_url;
}
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