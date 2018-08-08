<?php
 /**
** Adds oStore_category_collection_widget widget.
**/
add_action('widgets_init', 'ostore_hlp_products_widget');
function ostore_hlp_products_widget() {
    /**
     * Check if WooCommerce is active
     **/
    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        return;
    }
        
    register_widget('ostore_hlp_products_widget_area');
}
class ostore_hlp_products_widget_area extends WP_Widget {

    /**
    * Register widget with WordPress.
    **/
    protected $kwidget; 
    public function __construct() {
        parent::__construct(
            'ostore_hlp_products_widget_area', 'OS: HLP Products', array(
            'description' => __('widget that show Hot Deal , Latest Products and Popular Products section', 'ostore')
        ));

        $this->kwidget = KWidget::get_instance();
    }
    
    /*
    * prepare fields array
    */
    private function widget_fields() {
    return array( 
        'ostore_hlp_products_style' => array(
            'name' => 'ostore_hlp_products_style',
            'title' => __('HLP Products Style', 'ostore'),
            'type' => 'select',
            'options' => array(
                'style1' => __("Style 1", 'ostore'),
                'style2' => __("Style 2", 'ostore')
            )
            ),
            'ostore_hot_deal_cat' => array(
            'name' => 'ostore_hot_deal_cat',
            'title' => __('HLP Category', 'ostore'),
            'type' => 'wocategory',
            'desc' => "Hot, Latest and Popular"
            ),
                        
        );
    } 
    /**
    * Update Form Vlaue 
    */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            $instance[$name] = $this->kwidget->update($widget_field, $new_instance[$name]);
        }
        return $instance;
    }

    /**
    * Backend Form 
    **/
    public function form($instance) {
        $widget_fields = $this->widget_fields();
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            $widgets_field_value = !empty($instance[$name]) ? $instance[$name] : '';
            $this->kwidget->prepare($this, $widget_field, $widgets_field_value);
        }
    }

    /**
    * Display section(frontend)
    */
    public function widget($args, $instance) {
        extract($args);
        extract($instance);

        /**
        * wp query for first block
        **/  
        $hlp_style = ( ! empty( $instance['ostore_hlp_products_style'] ) ) ? sanitize_text_field( $instance['ostore_hlp_products_style'] ) : 'style1';
        $categories_cat_id = ( ! empty( $instance['ostore_hot_deal_cat'] ) ) ? absint( $instance['ostore_hot_deal_cat'] ) : '';

        $default_cat_query = new WP_Query($args);


        $term = get_term_by( 'id', $categories_cat_id, 'product_cat');
        if($term == null){
            $categories_cat_id = ostore_woo_cat_id_by_slug('watch-collection');
            
            //is default category
            if($categories_cat_id == ''){
                $categories_cat_id = ostore_woo_cat_id_by_slug('uncategorized');
            }

        }


        $post_slide_product_args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'product_cat',
                    'field'     => 'term_id', 
                    'terms'     => $categories_cat_id                                                                 
                )),
            'posts_per_page' => 3
        );

        echo $args['before_widget'];

        ?>
            <section class="ostore_hlp_product_area">
                <!-- End page header-->
                <div class="container">
                <div class="row equal-height">
                    <!-- Start Hot Deal Product -->
                    <?php if($hlp_style=='style1'){  
                        do_action('ostore_hlp_hot_deal_product',$post_slide_product_args,$categories_cat_id); 
                    } ?> 
                    <!-- Statrt Latest Products -->
                    <div class="col-md-4 col-sm-6 col-lg-4">
                    <div <?php post_class('panel_product ostore-hlp-panel-products'); ?> >
                        <h2 class="ostore_hlp_title"><?php echo esc_html__('Lastest Products','ostore'); ?></h2>

                        <?php
                            $latest_product_args = array(
                                'post_type' => 'product',                             
                                'posts_per_page' => 4
                            );
                            $query = new WP_Query($latest_product_args);
                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        ?>
                        <div class="ostore_hlp_single_panel_product">
                        <div class="ostore_hlp_panel_left">
                            <div class="panelp_img"> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('ostore-hlp-products'); ?></a> </div>
                        </div>
                        <div class="osote_hlp_panel_right">
                            <div class="ostore_hlp_des fix">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="price">
                                <div class="price-box"> <span class="regular-price"> <span class="price"><?php woocommerce_template_loop_price(); ?></span> </span> </div>
                                <div class="rating">
                                    <span><?php  ostore_get_star_rating(); ?></span>  
                                </div>
                                <div class="ostore_hlp_actions"> 
                                    <?php 
                                        if(function_exists( 'ostore_wishlist' )) { ostore_wishlist_products(); } 
                                        if(function_exists('ostore_quickview')){ostore_quickview();} 
                                        if(function_exists('ostore_add_compare_link')){ostore_add_compare_link();} 

                                        
                                        //woocommerce add to cart btn
                                        global $product;
                                        $id = $product->get_id();
                                        echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                            sprintf( '<a href="/%s/?add-to-cart=%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="add_to_cart_button ajax_add_to_cart" data-quantity="1"><i class="fa fa-shopping-cart"></i></a></a>',
                                                esc_attr( get_bloginfo('name') ),
                                                esc_attr( $id ),
                                                esc_attr( $id ),
                                                esc_attr( $product->get_sku() ),
                                                $product->is_purchasable() ? 'add_to_cart_button' : '',
                                                esc_attr( $product->get_type() ),
                                                esc_html( $product->add_to_cart_text() )
                                            ),
                                        $product );          

                                    ?>
                                </div>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php }} ?>
                        
                    </div>
                    </div><!-- End Latest Product -->
                    <!-- Start Hot Deal Product -->
                    <!-- Start Hot Deal Product -->
                    <?php if($hlp_style=='style2'){  
                         do_action('ostore_hlp_hot_deal_product',$post_slide_product_args,$categories_cat_id); 
                     } ?>  
                    <!-- End Hot Deal Poduct -->
                    <div class="col-md-4 col-sm-12 col-lg-4">
                    <div <?php post_class('panel_product ostore-hlp-panel-products'); ?>  >
                        <h2 class="ostore_hlp_title popular"><?php echo esc_html__('Popular Products','ostore'); ?></h2>
                        <?php
                            $ostore_hotdeal_label = esc_html__('New', 'ostore');
                            $upsell_product = array(
                                'post_type'         => 'product',
                                'meta_key'          => 'total_sales',
                                'orderby'           => 'meta_value_num',
                                'posts_per_page'    => 4
                            );
                            $query = new WP_Query($upsell_product);
                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        ?>
                        <div class="ostore_hlp_single_panel_product">
                        <div class="ostore_hlp_panel_left">
                            <div class="panelp_img"> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('ostore-hlp-products'); ?></a> </div>
                        </div>
                        <div class="osote_hlp_panel_right">
                            <div class="ostore_hlp_des fix popular-product">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="ostore-hlp-desc hidden-lg hidden-md hidden-xs"><p><?php the_excerpt(); ?></p></div>
                            <div class="price">
                                <div class="price-box"> <span class="regular-price"> <span class="price"><?php woocommerce_template_loop_price(); ?></span> </span> </div>
                                <div class="rating">
                                    <span><?php  ostore_get_star_rating()  ?></span>  
                                </div>
                                <div class="ostore_hlp_actions"> 
                                    <?php 
                                        if(function_exists( 'ostore_wishlist_products' )) { ostore_wishlist_products(); }  
                                        if(function_exists('ostore_quickview')){ostore_quickview();} 
                                        if(function_exists('ostore_add_compare_link')){ostore_add_compare_link();} 
                                    
                                        //woocommerce add to cart btn
                                        global $product;
                                        $id = $product->get_id();
                                        echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                            sprintf( '<a href="/%s/?add-to-cart=%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="add_to_cart_button ajax_add_to_cart" data-quantity="1"><i class="fa fa-shopping-cart"></i></a></a>',
                                                esc_attr( get_bloginfo('name') ),
                                                esc_attr( $id ),
                                                esc_attr( $id ),
                                                esc_attr( $product->get_sku() ),
                                                $product->is_purchasable() ? 'add_to_cart_button' : '',
                                                esc_attr( $product->get_type() ),
                                                esc_html( $product->add_to_cart_text() )
                                            ),
                                        $product );
                                    ?>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php }} ?>
                    </div>
                    </div>
                    
                </div>
                </div>
            </section>        
        <?php        
        echo $args['after_widget'];
    }
}