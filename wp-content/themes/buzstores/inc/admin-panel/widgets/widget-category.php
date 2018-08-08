<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_product_category_register');

function buzstores_product_category_register() {
    register_widget('buzstores_product_categoryr_Widget');
}

class buzstores_product_categoryr_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_product_categoryr_Widget', 
                esc_html__('Buzstores : Category Product', 'buzstores'), array(
                'description' => esc_html__('This Widget show product category Slider', 'buzstores')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
          $bs_woo_pro_categories = array();
          $bs_woo_pro_categories_obj = get_categories(array( 'taxonomy' => 'product_cat', 'pad_counts' => 0, 'show_count' => 0,'title_li' => '','hierarchical' => 1,'hide_empty' => 1));
          foreach ($bs_woo_pro_categories_obj as $bs_woo_pro_category) {
            $bs_woo_pro_categories[$bs_woo_pro_category->term_id] = $bs_woo_pro_category->name;
          }
    
        $fields = array(
        
            'product_category' => array(
                  'buzstores_widgets_name' => 'product_category',
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
        
        $product_categories = isset( $instance['product_category'] ) ? $instance['product_category'] : '' ;
        
        echo $before_widget;
        ?>
            <div class="product-category-wrap">
                <?php if($product_categories){ ?>
                    <div class="bs-main-pro">
                        <div class="ps-secondary-pro">
                            
                            <?php foreach($product_categories as $term_id => $product_category){
                                
                        	    $thumbnail_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true );
                                $image = wp_get_attachment_image_src($thumbnail_id, 'buzstores-woo-cat-image', true);
                                $product_cat_link = get_term_link($term_id);
                                $term_count_get = get_term_by( 'id', $term_id, 'product_cat');
                                $term_count = $term_count_get->count;
                                ?>
                                <div class="bs-cat-pro">
                                
                                    <?php if ( $image[0] ) { ?>
                                        <div class="image-pro-cat wow fadeInUp">
                                            <?php echo '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr($term_count_get->name) . '" title="' . esc_attr($term_count_get->name) . '" />'; ?>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="main-content-product wow fadeInUp">
                                        <?php if($term_count_get->name){ ?>
                                            <div class="cat-name"><?php echo esc_html($term_count_get->name); ?></div>
                                        <?php } ?>
                                        
                                        <div class="count-product"><?php echo absint($term_count).esc_html__(' Products','buzstores'); ?></div>
                                        
                                        <?php if($term_count >= '1'){
                                            ?>
                                                <a href="<?php echo esc_url($product_cat_link); ?>"><?php echo esc_html__('Visit Product','buzstores'); ?></a>
                                            <?php
                                        } ?>
                                    </div>
                                    
                                </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                <?php } ?>
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
