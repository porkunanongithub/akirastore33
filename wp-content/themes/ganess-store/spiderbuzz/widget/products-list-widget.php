<?php

/**
 * Displays latest, category wised posts in a 3 block layout.
 */

class Ganess_Store_Product_List extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'ganess_store_product_list', // Base ID
			esc_html__( 'GS: Products List Display', 'ganess-store' ), // Name
			array( 'description' => esc_html__( 'Dispaly Products List.', 'ganess-store' ), ) // Args
		);
	}

	/**
     * Widget Form
     */
	public function form( $instance ) {
		$defaults = array(
			'onsell_products_title'	    => esc_html__( 'ONSELL PRODUCTS', 'ganess-store' ),
			'upsell_products_title'	    => esc_html__( 'UPSELL PRODUCTS', 'ganess-store' ),
			'featured_products_title'	=> esc_html__( 'FEATURED PRODUCTS', 'ganess-store' ),
            'number_posts'              => 3,
		);
        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'onsell_products_title' ) ); ?>"><?php echo esc_html__( 'Onsell Products Title:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'onsell_products_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'onsell_products_title' ) ); ?>" value="<?php echo esc_attr($instance['onsell_products_title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'upsell_products_title' ) ); ?>"><?php echo esc_html__( 'Upsell Products Title:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'upsell_products_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'upsell_products_title' ) ); ?>" value="<?php echo esc_attr($instance['upsell_products_title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'featured_products_title' ) ); ?>"><?php echo esc_html__( 'Featured Products Title:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'featured_products_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'featured_products_title' ) ); ?>" value="<?php echo esc_attr($instance['featured_products_title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_posts' ) ); ?>"><?php echo esc_html__( 'Number of posts:', 'ganess-store' ); ?></label>
			<input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'number_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_posts' ) );?>" value="<?php echo absint( $instance['number_posts'] ); ?>" size="3"/> 
		</p>
	<?php

	}
	/**
     * UPdate Widget Data
     */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		//
		$instance[ 'onsell_products_title' ] = sanitize_text_field( $new_instance[ 'onsell_products_title' ] );	
		$instance[ 'upsell_products_title' ] = sanitize_text_field( $new_instance[ 'upsell_products_title' ] );	
		$instance[ 'featured_products_title' ] = sanitize_text_field( $new_instance[ 'featured_products_title' ] );	
		$instance[ 'number_posts' ] = intval( $new_instance[ 'number_posts' ] );
		return $instance;
	}
	
    /*
    *  Widgets Section
    */
	public function widget( $args, $instance ) {
		extract($args);
        
        //Products List Values
		$onsell_products_title      = ( ! empty( $instance['onsell_products_title'] ) ) ? wp_kses_post($instance['onsell_products_title']) : 'ONSELL PRODUCTS';	
		$upsell_products_title      = ( ! empty( $instance['upsell_products_title'] ) ) ? wp_kses_post($instance['upsell_products_title']) : 'UPSELL PRODUCTS';
		$featured_products_title    = ( ! empty( $instance['featured_products_title'] ) ) ? wp_kses_post($instance['featured_products_title']) : 'FEATURED PRODUCTS';
		$number_posts               = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 6; 
        
        echo $args['before_widget'];
        ?>

        <section id="product" class="grid-container">
            <div class="grid-x grid-margin-x grid-margin-y">
                <div class="large-4 medium-4 small-12 cell grid-x grid-margin-y">
                    <div id="vertical-grid" class="cell large-12 medium-12 small-12">
                        <h3><?php echo esc_html($onsell_products_title); ?></h3>
                        <ul>
                            <?php
                            $on_sale = array(
                            'post_type'      => 'product',
                            'posts_per_page' => $number_posts,
                            'meta_query'     => array(
                                'relation' => 'OR',
                                array( // Simple products type
                                    'key'           => '_sale_price',
                                    'value'         => 0,
                                    'compare'       => '>',
                                    'type'          => 'numeric'
                                    ),
                                array( // Variable products type
                                    'key'           => '_min_variation_sale_price',
                                    'value'         => 0,
                                    'compare'       => '>',
                                    'type'          => 'numeric'
                                    )
                                )
                            );
                        $query = new WP_Query($on_sale);
                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                            ?>
                            <li class="item">
                            <a class="grid-x" href="<?php the_permalink(); ?>">
                                <span class="cell large-3 medium-3 small-3">
                                <?php the_post_thumbnail('ganess-store-product-list'); ?>
                                </span>
                                <span class="cell auto">
                                <h4><?php the_title(); ?></h4>
                                <?php the_excerpt(); ?>
                                <span class="grid-x align-middle">
                                    <strong><?php woocommerce_template_loop_price(); ?></strong>
                                </span>
                                </span>
                            </a>
                            </li>
                            <?php } } wp_reset_postdata(); ?>        
                        </ul>
                    </div>
                </div>
                <div class="large-4  medium-4 small-12 cell grid-x grid-margin-y">
                    <div id="vertical-grid" class="cell large-12 medium-12 small-12">
                        <h3><?php echo esc_html($upsell_products_title); ?></h3>
                        <ul>
                            <?php
                            $upsell_product = array(
                                'post_type'         => 'product',
                                'meta_key'          => 'total_sales',
                                'orderby'           => 'meta_value_num',
                                'posts_per_page'    => $number_posts
                                );
                        $query = new WP_Query($upsell_product);
                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                            ?>
                            <li class="item">
                            <a class="grid-x" href="<?php the_permalink(); ?>">
                                <span class="cell large-3 medium-3 small-3">
                                <?php the_post_thumbnail('ganess-store-product-list'); ?>
                                </span>
                                <span class="cell auto">
                                <h4><?php the_title(); ?></h4>
                                <?php the_excerpt(); ?>
                                <span class="grid-x align-middle">
                                    <strong><?php woocommerce_template_loop_price(); ?></strong>
                                </span>
                                </span>
                            </a>
                            </li>
                            <?php } } wp_reset_postdata(); ?>        
                        </ul>
                    </div>
                </div>

                <div class="large-4  medium-4 small-12 cell grid-x grid-margin-y">
                    <div id="vertical-grid" class="cell large-12 medium-12 small-12">
                        <h3><?php echo esc_html($featured_products_title); ?></h3>
                        <ul>
                            <?php
                            $meta_query   = WC()->query->get_meta_query();
                                $meta_query[] = array(
                                    'key'   => '_featured',
                                    'value' => 'yes'
                                );
                                $feched_products_args = array(
                                    'post_type'   =>  'product',
                                    'stock'       =>  1,
                                    'showposts'   =>  $number_posts,
                                    'orderby'     =>  'date',
                                    'order'       =>  'DESC',
                                    'meta_query'  =>  $meta_query,
                                );
                        $query = new WP_Query($feched_products_args);
                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                            ?>
                            <li class="item">
                            <a class="grid-x" href="<?php the_permalink(); ?>">
                                <span class="cell large-3 medium-3 small-3">
                                <?php the_post_thumbnail('ganess-store-product-list'); ?>
                                </span>
                                <span class="cell auto">
                                <h4><?php the_title(); ?></h4>
                                <?php the_excerpt(); ?>
                                <span class="grid-x align-middle">
                                    <strong><?php woocommerce_template_loop_price(); ?></strong>
                                </span>
                                </span>
                            </a>
                            </li>
                            <?php } } wp_reset_postdata(); ?>        
                        </ul>
                    </div>
                </div>
            </div>
        </section>
	    <?php
		echo $args['after_widget'];
	}

}
// Register single category posts widget
function ganess_store_product_list_config() {
    register_widget( 'Ganess_Store_Product_List' );
}
add_action( 'widgets_init', 'ganess_store_product_list_config' );