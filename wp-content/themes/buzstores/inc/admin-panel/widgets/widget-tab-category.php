<?php
/**
 * @package buzstores
 */

add_action('widgets_init', 'buzstores_tab_product_category_register');

function buzstores_tab_product_category_register() {
    register_widget('buzstores_tab_product_categoryr_Widget');
}

class buzstores_tab_product_categoryr_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzstores_tab_product_categoryr_Widget', 
                esc_html__('Buzstores : Tab Category Product', 'buzstores'), array(
                'description' => esc_html__('This Widget show product category On Tab', 'buzstores')
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
            'tab_title' => array(
                'buzstores_widgets_name' => 'tab_title',
                'buzstores_widgets_title' => esc_html__('Section Title', 'buzstores'),
                'buzstores_widgets_field_type' => 'text',
            ),
            'tab_product_category' => array(
                  'buzstores_widgets_name' => 'tab_product_category',
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
        
        $title_widget = apply_filters( 'widget_title', empty( $instance['tab_title'] ) ? '' : $instance['tab_title'], $instance, $this->id_base );
        $product_categories = isset( $instance['tab_product_category'] ) ? $instance['tab_product_category'] : '' ;
        
        echo $before_widget;
        ?>
            <div class="bs-container">
                <div class="tab-category-wrap">
                    <?php if($product_categories){ ?>
                        <div class="bs-main-tab">
                        
                            <div class="cap-tab-title">
                            
                                    <?php if($title_widget){ ?>
                                        <div class="title-test wow fadeInUp">
                                            <?php echo $args['before_title'] . esc_html($title_widget) . $args['after_title']; ?>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="tab-button wow fadeInUp">
                                        <?php
                                        $count_tab_button = 1; 
                                        foreach($product_categories as $term_id => $tab_product_category){
                                        
                                            $term_count_get = get_term_by( 'id', $term_id, 'product_cat');
                                            ?>
                                            <span id="<?php echo absint($term_id); ?>" class="<?php if($count_tab_button == 1){echo 'active';} ?> cat-name"><?php echo esc_html($term_count_get->name); ?></span>
                                            <?php 
                                                                                
                                        $count_tab_button++; } ?>
                                    </div>
                            </div>
                            <div class="ps-cat-product wow fadeInUp">
                                
                                <?php 
                                $count_tab_product = 1;
                                foreach($product_categories as $term_id => $tab_product_category){
                                    ?><div id="tab-pro-<?php echo absint($term_id); ?>" class="<?php if($count_tab_product == 1){echo 'active';} ?> wrap-tab-roduct"> <?php
                                        if($term_id){ 
                                
                                            $product_query = new WP_Query(
                                                array(
                                                        'post_type' => 'product',
                                                        'tax_query' => array(array('taxonomy'  => 'product_cat',
                                                                           'field'     => 'term_id', 
                                                                           'terms'     => $term_id                                                                 
                                                                        )),
                                                        'posts_per_page' => '6'
                                                        )
                                                );
                                            if($product_query->have_posts()):
                                                ?>
                                                <div class="wrap-tab-pro">
                                                    <ul class="products wrap-pro-tab wow_tab fadeIn wow fadeIn">
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
                                    <?php $count_tab_product++; } ?>
                                
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
