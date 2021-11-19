$.validator.addMethod(
    "positiveNumber",
    function(value) {
        return Number(value) > 0;
    },
    amount_must_greater_0
    );
  // var sigpad = $('#sigpad').signature({syncField: '#signature', syncFormat: 'PNG'});
  //   $('#clear').click(function(e) {
  //       e.preventDefault();
  //       sigpad.signature('clear');
  //       $("#signature").val('');
  //   });
$("#staking_pool").validate({
    ignore: "input[type='text']:hidden",
    rules: {
        amount: {
            required: true,
            number: true,
            positiveNumber:true,
            minlength: 0,
            // maxlength: 6,
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
    },
    submitHandler: function(form) {
        var title = agreement_title.replace('#title',$('#package').val());
        $('#agreetitle').text(title);
        if($('#agreement').val() == 'confirm' && $('#poolsignature').val() != ''){
            form.submit();
        }else{
            $('#stakingpoolagreement').modal('show');
        }
        // swal({
        //     title: "Are you sure? ",
        //     text: "You want to invest $"+$('#amount').val()+" for "+$('#name').val()+" for "+' '+$('#duration').val()+" Months !",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: "#4B49AC",
        //     confirmButtonText: "Yes",
        //     closeOnConfirm: false
        // }, function(isConfirm){
        //     if (isConfirm) form.submit();
        // });
    }
});
$("#staking_agreement").validate({
    ignore: "input[type='text']:hidden",
    rules: {
        terms_agree: {
            required: true,
        },
        // signature: {
        //     required: true,
        // }
    },
    messages: {
        terms_agree: {
            required: err_field_req,
        },
         signature:{
             required: signature_required_field,
         },
    },
    submitHandler: function(form) {
        alert()
        $('#agreement').val('confirm');
        $('#poolsignature').val('test');//$('#signature').val()
        $("#staking_pool").trigger('submit');
    }
});
$('#cancelstaking').on('click',function(e) {
    $('#stakingpoolagreement').modal('hide');
    $("#staking_pool")[0].reset();
});