(function ($) {

jQuery('.content-bar').on('click', 'li', function() {
      jQuery('li.current').removeClass('current');
      jQuery(this).addClass('current');
});

jQuery( ".private-message-inbox-thread-link" ).click(function() {
  //alert( "Handler for .click() called." );
  window.load();
});

// jQuery("#ui-id-5").click(function(){
// 	alert( "Handler for .click() called." );
//     // jQuery("p").css("display", "none");
// });
// jQuery( document ).ready(function() {
//     jQuery("#navbar-collapse ul li:last-child").addClass("last-item");
// });

  $('body').on('keydown', '.user-login-form', function(e) {
    var key = e.which;
    if (key == 13) {
      // As ASCII code for ENTER key is "13"
      $('.modal-dialog .form-submit').click(); // Submit form code
    }
  });
  $('body').on('keydown', '.user-register-form', function(e) {
    var key = e.which;
    if (key == 13) {
      // As ASCII code for ENTER key is "13"
      $('.modal-dialog .form-submit').click(); // Submit form code
    }
  });


})(jQuery);