<?php
/**
 * Displays latest, category wised posts in a 3 block layout.
 */
class Ganess_Store_Products_Tab extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'ganess_store_product_tab', // Base ID
			esc_html__( 'GS: Products Tab', 'ganess-store' ), // Name
			array( 'description' => esc_html__( 'Display products with tab from category', 'ganess-store' ), ) // Args
		);
    }
    
	/**
     * Widget Form
     */
	public function form( $instance ) {
		$defaults = array(
			'title'			=> esc_html__( 'Latest Products', 'ganess-store' ),
            'number_posts'	=> 4,
            'category_id'   => array()
		);
        $instance = wp_parse_args( (array) $instance, $defaults );
        $taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      
        $pad_counts   = 0;  
        $hierarchical = 1;    
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
        $all_categories = get_categories( $args );

    ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		
        <h4><?php  echo esc_html__('Product Cateogy','ganess-store'); ?></h4>
        <?php foreach ($all_categories as $cat): 
            $category_id = $cat->term_id; 
            ?>
            <p>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id("category_id") ) . intval($category_id); ?>" name="<?php echo esc_attr( $this->get_field_name("category_id") ); ?>[]" type="checkbox" value="<?php echo esc_attr($category_id); ?>" <?php checked(in_array($category_id, $instance["category_id"])); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id('category_id') ); ?>"><?php echo esc_html($cat->name); ?></label>
            </p>
        <?php endforeach; ?>
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
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );	
		$instance[ 'number_posts' ] = (int)$new_instance[ 'number_posts' ];
        $instance[ 'category_id' ]	= (array)$new_instance[ 'category_id'] ;

        
		return $instance;
	}
	
    /*
    *  Widgets Section
    */
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? wp_kses_post( $instance['title'] ) : 'Latest Products';	
        $ganess_store_tab_products_title = apply_filters( 'widget_title', $title , $instance, $this->id_base );
        $tab_multiple_category_id = ( ! empty( $instance['category_id'] ) ) ?  (array)$instance['category_id']  : '';
        
        echo $args['before_widget'];

        $tab_product_count = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 4; 
		?>
		<section id="product" class="grid-container">
            <div class="grid-x grid-margin-x grid-margin-y"> 
                <div class="large-12 medium-12 cell">
                    <div id="horizontal-grid">
                        <div id="horizontal-grid-header" class="grid-x align-justify">
                            <?php if(!empty( $ganess_store_tab_products_title) ) { ?><h2 class="section-title cell large-4 medium-4 small-12"><?php echo esc_html($ganess_store_tab_products_title); ?></h2><?php } ?>
                            <ul class="tabs cell medium-auto grid-x align-right small-12" data-tabs id="product-tabs">
                            <?php 
                                $count = 1;
                                    if(!empty($tab_multiple_category_id)){
                                    foreach($tab_multiple_category_id as $tab_product_cat => $tab_product_cat_id){ 
                                        $term = get_term_by( 'id', $tab_product_cat_id, 'product_cat');
                                
                                        //term links
                                        if($term == null){
                                            $tab_product_cat_id = ganess_store_woo_cat_id_by_slug('healthy-summer');
                                            
                                            //is default category
                                            if($tab_product_cat_id == ''){
                                                $tab_product_cat_id = ganess_store_woo_cat_id_by_slug('uncategorized');
                                            }

                                            //multiple cat id
                                            $term = get_term_by( 'id', $tab_product_cat_id, 'product_cat');
                                        }
                                
                                ?>
                                <li id="<?php echo esc_attr($tab_product_cat_id); ?>" product_count= <?php  echo esc_attr($tab_product_count); ?> class="tabs-title <?php if($count == 1){ ?>is-active<?php }$count++; ?>"><a href="#<?php echo esc_attr( $term->slug ); ?>" " aria-selected="true"><?php echo esc_attr( $term->name ); ?></a></li>
                                <?php $count++; }} 
                            ?>
                            </ul>
                                <div class="tabs-content" data-active-collapse="true" data-tabs-content="product-tabs">
                                <?php 
                                    $count =1;
                                    $cat_val =0;
                                    if(is_array($tab_multiple_category_id)){
                                    foreach($tab_multiple_category_id as $tab_product_cat => $tab_product_cat_id){ 
                                    
                                        if($count == 1){
                                            $cat_val = $tab_product_cat_id;
                                        }
                                        $count++;

                                        //tab products cat id
                                        $term = get_term_by( 'id', $tab_product_cat_id, 'product_cat');
                                        //term links
                                        if($term == null){
                                            $cat_val = ganess_store_woo_cat_id_by_slug('healthy-summer');
                                            
                                            //is default category
                                            if($cat_val == ''){
                                                $cat_val = ganess_store_woo_cat_id_by_slug('uncategorized');
                                            }
                                        }#end term 

                                        }   
                                    }
                                ?>
                                <div class="tabs-panel is-active" >
                                    <div class="container-grid grid-x grid-margin-x">
                                    <?php 
                                        /*Loop the Products */
                                        $product_args = array(
                                                'post_type' => 'product',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy'  => 'product_cat',
                                                        'field'     => 'term_id', 
                                                        'terms'     => $cat_val                                                            
                                                    )),
                                                'posts_per_page' => $tab_product_count
                                            );
                                            $query = new WP_Query($product_args);
                                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                                
                                                ganess_store_woocommerce_before_shop_loop_item();
                                            } } wp_reset_postdata(); 
                                        ?>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </section>
	<?php
		echo $args['after_widget'];
	}
}
// Register single category posts widget
function ganess_store_product_tab_config() {
    register_widget( 'Ganess_Store_Products_Tab' );
}
add_action( 'widgets_init', 'ganess_store_product_tab_config' );
