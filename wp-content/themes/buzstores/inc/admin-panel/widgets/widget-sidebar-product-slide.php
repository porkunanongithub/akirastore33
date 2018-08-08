<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_sidebar_product_slide_register');

function buzstores_sidebar_product_slide_register() {
    register_widget('buzstores_sidebar_product_slider_Widget');
}

class buzstores_sidebar_product_slider_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_sidebar_product_slider_Widget', 
                esc_html__('Buzstores : Sidebar Product Slider', 'buzstores'), array(
                'description' => esc_html__('This Widget show product With Sidebar on carouser slider', 'buzstores')
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
            'side_title' => array(
                'buzstores_widgets_name' => 'side_title',
                'buzstores_widgets_title' => esc_html__('Section Title', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'side_description' => array(
                'buzstores_widgets_name' => 'side_description',
                'buzstores_widgets_title' => esc_html__('Section Description', 'buzstores'),
                'buzstores_widgets_field_type' => 'textarea',
            ),
            
            'button_text' => array(
                'buzstores_widgets_name' => 'button_text',
                'buzstores_widgets_title' => esc_html__('Button Text', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'button_link' => array(
                'buzstores_widgets_name' => 'button_link',
                'buzstores_widgets_title' => esc_html__('Button Link', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'bg_image' => array(
                'buzstores_widgets_name' => 'bg_image',
                'buzstores_widgets_title' => esc_html__('Background Image', 'buzstores'),
                'buzstores_widgets_field_type' => 'upload',
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
        
        $title_widget = apply_filters( 'widget_title', empty( $instance['side_title'] ) ? '' : $instance['side_title'], $instance, $this->id_base );
        $side_description = isset( $instance['side_description'] ) ? $instance['side_description'] : '' ;
        $button_text = isset( $instance['button_text'] ) ? $instance['button_text'] : '' ;
        $button_link = isset( $instance['button_link'] ) ? $instance['button_link'] : '' ;
        $bg_image = isset( $instance['bg_image'] ) ? $instance['bg_image'] : '' ;
        $product_category = isset( $instance['product_category'] ) ? $instance['product_category'] : '' ;
        
        echo $before_widget;
        ?>
            <div class="side-slider-wrap">
                <div class="bs-container">
                    <div <?php if($bg_image){ ?>style="background-image: url(<?php echo esc_url($bg_image); ?>);" <?php } ?> class="main-ps-wrap">
                        <?php if($title_widget || $side_description || $button_text || $button_link){ ?>
                            <div class="side-slider-content wow fadeInUp">
                                
                                <div class="title-desc-ps">
                                    <?php if($title_widget){
                                        echo $args['before_title'] . esc_html($title_widget) . $args['after_title'];
                                    } ?>
                                    
                                    <?php if($side_description){ ?>
                                        <p><?php echo esc_html($side_description); ?></p>
                                    <?php } ?>
                                    
                                    <?php if($button_link || $button_text){ ?>
                                        <a href="<?php echo esc_url($button_link); ?>"><?php echo esc_html($button_text); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <?php if($product_category){ 
                        
                            $product_query = new WP_Query(
                                array(
                                        'post_type' => 'product',
                                        'tax_query' => array(array('taxonomy'  => 'product_cat',
                                                           'field'     => 'slug', 
                                                           'terms'     => $product_category                                                                 
                                                        )),
                                        'posts_per_page' => '6'
                                        )
                                );
                            if($product_query->have_posts()):
                                ?>
                                <div class="main-wrap-side-slide wow fadeInUp">
                                    <ul class="products side-pro-slider">
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
                            
                        <?php } ?>
                    </div>
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
