<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package Baltic
 */

$unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<?php if ( ! class_exists( 'WooCommerce' ) ) :?>
<div class="widget header-search-area">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="<?php echo esc_attr( $unique_id ); ?>">
			<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'baltic' ); ?></span>
		</label>
		<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'baltic' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<?php
		wp_dropdown_categories( array(
			'name' 				=> 'category',
			'taxonomy' 			=> 'category',
			'show_option_none'	=> esc_html__( 'All Categories', 'baltic' ),
			'option_none_value'	=> '',
			'orderby'			=> 'name',
			'value_field' 		=> 'slug',
			'class'				=> 'search-filter'
		));
		?>
		<button type="submit" class="search-submit">
			<?php Baltic_Icons::svg( array( 'class' => 'icon-stroke', 'icon' => 'search' ) ); ?>
			<span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', 'baltic' ); ?></span>
		</button>
	</form>
</div>
<?php else : ?>
<div class="widget header-search-area">
	<form role="search" method="get" class="woocommerce-product-search search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>">
			<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'baltic' ); ?></span>
		</label>
		<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'baltic' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<input type="hidden" name="post_type" value="product" />
		<?php
		wp_dropdown_categories( array(
			'name' 				=> 'product_cat',
			'taxonomy' 			=> 'product_cat',
			'show_option_none'	=> esc_html__( 'All Products', 'baltic' ),
			'option_none_value'	=> '',
			'orderby'			=> 'name',
			'value_field' 		=> 'slug',
			'class'				=> 'search-filter'
		));
		?>
		<button type="submit" class="search-submit">
			<?php Baltic_Icons::svg( array( 'class' => 'icon-stroke', 'icon' => 'search' ) ); ?>
			<span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', 'baltic' ); ?></span>
		</button>
	</form>
</div>
<?php endif;?>
