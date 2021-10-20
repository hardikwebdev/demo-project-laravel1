function preview_image(event,selecter) 
{
	var file    = document.querySelector('input[id='+selecter+']').files[0];
	var reader  = new FileReader();

	reader.addEventListener("load", function () {
		$('.'+selecter+'_preview').attr("src",reader.result);
	}, false);

	if (file) {
		reader.readAsDataURL(file);
	}
}
function remove_preview(selecter,is_crop=false,crop_selector="")
{
	if(is_crop == false)
	{
		var src = $('.'+selecter+'_preview').data('src');
		$('.'+selecter+'_preview').attr("src",src);
	}
	else
	{
		$("."+crop_selector).removeClass("hide");
		$(".image-crop").addClass("hide");
	}
}