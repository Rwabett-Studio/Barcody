

function openNav() {
    $('#main').addClass('offset-lg-2');
    $('.header').addClass('offset-lg-2');
    $('#mySidebar').addClass('col-lg-2').animate({marginLeft:0});
    $('#openbtn').fadeOut('fast');

  }
  
  function closeNav() {
    $('#main').removeClass('offset-lg-2');
    $('.header').removeClass('offset-lg-2');
    $('#mySidebar').removeClass('col-lg-2').animate({marginLeft:-270});
    $('#openbtn').fadeIn(1000);
  }
  // checkbox 
  $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});


  // ------------------- 
  // new DataTable('#contactTable');
  $(document).ready( function () {
    var table = $('#contactTable').DataTable( {
      pageLength : 7,
      responsive: true,
      language: {
        oPaginate: {
          sNext: 'next',
          sPrevious: 'prev',
          // sFirst: '.',
          // sLast: ''
          }
          }  
    } )
    
  } );
