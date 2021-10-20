$("#investment-plan").validate({
    ignore: "",
     rules: {
         name : {
            required: true
         },
         banner_image: {
            required: true,
            extension: "jpg|png|gif|jpeg"
         },
         graph_image: {
            required: true,
            extension: "jpg|png|gif|jpeg"
         },
         banner_image_1 :{
            extension: "jpg|png|gif|jpeg"
         },
         graph_image_1: {
            extension: "jpg|png|gif|jpeg"
         },
         sort_description :{
            required: true,
         },
         description : {
            required: true,
         }
     }
});
$(document).on("click",".delete-record",function(e){
    e.preventDefault();
    var data_name = $(this).attr('data-name');
    var href = $(this).attr('href');
    var result = confirm("Are you sure you want to delete this " + data_name);
    if(result == true){
        location.href = href;
    }
});