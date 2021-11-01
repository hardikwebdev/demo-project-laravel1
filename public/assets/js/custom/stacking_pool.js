$.validator.addMethod(
    "positiveNumber",
    function(value) {
        return Number(value) > 0;
    },
    amount_must_greater_0
    );
$("#staking_pool").validate({
    ignore: "input[type='text']:hidden",
    rules: {
        amount: {
            required: true,
            number: true,
            positiveNumber:true,
            minlength: 0,
            maxlength: 6,
            min:min, 
            max:max, 
        },
        security_password: {
            required: true,
        },
        duration: {
            required: true,
        },
    },
    messages: {
        amount: {
            required: amount_required_field,
            number: enter_valid_number,
            minlength: please_enter_least_1_characters,
            maxlength: please_enter_no_more_than_6,
        },
        security_password: {
            required: securepassword_required_field,
        },
    }
});