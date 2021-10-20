$("#mt4_request_export").validate({
     rules: {
         daterange: {
            required: true
         },

     },
     messages:{
        message: {
            required: 'Please Select date range..',
            
        }
    }
});
$("#mt4_request_import").validate({
     rules: {
         mt4_file_import: {
            required: true,
            extension: "csv|xlsx|xls"
         },

     },
     messages:{
        mt4_file_import: {
            required: 'Please Select file to import data..',
            extension: 'Only .csv,.xls and .xlsx files are allowed to import',
            
        }
    }
});
var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}
$(document).ready(function(){
    $('input[name="daterange"]').attr('readonly',true);
    $('.input-daterange').attr('readonly',true);    
})

$('input[name="daterange"]').daterangepicker({
	startDate: start,
	endDate: end,
	maxDate:new Date(),
	autoApply:true,
	autoUpdateInput:true,
	locale: {
      format: 'M/DD/YYYY'
    }
});

 $('.input-daterange').datepicker();