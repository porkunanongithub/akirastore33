<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_testimonial_register');

function buzstores_testimonial_register() {
    register_widget('buzstores_testimonial_Widget');
}

class buzstores_testimonial_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_testimonial_Widget', 
                esc_html__('Buzstores : Testimonial', 'buzstores'), array(
                'description' => esc_html__('This Widget show Users Feedback', 'buzstores')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $buzstores_cat_list = buzstores_Category_list();
        $fields = array(
            'testimonial_title' => array(
                'buzstores_widgets_name' => 'testimonial_title',
                'buzstores_widgets_title' => esc_html__('Title', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'testimonial_category' => array(
                'buzstores_widgets_name' => 'testimonial_category',
                'buzstores_widgets_title' => esc_html__('Testimonial Category', 'buzstores'),
                'buzstores_widgets_field_type' => 'select',
                'buzstores_widgets_field_options' => $buzstores_cat_list,
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
        
        $title_widget = apply_filters( 'widget_title', empty( $instance['testimonial_title'] ) ? '' : $instance['testimonial_title'], $instance, $this->id_base );
        $testimonial_category = isset( $instance['testimonial_category'] ) ? $instance['testimonial_category'] : '' ;
        
        echo $before_widget;
        if($testimonial_category){
        ?>
            <div class="testimonial-wrap">
                <div class="bs-container">
                    <div class="test-contents">
                        <?php
                        $testimonial_args = array(
                            'poat_type' => 'post',
                            'order' => 'DESC',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'category_name' => $testimonial_category
                        ); 
                        $testimonial_query = new WP_Query($testimonial_args);
                        if($title_widget){ ?>
                            <div class="title-test wow fadeInUp"><?php echo $args['before_title'] . esc_html($title_widget) . $args['after_title']; ?></div>
                        <?php }
                        
                        if($testimonial_query->have_posts()): ?>
                            <div class="cliest-feedback wow fadeInUp">
                                <div class="main-test-loop">
                                    <?php while($testimonial_query->have_posts()){
                                            $testimonial_query->the_post();
                                            $test_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzstores-testimonial-image');
                                            ?>
                                                <div class="loop-test">
                                                    <?php if($test_image[0]){ ?>
                                                        <div class="image-test">
                                                            <img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo esc_url($test_image[0]); ?>" />
                                                        </div>
                                                    <?php } ?>
                                                    
                                                    <?php if(get_the_content() || get_the_title()){ ?>
                                                        <div class="content-title">
                                                        
                                                            <?php if(get_the_content()){ ?>
                                                                <p><?php the_content(); ?></p>
                                                            <?php } ?>
                                                            
                                                            <?php if(get_the_title()){ ?>
                                                                <h4><?php the_title(); ?></h4>
                                                            <?php } ?>
                                                            
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php
                                    } ?>
                                </div>
                            </div>
                        <?php endif; 
                        wp_reset_query();?>
                    </div>
                </div>
            </div>
        <?php
        }
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
