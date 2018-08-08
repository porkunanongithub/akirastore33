<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_blog_register');

function buzstores_blog_register() {
    register_widget('buzstores_blog_Widget');
}

class buzstores_blog_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_blog_Widget', 
                esc_html__('Buzstores : Blog', 'buzstores'), array(
                'description' => esc_html__('This Widget show Blogs', 'buzstores')
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
            'blog_title' => array(
                'buzstores_widgets_name' => 'blog_title',
                'buzstores_widgets_title' => esc_html__('Title', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'blog_category' => array(
                'buzstores_widgets_name' => 'blog_category',
                'buzstores_widgets_title' => esc_html__('Blog Category', 'buzstores'),
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
        
        $title_widget = apply_filters( 'widget_title', empty( $instance['blog_title'] ) ? '' : $instance['blog_title'], $instance, $this->id_base );        
        $blog_category = isset( $instance['blog_category'] ) ? $instance['blog_category'] : '' ;
        
        echo $before_widget;
        ?>
            <div class="blog-wrap">
                <div class="bs-container">
                    <div class="blog-contents">
                        <?php
                        $blog_args = array(
                            'poat_type' => 'post',
                            'order' => 'DESC',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'category_name' => $blog_category
                        ); 
                        $blog_query = new WP_Query($blog_args);
                        if (!empty($title_widget)): ?>
                            <div class="title-test wow fadeInUp"><?php echo $args['before_title'] . esc_html($title_widget) . $args['after_title']; ?></div>
                        <?php endif;
                        
                        if($blog_query->have_posts()): ?>
                            <div class="blog-main-wrap">
                                <div class="blog-loop-wrap wow fadeInUp">
                                    <?php while($blog_query->have_posts()){
                                            $blog_query->the_post();?>
                                                <div class="bs-loop-blog">
                                                
                                                    <?php if(has_post_thumbnail()){ ?>
                                                        <div class="image-blog">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_post_thumbnail('buzstores-blog-image'); ?>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                    
                                                    <div class="date-content">
                                                    
                                                        <div class="date-blog">
                                                            <span class="date"><?php echo absint(get_the_date('d')); ?></span>
                                                            <span class="month"><?php echo esc_html(get_the_date('M')); ?></span>
                                                            <span class="year"><?php echo absint(get_the_date('Y')); ?></span>
                                                        </div>
                                                        
                                                        <?php if(get_the_content() || get_the_title()){ ?>
                                                            <div class="blog-content-title">
                                                            
                                                                <?php if(get_the_title()){ ?>
                                                                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                                                <?php } ?>
                                                                
                                                                <?php if(get_the_content()){ ?>
                                                                    <p><?php echo wp_trim_words(get_the_content(),20,'...'); ?></p>
                                                                <?php } ?>
                                                                
                                                            </div>
                                                        <?php } ?>
                                                    </div>
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
