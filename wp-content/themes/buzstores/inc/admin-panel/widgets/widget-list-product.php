<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_product_list_register');

function buzstores_product_list_register() {
    register_widget('buzstores_product_list_Widget');
}

class buzstores_product_list_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_product_listr_Widget', 
                esc_html__('Buzstores : Product List', 'buzstores'), array(
                'description' => esc_html__('This Widget show product category List', 'buzstores')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
          $buzstores_Product_Category_list = buzstores_product_cat_list();
    
        $fields = array(
            'product_list_title' => array(
                'buzstores_widgets_name' => 'product_list_title',
                'buzstores_widgets_title' => esc_html__('Section Title', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'product_list_sub_title' => array(
                'buzstores_widgets_name' => 'product_list_sub_title',
                'buzstores_widgets_title' => esc_html__('Section Sub Title', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'product_list_category' => array(
                  'buzstores_widgets_name' => 'product_list_category',
                  'buzstores_widgets_title' => esc_html__('Select Products Categorys', 'buzstores'),
                  'buzstores_widgets_field_type' => 'select',
                  'buzstores_widgets_field_options' => $buzstores_Product_Category_list
              ),
            'product_post_number' => array(
                'buzstores_widgets_name' => 'product_post_number',
                'buzstores_widgets_title' => esc_html__('Number Of Post', 'buzstores'),
                'buzstores_widgets_field_type' => 'number',
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
        
        $title_widget = apply_filters( 'widget_title', empty( $instance['product_list_title'] ) ? '' : $instance['product_list_title'], $instance, $this->id_base );
        $product_list_sub_title = isset( $instance['product_list_sub_title'] ) ? $instance['product_list_sub_title'] : '' ;
        $product_categories = isset( $instance['product_list_category'] ) ? $instance['product_list_category'] : '' ;
        $product_post_number = isset( $instance['product_post_number'] ) ? $instance['product_post_number'] : '' ;
        if($product_post_number == ''){
            $product_post_number = 8;
        }
        
        echo $before_widget;
        ?>
            <div class="bs-container">
                <div class="product-list-wrap">
                    <?php if($title_widget || $product_list_sub_title){ ?>
                        <div class="section-titles-wrap wow fadeInUp">
                            <?php if($title_widget){ ?><div class="section-title"><?php echo $args['before_title'] . esc_html($title_widget) . $args['after_title']; ?></div><?php } ?>
                            <?php if($product_list_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_html($product_list_sub_title); ?></h2></div><?php } ?>
                        </div>
                    <?php } ?>
                    <?php if($product_categories){ ?>
                        <div class="bs-main-pro-list wow fadeInUp">
                            <div class="ps-secondary-pro-list">
                                
                                    <?php $product_query = new WP_Query(
                                        array(
                                                'post_type' => 'product',
                                                'tax_query' => array(array('taxonomy'  => 'product_cat',
                                                                   'field'     => 'slug', 
                                                                   'terms'     => $product_categories                                                                 
                                                                )),
                                                'posts_per_page' => $product_post_number,
                                                )
                                        );
                                        
                                    if($product_query->have_posts()):
                                        ?>
                                        <div class="main-wrap-pro-list">
                                            <ul class="products secondary-pro-list">
                                                <?php
                                                    while($product_query->have_posts()){
                                                        $product_query->the_post();
                                                        global $product; 
                                                            wc_get_template_part( 'content', 'product' ); 
                                                        }
                                                    ?>
                                            </ul>
                                        </div>
                                        <?php
                                    endif;
                                    wp_reset_query();?>
                                
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
