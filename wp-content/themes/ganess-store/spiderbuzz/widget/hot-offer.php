<?php
/**
 * Blog Widgets Section
 */
class Ganess_Store_Hot_Offer_Section extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'ganess_store_hot_offer_section', // Base ID
			esc_html__( 'GS: Hot Offer Section', 'ganess-store' ), //Widget Name
			array( 'description' => esc_html__( 'Display Hot Products', 'ganess-store' ), ) // Args
		);
	}

	/**
     * Widget Form Section
     */
	public function form( $instance ) {
		$defaults = array(
			'title'			=> esc_html__( 'Hot Offer', 'ganess-store' ),
			'category_select_id'		=> 'all',
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
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
			<input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'number_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_posts' ) );?>" value="<?php echo absint( $instance['number_posts'] ); ?>" size="3"/> 
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
		$instance[ 'number_posts' ] = intval( $new_instance[ 'number_posts' ]);
		return $instance;
	}


    /**
     * Front End Display
     */
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';	
        $hot_offer_title = apply_filters( 'widget_title', $title , $instance, $this->id_base );
		$category_select_id = ( ! empty( $instance['category_select_id'] ) ) ? absint( $instance['category_select_id'] ) : '';
		$number_posts = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 6; 
        
        //term links
        $term = get_term_by( 'id', $category_select_id, 'product_cat');
        if($term == null){
            $category_select_id = ganess_store_woo_cat_id_by_slug('healthy-summer');
            
            //is default category
            if($category_select_id == ''){
                $category_select_id = ganess_store_woo_cat_id_by_slug('uncategorized');
            }

        }

        // Hot Offer Products
        $hot_offer_product_args = array(
            'post_type' => 'product',
            'tax_query' => 
                array(
                    array('taxonomy'  => 'product_cat',
                        'field'     => 'term_id',
                        'terms'     => $category_select_id,
                    )
                ),
                'meta_query'     => array(
                    array(
                        'key'           => '_sale_price_dates_to',
                        'value'         => 0,
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                ),
            'posts_per_page' =>$number_posts
        );
    
    echo $args['before_widget'];
    ?>
        <section id="hotoffer" class="grid-container ">
            <?php if(!empty( $hot_offer_title) ) { ?><h2 class="section-title text-center"><?php echo wp_kses_post($hot_offer_title); ?></h2><?php } ?>
            <div class="grid-x grid-container align-justify hotoffer-arrow-container"></div>
            <div <?php body_class('hotoffer'); ?>>
                <?php
                    $query = new WP_Query( $hot_offer_product_args );
                    if( $query->have_posts() ) {  while( $query->have_posts() ) { $query->the_post();
                ?>
                <div class="item cell large-4">
                    <span class="hover">
                        <span class="button-container align-middle align-justify align-center-middle grid-x grid-container text-center">
                            <?php 
                                global $Ganess_Store_Woocommerce;
                                $Ganess_Store_Woocommerce->add_compare_link();
                                $Ganess_Store_Woocommerce->ganess_store_quickview(); 
                                ganess_store_wishlist_products();
                            ?>
                            <?php
                                $product_id = get_the_ID();
                                $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                                $price_sale = get_post_meta( $product_id, '_sale_price', true );
                                $date = date_create($sale_price_dates_to);
                                $new_date = date_format($date,"Y/m/d H:i");
                            ?>
                            <p class="promo countbox_1 timer-grid  countdown_<?php echo esc_attr($product_id); ?>">
                                <span ><i class="days"><?php esc_html_e('00','ganess-store'); ?></i><small><?php echo esc_html__('Days','ganess-store'); ?></small>
                                </span  >:<span ><i class="hours"><?php esc_html_e('00','ganess-store'); ?></i><small><?php echo esc_html__('Hours','ganess-store'); ?></small>
                                </span>:<span ><i class="minutes"><?php esc_html_e('00','ganess-store'); ?></i><small><?php echo esc_html__('Min','ganess-store'); ?></small>
                                </span>:<span ><i class="seconds"><?php esc_html_e('00','ganess-store'); ?></i><small><?php echo esc_html__('Sec','ganess-store'); ?></small></span>
                            </p>

                            <script type="text/javascript">
                                jQuery(document).ready(function($) {
                                    setTimeout(function(){
                                        jQuery(".countdown_<?php echo esc_attr($product_id); ?>").countdown({
                                            date: "<?php echo esc_attr($new_date); ?>",
                                            offset: -8,
                                            day: "Day",
                                            days: "Days"
                                        }, function () {
                                            console.log("done");
                                        });
                                    })
                                }, 900);
                            </script>
                        </span>
                        <span class="text-container">
                            <button type="button" class="detail-buttom"> <a href="<?php the_permalink(); ?>"><i class="fa fa-eye"></i><span><?php echo esc_html__('Details','ganess-store'); ?></span> </a></button>
                            <button type="button" class="add-to-cart-mt"><span><?php woocommerce_template_loop_add_to_cart(); ?> </span> </button>
                        </span>

                    </span>
                    <span class="image-container">
                        <?php global $post, $product; if ( $product->is_on_sale() ) : 
                            echo apply_filters( 'woocommerce_sale_flash', '<span class="sale">' . esc_html__( 'SALE', 'ganess-store' ) . '</span>', $post, $product ); ?>
                        <?php endif; ?>
                        <?php the_post_thumbnail( 'woocommerce_thumbnail' );  ?>
                    </span>
                    <span class="text-container">
                        <h3><?php the_title(); ?></h3>
                        <div class="grid-x align-middle-justify">
                            <span class="rating"><?php $Ganess_Store_Woocommerce->ganess_store_get_star_rating(); ?></span>
                            <span class="price"><?php woocommerce_template_loop_price(); ?></span>
                        </div>
                    </span>
                </div>
                <?php } } wp_reset_postdata(); ?>
            </div>
        </section>

	<?php
		echo $args['after_widget'];
	}


}
// Register The Category Posts
function ganess_store_hot_offer_config() {
    register_widget( 'Ganess_Store_Hot_Offer_Section' );
}
add_action( 'widgets_init', 'ganess_store_hot_offer_config' );
