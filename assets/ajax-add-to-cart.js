(function ($) {
  $(document).on('click', '.single_add_to_cart_button:not(.disabled)', function (e) {

    var $thisbutton = $(this),
            $form = $thisbutton.closest('form.cart'),
            quantity = $form.find('input[name=quantity]').val() || 1,
            product_id = $form.find('input[name=variation_id]').val() || $thisbutton.val();

    if (product_id) {

      e.preventDefault();

      var data = {
        'product_id': product_id,
        'quantity': quantity
      };

      $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

      $.ajax({
        type: 'POST',
        url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
        data: data,
        beforeSend: function (response) {
          $thisbutton.removeClass('added').addClass('loading');
        },
        complete: function (response) {
          $thisbutton.addClass('added').removeClass('loading');
        },
        success: function (response) {

          if (response.error & response.product_url) {
            window.location = response.product_url;
            return;
          }

          $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
        },
      });
      return false;
    }

  });
})(jQuery);