$(document).ready(function(){
  $('.dashboard-slider').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      prevArrow: '<button class="slide-arrow prev-arrow"><img src="'+arrow+'" alt=""></button>',
      nextArrow: '<button class="slide-arrow next-arrow"><img src="'+arrow+'" alt=""></button>'
    });

  $('.stacking-slider').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '<button class="slide-arrow prev-arrow"><img src="'+arrow+'" alt=""></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><img src="'+arrow+'" alt=""></button>',
    responsive: [
                  {
                    breakpoint: 576,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 992,
                    settings: {
                      slidesToShow: 2,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 1200,
                    settings: {
                      slidesToShow: 3,
                      slidesToScroll: 1
                    }
                  },

                ]
    });

  $('.collection-slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    prevArrow: '<button class="slide-arrow prev-arrow"><img src="'+arrow+'" alt=""></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><img src="'+arrow+'" alt=""></button>',
    responsive: [
                  {
                    breakpoint: 576,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                ]
    });

  $('.bull-kong-slider').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    prevArrow: '<button class="slide-arrow prev-arrow"><img src="'+arrow+'" alt=""></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><img src="'+arrow+'" alt=""></button>',
    responsive: [
                  {
                    breakpoint: 576,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 992,
                    settings: {
                      slidesToShow: 2,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 1200,
                    settings: {
                      slidesToShow: 3,
                      slidesToScroll: 1
                    }
                  },

                ]
    });


  $( "#datepicker1" ).datepicker({ dateFormat: 'dd-mm-yy',maxDate: 0 });
  $( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-yy',maxDate: 0 });    
  $( "#datepicker3" ).datepicker({ dateFormat: 'dd-mm-yy',maxDate: 0 });    
  $( "#datepicker4" ).datepicker({ dateFormat: 'dd-mm-yy',maxDate: 0 });    

});


 $(document).on('click', '.second-ajax-pag .pagination a',function(event)
 {
    event.preventDefault();
    
    $('.datas').append('<div class="cus-spinner-full"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
    $(this).parent('li').removeClass('active');
    $(this).parent('li').addClass('active');
    var myurl = $(this).attr('href');
    var page=$(this).attr('href').split('page=')[1];
     $.ajax(
    {
      url: '?page=' + page,
      type: "get",
      datatype: "html",
      data:{
        // htype: htype,
      },
    }).done(function(data){
     $(".table-history").empty().html(data);
     location.hash = page;
   }).fail(function(jqXHR, ajaxOptions, thrownError){
    alert('No response from server');   
    $('.cus-spinner-full').hide(200);
  });
 });
 function getData(page,htype = 0){
    $.ajax(
    {
      url: '?page=' + page,
      type: "get",
      datatype: "html",
      data:{
        htype: htype,
     },
  }).done(function(data){
   $(".table-history").empty().html(data);
   location.hash = page;
}).fail(function(jqXHR, ajaxOptions, thrownError){
  alert('No response from server');   
  $('.cus-spinner-full').hide(200);
});
}



    /*************************step wizard***************************/
  // $(document).ready(function(){  
  //   $("#form-wizards-register").steps({
  //     bodyTag: "fieldset",
  //     labels:{
  //     finish: '<button class="btn bg-warning text-white py-4 px-5 font-weight-bold rounded-0 mt-4 mt-md-2 font-18" id="finish">FINISH</button>',
  //     next: '<button class="btn bg-warning text-white py-4 px-5 font-weight-bold rounded-0 mt-4 mt-md-2 font-18">NEXT <img src="../images/assets/Staking_Pools/Group179.png" class="img-fluid ml-3 align-middle" alt=""></button>',
  //     previous: '<button class="btn bg-transparent border-warning text-white py-4 px-5 mt-4 mt-md-2 font-weight-bold rounded-0 font-18">PREVIOUS <img src="../images/assets/Staking_Pools/Group179.png" class="img-fluid ml-3 align-middle" alt=""></button>'
  //   },

  //     onInit: function (event, current) {
  //       var sigpad = $('#sigpad').signature({syncField: '#signature', syncFormat: 'PNG'});
  //       $('#clear').click(function(e) {
  //           e.preventDefault();
  //           sigpad.signature('clear');
  //           $("#signature").val('');
  //       });
  //         $('.actions > ul > li:first-child').attr('style', 'display:none');
  //     },
  //     onStepChanging: function (event, currentIndex, newIndex){    
  //         $('.actions > ul > li:first-child').attr('style', 'display:block');
  //         return true;
  //     }
      
  //   });   
  //   $('#finish').click(function() {
  //     window.location.href = 'login.html';
  //     return false;
  //   });
  // });
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
  $("#cryptowalletform").validate({
      rules: {
           amount: {
              required: true,
              positiveNumber:true,
              minlength: 0,
              maxlength: 6,
           },
           secure_password: {
              required: true,
           },
           upload_proof:{
            required: true,
            extension:'png|jpeg|jpg|pdf'
           }        
      },
      messages:{
      },

  });
  $("#cryptowalletform-myr").validate({
      rules: {
           amount: {
              required: true,
              positiveNumber:true,
              minlength: 0,
              maxlength: 6,
           },
           bank_id: {
              required: true,
           },
           secure_password: {
              required: true,
           }        
      },
      messages:{
        
      },

  });
  $("#yield-wallet-confirm").validate({
      ignore: "input[type='text']:hidden",
      rules: {
          amount: {
              required: true,
              number: true,
              positiveNumber:true,
              minlength: 0,
              maxlength: 6,
          },
          fund_type: {
              required: true,
          },
          secure_password: {
              required: true,
          },
      },
      messages: {
          secure_password: {
              required: securepassword_required_field,
          },            
          fund_type: {
              required: select_fund_type,
          },
          amount: {
              required: amount_required_field,
              number: enter_valid_number,
          },
      },
      submitHandler: function (form,event) {
          withdrawal_popup_txt = withdrawal_popup_txt.replace(':amount',$("input[name=amount]").val());
          if($('select[name="fund_type"]').val() == '0'){
              withdrawal_popup_txt = withdrawal_popup_txt.replace(':wallet',"Crypto");
          }else if($('select[name="fund_type"]').val() == '1'){
            withdrawal_popup_txt = withdrawal_popup_txt.replace(':wallet',"Withdrawal");
          }else{
              withdrawal_popup_txt = withdrawal_popup_txt.replace(':wallet',"NFT");
          }
          event.preventDefault();           
          swal({
            title: withdrawal_popup_txt,
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-danger",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false
        },
        function(isConfirm){
          if (isConfirm == true) {
              form.submit();
          }else{
              event.preventDefault();
          }
      });
          
      }
  });
  if($('.dropify').length){
      $('.dropify').dropify({
          messages: {
              'default': 'Drag and drop a file here or click',
              'replace': 'Drag and drop or click to replace',
              'remove':  'Remove',
          }
      });
  }
  $("#withdrawalform-usdt").validate({
      rules: {
           amount: {
              required: true,
              number:true,
              positiveNumber:true,
              minlength: 0,
              min:100,                
              max:10000000
           },
           secure_password: {
              required: true,
           },
           upload_proof:{
            required: true,
            extension:'png|jpeg|jpg' 
           }        
      },
      messages:{
      },

  });
  $("#cryptowalletform-coin").validate({
      rules: {
           amount: {
              required: true,
              number:true,
              positiveNumber:true,
              minlength: 0,
              min:10,                
              max:10000000
           },
           secure_password: {
              required: true,
           },       
      },
      messages:{
      },

  });
  $("#withdrawalform").validate({
      rules: {
           amount: {
              required: true,
              number:true,
              positiveNumber:true,
              minlength: 0,
              min:100,                
              max:10000000
           },
           secure_password: {
              required: true,
           }        
      },
      messages:{
      },

  });
  /*function getData(page,htype = 0){
      $.ajax(
      {
          url: '?page=' + page,
          type: "get",
          datatype: "html",
          data:{
              general_search: $('#sgenreal_search').val(),
              type: $( "#S_type option:selected" ).val(),
              status: $( "#S_status option:selected" ).val(),
              spagination: $( "#spagination option:selected" ).val(),
              htype: htype,
          },
      }).done(function(data){
          $(".table-pisprebate").empty().html(data);
          location.hash = page;
      }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');   
              $('.cus-spinner-full').hide(200);
      });
  }*/

  $(document).on('click', '.ticket-ajax-pag .pagination a',function(event)
  {
      event.preventDefault();
      
      $('.datas').append('<div class="cus-spinner-full"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
      $(this).parent('li span').parent('li span').removeClass('bg-warning px-1');
      $(this).parent('li span').addClass('bg-warning px-1');
      var myurl = $(this).attr('href');
      var page=$(this).attr('href').split('page=')[1];
      getData(page);
  });
  //For hepla and support 
  $(document).on('click', '.help-ajax',function(event){
      event.preventDefault();
      
      $('.datas').append('<div class="cus-spinner-full"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
      // var page=$(this).attr('href').split('page=')[1];
      
      var htype = $(this).attr('data-type');
      getData(0,htype);
  });
  //Suport ticket 
  $("#support-ticket").validate({
      ignore: "input[type='text']:hidden",
      rules: {
          subject_id: {
              required: true,
          },
          message: {
              required: true,
              normalizer: function(value) {
                  return $.trim(value);
              }
          },
          'attachment[]':{
              extension: "pdf|jpg|jpeg|png|JPG|JPEG",
              // filesize: 12000000
          }
      },
      messages: {
          subject_id:{
              required: title_required,
          },
          message:{
              required: messages_required,
          },
          'attachment[]':{
              extension: upload_bank_proof_img,
              // filesize: 'File size must be less than 12MB',
          }
      },
  });
  $("#personal-detail-upadte").validate({
        ignore: "input[type='text']:hidden",
        rules: {
                fullname: {
                    required: true,
                    maxlength: 50,
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
                phone_number: {
                    required: true,
                    number: true,
                    minlength:10,
                    maxlength: 15,
                },
            },
            messages: {
              name: {
                  required: "Please enter full name",
                  maxlength: "Maximim limit of sponsor name is 20 character",
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
              phone_number: {
                  required: "Please enter phone number",
                  number: "Please enter number only",
                  minlength:"Please enter minimum 9 character",
                  maxlength: "Maximim limit of username is 15 character",
              },
        },
  });
  $("#bank-detail-upadte").validate({
        ignore: "input[type='text']:hidden",
        rules: {
                bank_name:{
                    required: true,
                    maxlength: 50,
                },
                acc_holder_name:{
                    required: true,
                    maxlength: 50,
                    // equalTo: "#fullname"
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
            },
            messages: {
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
              
            },
  });
  $("#nft-wallet-address-upadte").validate({
        ignore: "input[type='text']:hidden",
        rules: {
                nft_wallet_address: {
                    required: true,
                    maxlength: 50,
                },
        },
        messages: {
          address: {
              required: "Please enter address",
          },
        },
  });
  $.validator.addMethod('mindate',function(v,el){
      // if (this.optional(el)){
      //     return true;
      // }
      if($("input[name=start_date]").val() == ''){
          return true;
      }
      var end_date = $("input[name=end_date]").datepicker('getDate');

      var start_date = $(el).datepicker('getDate');
      return end_date >= start_date;
  }, 'From Date must be less then To date');

  $.validator.addMethod('maxdate',function(v,el){
      if (this.optional(el)){
          return true;
      }
      if($("input[name=start_date]").val() == ''){
          return false;
      }
      var end_date = $("input[name=end_date]").datepicker('getDate');

      var start_date = $("input[name=start_date]").datepicker('getDate');
      return end_date >= start_date;
  }, 'To date must be greater then From date');
  $.validator.addMethod('c_mindate',function(v,el){
      // if (this.optional(el)){
      //     return true;
      // }
      if($("input[name=c_start_date]").val() == ''){
          return true;
      }
      var end_date = $("input[name=c_end_date]").datepicker('getDate');

      var start_date = $(el).datepicker('getDate');
      return end_date >= start_date;
  }, 'From Date must be less then To date');

  $.validator.addMethod('c_maxdate',function(v,el){
      if (this.optional(el)){
          return true;
      }
      if($("input[name=c_start_date]").val() == ''){
          return false;
      }
      var end_date = $("input[name=c_end_date]").datepicker('getDate');

      var start_date = $("input[name=c_start_date]").datepicker('getDate');
      return end_date >= start_date;
  }, 'To date must be greater then From date');
  $( "#export-staking-pool" ).validate({
      /*errorPlacement: function(error, element) {
          error.insertAfter(element.parent('div').parent('div'));
      },*/     
      rules: {
          start_date: {
              // required: true,
              mindate: true,
          },
          end_date: {
              // required: true,
              maxdate: true,
          },
          
      }, messages: {
          "start_date" :{
               mindate: "Start Date must be less then End Date"
          },
          "end_date" :{
               maxdate: "End Date must be greater then Start Date"
          },
              
      }
  });
  $( "#reports-pairing-commissions-export" ).validate({
      /*errorPlacement: function(error, element) {
          error.insertAfter(element.parent('div').parent('div'));
      },*/     
      rules: {
          c_start_date: {
              // required: true,
              c_mindate: true,
          },
          c_end_date: {
              // required: true,
              c_maxdate: true,
          },
          
      }, messages: {
          "c_start_date" :{
               c_mindate: "Start Date must be less then End Date"
          },
          "c_end_date" :{
               c_maxdate: "End Date must be greater then Start Date"
          },
              
      }
  });
  // commission-wallet-form validation
  $("#commission-wallet-confirm").validate({
      ignore: "input[type='text']:hidden",
      rules: {
          amount: {
              required: true,
              number: true,
              positiveNumber:true,
              minlength: 0,
              maxlength: 6,
          },
          fund_type: {
              required: true,
          },
          secure_password: {
              required: true,
          },
      },
      messages: {
          secure_password: {
              required: securepassword_required_field,
          },            
          fund_type: {
              required: select_fund_type,
          },
          amount: {
              required: amount_required_field,
              number: enter_valid_number,
          },
      },
  });
  $("#profile-image-update").validate({
      rules: {
           profile_image:{
            // required: true,
            extension:'png|jpeg|jpg'
           }        
      },
      messages:{
      },

  });


//Create New Ticket Hide Error Message
$('#new-tickets').on('hidden.bs.modal', function () {
    $('#new-tickets form')[0].reset();
    $("label.error").hide();
    $(".error-text").html("");
});
/***Copy element funtion*/
if($('#copy_code').length){
    document.getElementById("copy_code").addEventListener("click", function() {
        copyToClipboard(document.getElementById("copy-class-text"));
    });
}
  if($('#copy_address').length){
    document.getElementById("copy_address").addEventListener("click", function() {
        copyToClipboard(document.getElementById("copy-class-textaddress"));
    });
}
function copyToClipboard(elem) {
      // create hidden text element, if it doesn't already exist
      var targetId = "_hiddenCopyText_";
      var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
      var origSelectionStart, origSelectionEnd;
      if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    }
    else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
      succeed = document.execCommand("copy");
  } catch(e) {
    succeed = false;
}
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    jQuery('.copy_text').show().fadeOut(1500);
    return succeed;
}
$("#purchase_product").validate({
    ignore: "input[type='text']:hidden",
    rules: {
        security_password: {
            required: true,
        },
    },
    messages: {
        security_password: {
            required: securepassword_required_field,
        },
    }
});