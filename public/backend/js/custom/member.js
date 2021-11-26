/* fund wallet approve disapprove code*/
$('input[name="sponsor"]').on('keyup',function(){ $(this).parent().parent().parent().find('.help-block').text("") })
$('.verify-sponser').on('click',function(){
	var th = $(this);
	th.parent().parent().find('.help-block').text("");
	th.parent().parent().find('.help-block').text();
	var	sponsor = $('input[name=sponsor]').val();
	if(sponsor.trim()!=""){
		$.post(verify_sponsor,{"sponsor_username":sponsor},function(response){
			var resp = $.parseJSON(response);
			if(resp.valid){
                // th.parent().parent().parent().find('.help-block').text('The Sponsor username is verified.').addClass('text-navy').removeClass('text-danger');
                $(th).closest(".form-group-all").find("#sponsor_check").val(sponsor);
                $(th).closest(".form-group-all").find(".cus-success-sponsor").show(100);
                $(th).closest(".form-group-all").find(".cus-error-sponsor").hide(100);
                $(th).closest(".form-group-all").find(".sponsor_check-error").hide(100);
                $(th).closest(".form-group-all").find("#sponsor_check-error").hide(100);
                $(th).closest(".form-group-all").find("#sponsor_username").removeClass('error');
                $(th).closest(".form-group-all").find("#sponsor_username-error").hide(100);
        }else{
                // th.parent().parent().parent().find('.help-block').text('The Sponsor user is not found or not a valid sponsor. Please enter another sponsor username.');
                $(th).closest(".form-group-all").find(".cus-error-sponsor").show(100);
                $(th).closest(".form-group-all").find("#sponsor_username-error").show(100);
                $(th).closest(".form-group-all").find(".cus-success-sponsor").hide(100);
			}
		})

	}else{
		th.parent().parent().parent().find('.help-block').text('Please enter sponsor name');
	}
})



$(document).on("change", "input[name=child_position]", function(e) {
    $("#placement_check").val('');
});



/* fund wallet approve disapprove code*/
$('input[name="placement_username"]').on('keyup', function() { $(this).parent().parent().parent().find('.help-block').text("") })
$('.verify-placement').on('click', function() {
    var th = $(this);
    th.parent().parent().find('.help-block').text("");
    th.parent().parent().find('.help-block').text();

    var placement_username = $('#placement_username').val();
    var sponsor_check = $("#sponsor_check").val();
    var child_position = $("input[name='child_position']:checked").val();


    if (placement_username.trim() != "") {
        $.post(placementUsernameExits, {
            _token: $("input[name=_token]").val(),
            placement_username: placement_username,
            sponsor_check: sponsor_check,
            child_position: child_position
        }, function(data) {
            var parsed_data = JSON.parse(data);
            if (parsed_data.valid == true) {
                $("#placement_check").val(placement_username);
                $(".cus-success-placement").show(100);
                $(".cus-error-placement").hide(100);
                $(".placement_check-error").hide(100);
                $("#placement_check-error").hide(100);
                $("#placement_username").removeClass('error');
                $("#placement_username-error").hide(100);
            } else {
                $(".cus-error-placement").show(100);
                $("#placement_username-error").show(100);
                $(".cus-success-placement").hide(100);
            }
            // if (parsed_data.valid) {
            //     $(th).closest(".form-group-all").find("#placement_check").val(placement_username);
            //     $(th).closest(".form-group-all").find(".cus-success-sponsor").show(100);
            //     $(th).closest(".form-group-all").find(".cus-error-sponsor").hide(100);
            //     $(th).closest(".form-group-all").find(".sponsor_check-error").hide(100);
            //     $(th).closest(".form-group-all").find("#sponsor_check-error").hide(100);
            //     $(th).closest(".form-group-all").find("#sponsor_username").removeClass('error');
            //     $(th).closest(".form-group-all").find("#sponsor_username-error").hide(100);
            // } else {
            //     $(th).closest(".form-group-all").find(".cus-error-sponsor").show(100);
            //     $(th).closest(".form-group-all").find("#sponsor_username-error").show(100);
            //     $(th).closest(".form-group-all").find(".cus-success-sponsor").hide(100);
            // }
        })

    } else {
        th.parent().parent().parent().find('.help-block').text('Please enter placement name');
    }
})



/* fund wallet approve disapprove code*/

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
        'Value must be greater than 0'
    );
    $.validator.addMethod("regex", function(value, element, regexpr) {          
     return regexpr.test(value);
   }, "Please enter a valid value.");    
/* fund wallet approve disapprove code*/


$.validator.addMethod('ge', function(value, element, param) {
      return this.optional(element) || value >= $(param).val();
}, 'Invalid value.');


$.validator.addMethod('noSpace', function(value, element) {
    return value.indexOf(" ") < 0 && value != "";
}, 'No space please.');

$("#customer_register").on('submit',function(e){
	if(!$(this).validate()){
		e.preventDefault();
	}
});

jQuery.validator.addMethod("issponserverified", function(value, element) {
    var sponser_username = $('#sponsor_username').val().trim();
    var varifiedSponser = $('#sponsor_check').val();
    if(varifiedSponser != '' && sponser_username != varifiedSponser){
        return false;
    }  else if(sponser_username !=  '' && varifiedSponser == ''){
        return false;
    } else {
        return  true;
    }
}, 'Please verify the entered sponsor details.');





jQuery.validator.addMethod("isplacementverified", function(value, element) {
    var placement_username = $('#placement_username').val().trim();
    var varifiedPlacement = $('#placement_check').val();
    if (varifiedPlacement != '' && placement_username != varifiedPlacement) {
        return false;
    } else if (placement_username != '' && varifiedPlacement == '') {
        return false;
    } else {
        return true;
    }
}, "Please verify the entered placement details.");


jQuery.validator.addMethod("checksponserverified", function(value, element) {
    var sponser_username = $('#sponsor_username').val().trim();
    var varifiedSponser = $('#sponsor_check').val();
    if(varifiedSponser != '' && sponser_username != varifiedSponser){
        return false;
    }  else if(sponser_username !=  '' && varifiedSponser == ''){
        return false;
    }  else if(sponser_username ==  ''){
        return false;
    } else {
        return  true;
    }
}, "Please verify the sponsor id first.");
$.validator.addMethod(
        "alphanumeric1",
        function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\b]+$/i.test(value);
        },
        'This field consists of Letters and numbers only.'
    );
$('#country_id').on('change',function(e){
        e.preventDefault();
        if($(this).val() != '131'){
            $('#ic_number').attr('maxlength','');
        }else{
            $('#ic_number').attr('maxlength','12');
        }
})


// var sigpad = $('#sigpad').signature({syncField: '#signature', syncFormat: 'PNG'});
// $('#clear').click(function(e) {
//     e.preventDefault();
//     sigpad.signature('clear');
//     $("#signature").val('');
// });
$('#fullname').on('keypress keydown keyup',function(){
    var name = $(this).val();
    $('#acc_holder_name').val(name);
});


$("#customer_register").validate({
    ignore: "input[type='text']:hidden",
    rules: {
        sponsor: {
            required: true,
            alphanumeric: true,
            minlength: 3,
            maxlength: 50,
            issponserverified: true,
        },
        placement_username: {
            required: true,
            alphanumeric: true,
            minlength: 3,
            maxlength: 50,
            checksponserverified: true,
            isplacementverified: true
        },
        // sponsor_check: {
        //     required: true,
        // },
        // placement_check: {
        //     required: true,
        // },
        name: {
            required: true,
            maxlength: 50,
        },
        username: {
            required: true,
            alphanumeric: true,
            minlength: 3,
            maxlength: 50,
            /*
            remote: {
                url: usernameExits,
                type: "post",
                data: {
                    _token: $("input[name=_token]").val()
                },
                dataFilter: function(data) {
                    var data = JSON.parse(data);
                    if (data.valid != true) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }*/
        },
        address: {
            required: true,
            maxlength: 100,
        },
        city: {
            required: true,
            maxlength: 50,
        },
        state: {
            required: true,
            maxlength: 50,
        },
        country: {
            required: true,
            number: true,
        },
        ic_number: {
            required: true,
            alphanumeric1: true,
            maxlength: function() {
                if ($('#country_id').val() == '131') {
                    return '12';
                }
            },
            checksponserverified: true,
            remote: {
                url: icNumberDuplication,
                type: "post",
                data: {
                    _token: $("input[name=_token]").val(),
                    sponsor_username: function() {
                        return $("#sponsor_username").val();
                    }
                },
                dataFilter: function(data) {
                    var data = JSON.parse(data);
                    if (data.valid == true || data.valid == 'false') {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        },
        email: {
            required: true,
            email: true,
            maxlength: 50,
            // remote: {
            //     url: emailExists,
            //     type: "post",
            //     data: {
            //         _token: $("input[name=_token]").val()
            //     },
            //     dataFilter: function(data) {
            //         var data = JSON.parse(data);
            //         if (data.valid != true) {
            //             return false;
            //         } else {
            //             return true;
            //         }
            //     }
            // }
        },
        phone_number: {
            required: true,
            number: true,
            minlength:10,
            maxlength: 15,
        },
        password: {
            required: true,
            minlength: 8,
            maxlength: 15
        },
        retype_password: {
            required: true,
            equalTo: "#password"
        },
        secure_password: {
            required: true,
            minlength: 8,
            maxlength: 15
        },
        retype_secure_password: {
            required: true,
            equalTo: "#secure_password"
        },
        bank_name: {
            required: true,
            maxlength: 50,
        },
        acc_holder_name: {
            required: true,
            maxlength: 50,
            equalTo: "#fullname"
        },
        acc_number: {
            required: true,
            // number: true,
            maxlength: 20,
        },
        swift_code: {
            required: true,
            // number: true,
            maxlength: 20,
        },
        branch: {
            required: true,
            maxlength: 50,
        },
        bank_country_id: {
            required: true,
        },
        'terms_condition[]':{
            required: true,
            minlength: 4
        },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "terms_condition[]") {
            $('#terms_condition_error_msg').html(error);
        } else {
            error.insertAfter(element)
        }
    },
    messages: {
        sponsor: {
            alphanumeric: "Only number and alphabets are allowed",
            minlength: "Please enter minimum 3 character",
            maxlength: "Maximim limit of sponsor name is 50 character",
            required: "Please enter Sponsor Username"
        },
        // sponsor_check: {
        //     required: "Please enter Sponsor Username"
        // },
        placement_username: {
            alphanumeric: "Only number and alphabets are allowed",
            minlength: "Please enter minimum 3 character",
            maxlength: "Maximim limit of sponsor name is 50 character",
            required: "Please enter placement name",
        },
        // placement_check: {
        //     required: "Please enter placement name",
        // },
        name: {
            required: "Please enter full name",
            maxlength: "Maximim limit of sponsor name is 20 character",
        },
        username: {
            required: "Please enter username",
            alphanumeric: "Only number and alphabets are allowed",
            minlength: "Please enter minimum 3 character",
            maxlength: "Maximim limit of username is 50 character",
            remote: "",
        },
        address: {
            required: "Please enter address",
        },
        city: {
            required: "Please enter city",
        },
        state: {
            required: "Please enter state",
        },
        country: {
            required: "PLease select country",
        },
        ic_number: {
            required: "Please enter identification number",
            alphanumeric: "Only number and alphabets are allowed",
            maxlength: "Maximim limit of 12 character",
            remote: "This Identification number is already in use"
        },
        email: {
            required: "Please enter email address",
            email: "Please enter valid email address",
            // maxlength: 50,
            // remote: "",
        },
        phone_number: {
            required: "Please enter phone number",
            number: "Please enter number only",
            minlength: "Please enter minimum 10 character",
            maxlength: "Maximim limit of username is 15 character",
        },
        password: {
            required: "Please enter password",
            // minlength:8,
            // maxlength: 15
        },
        retype_password: {
            required: "Please enter retype password",
            equalTo: "Password and Retype password must be same"
        },
        secure_password: {
            required: "Please enter secure password",
            minlength: "Please enter minimum 8 character",
            maxlength: "Maximim limit of username is 15 character",
        },
        retype_secure_password: {
            required: "Please enter retype secure password",
            equalTo: "Secure password and Retype secure password must be same"
        },
        bank_name: {
            required: "Please enter bank name",
            // maxlength: 50,
        },
        acc_holder_name: {
            required: "Please enter account holder name",
            // maxlength: 50,
        },
        acc_number: {
            required: "Please enter account number",
            number: "Only number has been allowed",
            // maxlength: 20,
        },
        swift_code: {
            required: "Please enter swift code",
            // number: "Only number has been allowed",
            // maxlength: 20,
        },
        branch: {
            required: "Please enter bank branch",
            // maxlength: 50,
        },
        bank_country_id: {
            required: "Please select bank account country",
        },
        'terms_condition[]':{
            required: "Please select checkboxes",
            minlength: "Please choose atleast 4 checkboxes"
        },
    },
});


$("#customer_register_edit").validate({
    ignore: "input[type='text']:hidden",
    rules: {
        sponsor: {
            required: true,
        },
        placement_username: {
            required: true,
        },
        name: {
            required: true,
            maxlength: 50,
        },
        username: {
            required: true,
        },
        address: {
            required: true,
            maxlength: 100,
        },
        city: {
            required: true,
            maxlength: 50,
        },
        state: {
            required: true,
            maxlength: 50,
        },
        country: {
            required: true,
            number: true,
        },
        ic_number: {
            required: true,
            alphanumeric1: true,
            maxlength: function() {
                if ($('#country_id').val() == '131') {
                    return '12';
                }
            },
            // remote: {
            //     url: icNumberDuplicationEdit,
            //     type: "post",
            //     data: {
            //         _token: $("input[name=_token]").val(),
            //         sponsor_username: function() {
            //             console.log('hi')
            //             return $("#sponsor_username").val();
            //         }
            //     },
            //     dataFilter: function(data) {
            //         var data = JSON.parse(data);
            //         if (data.valid == true || data.valid == 'false') {
            //             return true;
            //         } else {
            //             return false;
            //         }
            //     }
            // }
        },
        email: {
            required: true,
            email: true,
            maxlength: 50,
        },
        phone_number: {
            required: true,
            number: true,
            minlength:10,
            maxlength: 15,
        },
        password: {
            minlength: 8,
            maxlength: 15
        },
        retype_password: {
            required: function () {
                return $('#password').val().length > 0;
            },
            equalTo: "#password"
        },
        secure_password: {
            minlength: 8,
            maxlength: 15
        },
        retype_secure_password: {
            required: function () {
                return $('#secure_password').val().length > 0;
            },
            equalTo: "#secure_password"
        },
        bank_name: {
            required: true,
            maxlength: 50,
        },
        acc_holder_name: {
            required: true,
            maxlength: 50,
            equalTo: "#fullname"
        },
        acc_number: {
            required: true,
            // number: true,
            maxlength: 20,
        },
        swift_code: {
            required: true,
            // number: true,
            maxlength: 20,
        },
        branch: {
            required: true,
            maxlength: 50,
        },
        bank_country_id: {
            required: true,
        },
        'terms_condition[]':{
            required: true,
            minlength: 4
        },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "terms_condition[]") {
            $('#terms_condition_edit_error_msg').html(error);
        } else {
            error.insertAfter(element)
        }
    },
    messages: {
        sponsor: {
            required: "Please enter Sponsor Username"
        },
        // sponsor_check: {
        //     required: "Please enter Sponsor Username"
        // },
        placement_username: {
            required: "Please enter placement name",
        },
        // placement_check: {
        //     required: "Please enter placement name",
        // },
        name: {
            required: "Please enter full name",
            maxlength: "Maximim limit of sponsor name is 20 character",
        },
        username: {
            required: "Please enter username",
        },
        address: {
            required: "Please enter address",
        },
        city: {
            required: "Please enter city",
        },
        state: {
            required: "Please enter state",
        },
        country: {
            required: "PLease select country",
        },
        ic_number: {
            required: "Please enter identification number",
            alphanumeric: "Only number and alphabets are allowed",
            maxlength: "Maximim limit of 12 character",
            // remote: "This Identification number is already in use"
        },
        email: {
            required: "Please enter email address",
            email: "Please enter valid email address",
            // maxlength: 50,
            // remote: "",
        },
        phone_number: {
            required: "Please enter phone number",
            number: "Please enter number only",
            minlength: "Please enter minimum 10 character",
            maxlength: "Maximim limit of username is 15 character",
        },
        password: {
            minlength: "Please enter minimum 8 character",
            maxlength: "Maximim limit of username is 15 character",
        },
        retype_password: {
            required: "Please enter retype password",
            equalTo: "Password and Retype password must be same"
        },
        secure_password: {
            minlength: "Please enter minimum 8 character",
            maxlength: "Maximim limit of username is 15 character",
        },
        retype_secure_password: {
            required: "Please enter retype secure password",
            equalTo: "Secure password and Retype secure password must be same"
        },
        bank_name: {
            required: "Please enter bank name",
            // maxlength: 50,
        },
        acc_holder_name: {
            required: "Please enter account holder name",
            // maxlength: 50,
        },
        acc_number: {
            required: "Please enter account number",
            number: "Only number has been allowed",
            // maxlength: 20,
        },
        swift_code: {
            required: "Please enter swift code",
            // number: "Only number has been allowed",
            // maxlength: 20,
        },
        branch: {
            required: "Please enter bank branch",
            // maxlength: 50,
        },
        bank_country_id: {
            required: "Please select bank account country",
        },
        'terms_condition[]':{
            required: "Please select checkboxes",
            minlength: "Please choose atleast 4 checkboxes"
        },
    },
});






    







$('input[name="fixed_rank"]').on('change',function(){
    if($(this).val()==1){
        $('.self_trading-collapse').collapse('show');
    }else{
        $('.self_trading-collapse').collapse('hide');

    }

})
    /*Update Fund Wallet Amount*/

$("#add_fund_userwallet").validate({
     rules: {
         amount: {
            required: true,
            number: true
         }
     },
     messages:{
        amount: {
            required: 'Please Enter amount.',
            number: 'Please enter valid amount'
        }
    }
});
/*Update Fund Wallet Amount*/

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

$('.btn-fund-wallet').on('click',function(){
    var username = $(this).data('user');
    var amount = $(this).data('amt');
    var user_id = $(this).data('user_id');
    $('#add_fund_userwallet input[name="user_id"]').val(user_id);
    $('#add_fund_userwallet input[name="amount"]').val('');
    $('#add_fund_userwallet textarea[name="description"]').val('');
    $('#add_fund_userwallet .username').text(username);

    if(username!=undefined && amount !=undefined && user_id!=undefined && username!='' && user_id!='' ){
        $('#fundWallet').modal('show');
    }
})
/*Update Fund Wallet Amount*/
/*Update SelfTrade Fund Wallet Amount*/
$('.btn-self-fund-wallet').on('click',function(){
    var username = $(this).data('user');
    var amount = $(this).data('amt');
    var user_id = $(this).data('user_id');
    $('#self_fund_wallets input[name="user_id"]').val(user_id);
    $('#self_fund_wallets input[name="amount"]').val(amount);
    $('#self_fund_wallets .username').text(username);

    console.log("user_id ::",user_id);
    console.log("amount ::",amount);
    console.log("username ::",username);
    if(username!=undefined && amount !=undefined && user_id!=undefined  ){
        $('#fundWallet').modal('show');
    }
    
})
/*Update SelfTrade Fund Wallet Amount*/


/*Update SelfTrade Pips Comiision Wallet*/
$('.btn-pips-commisons-wallet').on('click',function(){
    var username = $(this).data('user');
    var amount = $(this).data('amt');
    var user_id = $(this).data('user_id');
    $('#self_fund_wallets input[name="user_id"]').val(user_id);
    $('#self_fund_wallets input[name="amount"]').val(amount);
    $('#self_fund_wallets .username').text(username);

    console.log("user_id ::",user_id);
    console.log("amount ::",amount);
    console.log("username ::",username);
    if(username!=undefined && amount !=undefined && user_id!=undefined  ){
        $('#pipsComissions').modal('show');
    }
    
})
/*Update Pips Comiision Wallet Amount*/

/*Update SelfTrade Withdrewal  Wallet*/
$('.btn-st-withdrawl-wallet').on('click',function(){
    var username = $(this).data('user');
    var amount = $(this).data('amt');
    var user_id = $(this).data('user_id');
    $('#self_fund_wallets input[name="user_id"]').val(user_id);
    $('#self_fund_wallets input[name="amount"]').val(amount);
    $('#self_fund_wallets .username').text(username);

    console.log("user_id ::",user_id);
    console.log("amount ::",amount);
    console.log("username ::",username);
    if(username!=undefined && amount !=undefined && user_id!=undefined  ){
        $('#stwithdrawlWallet').modal('show');
    }
    
})
/*Update Selftrade Withdrewal  Wallet Amount*/

/*Update MT4 Topup Wallet Amount*/

$("#total_capital_form").validate({
     rules: {
         total_capital: {
            required: true,
            number: true
         },
         description: {
            required: true,
            maxlength: 500
         }
     },
     messages:{
        total_capital: {
            required: 'Please Enter Total Capital.',
            number: 'Please enter valid Total Capital'
        },
        description: {
            required: 'Please enter description',
            
        }
    }
});
$("#mtTopupForm").validate({
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

$('.btn-total_capital').on('click',function(){
    var username = $(this).data('user');
    var amount = $(this).data('amt');
    var user_id = $(this).data('user_id');
    var form_url = updateCapitalBalace //$('#reply_support_ticket').attr('action');
    form_url = form_url+'/'+user_id;
    $('#total_capital_form').attr('action',form_url);
    $('#total_capital_form input[name="user_id"]').val(user_id);
    $('#total_capital_form input[name="total_capital"]').val(amount);
     console.log(username+"--"+amount+"--"+user_id)
    if(user_id!=undefined && amount !=undefined  && user_id!='' ){
     console.log(username+"1--"+amount+"1--"+user_id)
        $('#total_capital').modal('show');
    }
})
$('.btn-mt-topup-wallet').on('click',function(){
    // alert('1234y')
    var username = $(this).data('user');
    var amount = $(this).data('amt');
    var user_id = $(this).data('user_id');
    $('#mtTopupForm .username').text(username);
    $('#mtTopupForm input[name="user_id"]').val(user_id);
    $('#mtTopupForm input[name="amount"]').val(amount);
     console.log(username+"--"+amount+"--"+user_id)
    if(amount !=undefined  && user_id!='' ){
     console.log(username+"1--"+amount+"1--"+user_id)
        $('#mtTopupWallet').modal('show');
    }
})
/*Update MT4 Topup Wallet Amount*/
/*Upgrade Package*/
$('.btn-upgrade-package').on('click',function(){
    var user_id = $(this).data('id');
    var package = $(this).data('package');
    
    var fund_amount = $('.row-user-'+user_id).find('td:eq(4) a').data('amt');
    fund_amount = parseFloat(fund_amount);
    var mt_topup = $('.row-user-'+user_id).find('td:eq(5) a').data('amt');
    // console.log(mt_topup);
    if(package == ''){
        package= '0';
    }
    mt_topup = parseFloat(mt_topup);
    if(user_id!=undefined && package!=undefined && user_id!="" && package!=""){
        $('#upgradePackageId').find('input[name="user_id"]').val(user_id);
        $('#upgradePackageId').find('input[name="fund_amount"]').val(fund_amount);
        $('#upgradePackageId').find('input[name="mt_topup"]').val(mt_topup);
        if(package!='0'){
            $('#upgradePackageId').find('select[name="package"]').val(package);
        }
        $('#upgradePackage').modal('show');
    }

});
$("#upgradePackageId").validate({
    rules: {
         package: {
            required: true,
         },
    },
    messages:{
        package: {
            required: 'Please Select Package',
        },
    },

});
$("#upgradePackageId").on('submit',function(e){
    if(!$(this).valid()){
        return false;
    }
    e.preventDefault();
    var action_url = $(this).attr('action')
    var formData = $(this).serialize()
    $.post(action_url,formData,function(response){
        console.log(response);
        if(response.status=='success'){
            var form = '.row-user-'+response.user_id;
            console.log(form);
            $(form).find('td:eq(5)').text(response.data.amount);
            $(form).find('td:eq(5) .btn-upgrade-package').attr('data-amt',response.data.amount);
            $(form).find('td:eq(5) .btn-upgrade-package').attr('data-package',response.data.id);
            $('#upgradePackage').modal('hide');
            var alertMsg = alerthtml(response.status,response.message);
            console.log(alertMsg);
            $('.wrapper-content').before(alertMsg);
        }else{
            var alertMsg = alerthtml(response.status,response.message);
            $('.wrapper-content .row:eq(0)').before(alertMsg);
        }
        setTimeout(function(){
            $('.alert').hide('100');
        },4000);
    })
})
/*Upgrade Package*/

/*Create News*/
$("#news-form").validate({
    rules: {
         title: {
            required: true,
            maxlength:255
         },
         language:{required:true},
         details: {
            required: true,
            maxlength:2500
         },
         url: {
            required: true,
            regex: /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
         },
         image:{
            required:true,
            extension:'png|jpeg|jpg'
         }
    },
    messages:{
        title: {
            required: 'Please enter title',
        },
        language: {
            required: 'Please select language',
        },
        details: {
            required: 'Please enter detail or description',
        },
        url: {
            required: 'Please enter url',
        },
        image: {
            required: 'Please select image',
        },
    },

});
/*Create News*/
/*Edit News*/
$("#news-form-edit").validate({
    rules: {
         title: {
            required: true,
            maxlength:255
         },
         language:{required:true},
         details: {
            required: true,
            maxlength:2500
         },
         url: {
            required: true,
            regex: /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
         },
         image:{
            extension:'png|jpeg|jpg'
         }
    },
    messages:{
        title: {
            required: 'Please enter title',
        },
        language: {
            required: 'Please select language',
        },
        details: {
            required: 'Please enter detail or description',
        },
        url: {
            required: 'Please enter url',
        },
    },

});
/*Create News*/
/*Announcement*/
jQuery.validator.addMethod("imageextension", function(value, element) {
  if(value){

    var ext = $(element).val().split('.').pop().toLowerCase();
    if(value && $.inArray(ext, ['jpg','jpeg','png','JPG','JPEG']) == -1) {
      return false;
    }
  }
  return true;
}, "Please choose image files only.");
$("#announcement-form").validate({
    rules: {

         title: {
            required: true,
            maxlength:255
         },
         description: {
            required: true,
            maxlength:2500
         },  
         //  url: {
         //    required: true,
         //    regex: /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
         // },
         image:{
            // required: true,
            imageextension:'png|jpeg|jpg|gif'
         },
         daterange: {
            required: true
         },         
    },
    messages:{
        title: {
            required: 'Please enter title',
        },       
        description: {
            required: 'Please enter description',
        },   
        details: {
            required: 'Please enter detail or description',
        },
        // url: {
        //     required: 'Please enter url',
        // },   
        daterange: {
            required: 'Please select start and end date',
        },
    },

});


/*Announcement*/
$("#slider-form").validate({
    rules: {

         title: {
            required: true,
            maxlength:255
         },
         mobile_image: {
            required: true,
            extension:'png|jpeg|jpg'
         },  
          url: {
            required: true,
            regex: /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
         },
         image:{
            required: true,
            extension:'png|jpeg|jpg'
         }
         // daterange: {
         //    required: true
         // },         
    },
    messages:{
        title: {
            required: 'Please enter title',
        },      
        mobile_image: {
            required: 'Please Upload mobile-image',
            extension: "Only png,jpeg,jpg allowed."
        },
        url: {
            required: 'Please enter url',
        },
        image: {
            required: 'Please Upload desktop-image',
            extension: "Only png,jpeg,jpg allowed."
        },   
        // daterange: {
        //     required: 'Please select start and end date',
        // },
    },
});


$("#slider-form-edit").validate({
    rules: {

         title: {
            required: true,
            maxlength:255
         },
         mobile_image: {
            // required: true,
            extension:'png|jpeg|jpg'
         },  
          url: {
            required: true,
            regex: /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
         },
         image:{
            // required: true,
            extension:'png|jpeg|jpg'
         }
         // daterange: {
         //    required: true
         // },         
    },
    messages:{
        title: {
            required: 'Please enter title',
        },      
        mobile_image: {
            // required: 'Please Upload mobile-image',
            extension: "Only png,jpeg,jpg allowed."
        },
        url: {
            required: 'Please enter url',
        },
        image: {
            // required: 'Please Upload desktop-image',
            extension: "Only png,jpeg,jpg allowed."
        },   
        // daterange: {
        //     required: 'Please select start and end date',
        // },
    },
});


if($('#announcement-form input[name="daterange"]').val() != undefined){
    var start = moment().subtract(29, 'days');
    var end = moment();
    $('#announcement-form input[name="daterange"]').daterangepicker({
        startDate: start,
        endDate: end,
        // maxDate:new Date(),
        autoApply:true,
        autoUpdateInput:true,
        locale: {
          format: 'M/DD/YYYY'
        }
    });    
}

/*Announcement*/
/*Ticket Mangement*/
$("#ticket-form").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         amount: {
            required: true,
            positiveNumber:true,
            number:true
         },  
         min_limit: {
            positiveNumber:true,
             number:true
         },   
         max_limit: {
            positiveNumber:true,
            number:true
         },         
    },
    messages:{
        name: {
            required: 'Please enter ticket name',
        },       
        amount: {
            required: 'Please enter ticket amount',
        },  
        min_limit: {
           positiveNumber:'Minimum Quantity Limit must be greater than 0',
        },   
        max_limit: {
           positiveNumber:'Maximum Quantity Limit must be greater than 0',
        },
        daterange: {
            required: 'Please select start and end date',
        },
    },

});
/*Ticket Mangement*/
/*Product Mangement*/
$("#product-form").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         amount: {
            required: true,
            number:true
         },  
         min_limit: {
             number:true
         },   
         max_limit: {
            number:true
         },    
         stock: {
            required: true,
            number:true
         },      
         "rank_ids[]": {
            required: true,
         },         
    },
    messages:{
        name: {
            required: 'Please enter product name',
        },       
        amount: {
            required: 'Please enter product amount',
        },      
        stock: {
            required: 'Please enter product stock',
        },
    },

});
/*Product Mangement*/
// Packages add form
$.validator.addMethod('min_stacking_actual12',function(v,el){
    // if (this.optional(el)){
    //     return true;
    // }
    if($("input[name=stacking_actual12_start]").val() == ''){
        return true;
    }
    if($("input[name=stacking_actual12_end]").val() == ''){
        return true;
    }
    var stacking_actual12_end = $("input[name=stacking_actual12_end]").val();

    var stacking_actual12_start = $(el).val();
    return parseFloat(stacking_actual12_end) > parseFloat(stacking_actual12_start);
}, 'Period (12 Month) Start must be less then Period (12 Month) End');

$.validator.addMethod('max_stacking_actual12',function(v,el){
    if (this.optional(el)){
        return true;
    }
    if($("input[name=stacking_actual12_start]").val() == ''){
        return false;
    }
    var stacking_actual12_end = $("input[name=stacking_actual12_end]").val();

    var stacking_actual12_start = $("input[name=stacking_actual12_start]").val();
    return parseFloat(stacking_actual12_end) > parseFloat(stacking_actual12_start);
}, 'Period (12 Month) End must be greater then  Period (12 Month) Start');

$.validator.addMethod('min_stacking_actual24',function(v,el){
    // if (this.optional(el)){
    //     return true;
    // }
    if($("input[name=stacking_actual24_start]").val() == ''){
        return true;
    }
    if($("input[name=stacking_actual24_end]").val() == ''){
        return true;
    }
    var stacking_actual24_end = $("input[name=stacking_actual24_end]").val();

    var stacking_actual24_start = $(el).val();
    return parseFloat(stacking_actual24_end) > parseFloat(stacking_actual24_start);
}, 'Period (24 Month) Start must be less then Period (24 Month) End');

$.validator.addMethod('max_stacking_actual24',function(v,el){
    if (this.optional(el)){
        return true;
    }
    if($("input[name=stacking_actual24_start]").val() == ''){
        return false;
    }
    var stacking_actual24_end = $("input[name=stacking_actual24_end]").val();

    var stacking_actual24_start = $("input[name=stacking_actual24_start]").val();
    return parseFloat(stacking_actual24_end) > parseFloat(stacking_actual24_start);
}, 'Period (24 Month) End must be greater then  Period (24 Month) Start');
$.validator.addMethod('min_stacking_display',function(v,el){
    // if (this.optional(el)){
    //     return true;
    // }
    if($("input[name=stacking_display_start]").val() == ''){
        return true;
    }
    if($("input[name=stacking_display_end]").val() == ''){
        return true;
    }
    var stacking_display_end = $("input[name=stacking_display_end]").val();

    var stacking_display_start = $(el).val();
    return parseFloat(stacking_display_end) > parseFloat(stacking_display_start);
}, 'Staking Dispaly Start must be less then Staking Dispaly End');

$.validator.addMethod('max_stacking_display',function(v,el){
    if (this.optional(el)){
        return true;
    }
    if($("input[name=stacking_display_start]").val() == ''){
        return false;
    }
    var stacking_display_end = $("input[name=stacking_display_end]").val();

    var stacking_display_start = $("input[name=stacking_display_start]").val();
    return parseFloat(stacking_display_end) > parseFloat(stacking_display_start);
}, 'Staking Dispaly End must be greater then  Staking Dispaly Start');

$("#package_create").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         amount: {
            required: true,
            number:true,
            positiveNumber :true
         },
         stacking_actual12_start: {
            required: true,
            number:true,
            positiveNumber :true,
            min_stacking_actual12 :true
         },
         stacking_actual12_end:{
            required: true,
            number:true,
            positiveNumber :true,
            max_stacking_actual12:true
         },
         stacking_actual24_start:{
            required: true,
            number:true,
            positiveNumber :true,
            min_stacking_actual24 :true
         },
         stacking_actual24_end:{
            required: true,
            number:true,
            positiveNumber :true,
            max_stacking_actual24:true
         },
         direct_refferal:{
            required: true,
            number:true,
            positiveNumber :true
         },
         network_pairing:{
            required: true,
            number:true,
            positiveNumber :true
         },
         daily_limit:{
            required: true,
            number:true,
            positiveNumber :true
         }         
    },
    messages:{
        name: {
            required: 'Please enter name',
        },       
        amount: {
            required: 'Please enter amount',
        },
        stacking_actual12_start: {
            required: 'Please enter staking period (12 month) start',
        },
        stacking_actual12_end: {
            required: 'Please enter staking period (12 month) end',
        },
        stacking_actual24_start: {
            required: 'Please enter staking period (24 month) start',
        },
        stacking_actual24_end: {
            required: 'Please enter staking period (24 month) end',
        },
        direct_refferal: {
            required: 'Please enter direct refferal',
        },
        network_pairing: {
            required: 'Please enter network pairing',
        },
        daily_limit: {
            required: 'Please enter daily limit',
        },
    },

});
$("#package_edit").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         amount: {
            required: true,
            number:true,
            positiveNumber :true
         },
         stacking_actual12_start: {
            required: true,
            number:true,
            positiveNumber :true,
            min_stacking_actual12 :true
         },
         stacking_actual12_end:{
            required: true,
            number:true,
            positiveNumber :true,
            max_stacking_actual12:true
         },
         stacking_actual24_start:{
            required: true,
            number:true,
            positiveNumber :true,
            min_stacking_actual24 :true
         },
         stacking_actual24_end:{
            required: true,
            number:true,
            positiveNumber :true,
            max_stacking_actual24:true
         },
         direct_refferal:{
            required: true,
            number:true,
            positiveNumber :true
         },
         network_pairing:{
            required: true,
            number:true,
            positiveNumber :true
         },
         daily_limit:{
            required: true,
            number:true,
            positiveNumber :true
         }         
    },
    messages:{
        name: {
            required: 'Please enter name',
        },       
        amount: {
            required: 'Please enter amount',
        },
        stacking_actual12_start: {
            required: 'Please enter staking period (12 month) start',
        },
        stacking_actual12_end: {
            required: 'Please enter staking period (12 month) end',
        },
        stacking_actual24_start: {
            required: 'Please enter staking period (24 month) start',
        },
        stacking_actual24_end: {
            required: 'Please enter staking period (24 month) end',
        },
        direct_refferal: {
            required: 'Please enter direct refferal',
        },
        network_pairing: {
            required: 'Please enter network pairing',
        },
        daily_limit: {
            required: 'Please enter daily limit',
        },
    },

});
$("#pool_package_create").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         image: {
            required: true,
         },
         symbol: {
            required: true,
         },
         stacking_display_start: {
            required: true,
            number:true,
            positiveNumber :true,
            min_stacking_display :true
         },
         stacking_display_end:{
            required: true,
            number:true,
            positiveNumber :true,
            max_stacking_display:true
         }         
    },
    messages:{
        name: {
            required: 'Please enter name',
        },
        image: {
            required: 'Image is required.',
        },
        symbol: {
            required: 'Symbol is required.',
        },
        stacking_display_start: {
            required: 'Please enter stacking display start',
        },
        stacking_display_end: {
            required: 'Please enter stacking display end',
        }
    },

});
$("#pool_package_edit").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         stacking_display_start: {
            required: true,
            number:true,
            positiveNumber :true,
            min_stacking_display :true
         },
         stacking_display_end:{
            required: true,
            number:true,
            positiveNumber :true,
            max_stacking_display:true
         }         
    },
    messages:{
        name: {
            required: 'Please enter name',
        },
        stacking_display_start: {
            required: 'Please enter stacking display start',
        },
        stacking_display_end: {
            required: 'Please enter stacking display end',
        }
    },
});
// NFT Category
$("#nft_category_create").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         image:{
            required: true,
            extension: "jpg,jpeg,png,gif"
         },
        //  order_id:{
        //     required: true,
        //  }      
    },
    messages:{
        name: {
            required: 'Please enter name.',
        },
        image: {
            required: 'Please choose image.',
            extension: 'Please choose (jpg, jpeg, png, gif) file.'
        },
        // order_id: {
        //     required: 'Please enter arrangement sequence number.',
        // },
    },

});
$("#nft_category_edit").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         image:{
            extension: "jpg,jpeg,png,gif"
         },
        //  order_id:{
        //     required: true,
        //  }        
    },
    messages:{
        name: {
            required: 'Please enter name.',
        },
        image: {
            extension: 'Please choose (jpg, jpeg, png, gif) file.'
        },
        // order_id: {
        //     required: 'Please enter arrangement sequence number.',
        // },
    },

});
$("#nft_product_create").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         price: {
            required: true,
            number:true,
            positiveNumber :true,
         },
         category: {
            required: true,
         },
         image:{
            required: true,
            extension: "jpg,jpeg,png,gif"
         }        
    },
    messages:{
        name: {
            required: 'Please enter name.',
        },
        price: {
            required: 'Please enter price.',
        },
        category: {
            required: 'Please select category..',
        },
        image: {
            required: 'Please choose image.',
            extension: 'Please choose (jpg, jpeg, png, gif) file.'
        },
    },

});
$("#nft_product_edit").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         price: {
            required: true,
            number:true,
            positiveNumber :true,
         },
         category: {
            required: true,
         },
         image:{
            extension: "jpg,jpeg,png,gif"
         }        
    },
    messages:{
        name: {
            required: 'Please enter name.',
        },
        price: {
            required: 'Please enter price.',
        },
        category: {
            required: 'Please select category..',
        },
        image: {
            required: 'Please choose image.',
            extension: 'Please choose (jpg, jpeg, png, gif) file.'
        },
    },

});



$("#productcoin_create").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         symbol: {
            required: true,
            maxlength:30
         },
         price: {
            required: true,
            number:true,
            positiveNumber :true,
         },
         image:{
            required: true,
            extension: "jpg,jpeg,png,gif"
         },
         chain: {
            required: true,
            maxlength:50
         },
         address: {
            required: true,
            maxlength:50,
            noSpace: true,
         },      
    },
    messages:{
        name: {
            required: 'Please enter name.',
        },
        symbol: {
            required: 'Please enter symbol.',
        },
        price: {
            required: 'Please enter price.',
        },
        image: {
            required: 'Please choose image.',
            extension: 'Please choose (jpg, jpeg, png, gif) file.'
        },
        chain: {
            required: 'Please enter chain.',
        },
        address: {
            required: 'Please enter address.',
        },
    },

});



$("#productcoin_edit").validate({
    rules: {
         name: {
            required: true,
            maxlength:255
         },
         symbol: {
            required: true,
            maxlength:30
         },
         price: {
            required: true,
            number:true,
            positiveNumber :true,
         },
         image:{
            // required: true,
            extension: "jpg,jpeg,png,gif"
         },
         chain: {
            required: true,
            maxlength:50
         },
         address: {
            required: true,
            maxlength:50,
            noSpace: true,
         },         
    },
    messages:{
        name: {
            required: 'Please enter name.',
        },
        symbol: {
            required: 'Please enter symbol.',
        },
        price: {
            required: 'Please enter price.',
        },
        image: {
            // required: 'Please choose image.',
            extension: 'Please choose (jpg, jpeg, png, gif) file.'
        },
        chain: {
            required: 'Please enter chain.',
        },
        address: {
            required: 'Please enter address.',
        },
    },

});




$("#product_trading_history_create").validate({
    rules: {
        purchase_amount: {
            required: true,
            number:true,
            positiveNumber :true,
         }, 
         date: {
            required: true,
         },      
    },
    messages:{
        purchase_amount: {
            required: 'Please enter amount.',
        },
        date: {
            required: 'Please select date.',
        },
    },

});


$("#product_trading_history_edit").validate({
    rules: {
        purchase_amount: {
            required: true,
            number:true,
            positiveNumber :true,
         }, 
         date: {
            required: true,
         },      
    },
    messages:{
        purchase_amount: {
            required: 'Please enter amount.',
        },
        date: {
            required: 'Please select date.',
        },
    },

});