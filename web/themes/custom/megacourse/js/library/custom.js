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


})(jQuery);