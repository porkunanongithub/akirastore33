<?php
/**
 * Blog Widgets Section
 */
class Ganess_Store_Blog_Section extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'ganess_store_blog_section', // Base ID
			esc_html__( 'GS: Blog Section', 'ganess-store' ), //Widget Name
			array( 'description' => esc_html__( 'Display Latest Posts.', 'ganess-store' ), ) // Args
		);
	}

	/**
     * Widget Form Section
     */
	public function form( $instance ) {
		$defaults = array(
			'title'			=> esc_html__( 'Latest Posts', 'ganess-store' ),
			'category'		=> 'all',
			'number_posts'	=> 5,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'ganess-store' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label><?php echo esc_html__( 'Select a post category:', 'ganess-store' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category'), 'selected' => $instance['category'], 'show_option_all' => __('Show all posts','ganess-store' ), 'class' => 'widefat' ) ); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_posts' ) ); ?>"><?php echo esc_html__( 'Number of posts:', 'ganess-store' ); ?></label>
			<input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'number_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_posts' ) );?>" value="<?php echo absint( $instance['number_posts'] ); ?>" size="3"/> 
		</p>
					
	<?php

	}

    /**
     * Post Update 
     */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );	
		$instance[ 'category' ]	= absint( $new_instance[ 'category' ] );
		$instance[ 'number_posts' ] = intval($new_instance[ 'number_posts' ]);
		return $instance;
	}


    /**
     * Front End Display
     */
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';	
        $home_blog_title = apply_filters( 'widget_title', $title , $instance, $this->id_base );
		$home_blog_category_id = ( ! empty( $instance['category'] ) ) ? absint( $instance['category'] ) : '';
		$number_posts = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 6; 
		
		// Latest Posts
		echo $before_widget;
	?>
        <section id="blog" class="grid-container full"> 
            <?php if(!empty( $home_blog_title) ) { ?><h2 class="section-title text-center"><?php echo wp_kses_post($home_blog_title); ?></h2><?php } ?>
                <div class="grid-x grid-container align-justify blog-arrow-container"></div>
                    <div class="blog widget_blog_slider">
                    <?php 
                        $args = array('post_type'=>'post','posts_per_page'=>$number_posts,'cat'=>$home_blog_category_id);
                        $blog_query = new WP_Query( $args ); 
                        
                        while($blog_query->have_posts()): $blog_query->the_post(); 
                    ?>
                    <div class="item cell large-4">
                        <?php if( has_post_thumbnail() ): ?>
							<div class="date">
								<span class="day"><?php echo esc_html(get_the_date('d')); ?></span>
								<span class="month-year"><?php the_date('M, Y'); ?></span>
							</div>
							<div class="image-container">
								<?php the_post_thumbnail(); ?>
							</div>
						<?php endif; ?>
                        <div class="text-container">
                            <h4 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <p class="excerpt text-center"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More','ganess-store'); ?></a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
	<?php
		echo $after_widget;
	}


}
// Register The Category Posts
function ganess_store_blog_section_config() {
    register_widget( 'Ganess_Store_Blog_Section' );
}
add_action( 'widgets_init', 'ganess_store_blog_section_config' );