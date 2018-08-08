<?php
/**
** Adds Tab widget.
**/
add_action('widgets_init', 'tab_widget');
function tab_widget() {
    /**
     * Check if WooCommerce is active
     **/
    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        return;
    }
    register_widget('tab_widget_area');
}

class tab_widget_area extends WP_Widget {

    /**
    * Register widget with WordPress.
    **/
    protected $kwidget; 
    public function __construct() {
        parent::__construct(
            'tab_widget_area', 'OS: Tab Products Slider  ', array(
            'description' => esc_html__('Tab for WooCommerce or Product Category', 'ostore')
        ));

        $this->kwidget = KWidget::get_instance();
    }
    
    /*
    * prepare fields array
    */
    private function widget_fields() {
        return array( 
			'ostore_tab_title' => array(
                'name' => 'ostore_tab_title',
                'title' => __('Title', 'ostore'),
                'type' => 'text'
			),
			'ostore_tab_desc' => array(
                'name' => 'ostore_tab_desc',
                'title' => __('Very Short Description', 'ostore'),
                'type' => 'textarea',
                'rows'  => 4
			),
            'ostore_tab_radio' => array(
                'name' => 'ostore_tab_radio',
                'title' => __('Type of Tabs', 'ostore'),
                'type' => 'radio',
                'default'=>'wo',
                'options' => array(
                    'wo' => __("WoCommerce", 'ostore'),
                    'cat' => __("Categories", 'ostore')
                )
			),
            'default_woocommerce_collection' => array(
                'name' => 'default_woocommerce_collection',
                'title' => __('Select Default Woocommerce', 'ostore'),
                'type' => 'multiselect',
                'options' => array(
                    'feature_product' => __("Feature Product", 'ostore'),
                    'latest_product' =>  __("Latest Product", 'ostore'),
                    'onsale_product'  =>  __("Onsale Product", 'ostore'),
                    'upsale_product'  =>  __("Upsale Product", 'ostore')
                )
			),     
			'category_tab_collection' => array(
                'name' => 'category_tab_collection',
                'title' => __('Select Lists Collection Category', 'ostore'),
                'type' => 'womulticategory',
                'desc' => __('Select Multiple Category Show', 'ostore')
			),
            'ostore_tab_number' => array(
                'name' => 'ostore_tab_number',
                'title' => __('Number of product', 'ostore'),
                'type' => 'select',
                'options' => array("4" => 4, "5" => 5, "1"=> __("Please Upgrade for more..", 'ostore'))
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
        $tab_title = ( ! empty( $instance['ostore_tab_title'] ) ) ? sanitize_text_field( $instance['ostore_tab_title'] ) : '';
        $tab_short_desc = ( ! empty( $instance['ostore_tab_desc'] ) ) ? esc_textarea( $instance['ostore_tab_desc'] ) : '';
        $tab_multiple_category_id = ( ! empty( $instance['category_tab_collection'] ) ) ? $instance['category_tab_collection']  : array();
        $tab_product_count = ( ! empty( $instance['ostore_tab_number'] ) ) ? absint($instance['ostore_tab_number'])  : 4;
        $tab_product_multiple_select = ( ! empty( $instance['default_woocommerce_collection'] ) ) ? $instance['default_woocommerce_collection']  : array();
        $tab_product_default = ( ! empty( $instance['ostore_tab_radio'] ) ) ? sanitize_text_field( $instance['ostore_tab_radio'] ) : '';

        echo $before_widget;
        ?> 
        
            <div class="container">
            <div class="row">
            <div class="new-product col-xs-12 wow fadeInUp">
                <div class="heading">  
                    <?php if(!empty($tab_title)): ?><div class="hr-title ostore-tab-hr-title hr-long center"><span><?php echo esc_html($tab_title); ?></span> </div><?php endif; ?>
                    <?php if(!empty($tab_short_desc)): ?> <p class="ostore-hot-deal-desc"><?php echo wp_kses_post($tab_short_desc); ?></p> <?php endif; ?>
                </div>
                <div class="new-pro">
                <?php  do_action('ostore_tab_diff_layout',$tab_product_default,$tab_multiple_category_id,$tab_product_multiple_select); ?>
                
                <div id="productTabContent" class="tab-content">
                    <?php 
                        if($tab_product_default == 'cat' && (!empty($tab_multiple_category_id))){ 
                        $count =1;
                        foreach($tab_multiple_category_id as $tab_multiple_cat => $key_nothing){ 
                        $term = get_term_by( 'id', $tab_multiple_cat, 'product_cat');
                        
                        //term links
                        if($term == null){
                            $tab_multiple_cat = ostore_woo_cat_id_by_slug('women-collection');
                            
                            //is default category
                            if($tab_multiple_cat == ''){
                                $tab_multiple_cat = ostore_woo_cat_id_by_slug('uncategorized');
                            }

                            //multiple cat id
                            $term = get_term_by( 'id', $tab_multiple_cat, 'product_cat');
                        }
                        ?>
                        <div  class="tab-pane fade <?php if($count == 1){ ?>active in <?php }$count++; ?>"  id="<?php echo esc_attr( 
                            $term->slug ); ?>" >
                            <div class="slider-items-products">
                                <div id="new-product-slider" class="product-flexslider hidden-buttons">
                                <div class="slider-items slider-width-col4">
                                    <?php
                                        $product_args = array(
                                            'post_type' => 'product',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy'  => 'product_cat',
                                                    'field'     => 'term_id', 
                                                    'terms'     => $tab_multiple_cat                                                                 
                                                ),
                                                array(
                                                    'taxonomy' => 'product_visibility',
                                                    'field' => 'name',
                                                    'terms' => 'exclude-from-catalog',
                                                    'operator'  =>  'NOT IN'
                                                )
                                            ),
                                            'posts_per_page' => $tab_product_count
                                        );
                                        $query = new WP_Query($product_args);
                                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                            ?>
                                            <?php wc_get_template_part( 'content', 'product' ); ?>                          
                                        <?php } }else{
                                            echo esc_html__("No products found!", 'ostore');
                                        } wp_reset_postdata(); ?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <?php }  
                        if(!empty($tab_product_count)){
                        ?> 
                        <div  class="tab-pane fade "  id="all" >
                            <div class="slider-items-products">
                                <div id="new-product-slider" class="product-flexslider hidden-buttons">
                                <div class="slider-items slider-width-col4">

                            <?php
                            $args = array(
                                'number'     => $tab_product_count,
                                'orderby'    => 'rand',
                                'order'      => 'ASC',
                            );
                            $product_categories = get_terms( 'product_cat', $args );
                            
                                foreach ( $product_categories as $product_category ) {
                                    $args = array(
                                        'posts_per_page' => 1,
                                        'tax_query' => array(
                                            'relation' => 'AND',
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field' => 'slug',
                                                'terms' => $product_category->slug
                                            )
                                        ),
                                        'post_type' => 'product',
                                        'orderby' => 'rand,'
                                    );
                                    $products = new WP_Query( $args );
                                    while ( $products->have_posts() ) {
                                        $products->the_post();
                                        ?>
                                            <?php wc_get_template_part( 'content', 'product' ); ?>                          
                                        <?php } } wp_reset_postdata(); ?>
                                        <?php
                                    }
                            ?>
                            </div>
                                </div>
                            </div>
                            </div>
                            <?php }else{
                            $woo_count1 = 1;
                            if(in_array('feature_product', $tab_product_multiple_select)){ ?>
                            <div  class="tab-pane fade <?php if($woo_count1 == 1){ ?>active in <?php }$woo_count1++; ?>"  id="feature_product" >
                            <div class="slider-items-products">
                            <div id="new-product-slider" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col4">
                                <?php 
                                
                                    //new
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
                                            'posts_per_page'      => $tab_product_count,
                                            'orderby'   => 'meta_value_num',
                                            'meta_key'  => '_price',
                                            'order' => 'asc',
                                            'tax_query'           => $tax_query
                                        );
                                        
                                        $query = new WP_Query( $args );
                                        if ( $query->have_posts() ) {
                                            while ( $query->have_posts() ) { $query->the_post();

                                        wc_get_template_part( 'content', 'product' ); 
                                    } }else{
                                           echo  esc_html__("No products found!", 'ostore');
                                        } wp_reset_postdata(); ?>
                                </div>
                                </div>
                            </div>
                            </div>   
                            <?php

                            }
                            if(in_array('latest_product', $tab_product_multiple_select)){?>
                            <div  class="tab-pane fade <?php if($woo_count1 == 1){ ?>active in <?php }$woo_count1++; ?>"  id="latest_product" >
                            <div class="slider-items-products">
                            <div id="new-product-slider" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col4">
                                <?php
                                $product_args = array(
                                    'post_type' => 'product',                             
                                    'posts_per_page' => $tab_product_count
                                );
                                $query = new WP_Query($product_args);
                                if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                        wc_get_template_part( 'content', 'product' ); 
                                            } } wp_reset_postdata(); 
                                        ?>
                                </div>
                                </div>
                            </div>
                            </div>
                            <?php }
                            
                            if(in_array('onsale_product', $tab_product_multiple_select)){?>
                            <div  class="tab-pane fade <?php if($woo_count1 == 1){ ?>active in <?php }$woo_count1++; ?>"  id="onsale_product" >
                            <div class="slider-items-products">
                            <div id="new-product-slider" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col4">
                            <?php
                                $on_sale = array(
                                'post_type'      => 'product',
                                'posts_per_page' => $tab_product_count,
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
                                    <?php wc_get_template_part( 'content', 'product' ); ?>                          
                                        <?php } } wp_reset_postdata(); ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            if(in_array('upsale_product', $tab_product_multiple_select)){?>
                            <div  class="tab-pane fade <?php if($woo_count1 == 1){ ?>active in <?php }$woo_count1++; ?>"  id="upsale_product" >
                            <div class="slider-items-products">
                            <div id="new-product-slider" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col4">
                            <?php
                                $ostore_hotdeal_label = esc_html__('New', 'ostore');
                                $upsell_product = array(
                                'post_type'         => 'product',
                                'meta_key'          => 'total_sales',
                                'orderby'           => 'meta_value_num',
                                'posts_per_page'    => $tab_product_count
                                );
                                $query = new WP_Query($upsell_product);
                                if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                    ?>
                                        <?php wc_get_template_part( 'content', 'product' ); ?>                          
                                        <?php } } wp_reset_postdata(); ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            
                            }
                        ?>
                </div>
            </div>
    </div>
    </div>
    </div>
        <?php         
        echo $after_widget;
    }
}
