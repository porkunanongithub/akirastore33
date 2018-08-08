<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_banner_register');

function buzstores_banner_register() {
    register_widget('buzstores_banner_Widger');
}

class buzstores_banner_Widger extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_banner_Widger', 
                esc_html__('Buzstores : Banner Image', 'buzstores'), array(
                'description' => esc_html__('This widget show banner with title, description and link', 'buzstores')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(
            'banner_title' => array(
                'buzstores_widgets_name' => 'banner_title',
                'buzstores_widgets_title' => esc_html__('Title', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'banner_image' => array(
                'buzstores_widgets_name' => 'banner_image',
                'buzstores_widgets_title' => esc_html__('Banner Image', 'buzstores'),
                'buzstores_widgets_field_type' => 'upload',
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
        
        $banner_image = isset( $instance['banner_image'] ) ? $instance['banner_image'] : '' ;
        $button_text = isset( $instance['button_text'] ) ? $instance['button_text'] : '' ;
        $button_link = isset( $instance['button_link'] ) ? $instance['button_link'] : '' ;
        $title_widget = apply_filters( 'widget_title', empty( $instance['banner_title'] ) ? '' : $instance['banner_title'], $instance, $this->id_base );
        
        
        echo $before_widget;
        ?>
            <div class="banner-main-wrap wow fadeInUp">
                <?php if($banner_image){ ?>
                    <div class="banner-img">
                        <img src="<?php echo esc_url($banner_image); ?>" title="<?php esc_attr_e('Banner Image','buzstores'); ?>" alt="<?php esc_attr_e('Banner Image','buzstores'); ?>" />
                    </div>
                <?php } ?>
                <div class="title-desc-button">
                    <?php if (!empty($title_widget)):
                        echo $args['before_title'] . esc_html($title_widget) . $args['after_title'];
                    endif; ?>
                        <?php if($button_text || $button_link){ ?>
                            <div class="banner-button">
                                <a href="<?php echo esc_url($button_link); ?>"><?php echo esc_html($button_text); ?></a>
                            </div>
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
