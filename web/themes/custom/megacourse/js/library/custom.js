(function ($) {

jQuery('.content-bar').on('click', 'li', function() {
      jQuery('li.current').removeClass('current');
      jQuery(this).addClass('current');
});


})(jQuery);