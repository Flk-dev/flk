(function ($) {
  	$(document).ready(function () {

		$('.nd_form button').click(function(e){

			e.preventDefault();
			$('input.error, select.error').removeClass('error');

			var form = $(this).closest('form'),
				title = form.find('input[name="title"]'),
				type = form.find('select[name="type"]'),
				city = form.find('select[name="city"]'),
				pl = form.find('input[name="pl"]'),
				price = form.find('input[name="price"]'),
				address = form.find('input[name="address"]'),
				zh_pl = form.find('input[name="zh_pl"]'),
				et = form.find('input[name="et"]');

            if(title.val() == ''){
            	title.addClass('error');
            }

            if(pl.val() == ''){
            	pl.addClass('error');
            }

            if(price.val() == ''){
            	price.addClass('error');
            }

            if(address.val() == ''){
            	address.addClass('error');
            }

            if(zh_pl.val() == ''){
            	zh_pl.addClass('error');
            }

            if(et.val() == ''){
            	et.addClass('error');
            }

            if(type.val() == '0'){
            	type.addClass('error');
            }

            if(city.val() == '0'){
            	city.addClass('error');
            }


            if(form.find('input.error').length == 0) {
				$.ajax({
					url: '/wp-admin/admin-ajax.php',
					type: 'POST',
					data: form.serialize() + '&action=send_nd',
					success: function( result ) {

						if(result.success == true){
							form.find('.umessage').html(result.message).slideDown(200).addClass('success');
							form[0].reset();
						} else {
							form.find('.umessage').html(result.message).slideDown(200).addClass('fail');
						}

					}
				});
			}
		});

  	});
})(jQuery);