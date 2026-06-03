

function syncMobileShell(open) {
    if (window.innerWidth < 992) {
        $('body').toggleClass('sidebar-mobile-open', open);
    } else {
        $('body').removeClass('sidebar-mobile-open');
    }
}

function openNav() {
    $('#main').addClass('offset-lg-2');
    $('.header').addClass('offset-lg-2');
    $('#mySidebar').addClass('col-lg-2 is-open').animate({marginLeft:0});
    $('#openbtn').fadeOut('fast');
    if (window.innerWidth < 992) {
        syncMobileShell(true);
        $('#sidebarOverlay').fadeIn(150);
    }

  }
  
  function closeNav() {
    $('#main').removeClass('offset-lg-2');
    $('.header').removeClass('offset-lg-2');
    $('#mySidebar').removeClass('col-lg-2 is-open').animate({marginLeft:-270});
    $('#openbtn').fadeIn(1000);
    syncMobileShell(false);
    $('#sidebarOverlay').fadeOut(150);
  }

$(document).ready(function () {
  if (window.innerWidth < 992) {
    $('#main').removeClass('offset-lg-2');
    $('.header').removeClass('offset-lg-2');
    $('#mySidebar').removeClass('col-lg-2 is-open').css('marginLeft', -270);
    $('#openbtn').show();
    $('#sidebarOverlay').hide();
    syncMobileShell(false);
  } else {
    $('#sidebarOverlay').hide();
    syncMobileShell(false);
  }

  $('#sidebarOverlay').on('click', function () {
    closeNav();
  });
});

$(window).on('resize', function () {
  if (window.innerWidth >= 992) {
    $('#main').addClass('offset-lg-2');
    $('.header').addClass('offset-lg-2');
    $('#mySidebar').addClass('col-lg-2 is-open').css('marginLeft', 0);
    $('#openbtn').hide();
    $('#sidebarOverlay').hide();
    syncMobileShell(false);
  } else if ($('#mySidebar').hasClass('is-open')) {
    $('#sidebarOverlay').show();
    syncMobileShell(true);
  } else {
    $('#sidebarOverlay').hide();
    syncMobileShell(false);
  }
});

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

$(document).on('click', '.js-contact-delete', function () {
  const button = $(this);
  $('#deleteContactName').text(button.data('contact-name') || '-');
  $('#deleteContactPhone').text(button.data('contact-phone') || '-');
  $('#deleteContactEvent').text(button.data('contact-event') || '-');
  $('#contactDeleteForm').attr('action', button.data('contact-action') || '#');
});

$(document).on('click', '.js-event-delete', function () {
  const button = $(this);
  $('#deleteEventName').text(button.data('event-name') || '-');
  $('#deleteEventDate').text(button.data('event-date') || '-');
  $('#deleteEventCategory').text(button.data('event-category') || '-');
  $('#eventDeleteForm').attr('action', button.data('event-action') || '#');
});

$(document).on('click', '.js-user-delete', function () {
  const button = $(this);
  $('#deleteUserName').text(button.data('user-name') || '-');
  $('#deleteUserEmail').text(button.data('user-email') || '-');
  $('#deleteUserRole').text(button.data('user-role') || '-');
  $('#userDeleteForm').attr('action', button.data('user-action') || '#');
});

$(document).on('click', '.js-inbox-delete', function () {
  const button = $(this);
  $('#deleteInboxName').text(button.data('inbox-name') || '-');
  $('#deleteInboxEmail').text(button.data('inbox-email') || '-');
  $('#deleteInboxPhone').text(button.data('inbox-phone') || '-');
  $('#deleteInboxMessage').text(button.data('inbox-message') || '-');
  $('#inboxDeleteForm').attr('action', button.data('inbox-action') || '#');
});

$(document).on('click', '.js-hero-delete', function () {
  const button = $(this);
  $('#deleteHeroName').text(button.data('hero-name') || '-');
  $('#deleteHeroTitle').text(button.data('hero-title') || '-');
  $('#heroDeleteForm').attr('action', button.data('hero-action') || '#');
});

$(document).on('click', '.js-invitation-category-delete', function () {
  const button = $(this);
  $('#deleteInvitationCategoryName').text(button.data('category-name') || '-');
  $('#invitationCategoryDeleteForm').attr('action', button.data('category-action') || '#');
});

$(document).on('click', '.js-how-use-delete', function () {
  const button = $(this);
  $('#deleteHowUseName').text(button.data('how-use-name') || '-');
  $('#deleteHowUseDescription').text(button.data('how-use-description') || '-');
  $('#howUseDeleteForm').attr('action', button.data('how-use-action') || '#');
});

$(document).on('click', '.js-plan-delete', function () {
  const button = $(this);
  $('#deletePlanName').text(button.data('plan-name') || '-');
  $('#deletePlanPrice').text(button.data('plan-price') || '-');
  $('#planDeleteForm').attr('action', button.data('plan-action') || '#');
});

$(document).on('click', '.js-faq-delete', function () {
  const button = $(this);
  $('#deleteFaqQuestion').text(button.data('faq-question') || '-');
  $('#deleteFaqAnswer').text(button.data('faq-answer') || '-');
  $('#faqDeleteForm').attr('action', button.data('faq-action') || '#');
});

$(document).on('click', '.js-information-delete', function () {
  const button = $(this);
  $('#deleteInformationName').text(button.data('information-name') || '-');
  $('#deleteInformationTitle').text(button.data('information-title') || '-');
  $('#informationDeleteForm').attr('action', button.data('information-action') || '#');
});

$(document).on('change', 'input[type="file"][data-preview-target]', function () {
  const input = this;
  const file = input.files && input.files[0];
  const previewSelector = $(input).data('preview-target');
  const placeholderSelector = $(input).data('placeholder-target');
  const preview = previewSelector ? document.querySelector(previewSelector) : null;
  const placeholder = placeholderSelector ? document.querySelector(placeholderSelector) : null;

  if (!preview) {
    return;
  }

  if (!file) {
    preview.removeAttribute('src');
    preview.style.display = 'none';
    if (placeholder) {
      placeholder.style.display = 'inline-flex';
    }
    return;
  }

  const objectUrl = URL.createObjectURL(file);
  preview.src = objectUrl;
  preview.style.display = 'block';
  if (placeholder) {
    placeholder.style.display = 'none';
  }

  preview.onload = function () {
    URL.revokeObjectURL(objectUrl);
  };
});
