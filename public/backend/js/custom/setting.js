var request_ids = [];


$("#genral_setting").validate({
     rules: {
         admin_email: {
            required: true,           
            email:true
         },
         withdrawal_fee: {
         	required: true,           
            number:true
         },
         withdrawal_window_from_day: {
         	required: true,           
            number:true
         },
         withdrawal_window_to_day: {
         	required: true,           
            number:true
         },
         allow_first_withdrawal_after_days: {
         	required: true,           
            number:true
         },
         min_withdrawal_request_amount: {
         	required: true,           
            number:true
         },
     },
     messages:{
       admin_email: {
            required: "Please enter admin email address",           
            email:"Please enter valid email address"
         },
         withdrawal_fee: {
         	required: "Please enter withdrawal amunt",           
            number:"Only number should be allowed"
         },
         withdrawal_window_from_day: {
         	// required: "",           
            number:"Only number should be allowed"
         },
         withdrawal_window_to_day: {
         	// required: "",           
            number:"Only number should be allowed"
         },
         allow_first_withdrawal_after_days: {
         	// required: "",           
            number:"Only number should be allowed"
         },
         min_withdrawal_request_amount: {
         	// required: "",           
            number:"Only number should be allowed"
         },
    }
});

$("#bank_setting").validate({
     rules: {
         remark: {
            required: true,           
         },
         remark: {
            required: true,           
         },
         remark: {
            required: true,           
         },
         remark: {
            required: true,           
         },
         remark: {
            required: true,           
         },
         remark: {
            required: true,           
         },
     },
     messages:{
        remark: {
            required: "",           
         },
         remark: {
            required: "",           
         },
         remark: {
            required: "",           
         },
         remark: {
            required: "",           
         },
         remark: {
            required: "",           
         },
         remark: {
            required: "",           
         },
    }
});

$("#product_setting").validate({
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
