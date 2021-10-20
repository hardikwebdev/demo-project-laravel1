var exportBankRequests = function(thi){
	var data = $( "form#filter_data_ajax" ).serialize()
	export_url = export_url+'?'+data
	window.location.href=export_url;
}

$("#ticket_request_form").validate({
     rules: {
         ticket: {
            required: true,
            extension: "jpg|png|gif|jpeg|pdf"
         }
     },
     messages:{
        trans_slip: {
            required: 'Please select payment proof',
            extension: 'Only jpg,png and jpeg files are allowed to select.',
            
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

var ticketRequest = function(th){
	var request_id = $(th).data('id');
	var status = $(th).data('status');
    if(status == '0'){
        var username = $(th).parent().parent().parent().find('.user-name').text();
        var form_url = $('#ticket_request_form').attr('action');
        form_url = form_url+'/'+request_id;
        $('#ticket_request_form').attr('action',form_url);
        $('#ticket_request_form').find('span.username').text(username+"'s")
        $('#ticket_request_form').find('input[name=request_id]').val(request_id)
        $('#ticket_request').modal('show');
    }
    if(status == '2'){
        var username = $(th).parent().parent().parent().find('.user-name').text();
      
        if(confirmDelete(this,'Decline the selected request?')){
            window.location = route_url+'/'+request_id;
        }
    }
}
$('.input-daterange').datepicker();
$(document).ready(function(){
    $('.input-daterange').attr('readonly',true);
})
var exportTicketRequests = function(thi){
	var data = $( "form#filter_request" ).serialize()
    ticket_request_export = ticket_request_export+'?'+data;
	window.location.href=ticket_request_export;
}
var exportTicket2Requests = function(thi){
	var data = $( "form#filter_request" ).serialize()
    ticket_request_export2 = ticket_request_export2+'?'+data;
	window.location.href=ticket_request_export2;
}
var exportTicket3Requests = function(thi){
	var data = $( "form#filter_request" ).serialize()
    ticket_request_export3 = ticket_request_export3+'?'+data;
	window.location.href=ticket_request_export3;
}
