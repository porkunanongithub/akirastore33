<?php
/**
 * Blog Widgets Section
 */
class Ganess_Store_Products_Slider_Section extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'ganess_store_products_slider_section', 
			esc_html__( 'GS: Products Slider Section', 'ganess-store' ), //Widget Name
			array( 'description' => esc_html__( 'Display Latest Posts.', 'ganess-store' ), ) // Args
		);
	}

	/**
     * Widget Form Section
     */
	public function form( $instance ) {
		$defaults = array(
			'title'			=> esc_html__( 'Popular Products', 'ganess-store' ),
			'category_select_id' => 'all',
			'number_posts'	=> 5,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

        $taxonomy     = 'product_cat';
        $empty        = 1;
        $orderby      = 'name';  
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no  
        $title        = '';  
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );

        $all_categorys = get_categories($args);
	    ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Products Categorys Titl:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>

        <p>
            <label for="<?php echo esc_html__('Category Select','ganess-store'); ?>"><?php echo esc_html__('Category Select','ganess-store'); ?>:</label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'category_select_id' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'category_select_id' ) ); ?>" class="widefat">
                
                <?php foreach ($all_categorys as $categore) { ?>
                    <option value="<?php echo intval($categore->cat_ID); ?>" id="<?php echo intval($categore->cat_ID); ?>" <?php selected($instance['category_select_id'], $categore->cat_ID); ?>><?php echo  esc_html($categore->name); ?></option>
                <?php } ?>
            </select>
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
        $instance[ 'category_select_id' ]	= intval( $new_instance[ 'category_select_id' ] );
        
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
		$category_select_id = ( ! empty( $instance['category_select_id'] ) ) ? absint( $instance['category_select_id'] ) : '';
		$number_posts = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 6; 
    
        //term links
        $term = get_term_by( 'id', $category_select_id, 'product_cat');
        if($term == null){
            $category_select_id = ganess_store_woo_cat_id_by_slug('healthy-summer');
        }

        echo $args['before_widget'];
    ?>
        <section id="hotoffer" class="grid-container ">
            <h2 class="section-title text-center"><?php echo esc_html($product_slider_title); ?></h2>
            <div class="grid-x grid-container align-justify hotoffer-arrow-container"></div>
                <div class="hotoffer">
                <?php
                    $product_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'term_id', 
                                'terms'     => $category_select_id                                                                 
                            )),
                        'posts_per_page' => $number_posts
                    );
                    $query = new WP_Query($product_args);
                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        echo wc_get_template_part( 'content', 'product' ); 
                    } } wp_reset_postdata(); ?>
            </div>
        </section>
	<?php
		echo $args['after_widget'];
	}
}
// Register The Category Posts
function ganess_store_products_slider_config() {
    register_widget( 'Ganess_Store_Products_Slider_Section' );
}
add_action( 'widgets_init', 'ganess_store_products_slider_config' );