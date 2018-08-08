<?php
/**
 * Blog Widgets Section
 */
class Ganess_Store_Featured_Products_Slider_Section extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'ganess_store_featured_products_slider_section', 
			esc_html__( 'GS:Featured Products Slider Section', 'ganess-store' ), //Widget Name
			array( 'description' => esc_html__( 'Display Latest Posts.', 'ganess-store' ), ) // Args
		);
	}

	/**
     * Widget Form Section
     */
	public function form( $instance ) {
		$defaults = array(
			'title'			=> esc_html__( 'Featured Products', 'ganess-store' ),
			'number_posts'	=> 5,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

        
	    ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Products Categorys Titl:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_posts' ) ); ?>"><?php echo esc_html__( 'Number of posts:', 'ganess-store' ); ?></label>
			<input class="widefat" type="number" id="<?php echo esc_attr($this->get_field_id( 'number_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_posts' ) );?>" value="<?php echo absint( $instance['number_posts'] ); ?>" size="3"/> 
		</p>
	<?php

	}

    /**
     * Post Update 
     */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );	
		$instance[ 'number_posts' ] = intval($new_instance[ 'number_posts' ]);
		return $instance;
	}

    /**
     * Front End Display
     */
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';	
        $product_slider_title = apply_filters( 'widget_title', $title , $instance, $this->id_base );
		$number_posts = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 6; 
    
    echo $before_widget;
    ?>
        <section id="hotoffer" class="grid-container ">
            <h2 class="section-title text-center"><?php echo esc_html($product_slider_title); ?></h2>
            <div class="grid-x grid-container align-justify hotoffer-arrow-container"></div>
                <div class="hotoffer">
                <?php
                    $tax_query[] = array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                        'operator' => 'IN',
                    );
                    
                    // And
                    $args = array(
                        'post_type'           => 'product',
                        'post_status'         => 'publish',
                        'ignore_sticky_posts' => 1,
                        'posts_per_page'      => $number_posts,
                        'orderby'   => 'meta_value_num',
                        'meta_key'  => '_price',
                        'order' => 'asc',
                        'tax_query'           => $tax_query
                    );
                    
                    $query = new WP_Query( $args );
                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) { $query->the_post();
                        echo wc_get_template_part( 'content', 'product' ); 
                    } } wp_reset_postdata(); ?>
            </div>
        </section>
	<?php
		echo $after_widget;
	}
}
// Register The Category Posts
function ganess_store_featured_products_slider_config() {
    register_widget( 'Ganess_Store_Featured_Products_Slider_Section' );
}
add_action( 'widgets_init', 'ganess_store_featured_products_slider_config' );