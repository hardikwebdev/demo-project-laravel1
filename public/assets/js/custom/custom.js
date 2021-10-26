$(document).ready(function(){
  $('.dashboard-slider').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      prevArrow: '<button class="slide-arrow prev-arrow"><img src="../../images/assets/Dashboard/Group948.png" alt=""></button>',
      nextArrow: '<button class="slide-arrow next-arrow"><img src="../../images/assets/Dashboard/Group948.png" alt=""></button>'
    });

  $('.stacking-slider').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '<button class="slide-arrow prev-arrow"><img src="../../images/assets/Dashboard/Group948.png" alt=""></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><img src="../../images/assets/Dashboard/Group948.png" alt=""></button>',
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
    prevArrow: '<button class="slide-arrow prev-arrow"><img src="../../images/assets/Dashboard/Group948.png" alt=""></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><img src="../../images/assets/Dashboard/Group948.png" alt=""></button>',
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
    prevArrow: '<button class="slide-arrow prev-arrow"><img src="../../images/assets/Dashboard/Group948.png" alt=""></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><img src="../../images/assets/Dashboard/Group948.png" alt=""></button>',
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


  $( "#datepicker1" ).datepicker();
  $( "#datepicker2" ).datepicker();    

});






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
          security_password: {
              required: true,
          },
      },
      messages: {
          security_password: {
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
