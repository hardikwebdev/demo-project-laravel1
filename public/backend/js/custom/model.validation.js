 $.validator.addMethod(
        "alphanumeric",
        function(value, element) {
            return this.optional(element) || /^[\w.]+$/i.test(value);
        },
        'This field consists of Letters, numbers, and underscores only.'
    );
    $.validator.addMethod(
        "positiveNumber",
        function(value) {
            return Number(value) > 0;
        },
        'Amount must be greater than 0'
    );
    $.validator.addMethod("regex", function(value, element, regexpr) {          
     return regexpr.test(value);
   }, "Please enter a valid value.");    
/* fund wallet approve disapprove code*/
/*Update Fund Wallet Amount*/
$("#fund_wallet_form").validate({
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
/*Update Fund Wallet Amount*/
/*Update Leader Bounus Amount*/
$("#leader_bonus_form").validate({
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
/*Update Leader Bounus Amount*/
/*Update MT4 Topup Amount*/
$("#mt4_topup_form").validate({
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
/*Update MT4 Topup Amount*/
/*Update Mt4 Wallet Amount*/
$("#mt4_wallet_form").validate({
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
/*Update Mt4 Wallet Amount*/
/*Update Pips Rebate Amount*/
$("#pips_rebate_form").validate({
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
/*Update Pips Rebate Amount*/
/*Update Pips Rebate Commission Amount*/
$("#pips_commission_form").validate({
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
/*Update Pips Rebate Commission Amount*/
/*Update Overriding wallet Amount*/
$("#overriding_form").validate({
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
/*Update Overriding wallet Amount*/
/*Update Profit Sharing Amount*/
$("#profit_sharing_form").validate({
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
/*Update Profit Sharing Amount*/
