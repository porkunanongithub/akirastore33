<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_product_slide_register');

function buzstores_product_slide_register() {
    register_widget('buzstores_product_slider_Widget');
}

class buzstores_product_slider_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_product_slider_Widget', 
                esc_html__('Buzstores : Product Slider', 'buzstores'), array(
                'description' => esc_html__('This Widget show product on carouser slider', 'buzstores')
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
            'slider_title' => array(
                'buzstores_widgets_name' => 'slider_title',
                'buzstores_widgets_title' => esc_html__('Title', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'product_category' => array(
                'buzstores_widgets_name' => 'product_category',
                'buzstores_widgets_title' => esc_html__('Product Category', 'buzstores'),
                'buzstores_widgets_field_type' => 'select',
                'buzstores_widgets_field_options' => $buzstores_Product_Category_list,
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
        
        $title_widget = apply_filters( 'widget_title', empty( $instance['slider_title'] ) ? '' : $instance['slider_title'], $instance, $this->id_base );
        $product_category = isset( $instance['product_category'] ) ? $instance['product_category'] : '' ;
        
        echo $before_widget;
        ?>
            <div class="product-slider-wrap">
                <div class="bs-container">
                    <?php if($title_widget){ ?><div class="title-test wow fadeInUp"><?php echo $args['before_title'] . esc_html($title_widget) . $args['after_title']; ?></div><?php } ?>
                    <?php if($product_category){ 
                    
                        $product_query = new WP_Query(
                            array(
                                    'post_type' => 'product',
                                    'tax_query' => array(array('taxonomy'  => 'product_cat',
                                                       'field'     => 'slug', 
                                                       'terms'     => $product_category                                                                 
                                                    )),
                                    'posts_per_page' => -1
                                    )
                            );
                        if($product_query->have_posts()): ?>
                            <ul class="products wrap-pro-slider wow fadeInUp">
                                <?php
                                    while($product_query->have_posts()){
                                        $product_query->the_post();
                                        global $product; 
                                        ?>
                                            
                                                <?php wc_get_template_part( 'content', 'product' ); ?>
                                            
                                            <?php
                                        }
                                ?>
                            </ul>
                            <?php
                        endif;
                        wp_reset_query();?>
                        
                    <?php } ?>
                </div>
            </div>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	buzstores_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$buzstores_widgets_name] = buzstores_widgets_updated_field_value($widget_field, $new_instance[$buzstores_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	buzstores_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $buzstores_widgets_field_value = !empty($instance[$buzstores_widgets_name]) ? esc_attr($instance[$buzstores_widgets_name]) : '';
            buzstores_widgets_show_widget_field($this, $widget_field, $buzstores_widgets_field_value);
        }
    }

}
