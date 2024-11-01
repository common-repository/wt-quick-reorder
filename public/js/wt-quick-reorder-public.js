(function($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	jQuery(document).ready(function(){

	 	/* Show add to cart notice */
		setTimeout(function(){
			var $reorder_message = readCookie('wc_order_cart');
			if( $reorder_message == 'done' && $reorder_message != ''){
				jQuery('.top-cart-error .sucess').show();
			}
		},200);

	 	/* Hide add to cart notice */
		setTimeout(function(){
			jQuery('.top-cart-error .sucess').hide();
			jQuery('.top-cart-error .error').hide();
			eraseCookie('wc_order_cart');
		},5000);

	 	/* order product add to cart */
		jQuery(document).on('click','.top-cart-btn  .multi-add-to-cart-button',function(){
			var valid_flag = 0;
			var add_cart_obj = [];
			jQuery(this).addClass('active');

			var nonce_field = jQuery(this).parents('.top-cart-btn').find('input[name="reorderType"]').val();
			jQuery('.reorder-table tr').removeClass('error-tr');
			jQuery('.reorder-list-main .reorder-table tbody .wc-product').each(function(){
				jQuery(this).find('.reorder-subtable tbody .reorder-list.active').each(function(){
					var tr_this = jQuery(this);
					tr_this.removeClass('error-tr');
					var product_id = jQuery(this).attr('product_id');
					var variation_id = jQuery(this).attr('variation_id');
					if ( variation_id != 0 ) {
						product_id = variation_id;
					}
					

					if( jQuery(this).find('.quantity .input-text.qty').length == 0 ){
						var quantity = 1;
					}else{
						var quantity = jQuery(this).find('.quantity .input-text.qty').val();
					}

					if( quantity > 0){
						add_cart_obj.push( { 'produt_id' : product_id, 'quantity' : quantity } );	
					}else{
						valid_flag = 1;
						tr_this.addClass('error-tr');
					}						
				});
			});
			if( valid_flag == 0 ){
				add_cart_order_list_ajax( add_cart_obj , nonce_field );
			}else{
				var h_height = jQuery('header').outerHeight();
				jQuery('html, body').animate({scrollTop: jQuery('tr.reorder-list.error-tr').first().offset().top - h_height - 50 }, 1000);	
				jQuery(this).removeClass('active');
			}
		});

		jQuery(document).on('change','.product-qty .quantity .qty',function(){
			if( !jQuery(this).parents('.reorder-list').hasClass('active') ){				
				jQuery(this).parents('.reorder-list').find('.product-check input[name="check_add_cart"]').click();
			}
		});

		jQuery(document).on('change','.reorder-list td input[name="check_add_cart"]',function(){

			var product_id = jQuery(this).parents('.reorder-list').attr('product_id');
			jQuery('.reorder-list[product_id="'+product_id+'"]').toggleClass('same_product');
			jQuery(this).parents('.reorder-list').toggleClass('active').removeClass('same_product');
			var count = jQuery('.reorder-list.active').length;

			setTimeout(function(){

				jQuery('.reorder-list.hide[product_id="'+product_id+'"]').prop( "disabled", true );

				if( parseInt( count ) > 0 ){
					jQuery('.reorder-list-main .top-cart-btn .multi-add-to-cart-button').prop( "disabled", false );
				}else{
					jQuery('.reorder-list-main .top-cart-btn .multi-add-to-cart-button').prop( "disabled", true );
				}

			},100);
		});
		/* Plus Minus Qty Change Event */
		jQuery(document).on( 'click', 'button.wt-plus, button.wt-minus', function() {

			var qty = $( this ).parent( '.quantity' ).find( '.qty' );
			var val = parseFloat(qty.val());
			var max = parseFloat(qty.attr( 'max' ));
			var min = parseFloat(qty.attr( 'min' ));
			var step = parseFloat(qty.attr( 'step' ));

			if ( $( this ).is( '.wt-plus' ) ) {
				if ( max && ( max <= val ) ) {
					qty.val( max ).change();
				} else {
					qty.val( val + step ).change();
				}
			} else {
				if ( min && ( min >= val ) ) {
					qty.val( min ).change();
				} else if ( val > 1 ) {
					qty.val( val - step ).change();
				}
			}

		});

	 	/* Load more order list */
		jQuery(document).on('click','.load-more-button button', function() {
			var btn_this = jQuery(this);
			btn_this.find('.fa-spinner').css('display', 'inline-block');
			var order_date = jQuery('.reorder-list-filter .order-by-date').find(":selected").val();
			var page = jQuery(this).attr('page');
			var max_pages = jQuery(this).attr('max_pages');
			if( page == max_pages ) {
				jQuery('.load-more-button button.load-more').hide();
			}

			load_more_reorder_list_ajax( page, btn_this, order_date );

			return false;
		});

	});

})(jQuery);

	/* Set here function use to initialize quick reorder layout. */

function createCookie( name, value, days ) {
	var expires;
	if( days ) {
		var date = new Date();
		date.setTime( date.getTime() + ( days * 24 * 60 * 60 * 1000 ) );
		expires = "; expires=" + date.toGMTString();
	} else {
		expires = "";
	}
	document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie( name ) {
	var nameEQ = encodeURIComponent(name) + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) === ' ') { c = c.substring(1, c.length); }
		if( c.indexOf(nameEQ) === 0 ){ return decodeURIComponent(c.substring(nameEQ.length, c.length)); }
	}
	return null;
}

function eraseCookie( name ) {
	createCookie( name, "", -1 );
}

function add_cart_order_list_ajax( add_cart_obj , nonce_field = ''){

	if( add_cart_obj ){

		jQuery.ajax({
			url: wqrAjax.ajaxurl,
			type: 'POST',
			data: { action : 'wt_reorder_add_cart_obj' ,order_product_list: add_cart_obj, reorderType : nonce_field },
			success: function(response) {

				if( response ){

					jQuery('.top-cart-btn  .multi-add-to-cart-button').removeClass('active');

					if(response.sucess ){
						jQuery('.reorder-list td input[name="check_add_cart"]').prop('checked', false);
						jQuery('.reorder-list').removeClass('active').removeClass('same_product')
						jQuery('.reorder-list .product_qty .quantity .input-text').val('');
						createCookie('wc_order_cart','done',30);
						location.href = location.href
					}else{
						jQuery('.top-cart-error .error').show();
						jQuery('.top-cart-error .error').html(response.html);
					}

				}
			}
		});
	}
}

function load_more_reorder_list_ajax( page, btn_this, order_date ){

	if( page ){
		jQuery.ajax({
			type: "post",
			url: wqrAjax.ajaxurl,
			dataType: "html",
			data : { action : 'wt_reorder_load_more', nonce : wqrAjax.nonce, page: page, order_date: order_date },
			success: function (response) {
				btn_this.find('.fa-spinner').hide();
				if(response) {
					var reorder_html = JSON.parse(response); 
					if( reorder_html.html.length ){
						jQuery('.reorder-table > tbody > tr:last-child').after(reorder_html.html); 
					}
					jQuery('button.load-more').attr('page', parseInt(page)+parseInt(1));
				} else {
					jQuery('.load-more-button button.load-more').hide();
				}
			},

			error: function () {
				btn_this.find('.fa-spinner').hide();
				jQuery('.load-more-button button.load-more').hide();
			}

		});
	}

}