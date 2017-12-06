(function ($) {

jQuery('.content-bar').on('click', 'li', function() {
      jQuery('li.current').removeClass('current');
      jQuery(this).addClass('current');
});

jQuery( ".private-message-inbox-thread-link" ).click(function() {
  //alert( "Handler for .click() called." );
  window.load();
});

})(jQuery);