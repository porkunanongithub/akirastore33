<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_multiple_slide_category_register');

function buzstores_multiple_slide_category_register() {
    register_widget('buzstores_multiple_slide_categoryr_Widget');
}

class buzstores_multiple_slide_categoryr_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_multiple_slide_categoryr_Widget', 
                esc_html__('Buzstores : Multiple Product Slide', 'buzstores'), array(
                'description' => esc_html__('This Widget show Multiple Product Slide', 'buzstores')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
          $bs_woo_pro_categories = array();
          $bs_woo_pro_categories_obj = get_categories(array( 'taxonomy' => 'product_cat', 'orderby' => 'name', 'pad_counts' => 0, 'show_count' => 0,'title_li' => '','hierarchical' => 1,'hide_empty' => 1));
          foreach ($bs_woo_pro_categories_obj as $bs_woo_pro_category) {
            $bs_woo_pro_categories[$bs_woo_pro_category->term_id] = $bs_woo_pro_category->name;
          }
    
        $fields = array(
            
            'multiple_slide_category' => array(
                  'buzstores_widgets_name' => 'multiple_slide_category',
                  'buzstores_widgets_title' => esc_html__('Select Products Categorys', 'buzstores'),
                  'buzstores_widgets_field_type' => 'multicheckboxes',
                  'buzstores_widgets_field_options' => $bs_woo_pro_categories
              ),
            
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        
        $multiple_slide_category = isset( $instance['multiple_slide_category'] ) ? $instance['multiple_slide_category'] : '' ;
        
        echo $before_widget;
        ?>
            <div class="bs-container">
                <div class="multi-category-wrap">
                    <?php if($multiple_slide_category){ ?>
                        <div class="bs-main-multi">
                            <div class="multiple-cat-product">
                                
                                <?php 
                                foreach($multiple_slide_category as $term_id => $tab_product_category){
                                $term_name_get = get_term_by( 'id', $term_id, 'product_cat');?>
                                
                                    <div class="wrap-tab-roduct">
                                        <?php if($term_name_get->name){ ?>
                                            <div class="title-test wow fadeInUp">
                                                <h2><?php echo esc_html($term_name_get->name); ?></h2>
                                            </div>
                                        <?php } ?>
                                        <?php if($term_id){
                                    
                                                $product_query = new WP_Query(
                                                    array(
                                                            'post_type' => 'product',
                                                            'tax_query' => array(array('taxonomy'  => 'product_cat',
                                                                               'field'     => 'term_id', 
                                                                               'terms'     => $term_id                                                                 
                                                                            )),
                                                            'posts_per_page' => -1,
                                                            )
                                                    );
                                                    
                                                if($product_query->have_posts()):
                                                
                                                    $product_array = array();
                                                    $product_array_count = 1;
                                                    while($product_query->have_posts()):
                                                        $product_query->the_post();
                                                        $product_array[$product_array_count] = get_the_ID();
                                                        $product_array_count++;
                                                    endwhile;
                                                    
                                                    $product_array = array_chunk($product_array,3); ?> 
                                                    <div class="second-product-loop wow fadeInUp">
                                                        <?php
                                                            foreach($product_array as $product_arrays){
                                                                    ?><div class="item-wrap-loop"><?php
                                                                        $product_secont_query = new WP_Query(
                                                                        array(
                                                                                'post_type' => 'product',
                                                                                'tax_query' => array(array('taxonomy'  => 'product_cat',
                                                                                                   'field'     => 'term_id', 
                                                                                                   'terms'     => $term_id                                                                 
                                                                                                )),
                                                                                'posts_per_page' => -1,
                                                                                'post__in' => $product_arrays,
                                                                                )
                                                                        );
                                                                        while($product_secont_query->have_posts()){
                                                                            $product_secont_query->the_post();
                                                                            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzstores-product-image');
                                                                            ?>
                                                                            <div class="main-wrap-items">
                                                                                <?php if($product_image[0]){ ?>
                                                                                <div class="item-image">
                                                                                    <img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo esc_url($product_image[0]); ?>" />
                                                                                </div>
                                                                                
                                                                                    
                                                                                    <?php } ?>
                                                                                    <div class="title-rate-price">
                                                                                        <?php
                                                                                        /**
                                                                                    	 * woocommerce_shop_loop_item_title hook.
                                                                                    	 *
                                                                                    	 * @hooked woocommerce_template_loop_product_title - 10
                                                                                    	 */
                                                                                    	do_action( 'woocommerce_shop_loop_item_title' );
                                                                                        /**
                                                                                    	 * woocommerce_after_shop_loop_item_title hook.
                                                                                    	 *
                                                                                    	 * @hooked woocommerce_template_loop_rating - 5
                                                                                    	 * @hooked woocommerce_template_loop_price - 10
                                                                                    	 */
                                                                                    	do_action( 'woocommerce_after_shop_loop_item_title' );
                                                                                        ?>
                                                                                    </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        wp_reset_query();
                                                                    ?></div><?php
                                                                }?>
                                                        </div><?php
                                                        
                                                endif;
                                                wp_reset_query();?>
                                        
                                            <?php } ?>
                                        </div>
                                        
                                    <?php } ?>
                                
                            </div>
                            
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php
        echo $after_widget;
    }

     public function update($new_instance, $old_instance) {
          $instance = $old_instance;
          $widget_fields = $this->widget_fields();
          foreach ($widget_fields as $widget_field) {
              extract($widget_field);
              $instance[$buzstores_widgets_name] = buzstores_widgets_updated_field_value($widget_field, $new_instance[$buzstores_widgets_name]);
          }
          return $instance;
      }

      public function form($instance) {
          $widget_fields = $this->widget_fields();
          foreach ($widget_fields as $widget_field) {
              extract($widget_field);
              $buzstores_widgets_field_value = !empty($instance[$buzstores_widgets_name]) ? $instance[$buzstores_widgets_name] : '';
              buzstores_widgets_show_widget_field($this, $widget_field, $buzstores_widgets_field_value);
          }
      }

}
