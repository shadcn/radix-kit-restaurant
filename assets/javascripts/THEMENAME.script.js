/**
 * @file
 * Custom scripts for theme.
 */
(function ($) {
  Drupal.behaviors.THEMENAME = {
    attach: function(context, settings) {
      //
    }
  }

  function isBreakpoint(alias) {
    return $('.device-' + alias).is(':visible');
  }
})(jQuery);
