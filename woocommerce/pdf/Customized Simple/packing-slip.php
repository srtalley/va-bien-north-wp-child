<?php do_action( 'wpo_wcpdf_before_document', $this->type, $this->order ); ?>

	<div style="display:inline-block;width:22%;vertical-align:top;text-align:left;">"
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Va-invoice.png" alt="VaBien" width="99" height="61">
	</div>

<?php do_action( 'wpo_wcpdf_before_order_data', $this->type, $this->order ); ?>

	<div style="display:inline-block;width:28%;vertical-align:top;">

		<p style="margin-bottom: 35px;font-size:14px;"><?php _e( 'Shipping To:', 'woocommerce-pdf-invoices-packing-slips' ); ?><br>
			<?php $this->shipping_address(); ?><br>
			<?php $this->billing_email(); ?><br>
			<?php $this->billing_phone(); ?></p>


		<p style="padding-bottom:0px;margin-bottom:0;font-size:14px;"><span><?php _e( 'Order No.', 'woocommerce-pdf-invoices-packing-slips' ); ?></span>
			<span><?php $this->order_number(); ?></span></p>

	</div>

	<div style="display:inline-block;width:28%;vertical-align:top;">

		<p style="margin-bottom: 35px;font-size:14px;"><span><?php _e( 'Invoice No.', 'woocommerce-pdf-invoices-packing-slips' ); ?></span>
			<span><?php $this->invoice_number(); ?></span><br>
			<span><?php _e( 'Invoice Date:', 'woocommerce-pdf-invoices-packing-slips' ); ?></span> <span><?php $this->invoice_date( "M d, Y" ); ?></span><br>
			<span><?php _e( 'Shipping Method:', 'woocommerce-pdf-invoices-packing-slips' ); ?></span><br>
			<span><?php $this->shipping_method(); ?></span></p>

	</div>

<?php do_action( 'wpo_wcpdf_after_order_data', $this->type, $this->order ); ?>

	<div style="display:inline-block;width:20%;vertical-align:bottom;text-align:right;">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Bien-invoice.png" alt="VaBien" width="61" height="170">
	</div>

	<hr style="margin:50px 0;">

<?php do_action( 'wpo_wcpdf_before_order_details', $this->type, $this->order ); ?>

	<table class="order-details">
		<thead>
		<tr>
			<th class="product"><?php _e( 'Style', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
			<th class="product"><?php _e( 'Product', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
			<th class="quantity"><?php _e( 'Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
		</tr>
		</thead>
		<tbody>

		<?php		
		$items = $this->order->get_items();
		if ( sizeof( $items ) > 0 ) :

			foreach ( $items as $item_id => $item ) :
				$attribute_name = '';
				$attribute_value = '';
				$attribute_nice_name = '';
				$item_name = $item['name'];
				$product = $item->get_product();
				if($product != null) {

				
					if($product->is_type('variation')) {
						// Get the variation attributes
						$variation_attributes = $product->get_variation_attributes();

						// Loop through each selected attributes
						foreach($variation_attributes as $attribute_taxonomy => $term_slug) {
							$taxonomy = str_replace('attribute_', '', $attribute_taxonomy );

							// The name of the attribute
							$attribute_name = get_taxonomy( $taxonomy )->labels->singular_name;
	
							// The term name (or value) for this attribute
							$attribute_value = get_term_by( 'slug', $term_slug, $taxonomy )->name;
							// see if one of these values is blank. If so,
							// retrieve it from the order meta.
							if($attribute_value == '') {
								$order_meta = wc_get_order_item_meta($item_id, $taxonomy );
								$attribute_value = get_term_by('slug', $order_meta, $taxonomy)->name;

							} // end if attribute value is null
							// See if the attribute is in the item name
							if($attribute_value != '') {
								if(strpos($item_name, $attribute_value) === false) {
									$item_name .= ', ' . $attribute_value;
								}
							}
						} // end foreach variation attributes

					} // end if product is variation
				} // end if product is not null
			?>
				<tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item->get_id(), $this->type, $this->order, $item->get_id() ); ?>">

					<td style="width: 100px;">
					<?php
							// see if the custom style field is set
							$style_number = wc_get_order_item_meta( $item_id, 'Style Number' );
							// if it's not set, try and get the variation ID
							if($style_number == '') {
								if($product->is_type('variation')) {
									// get the parent of the variation
									$parent_id = $product->get_parent_id();
									$wc_parent_product = wc_get_product( $parent_id );
	
									// set the parent sku as MPN attribute
									$style_number = 'SKU: ' . $wc_parent_product->get_sku();
								} else {
									$style_number = 'SKU: ' . $product->get_sku();
								}
							}
							
							if ( $style_number != '' ) : ?>
								<p style="font-size: 15px;"><?php _e( $style_number ); ?></p>

							<?php endif; ?>
					</td>

					<td class="product">
						<?php $description_label = __( 'Description', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation
						?>

						<span class="item-name"><?php echo $item_name; ?></span>

						<?php do_action( 'wpo_wcpdf_before_item_meta', $this->type, $item, $this->order ); ?>

						<?php do_action( 'wpo_wcpdf_after_item_meta', $this->type, $item, $this->order ); ?>
					</td>
					<td class="quantity"><?php echo $item->get_quantity(); ?></td>
				</tr>
			<?php endforeach;
		endif;?>
		</tbody>
	</table>

<?php do_action( 'wpo_wcpdf_after_order_details', $this->type, $this->order ); ?>

<?php do_action( 'wpo_wcpdf_before_customer_notes', $this->type, $this->order ); ?>
	<div class="customer-notes">
		<?php if ( $this->get_shipping_notes() ) : ?>
			<h3><?php _e( 'Customer Notes', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
			<?php $this->shipping_notes(); ?>
		<?php endif; ?>
	</div>
<?php do_action( 'wpo_wcpdf_after_customer_notes', $this->type, $this->order ); ?>

<?php if ( $this->get_footer() ): ?>
	<div id="footer">
		<!--<?php $this->footer(); ?>-->
	</div><!-- #letter-footer -->
<?php endif; ?>
<p>	<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Va-invoice.png</p>

<?php do_action( 'wpo_wcpdf_after_document', $this->type, $this->order ); ?>