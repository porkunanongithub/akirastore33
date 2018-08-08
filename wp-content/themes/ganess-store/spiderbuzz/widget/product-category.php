<?php

/**
 * Displays latest, category wised posts in a 3 block layout.
 */
class Ganess_Store_Products_Category extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'ganess_store_product_category', // Base ID
			esc_html__( 'GS: Products Cateories', 'ganess-store' ), // Name
			array( 'description' => esc_html__( 'Displays latest products from a choosen category.', 'ganess-store' ), ) // Args
		);
    }
    
	/**
     * Widget Form
     */
	public function form( $instance ) {
	    
	    //Set the Default Values
		$defaults = array(
            'category_id'   => array(),
            'category_layouts_options' => esc_html__( '3-column-grid', 'ganess-store' ),
		);
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        
        //Products Category Passes
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
        
        
        //Category layout Argument
        $category_display_layout = array(
                                        '2-column-grid'=> esc_html__('Two Column', 'ganess-store'),
                                        '3-column-grid'=>esc_html__('Three Column', 'ganess-store'),
                                        'random-size-category'=> esc_html__('Random Column', 'ganess-store'),
                                        'category-diff'=> esc_html__('Two Category', 'ganess-store')
                                    );
        
        
    ?>
		
        <h4><?php  echo esc_html__('Product Cateogy','ganess-store'); ?></h4>
            <?php 
            foreach ($all_categories as $cat): 
                $category_id = $cat->term_id; 
                ?>
                <p>
                    <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id("category_id") ) . intval($category_id); ?>" name="<?php echo esc_attr( $this->get_field_name("category_id") ); ?>[]" type="checkbox" value="<?php echo esc_attr($category_id); ?>" <?php checked(in_array( $category_id, (array)$instance["category_id"])); ?> />
                    <label for="<?php echo esc_attr( $this->get_field_id('category_id') ); ?>"><?php echo esc_html($cat->name); ?></label>
                </p>
            <?php endforeach; ?>
            
            <!--Category Layouts-->
            <h4><?php  echo esc_html__('Product Cateogy','ganess-store'); ?></h4>
            <p>
                <label for="<?php echo esc_html__('Categorys Layout','ganess-store'); ?>"><?php echo esc_html__('Category Select','ganess-store'); ?>:</label>
                <select name="<?php echo $this->get_field_name( 'category_layouts_options' ); ?>" id="<?php echo $this->get_field_id( 'category_layouts_options' ); ?>" class="widefat">
                    
                    <?php foreach ($category_display_layout as $categore_layout_id => $category_layout_name) { ?>
                        <option value="<?php echo $categore_layout_id; ?>" id="<?php echo $categore_layout_id; ?>" <?php selected($instance['category_layouts_options'], $categore_layout_id); ?>><?php echo  esc_html($category_layout_name); ?></option>
                    <?php } ?>
                </select>
            </p>
            
	<?php

	}

	/**
     * UPdate Widget Data
     */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		//Category Id Value Update
		$instance[ 'category_id' ]	= (array) $new_instance[ 'category_id'] ;
		$instance[ 'category_layouts_options' ] = $new_instance[ 'category_layouts_options' ];
		
		return $instance;
	}
	
    /*
    *  Widgets Section
    */
	public function widget( $args, $instance ) {
		extract($args);

        // Ganess Store Collection
        $ganess_store_collection_id = ( ! empty( $instance['category_id'] ) ) ?  $instance['category_id']  : array();
        $categories_layout = ( ! empty( $instance['category_layouts_options'] ) ) ?  $instance['category_layouts_options']  : '3-column-grid';

        
        echo $args['before_widget'];
        
        if($categories_layout == '2-column-grid' OR  $categories_layout == '3-column-grid' OR $categories_layout =='random-size-category'){
        ?>
		<section id="category" class="grid-container">
            <div class="grid-x grid-margin-x grid-margin-y">
            <?php
                $category_count = 0 ; 
                foreach($ganess_store_collection_id as $cat_name => $cat_name_id){ 
                
                $term = get_term_by( 'id', $cat_name_id, 'product_cat');

                //term links
                if($term == null){
                    $cat_name_id = ganess_store_woo_cat_id_by_slug('healthy-summer');
                    
                    //is default category
                    if($cat_name_id == ''){
                        $cat_name_id = ganess_store_woo_cat_id_by_slug('uncategorized');
                    }

                }
                
                //Category Image
                $thumbnail_id = get_woocommerce_term_meta( $cat_name_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );
                $image_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                //Category layout
                $category_column_option = 'large-4 medium-12';
                if($categories_layout=='2-column-grid'){
                    $category_column_option = 'column-grid-2 large-6 medium-6';
                }elseif($categories_layout=='3-column-grid'){
                    $category_column_option = 'column-grid-3 large-4 medium-4';
                }elseif($categories_layout == 'random-size-category'){
                    if($category_count % 6 == 0){
                        $category_column_option= "random-size-category large-8 medium-8";
                    } else{
                        $category_column_option = "random-size-category large-4 medium-12 ";
                    }
                }

            ?>
            <div class="<?php echo esc_attr($category_column_option); ?> cell">
                <div class="item">
                    <a class="grid-x align-middle cell" href="<?php echo esc_url(get_term_link(intval($cat_name_id), 'product_cat')); ?>"><i class="sprite kitchen"></i><span><?php echo esc_html($term->name); ?></span><span class="post-count grid-x cell auto align-middle align-right">(<?php echo esc_html( $term->count );  ?> <?php echo esc_html__('Items','ganess-store'); ?></span></a>
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>" >
                </div>
            </div>
            <?php  $category_count++; } ?>

            </div>
        </section>
        <?php }else{ ?>
        <section id="featured" class="grid-container full">
            <div class="grid-x">
            <?php
                $category_count = 0 ; 
                
                foreach($ganess_store_collection_id as $cat_name_id => $cat_name){ 
                  
                  //conditions for Count
                  if($category_count<2){ 
                        $term = get_term_by( 'id', $cat_name, 'product_cat');
                        //Category Image
                        $thumbnail_id = get_woocommerce_term_meta( $cat_name, 'thumbnail_id', true );
                        $image = wp_get_attachment_url( $thumbnail_id ); 
                        
                        //condition For Flip
                        if( $category_count % 2 == 0){
                            $category_diff_id= "masculine";
                        } else{
                            $category_diff_id = "feminine";
                        }
                        ?>
                        <div id="<?php echo esc_attr($category_diff_id); ?>" class="cell large-6 medium-6 small-12">
                            <div class="grid-x align-right align-middle">
                                <img class="align-right grid-x cell auto small-12" src="<?php echo esc_url($image); ?>" >
                                <span class="cell text-container large-4 medium-8 small-12 grid-x align-left">
                                    <h2><?php echo esc_html( $term->name ); ?></h2>
                                    <a href="<?php echo esc_url( get_category_link($cat_name) ); ?>" class="button hollow white"><?php echo esc_html__('Shop Now','ganess-store'); ?></a>
                                </span>
                            </div>
                        </div>
                <?php $category_count++; } } ?>
            </div>
        </section>
        
    <?php } 
		echo $args['after_widget'];
	}
}
// Register single category posts widget
function ganess_store_product_categoryes_config() {
    register_widget( 'Ganess_Store_Products_Category' );
}
add_action( 'widgets_init', 'ganess_store_product_categoryes_config' );
