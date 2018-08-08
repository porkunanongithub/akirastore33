<?php
 /**
** Adds logo_slider_widget widget.
**/
add_action('widgets_init', 'single_category_products_widget');
function single_category_products_widget() {
    /**
     * Check if WooCommerce is active
     **/
    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        return;
    }
    register_widget('ostore_single_category_products_widget_area');
}

class ostore_single_category_products_widget_area extends WP_Widget {

    /**
    * Register widget with WordPress.
    **/
    protected $kwidget; 
    public function __construct() {
        parent::__construct(
            'ostore_single_category_products_widget_area', 'OS: Single Category  Products', array(
            'description' => __('Display Single Category  Products Display', 'ostore')
        ));

        $this->kwidget = KWidget::get_instance();
    }
    
    /*
    * prepare fields array
    */
    private function widget_fields() {
        return array( 
			
			'single_category_collection' => array(
                'name' => 'single_category_collection',
                'title' => __('Select Single  Category Products', 'ostore'),
                'desc'  => __("Select Category", 'ostore'),
                'type'  => 'wocategory'
            ),
            'number_of_products' => array(
                'name' => 'number_of_products',
                'title' => __('Number of Products', 'ostore'),
                'desc'  => __("Select Category", 'ostore'),
                'type'  => 'number'
			)                
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
        $single_category_collection_id = ( ! empty( $instance['single_category_collection'] ) ) ? $instance['single_category_collection'] : '';
        $number_of_products = ( ! empty( $instance['number_of_products'] ) ) ? absint( $instance['number_of_products'] ) : '';
        
        $categories_id = array();

        
        echo $args['before_widget'];
        ?>
        <section id="hot-deal" class="ostore-hot-deal">
        <div class="container">
            <?php 
            $term = get_term_by( 'id', intval($single_category_collection_id), 'product_cat');
            
            //Term file
            if($term == null){
                $single_category_collection_id = ostore_woo_cat_id_by_slug('women-collection');
                
                //is default category
                if($single_category_collection_id == ''){
                    $single_category_collection_id = ostore_woo_cat_id_by_slug('uncategorized');
                }

                //multiple cat id
                $term = get_term_by( 'id', $single_category_collection_id, 'product_cat');
            }

            //Condtion for
            if( !empty($single_category_collection_id) ){
                $hot_deal_title = $term->name;
                $hot_deal_short_desc = substr($term->description,0,40);
                
                //Functions call
                ostore_title( $hot_deal_title,$hot_deal_short_desc ); 
            }
            ?>
            <div class="row">
                <?php
                    $product_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'term_id', 
                                'terms'     => $single_category_collection_id                                                                 
                            ),
                            array(
                                'taxonomy' => 'product_visibility',
                                'field' => 'name',
                                'terms' => 'exclude-from-catalog',
                                'operator'  =>  'NOT IN'
                            )
                        ),
                        'posts_per_page' => $number_of_products
                    );
                    $query = new WP_Query($product_args);
                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        //porducts call hear
                        ?>
                         <div class="col-md-3 col-sm-6 ostore-hot-deal">
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                        </div>
                        <?php
                     } }else{
                        echo esc_html__("No products found!", 'ostore');
                    } wp_reset_postdata(); ?>
                </div>
                </div>
            </section>
        <?php      
        echo $args['after_widget'];
    }
}
