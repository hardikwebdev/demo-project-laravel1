
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
          min_stackingpool_amount: {
             required: true,           
             number:true
          },
          bank_usdt_amount: {
             required: true,           
             number:true
          },
          bank_myr_amount: {
             required: true,           
             number:true
          },
          date_format: {
             required: true,           
          },
          nft_commission: {
            required: true,           
            number:true
         },
      },
      messages:{
        admin_email: {
             required: "Please enter admin email address.",           
             email:"Please enter valid email address."
          },
          withdrawal_fee: {
             required: "Please enter withdrawal amount.",           
             number:"Only number should be allowed."
          },
          min_stackingpool_amount: {
             required: "Please enter stackingpool amount.",           
             number:"Only number should be allowed."
          },
          bank_usdt_amount: {
              required: "Please enter USD to USDT amount.",           
             number:"Only number should be allowed."
          },
          bank_myr_amount: {
              required: "Please enter USD to MYR amount.",           
             number:"Only number should be allowed."
          },
          date_format: {
             required: "Please select date format.",           
          },
          nft_commission: {
            required: "Please enter NFT commission.",           
           number:"Only number should be allowed."
        },
     }
 });




// $("#bank_setting").validate({
//      rules: {
//          remark: {
//             required: true,           
//          },
//          remark: {
//             required: true,           
//          },
//          remark: {
//             required: true,           
//          },
//          remark: {
//             required: true,           
//          },
//          remark: {
//             required: true,           
//          },
//          remark: {
//             required: true,           
//          },
//      },
//      messages:{
//         remark: {
//             required: "",           
//          },
//          remark: {
//             required: "",           
//          },
//          remark: {
//             required: "",           
//          },
//          remark: {
//             required: "",           
//          },
//          remark: {
//             required: "",           
//          },
//          remark: {
//             required: "",           
//          },
//     }
// });

// $("#product_setting").validate({
//      rules: {
//          remark: {
//             required: true,           
//             maxlength:500
//          }
//      },
//      messages:{
//         remark: {
//             required: 'Please enter remark for withdrawal request',
            
//         }
//     }
// });
