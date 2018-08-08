<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_terms_register');

function buzstores_terms_register() {
    register_widget('buzstores_termsr_Widget');
}

class buzstores_termsr_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_termsr_Widget', 
                esc_html__('Buzstores : Terms & Condition', 'buzstores'), array(
                'description' => esc_html__('This Widget show Term And Condition', 'buzstores')
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
            'term_title' => array(
                'buzstores_widgets_name' => 'term_title',
                'buzstores_widgets_title' => esc_html__('Term Title', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'term_description' => array(
                'buzstores_widgets_name' => 'term_description',
                'buzstores_widgets_title' => esc_html__('Term Description', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            
            'term_feature_icon' => array(
                'buzstores_widgets_name' => 'term_feature_icon',
                'buzstores_widgets_title' => esc_html__('Feature Icon Class', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
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
        
        $title_widget = apply_filters( 'widget_title', empty( $instance['term_title'] ) ? '' : $instance['term_title'], $instance, $this->id_base );
        $term_description = isset( $instance['term_description'] ) ? $instance['term_description'] : '';
        $term_feature_icon = isset( $instance['term_feature_icon'] ) ? $instance['term_feature_icon'] : '';
        
        echo $before_widget;
        ?>
            <div class="term-main-wrap">
                <div class="terms-wrap">
                    <div class="content-term">
                    
                        <?php if($term_feature_icon){ ?>
                            <div class="icon-term">
                                <i class="fa <?php echo esc_attr($term_feature_icon); ?>" aria-hidden="true"></i>
                            </div>
                        <?php } ?> 
                        
                        <?php if($title_widget){
                            echo $args['before_title'] . esc_html($title_widget) . $args['after_title'];
                        } ?>
                        
                        <?php if($term_description){ ?>
                            <div class="desc-term">
                                <?php echo esc_html($term_description); ?>
                            </div>
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
