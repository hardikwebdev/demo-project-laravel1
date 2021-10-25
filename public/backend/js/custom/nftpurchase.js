var exportnftpurchasehistoryFunction = function (thi) {
    var data = $("form#filter_nft_data_ajax").serialize()
    exportnfth_url = exportnfth_url + '?' + data
    window.location.href = exportnfth_url;
}


var exportnftpRequests = function(thi){
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

/* fund wallet approve disapprove code*/
$('.nftreq').on('click',function(e){
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

		$.post(nft_url+'/'+trans_id,{_method:"patch","status":value,'status_type':type},function(response){
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