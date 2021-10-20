//upload proof approove and decline 
/* fund wallet approve disapprove code*/
$('.maestro').on('click',function(e){
	e.preventDefault();
	var th = $(this);
    var type = $(this).data('type');
    var username = $(this).data('username');
	var id = $(this).data('id');
	var value = $(this).data('value');
     $('#append').parent().find('.row:eq(0)').remove();
    $.get(detail_url+'/'+id,function(response){
        if(response.status == 'success'){
            $('#append').before(response.html);
        }
    })
    $('#remark_decline').modal('show');
    $('#remark_decline').find('.remark-decline').show();
    $('#remark_decline').find('.btn-success').text('Decline');
    $('#remark_decline').find('.modal-title').html('Decline proof request of <strong>'+username+'</strong>');
    if(type == 'approve'){
        $('#remark_decline').find('.remark-decline').hide();
        $('#remark_decline').find('.btn-success').text('Approve');
        $('#remark_decline').find('.modal-title').html('Approve proof request of <strong>'+username+'</strong>');
    }
    $('#remark_decline').find('.proof_id').val(id);
    // $('#remark_decline').find('.username').text(username);
    $('#remark_decline').find('.status_value').val(value);
});
/**validaiton on decline remark */
$("#proof_request_update").validate({
    rules: {
        remark: {
           required: true,           
           maxlength:500
        },
    },
    messages:{
        remark: {
           required: 'Please enter remark.',
       }
   }
});
var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
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

 $('.input-daterange').datepicker();