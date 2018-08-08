<?php
/**
 * Blog Widgets Section
 */
class Ganess_Store_News_Letter_Section extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'ganess_store_news_letter_section', // Base ID
			esc_html__( 'GS: News Letter Section', 'ganess-store' ), //Widget Name
			array( 'description' => esc_html__( 'Display Latest Posts.', 'ganess-store' ), ) // Args
		);
	}

	/**
     * Widget Form Section
     */
	public function form( $instance ) {
		$defaults = array(
			'title'						=> esc_html__( 'News Letter', 'ganess-store' ),
			'news_letter_desc'			=> esc_html__( 'Very Short Description', 'ganess-store' ),
			'news_letter_shortcode'		=> '',
			'ganess_store_facebook_url'	=>esc_html__('www.facebook.com','ganess-store'),
			'ganess_store_twitter_url'	=>esc_html__('www.twitter.com','ganess-store'),
			'ganess_store_google_plus'	=>esc_html__('www.google-plus.com','ganess-store'),
			'ganess_store_pinterest_url'=>esc_html__('www.pinterest.com','ganess-store')
			
			
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'news_letter_desc' ) ); ?>"><?php echo esc_html__( 'Description:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'news_letter_desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'news_letter_desc' ) ); ?>" value="<?php echo esc_attr($instance['news_letter_desc']); ?>"/>
		</p>
		
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'news_letter_shortcode' ) ); ?>"><?php echo esc_html__( 'Mailchimp ShortCode:', 'ganess-store' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'news_letter_desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'news_letter_shortcode' ) ); ?>" value="<?php echo esc_attr($instance['news_letter_shortcode']); ?>"/>
        </p>

        <h2><?php echo esc_html__('Social Links','ganess-store'); ?></h2>
        <!-- Facebook URL -->
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ganess_store_facebook_url' ) ); ?>"><?php echo esc_html__( 'Faceook URL:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ganess_store_facebook_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ganess_store_facebook_url' ) ); ?>" value="<?php echo esc_attr($instance['ganess_store_facebook_url']); ?>"/>
		</p>

        <!-- Twitter URL -->
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ganess_store_twitter_url' ) ); ?>"><?php echo esc_html__( 'Twitter URL:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ganess_store_twitter_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ganess_store_twitter_url' ) ); ?>" value="<?php echo esc_attr($instance['ganess_store_twitter_url']); ?>"/>
		</p>
        

        <!-- Google Plus URL -->
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ganess_store_google_plus' ) ); ?>"><?php echo esc_html__( 'Google Plus URL:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ganess_store_google_plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ganess_store_google_plus' ) ); ?>" value="<?php echo esc_attr($instance['ganess_store_google_plus']); ?>"/>
		</p>

        <!-- Pinterest URL -->
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ganess_store_pinterest_url' ) ); ?>"><?php echo esc_html__( 'Pinintrest URL:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ganess_store_pinterest_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ganess_store_pinterest_url' ) ); ?>" value="<?php echo esc_attr($instance['ganess_store_pinterest_url']); ?>"/>
		</p>

					
	<?php

	}

    /**
     * Post Update 
     */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );	
		$instance[ 'news_letter_desc' ] = sanitize_text_field( $new_instance[ 'news_letter_desc' ] );

        //Shortcode
        $instance[ 'news_letter_shortcode' ] = sanitize_text_field( $new_instance[ 'news_letter_shortcode' ] );	
        
        //Social Links
        $instance[ 'ganess_store_facebook_url' ] = esc_url( $new_instance[ 'ganess_store_facebook_url' ] );
        $instance[ 'ganess_store_twitter_url' ] = esc_url( $new_instance[ 'ganess_store_twitter_url' ] );
        $instance[ 'ganess_store_google_plus' ] = esc_url( $new_instance[ 'ganess_store_google_plus' ] );
        $instance[ 'ganess_store_pinterest_url' ] = esc_url( $new_instance[ 'ganess_store_pinterest_url' ] );
        
        return $instance;
	}


    /**
     * Front End Display
     */
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';	
        $hot_offer_title = apply_filters( 'widget_title', $title , $instance, $this->id_base );
        $hot_offer_short_desc = ( ! empty( $instance['news_letter_desc'] ) ) ? $instance['news_letter_desc'] : '';
        $mailchimp_shortdoce_form = ( ! empty( $instance['news_letter_shortcode'] ) ) ? $instance['news_letter_shortcode'] : ''; 
        
        /**
         * Social Links
         */
        $ganess_store_facebook_url = ( ! empty( $instance['ganess_store_facebook_url'] ) ) ? $instance['ganess_store_facebook_url'] : 'www.facebook.com';
        $googleplus_url = ( ! empty( $instance['ganess_store_google_plus'] ) ) ? $instance['ganess_store_google_plus'] : 'www.google.plus.com';
        $twitter_url = ( ! empty( $instance['ganess_store_twitter_url'] ) ) ? $instance['ganess_store_twitter_url'] : 'www.twitter.com';
        $ganess_store_pinterest_url = ( ! empty( $instance['ganess_store_pinterest_url'] ) ) ? $instance['ganess_store_pinterest_url'] : 'www.pinterest.com';
        
        echo $args['before_widget'];
	?>
        <section id="newsletter">
            <div class="grid-container align-center grid-x">
                <div class="cell grid-x align-middle large-4 medium-3 small-12">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    <?php  if(!empty($hot_offer_title)){ ?><h2><?php echo esc_html($hot_offer_title); ?><br><?php } ?>
                    <?php  if(!empty($hot_offer_short_desc)){ ?><small><?php echo esc_html($hot_offer_short_desc); ?></small></h2><?php } ?></h2>
                </div>
              <?php  if(!empty($mailchimp_shortdoce_form)){ echo do_shortcode($mailchimp_shortdoce_form); } ?>
              <div class="cell grid-x align-middle large-auto medium-4 small-12 align-center">
                <?php if(!empty( $ganess_store_facebook_url) ) { ?><div class="social"><a class="grid-x align-middle" href="<?php echo esc_url($ganess_store_facebook_url); ?>"><i class="fa fa-facebook" aria-hidden="true"></i> <span><?php echo esc_html__('Facebook','ganess-store'); ?></span> </a> </div> <span class="separator">|</span><?php } ?>
                <?php if(!empty( $twitter_url) ) { ?><div class="social"><a class="grid-x align-middle" href="<?php echo esc_url($twitter_url); ?>"><i class="fa fa-twitter" aria-hidden="true"></i><span><?php echo esc_html__('Twitter','ganess-store'); ?> </span> </a> </div> <span class="separator">|</span> <?php } ?>
                <?php if(!empty( $googleplus_url) ) { ?><div class="social"><a class="grid-x align-middle" href="<?php echo esc_url($googleplus_url); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i> <span><?php echo esc_html__('Google Plus','ganess-store'); ?></span> </a> </div> <span class="separator">|</span><?php } ?> 
                <?php if(!empty( $ganess_store_pinterest_url) ) { ?><div class="social"><a class="grid-x align-middle" href="<?php echo esc_url($ganess_store_pinterest_url); ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span><?php echo esc_html__('Pinterest','ganess-store'); ?></span> </a> </div><?php } ?>
              </div>
            </div>
        </section>
	<?php
		echo $args['after_widget'];
	}


}
// Register News Letter Section
function ganess_store_news_letter_section_config() {
    register_widget( 'Ganess_Store_News_Letter_Section' );
}
add_action( 'widgets_init', 'ganess_store_news_letter_section_config' );
