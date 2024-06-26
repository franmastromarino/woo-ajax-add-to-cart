(function ($) {

	function serializeForm(form, submitter) {
		var formData = new FormData(form, submitter);
		var serializedObject = {};
	
		formData.forEach(function(value, key) {
			if (key.includes('[')) {
				var keys = key.split(/\[|\]/).filter(function(k) { return k; });
				var current = serializedObject;
	
				keys.forEach(function(subKey, index) {
					if (index === keys.length - 1) {
						if (Array.isArray(current[subKey])) {
							current[subKey].push(value);
						} else if (current[subKey]) {
							current[subKey] = [current[subKey], value];
						} else {
							current[subKey] = key.includes('[]') ? [value] : value; // Key includes [] without a subkey, ie: field[].
						}
					} else {
						if (!current[subKey]) {
							current[subKey] = {};
						}
						current = current[subKey];
					}
				});
			} else {
				if (serializedObject[key]) {
					if (Array.isArray(serializedObject[key])) {
						serializedObject[key].push(value);
					} else {
						serializedObject[key] = [serializedObject[key], value];
					}
				} else {
					serializedObject[key] = value;
				}
			}
		});
 
		// Check if product_id exists, if not add it with the value of add-to-cart. Use variation_id for variable products.
		if (serializedObject['variation_id']) {
			serializedObject['product_id'] = serializedObject['variation_id'];  
		} else if (!serializedObject['product_id'] && serializedObject['add-to-cart']) {
			serializedObject['product_id'] = serializedObject['add-to-cart'];
		}

		delete serializedObject['add-to-cart']; // Need to remove this so that the form handler doesn't try to add the product to the cart again.
	
		return serializedObject;
	}
  
	$(document).on('click', '.single_add_to_cart_button:not(.disabled)', function (e) {
  
	  var $thisbutton = $(this),
			  $form = $thisbutton.closest('form.cart'),
			  data = serializeForm( $form[0], this );
  
	  e.preventDefault();

	  $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

		$.ajax({
			type: 'POST',
			url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
			data: data,
			beforeSend: function (response) {
				$thisbutton.prop( 'disabled', true );
				$thisbutton.removeClass('added').addClass('loading');
			},
			complete: function (response) {
				$thisbutton.prop( 'disabled', false );
				$thisbutton.addClass('added').removeClass('loading');
			},
			success: function (response) {

				if (response.error && response.product_url) {
					window.location = response.product_url;
					return;
				}

				$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
			},
		});

		return false;

	});
})(jQuery);
