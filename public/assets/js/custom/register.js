 $(document).on("click", ".verify-placement", function(e) {
        // alert('ad');
        var $this = this;
        var placement_username = $('#placement_username').val();
        var sponsor_check = $("#sponsor_check").val();
        // var child_position = $("input[name='child_position']:checked").val();

        $.ajax({
            type: "POST",
            url:placementUsernameExits,
            cache: false,
            data: {
                _token: $("input[name=_token]").val(),
                placement_username:placement_username,
                sponsor_check:sponsor_check,
                // child_position:child_position
            },
            success: function(data) {
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
                    $('#placement_username-error').hide(100);
                }
            }
        });
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
}, verify_entered_sponsor);
   jQuery.validator.addMethod("isplacementverified", function(value, element) {
    var placement_username = $('#placement_username').val().trim();
    var varifiedPlacement = $('#placement_check').val();
    if(varifiedPlacement != '' && placement_username != varifiedPlacement){
        return false;
    }  else if(placement_username !=  '' && varifiedPlacement == ''){
        return false;
    } else {
        return  true;
    }
}, verify_entered_sponsor);

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
}, please_verify_the_sponsor_id_first);
   $.validator.addMethod(
    "alphanumeric1",
    function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\b]+$/i.test(value);
    },
    consists_letters_numbers_only
    );
   // $.validator.addMethod(
   //  "max3allowed",
   //  function(value, element) {
   //      var result =true;
   //      result=$.ajax({
   //          url: icNumberDuplication,
   //          type: "post",
   //           async: false,
   //          data: {
   //              _token: $("input[name=_token]").val(),
   //              sponsor_username: function() {
   //                  return $( "#sponsor_username" ).val();
   //              },
   //              ic_number: value,
   //          },
   //          done: function(data,result) {
   //              var data = JSON.parse(data);
   //              if (data.valid == 'false') {
   //                  result= false;
   //              } 
   //              result= true;
   //          }
   //  }).responseText;
   //      var data = JSON.parse(result);
   //      if (data.valid == 'false') {
   //                  return false;
   //              } 
   //                  return true;
   //      return response;
   // },
   // max_3_identfication_allowed
   // );

   $("#form-wizards-register").steps({
     bodyTag: "fieldset",
     labels:{
      finish: '<button class="btn bg-warning text-white py-4 px-5 font-weight-bold rounded-0 mt-4 mt-md-2 font-18 text-uppercase" id="finish">'+finish+'</button>',
      next: '<button class="btn bg-warning text-white py-4 px-5 font-weight-bold rounded-0 mt-4 mt-md-2 font-18 text-uppercase d-flex align-items-center">'+next+' <img src="'+arrow+'" class="img-fluid ml-3 align-middle" alt=""></button>',
      previous: '<button class="btn bg-transparent border-warning text-white py-4 px-5 mt-4 mt-md-2 font-weight-bold rounded-0 font-18 text-uppercase d-flex align-items-center"><img src="'+arrow+'" class="img-fluid mr-3 align-middle" alt="" style="transform: rotate(180deg);">'+previous+'</button>'
  },
  onInit: function (event, current) {
    var sigpad = $('#sigpad').signature({syncField: '#signature', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sigpad.signature('clear');
        $("#signature").val('');
    });
    $('.actions > ul > li:first-child').attr('style', 'display:none');
},
onStepChanging: function (event, currentIndex, newIndex)
{
  $('.actions > ul > li:first-child').attr('style', 'display:block');

            // Always allow going backward even if the current step contains invalid fields!
            if (currentIndex > newIndex)
            {
             return true;
         }

            // Forbid suppressing "Warning" step if the user is to young
            if (newIndex === 2 && Number($("#age").val()) < 18)
            {
             return false;
         }

         var form = $(this);

            // Clean up if user went backward before
            if (currentIndex < newIndex)
            {
                // To remove error styles
                $(".body:eq(" + newIndex + ") label.error", form).remove();
                $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
            }

            // Disable validation on fields that are disabled or hidden.
            form.validate().settings.ignore = ":disabled,:hidden";

            // Start validation; Prevent going forward if false
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            // Suppress (skip) "Warning" step if the user is old enough.
            if (currentIndex === 2 && Number($("#age").val()) >= 18)
            {
             $(this).steps("next");
         }

            // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3)
            {
             $(this).steps("previous");
         }
     },
     onFinishing: function (event, currentIndex)
     {
         var form = $(this);

            // Disable validation on fields that are disabled.
            // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
            form.validate().settings.ignore = ":disabled";

            // Start validation; Prevent form submission if false
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            var form = $(this);
            // alert(form.valid());

            // Submit form input
            form.submit();
        }
    }).validate({
       errorPlacement: function (error, element)
       {
        element.after(error);
    },
    ignore: "input[type='text']:hidden",
    rules: {
      sponsor_username: {
       required: true,
       alphanumeric : true,
       minlength: 3,
       maxlength: 50,
       issponserverified: true,
                           // remote: {
                           //     url: sponsorUsernameExits,
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
                       placement_username: {
                         required: true,
                         checksponserverified: true,
                         isplacementverified:true

                     },
                     sponsor_check: {
                         required: true,
                     },
                     placement_check: {
                         required: true,
                     },
                     fullname: {
                       required: true,
                       maxlength: 50,
                   },
                   username: {
                       required: true,
                       alphanumeric : true,
                       minlength: 3,
                       maxlength: 50,
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
                    }
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
               },
               ic_number: {
                   required: true,
                   alphanumeric1: true,
                           // max3allowed:true,
                         //   maxlength: function(){
                         //      if($('#country_id').val() == '131'){
                         //         return '12';
                         //     }
                         // },
                         checksponserverified: true,
                         // remote: {
                         //      url: icNumberDuplication,
                         //      type: "post",
                         //      data: {
                         //         _token: $("input[name=_token]").val(),
                         //         sponsor_username: function() {
                         //            return $( "#sponsor_username" ).val();
                         //        }
                         //            // ic_number: $(this).val(),
                         //        },
                         //        dataFilter: function(data) {
                         //            var data = JSON.parse(data);
                         //            if (data.valid == true || data.valid == 'false') {
                         //              return true;
                         //          } else {

                         //              return false;
                         //          }
                         //      }
                         //  }
                     },
                     email: {
                       required: true,
                       email: true,
                       maxlength: 50,
                       remote: {
                          url: emailExists,
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
                    }
                },
                confirm_email: {
                   required: true,
                   equalTo: "#email"
               },
               phone_number: {
                   required: true,
                   number: true,
                   minlength:10,
                   maxlength: 15,
               },
               password: {
                   required: true,
                   minlength:8,
                   maxlength: 15
               },
               password_confirmation: {
                   required: true,
                   equalTo: "#password"
               },
               secure_password: {
                   required: true,
                   minlength:8,
                   maxlength: 15
               },
               confirm_secure_password: {
                   required: true,
                   equalTo: "#secure_password"
               },
               bank_name:{
                   required: true,
                   maxlength: 50,
               },
               acc_holder_name:{
                   required: true,
                   maxlength: 50,
                   equalTo: "#fullname"
               },
               acc_number:{
                   required: true,
                           // number: true,
                           maxlength: 20,
                       },
                       swift_code:{
                           required: true,
                           // number: true,
                           maxlength: 20,
                       },
                       bank_branch:{
                           required: true,
                           maxlength: 50,
                       },
                       bank_country_id:{
                           required: true,
                       },
                       signature:{
                           required: true,
                           // maxlength: 50,
                       },
                       // d_date:{
                       //     required: true,
                       // },
                       // 'terms_condition[]':{
                       //     required: true,
                       //     minlength: 4
                       // },
                       // iagree:{
                       //     required: true,
                       // }
                   },
                   messages: {

                    sponsor_username: {
                       minlength: please_enter_least_3_characters,
                       maxlength: please_enter_no_more_than_50,
                       remote: please_check_sponsor_username_not_valid,
                   },
                   sponsor_check:{
                       required: please_enter_sponsor_name
                   },
                   placement_username: {
                       required: please_enter_placement_name,
                   },
                   placement_check:{
                       required: please_enter_placement_name
                   },
                   fullname: {
                       required: fullname_required,
                       maxlength: please_enter_no_more_than_50,
                   },
                   username: {
                       required: username_required_field,
                       alphanumeric: letters_numbers_and_underscores_only_please,
                       minlength: please_enter_least_3_characters,
                       maxlength: please_enter_no_more_than_50,
                       remote: username_already_exists,
                   },
                   address: {
                       required: address_required_field,
                       maxlength: please_enter_no_more_than_100,
                   },
                   city: {
                       required: city_required_field,
                       maxlength: please_enter_no_more_than_50,
                   },
                   state: {
                       required: state_required_field,
                       maxlength: please_enter_no_more_than_50,
                   },
                   country: {
                       required: country_required_field,
                   },
                   ic_number: {
                       required: ic_required_field,
                       maxlength: please_enter_no_more_than_20,
                       remote: identification_alread_use
                   },
                   email: {
                       required: eamil_required_field,
                       email: please_enter_valid_email_address,
                       maxlength: please_enter_no_more_than_50,
                       remote: email_already_exists
                   },
                   confirm_email: {
                       required: eamil_required_field,
                       equalTo: please_enter_same_value
                   },
                   phone_number: {
                       required: phone_number_required_field,
                       number: enter_valid_number,
                       minlength:please_enter_least_10_characters,
                       maxlength: please_enter_no_more_than_15,
                   },
                   password: {
                       required: password_required_field,
                       minlength:please_enter_least_8_characters,
                       maxlength: please_enter_no_more_than_15
                   },
                   password_confirmation: {
                       required: repeatpassword_required_field,
                       equalTo: please_enter_same_value
                   },
                   secure_password: {
                       required: securepassword_required_field,
                       minlength:please_enter_least_8_characters,
                       maxlength: please_enter_no_more_than_15
                   },
                   confirm_secure_password: {
                       required: repeatsecurepassword_required_field,
                       equalTo: please_enter_same_value
                   },
                   bank_name:{
                       required: bankname_required_field,
                       maxlength: please_enter_no_more_than_50,
                   },
                   acc_holder_name:{
                       required: accountholder_required_field,
                       maxlength: please_enter_no_more_than_50,
                       equalTo: account_holder_name_and_full_name_same
                   },
                   acc_number:{
                       required: accountnumber_required_field,
                       maxlength: please_enter_no_more_than_20,
                   },
                   swift_code:{
                       required: swift_code_required_field,
                       maxlength: please_enter_no_more_than_20,
                   },
                   bank_branch:{
                       required: bank_branch_required_field,
                       maxlength: please_enter_no_more_than_50,
                   },
                   bank_country_id:{
                       required: bank_country_required_field,
                   },
                   signature:{
                       required: signature_required_field,
                       maxlength: please_enter_no_more_than_50,
                   },
                   // 'terms_condition[]':{
                   //     required: select_all,
                   //     minlength: please_select_atleast_4_checkboxes
                   // },
                   // 'iagree':{
                   //     required: select_all,
                   // },
               },
           })