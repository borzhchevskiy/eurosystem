<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */
 
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
	<div class="widget_shopping_cart_body matjar-scroll">
		<div class="matjar-scroll-content">
			<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
				<?php
					do_action( 'woocommerce_before_mini_cart_contents' );

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							/**
							 * This filter is documented in woocommerce/templates/cart/cart.php.
							 *
							 * @since 2.1.0
							 */
							$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
							$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<li 
								class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>"
								data-cart_item_key="<?php echo esc_attr( $cart_item_key );?>"
							>
								<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											/* translators: %s is the product name */
											esc_attr( sprintf( __( 'Remove %s from cart', 'matjar' ), wp_strip_all_tags( $product_name ) ) ),
											esc_attr( $product_id ),
											esc_attr( $cart_item_key ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
								?>
								<?php if ( empty( $product_permalink ) ) : ?>
									<?php echo wp_kses_post( $thumbnail ); ?>
								<?php else : ?>
									<a class="mini_cart_item_image" href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo wp_kses_post( $thumbnail ); ?>
									</a>
								<?php endif; ?>
								<div class="mini-cart-item-content">
									<?php if ( empty( $product_permalink ) ) : ?>
										<?php echo wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php else : ?>
										<a class="mini_cart_item_image" href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</a>
									<?php endif; ?>
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
									<?php
									if( matjar_get_option( 'mini-cart-quantity', 1 ) ) {	
										if ( ! $_product->is_sold_individually() && $_product->is_purchasable() ) {
											woocommerce_quantity_input(
												array(
													'input_value' => $cart_item['quantity'],
													'min_value' => 0,
													'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
												),
												$_product
											);
										}
									}
									?>
									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
								</div>
							</li>
							<?php
						}
					}

					do_action( 'woocommerce_mini_cart_contents' );
				?>
			</ul>
		</div>
	</div>
	
	<div class="widget_shopping_cart_footer">
	
		<p class="woocommerce-mini-cart__total total">
			<?php
			/**
			 * Woocommerce_widget_shopping_cart_total hook.
			 *
			 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
			 */
			do_action( 'woocommerce_widget_shopping_cart_total' );
			?>
		</p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
		
	</div>

<?php else : ?>
	
	<div class="woocommerce-mini-cart-empty">
		<i class="cart-empty-icon"></i>
		<p class="woocommerce-mini-cart__empty-message"><?php echo apply_filters( 'matjar_woocommerce_empty_mini_cart_message', esc_html__( 'Shopping cart is empty!', 'matjar' ) ); ?></p>	
		<?php do_action( 'matjar_after_empty_mini_cart' ); ?>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
