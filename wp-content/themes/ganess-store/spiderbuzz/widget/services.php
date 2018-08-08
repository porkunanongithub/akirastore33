<?php
/**
 * Blog Widgets Section
 */
class Ganess_Store_Service_Box_Section extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'ganess_store_service_box_section', // Base ID
			esc_html__( 'GS: Service Box Section', 'ganess-store' ), //Widget Name
			array( 'description' => esc_html__( 'Display service area', 'ganess-store' ), ) // Args
		);
	}

	/**
     * Widget Form Section
     */
	public function form( $instance ) {
		$defaults = array(
            'service_box_text_1'			=> esc_html__( 'Address', 'ganess-store' ),
            'service_box_text_2'			=> esc_html__( 'Phone No.', 'ganess-store' ),
            'service_box_text_3'			=> esc_html__( 'WordPress Theme', 'ganess-store' ),

            'service_box_desc_1'			=> esc_html__( 'Kathamandu, Nepal', 'ganess-store' ),
            'service_box_desc_2'			=> esc_html__( '123 456 7890', 'ganess-store' ),
            'service_box_desc_3'			=> esc_html__( 'Wordpress Theme Development', 'ganess-store' ),

            'service_box_icon_1'			=> esc_html__( 'fa fa-address-book', 'ganess-store' ),
            'service_box_icon_2'			=> esc_html__( 'fa fa-phone', 'ganess-store' ),
            'service_box_icon_3'			=> esc_html__( 'fa fa-wordpress', 'ganess-store' ),
			
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>
    <h3><?php echo esc_html__('Service Box 1', 'ganess-store'); ?></h3>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'service_box_text_1' ) ); ?>"><?php echo esc_html__( 'Box 1: Service Box :', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'service_box_text_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_box_text_1' ) ); ?>" value="<?php echo esc_attr($instance['service_box_text_1']); ?>"/>
		</p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'service_box_desc_1' ) ); ?>"><?php echo esc_html__( 'Box 1: Description:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'service_box_desc_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_box_desc_1' ) ); ?>" value="<?php echo esc_attr($instance['service_box_desc_1']); ?>"/>
		</p>
		
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'service_box_icon_1' ) ); ?>"><?php echo esc_html__( 'Box 1: fontawesome class', 'ganess-store' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'service_box_icon_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_box_icon_1' ) ); ?>" value="<?php echo esc_attr($instance['service_box_icon_1']); ?>"/>
        </p>

    <h3><?php echo esc_html__('Service Box 2', 'ganess-store'); ?></h3>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'service_box_text_2' ) ); ?>"><?php echo esc_html__( 'Box 2: Title :', 'ganess-store' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'service_box_text_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_box_text_2' ) ); ?>" value="<?php echo esc_attr($instance['service_box_text_2']); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'service_box_desc_2' ) ); ?>"><?php echo esc_html__( 'Box 2: Description:', 'ganess-store' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'service_box_desc_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_box_desc_2' ) ); ?>" value="<?php echo esc_attr($instance['service_box_desc_2']); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'service_box_icon_2' ) ); ?>"><?php echo esc_html__( 'Box 2: fontawesome class', 'ganess-store' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'service_box_icon_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_box_icon_2' ) ); ?>" value="<?php echo esc_attr($instance['service_box_icon_2']); ?>"/>
        </p>
    <h3><?php echo esc_html__('Service Box 3', 'ganess-store'); ?></h3>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'service_box_text_3' ) ); ?>"><?php echo esc_html__( 'Box 3: Title :', 'ganess-store' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'service_box_text_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_box_text_3' ) ); ?>" value="<?php echo esc_attr($instance['service_box_text_3']); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'service_box_desc_3' ) ); ?>"><?php echo esc_html__( 'Box 3: Description:', 'ganess-store' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'service_box_desc_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_box_desc_3' ) ); ?>" value="<?php echo esc_attr($instance['service_box_desc_3']); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'service_box_icon_3' ) ); ?>"><?php echo esc_html__( 'Box 3: fontawesome class', 'ganess-store' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'service_box_icon_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_box_icon_3' ) ); ?>" value="<?php echo esc_attr($instance['service_box_icon_3']); ?>"/>
        </p>
					
	<?php

	}

    /**
     * Post Update 
     */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'service_box_text_1' ] = sanitize_text_field( $new_instance[ 'service_box_text_1' ] );	
        $instance[ 'service_box_text_2' ] = sanitize_text_field( $new_instance[ 'service_box_text_2' ] );
        $instance[ 'service_box_text_3' ] = sanitize_text_field( $new_instance[ 'service_box_text_3' ] );

        $instance[ 'service_box_desc_1' ] = sanitize_text_field( $new_instance[ 'service_box_desc_1' ] );
        $instance[ 'service_box_desc_2' ] = sanitize_text_field( $new_instance[ 'service_box_desc_2' ] );
        $instance[ 'service_box_desc_3' ] = sanitize_text_field( $new_instance[ 'service_box_desc_3' ] );

        $instance[ 'service_box_icon_1' ] = sanitize_text_field( $new_instance[ 'service_box_icon_1' ] );
        $instance[ 'service_box_icon_2' ] = sanitize_text_field( $new_instance[ 'service_box_icon_2' ] );
        $instance[ 'service_box_icon_3' ] = sanitize_text_field( $new_instance[ 'service_box_icon_3' ] );
        return $instance;
	}


    /**
     * Front End Display
     */
	public function widget( $args, $instance ) {
		extract($args);

		
        /**
        * wp query for first block
        **/
        if( isset($instance['service_box_text_1'])){
            $service_box_text_1 = $instance['service_box_text_1']; 
        }else{
            $service_box_text_1 = "";
        }
        
        if( isset($instance['service_box_text_2'])){
            $service_box_text_2 = $instance['service_box_text_2']; 
        }else{
            $service_box_text_2 = "";
        }
        
        if( isset($instance['service_box_text_3'])){
            $service_box_text_3 = $instance['service_box_text_3']; 
        }else{
            $service_box_text_3 = "";
        }
        
        if( isset($instance['service_box_desc_1'])){
            $service_box_desc_1 = $instance['service_box_desc_1']; 
        }else{
            $service_box_desc_1 = "";
        }
        
        if( isset($instance['service_box_desc_2'])){
            $service_box_desc_2 = $instance['service_box_desc_2']; 
        }else{
            $service_box_desc_2 = "";
        }
        
        if( isset($instance['service_box_desc_3'])){
            $service_box_desc_3 = $instance['service_box_desc_3']; 
        }else{
            $service_box_desc_3 = "";
        }
        
        if( isset($instance['service_box_icon_1'])){
            $service_box_icon_1 = $instance['service_box_icon_1']; 
        }else{
            $service_box_icon_1 = "";
        }
        
        if( isset($instance['service_box_icon_2'])){
            $service_box_icon_2 = $instance['service_box_icon_2']; 
        }else{
            $service_box_icon_2 = "";
        }
        
        if( isset($instance['service_box_icon_3'])){
            $service_box_icon_3 = $instance['service_box_icon_3']; 
        }else{
            $service_box_icon_3 = "";
        }
        
        echo $args['before_widget'];
	?>
        <section id="services">
            <div class="grid-container grid-x grid-padding-x">
                <div class="item cell large-4 medium-4 small-12 align-middle grid-x">
                    <i class="<?php echo  esc_attr($service_box_icon_1); ?>  fa-3x "></i>
                    <div class="cell auto">
                    <h4><?php echo esc_html($service_box_text_1); ?></h4>
                    <p><?php echo esc_html($service_box_desc_1); ?></p>
                    </div>
                </div>
                <div class="item cell large-4 medium-4 small-12 align-middle grid-x">
                    <i class="<?php echo esc_attr($service_box_icon_2); ?> fa-3x"></i>
                    <div class="cell auto">
                    <h4><?php echo esc_html($service_box_text_2); ?></h4>
                    <p><?php echo esc_html($service_box_desc_2); ?></p>
                    </div>
                </div> 
                <div class="item cell large-4 medium-4 small-12 align-middle grid-x">
                    <i class="<?php echo esc_attr($service_box_icon_3); ?> fa-3x"></i>
                    <div class="cell auto">
                    <h4><?php echo esc_html($service_box_text_3); ?></h4>
                    <p><?php echo esc_html($service_box_desc_3); ?></p>
                    </div>
                </div> 
            </div>     
      </section>
	<?php
		echo $args['after_widget'];
	}


}
// Register Service Box Configer
function ganess_store_service_box_config() {
    register_widget( 'Ganess_Store_Service_Box_Section' );
}
add_action( 'widgets_init', 'ganess_store_service_box_config' );
