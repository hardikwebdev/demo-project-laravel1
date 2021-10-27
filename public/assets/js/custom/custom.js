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


  $( "#datepicker1" ).datepicker();
  $( "#datepicker2" ).datepicker();    

});


 $(document).on('click', '.second-ajax-pag .pagination a',function(event)
 {
    event.preventDefault();
    
    $('.datas').append('<div class="cus-spinner-full"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
    $(this).parent('li').removeClass('active');
    $(this).parent('li').addClass('active');
    var myurl = $(this).attr('href');
    var page=$(this).attr('href').split('page=')[1];
    getData(page);
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
