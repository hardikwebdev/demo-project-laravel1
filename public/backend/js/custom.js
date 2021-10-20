$(document).ready(function(){
	$.each($.validator.methods, function (key, value) {
		$.validator.methods[key] = function () {           
			if(arguments.length > 0) {
				arguments[0] = $.trim(arguments[0]);
			}
			return value.apply(this, arguments);
		};
	});

	setTimeout(function(){
		$('.alert').hide('100');
	},4000);

	$('[data-toggle="tooltip"]').tooltip();
});
var confirmDelete = function(element,text){
	if(confirm(text)){
		/*alert("True");
		console.log("Confirm Yes ::",text);*/
		return true;
	}else{
		/*alert("false");
		console.log("Confirm No ::",text);
		element.preventDefault()*/;
		return false;
	}

}
var alerthtml = function(alertType='error',message){
	var className = '';
	var type = '';
	if(alertType=='error'){
		className = 'danger';
		type = 'Error';
	}
	if(alertType=='success'){
		className = 'success';
		type = 'Success';
	}
	if(alertType=='warning'){
		className = 'warning';
		type = 'Warning';
	}
	var html = '<div class="alert alert-'+className+'" role="alert"><strong>'+type+'!</strong> '+message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	
	return html;
}

$(document).ready(function(){
	// alert($(window).innerWidth() );
	if($(document).width() <= 980){
		// $('.mini-navbar1').addClass('mini-navbar');
	}
})
