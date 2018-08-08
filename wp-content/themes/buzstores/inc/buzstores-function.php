<?php
/** Sidebar **/
if( ! function_exists( 'buzstores_get_sidebar' ) ):
function buzstores_get_sidebar() {
    $sidebar_meta_option = 'right-sidebar';
    global $post;
    if(is_archive()) {
        $sidebar_meta_option = esc_attr(get_theme_mod( 'buzstores_archive_sidebar_layout', 'right-sidebar' ));
        if( $sidebar_meta_option == 'right-sidebar' || $sidebar_meta_option == 'both-sidebar' || $sidebar_meta_option == '') {
            get_sidebar();
        }
        
        if($sidebar_meta_option == 'both-sidebar' || $sidebar_meta_option == 'left-sidebar'){
            get_sidebar( 'left' );
        }
        
    }else{
        
        if( 'post' === get_post_type() ) {
            $sidebar_meta_option = get_post_meta( $post->ID, 'buzstores_post_sidebar_layout', true );
        }
    
        if( 'page' === get_post_type() ) {
        	$sidebar_meta_option = get_post_meta( $post->ID, 'buzstores_post_sidebar_layout', true );
        }
         
        if( is_home() ) {
            $set_id = get_option( 'page_for_posts' );
    		$sidebar_meta_option = get_post_meta( $set_id, 'buzstores_post_sidebar_layout', true );
        }
        
        if( $sidebar_meta_option == 'right-sidebar' || $sidebar_meta_option == 'both-sidebar' || $sidebar_meta_option == '') {
            get_sidebar();
        }
        
        if($sidebar_meta_option == 'both-sidebar' || $sidebar_meta_option == 'left-sidebar'){
            get_sidebar( 'left' );
        }
        
    }
}
endif;

/** Post Category List **/
function buzstores_Category_list(){
    $buzstores_cat_lists = get_categories(
        array(
            'hide_empty' => '0',
            'exclude' => '1',
        )
    );
    $buzstores_cat_array = array();
    $buzstores_cat_array[''] = esc_html__('--Choose--','buzstores');
    foreach($buzstores_cat_lists as $buzstores_cat_list){
        $buzstores_cat_array[esc_attr($buzstores_cat_list->slug)] = esc_attr($buzstores_cat_list->name);
    }
    return $buzstores_cat_array;
}

/** Slider Function **/
function buzstores_slider_callback(){
    $buzstores_slider_cat = esc_attr(get_theme_mod('buzstores_slider_cat'));
    if($buzstores_slider_cat){
        $slider_query = new WP_Query(array('post_type'=>'post','order' => 'DESC','posts_per_page' => -1,'post_status' => 'publish','category_name' => $buzstores_slider_cat));
        if($slider_query->have_posts()):
            ?>
            <div class="bs-container">
            
                <?php
                $buzstores_slider_image_1 = get_theme_mod('buzstores_slider_image_1');
                $buzstores_image_1_link = get_theme_mod('buzstores_image_1_link');
                $buzstores_slider_image_2 = get_theme_mod('buzstores_slider_image_2');
                $buzstores_image_2_link = get_theme_mod('buzstores_image_2_link'); 
                ?>
                <div class="banner-slider">
                    <div class="banner-slider-image">
                        <?php if($buzstores_slider_image_1){ ?>
                            <div class="image-one">
                                <a href="<?php echo esc_url($buzstores_image_1_link); ?>"><img title="<?php esc_attr_e('Slider Feature Image','buzstores'); ?>" alt="<?php esc_attr_e('Slider Feature Image','buzstores'); ?>" src="<?php echo esc_url($buzstores_slider_image_1); ?>" /></a>
                            </div>
                        <?php } ?>
                        <?php if($buzstores_slider_image_2){ ?>
                            <div class="image-two">
                                <a href="<?php echo esc_url($buzstores_image_2_link); ?>"><img title="<?php esc_attr_e('Slider Feature Image','buzstores'); ?>" alt="<?php esc_attr_e('Slider Feature Image','buzstores'); ?>" src="<?php echo esc_url($buzstores_slider_image_2); ?>" /></a>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="main-slider-wraper">
                        <div id="secondary-slider-wrap">
                            <?php
                            while($slider_query->have_posts()):
                                $slider_query->the_post();?>
                                    <div class="row-slider">
                                        <div class="cntent-slider">
                                        
                                            <?php if(has_post_thumbnail()){ ?>
                                                <div class="image-slider">
                                                    <?php the_post_thumbnail('buzstores-slider-image'); ?>
                                                </div>
                                            <?php } ?>
                                            
                                            <div class="titl-desc">
                                            
                                                <?php if(get_the_title()){ ?> 
                                                    <div class="title-slider">
                                                        <?php the_title(); ?>
                                                    </div>
                                                <?php } ?>
                                                
                                                <?php if(get_the_content()){ ?>
                                                    <div class="content-slider">
                                                        <?php the_content(); ?>
                                                    </div>
                                                <?php } ?>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                <?php
                            endwhile;
                            ?>
                        </div>
                    </div>
                </div>    
            </div>
            <?php
        endif;
        wp_reset_query();
    }
}
add_action('buzstores_slider_callback_action','buzstores_slider_callback');

/** Header Product Search **/
function buzstores_product_search(){
    if ( buzstores_is_woocommerce_activated() ) { ?>
		<div class="custom-product-search">
			<form class="search-product-cat" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php $cats = buzstores_get_product_categories();
                if($cats){ ?> 
    				<div class="cat-list">		
    					<?php
    						echo buzstores_product_cat_select('indent_sub');
    					?>
    				</div>
                <?php } ?>
				<div class="search-icon">
					<button type="submit"><i class="fa fa-search"></i></button>
				</div>
				<div class="search-field">
					<input type="hidden" name="post_type" value="product" />
					<input name="s" type="text" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Enter Your Key Word...', 'buzstores' ); ?>"/>
				</div>
			</form>
		</div>
		<?php
	}
}

/**  Check Woocomerce Activation  **/
if ( ! function_exists( 'buzstores_is_woocommerce_activated' ) ) {

	function buzstores_is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

function buzstores_product_cat_select( $indent_sub = '', $select_id = 'product_cat_list' ) {

	$cats = buzstores_get_product_categories();
	
	$select = '';

	if ( count( $cats ) > 0 ) {

		$select = '<select class="buzstores-cat-list" id="' . $select_id .'" name="product_cat">';
		$select .= apply_filters('buzstores_cat_all_option', '<option value="">'. esc_html__( 'All Category', 'buzstores' ) .'</option>' );

		foreach( $cats as $cat ) {

			if ($indent_sub === 'indent_sub' ) {

				if ( $cat->parent === 0 ) {

					$select .= sprintf( '<option value="%s" %s>%s</option>', esc_attr( $cat->category_nicename ), buzstores_cat_selected( $cat->category_nicename ), esc_html( $cat->name ) );

					/**
					 * Start child
					 */
					$children = buzstores_get_product_categories(array('parent' => $cat->term_id ));

					if ( count($children) ) {

						foreach( $children as $ct ) {
							$select .= sprintf( '<option value="%s">&nbsp&nbsp%s</option>', esc_attr( $ct->category_nicename ), esc_html( $ct->name ) );
						}
					}
				}


			} else {

				$select .= sprintf( '<option value="%s" %s>%s</option>', esc_attr( $cat->category_nicename ), buzstores_cat_selected($cat->category_nicename), esc_html( $cat->name ) );

			}

		}

		$select .= '</select>';

	}

	return $select;
	
}

function buzstores_get_product_categories( $args = array() ) {

	$args = wp_parse_args( $args, array(
		         'taxonomy'     => 'product_cat',
		         'orderby'      => 'name',
		         'show_count'   => 0,
		         'pad_counts'   => 0,
		 ) );

	return get_categories( $args );

}

function buzstores_product_cat_list($args = array()){
    $args = wp_parse_args( $args, array(
		         'taxonomy'     => 'product_cat',
		         'orderby'      => 'name',
		         'show_count'   => 0,
		         'pad_counts'   => 0,
		 ) );
    $buzstores_pro_cat_lists = get_categories( $args );
    $buzstores_pro_cat_array = array();
    $buzstores_pro_cat_array[''] = esc_html__('--Choose--','buzstores');
    foreach($buzstores_pro_cat_lists as $buzstores_pro_cat_list){
        $buzstores_pro_cat_array[esc_attr($buzstores_pro_cat_list->slug)] = esc_attr($buzstores_pro_cat_list->name);
    }
    return $buzstores_pro_cat_array;
}

function buzstores_cat_selected( $cat_nicename ) {

	$q_var = get_query_var( 'product_cat' );

	if ( $q_var === $cat_nicename ) {

		return esc_attr('selected="selected"');
	}

	return false;
}

/** Buzstores Top Header **/
function buzstores_top_header(){
    $buzstores_top_header_enable = get_theme_mod('buzstores_top_header_enable','hide');
    if($buzstores_top_header_enable == 'show'){
    $buzstores_top_menu_enable = get_theme_mod('buzstores_top_menu_enable','show');?>
        <div class="main-top-header">
            <div class="bs-container">
                <div class="top-header">
                    <?php
                    $buzstores_facebook_link = get_theme_mod('buzstores_facebook_link');
                    $buzstores_twitter_link = get_theme_mod('buzstores_twitter_link');
                    $buzstores_youtube_link = get_theme_mod('buzstores_youtube_link');
                    $buzstores_google_link = get_theme_mod('buzstores_google_link');
                    $buzstores_linkedin_link = get_theme_mod('buzstores_linkedin_link');
                    $buzstores_pinterest_link = get_theme_mod('buzstores_pinterest_link');
                    if($buzstores_facebook_link || $buzstores_twitter_link || $buzstores_youtube_link || 
                    $buzstores_google_link || $buzstores_linkedin_link || $buzstores_pinterest_link){ ?>
                        <div class="social-links">
                            <?php if($buzstores_facebook_link){?><a href="<?php echo esc_url($buzstores_facebook_link); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a><?php }
                            if($buzstores_twitter_link){?><a href="<?php echo esc_url($buzstores_twitter_link); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a><?php }
                            if($buzstores_youtube_link){?><a href="<?php echo esc_url($buzstores_youtube_link); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a><?php }
                            if($buzstores_google_link){?><a href="<?php echo esc_url($buzstores_google_link); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a><?php }
                            if($buzstores_linkedin_link){?><a href="<?php echo esc_url($buzstores_linkedin_link); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a><?php }
                            if($buzstores_pinterest_link){?><a href="<?php echo esc_url($buzstores_pinterest_link); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a><?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php if($buzstores_top_menu_enable == 'show'){ ?>
                        <nav id="top-navigation" class="top-navigation">
                			<div id="top-toggle" class="top-toggle">
                	            <span class="one"> </span>
                	            <span class="two"> </span>
                	            <span class="three"> </span>
                	        </div>
                			<?php
                				wp_nav_menu( array(
                					'theme_location' => 'buzstores-top-menu',
                					'menu_id'        => 'primary-menu',
                				) );
                			?>
                		</nav><!-- #site-navigation -->
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php }
}
add_action('buzstores_top_header_action','buzstores_top_header');
/** Buzstores Mid Header **/
function buzstores_mid_header(){
    ?>
    <div class="main-mid-header">
        <div class="bs-container">
            <div class="mid-header">
                    
            	<div class="site-branding">
            		<?php if(get_header_image()){ ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php esc_url(header_image()); ?>" alt="<?php esc_attr_e('Header Logo','buzstores'); ?>" /></a>
            		<?php }
                    else{
            			?>
            				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></p>
            			<?php
                        $description = get_bloginfo( 'description','display' );
            			if ( $description || is_customize_preview() ) : ?>
            				<p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
            			<?php
            			endif;
                    } ?>
            	</div><!-- .site-branding -->
                
                <?php
                $buzstores_product_search_enable = get_theme_mod('buzstores_product_search_enable','show');
                if($buzstores_product_search_enable == 'show' || $buzstores_product_search_enable == ''){
                    if(buzstores_is_woocommerce_activated()){ ?>
                    <div class="advance-search">
                        <?php buzstores_product_search(); ?>
                    </div>
                <?php }
                } ?>
                
                <?php 
                $buzstores_header_info_enable = get_theme_mod('buzstores_header_info_enable','show');
                if($buzstores_header_info_enable == 'show'){ 
                    $buzstores_header_phone = get_theme_mod('buzstores_header_phone');
                    $buzstores_header_email = get_theme_mod('buzstores_header_email');
                    if($buzstores_header_phone || $buzstores_header_email){?>
                    <div class="info-top-header">
                    
                        <?php if($buzstores_header_phone){ ?>
                        <span class="header-phone">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span><?php echo esc_html($buzstores_header_phone); ?></span>
                        </span>
                        <?php } ?>
                        
                        <?php if($buzstores_header_email){ ?>
                        <span class="header-email">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <span><?php echo esc_html($buzstores_header_email); ?></span>
                        </span>
                        <?php } ?>
                        
                    </div>
                <?php } 
                }?>
                
                <?php
                $buzstores_header_cart_enable = get_theme_mod('buzstores_header_cart_enable','show');
                if($buzstores_header_cart_enable == 'show' || $buzstores_header_cart_enable == ''){
                    if(buzstores_is_woocommerce_activated()){ ?>
                            <?php
                                if(is_active_sidebar('buzstores-header-cart')){?>
                                    <div class="header-cart">
                                        <span class="cart-icon">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span class="cart-count"><?php echo absint(WC()->cart->get_cart_contents_count()); ?></span>
                                        </span><?php
                                            dynamic_sidebar('buzstores-header-cart');?>
                                    </div>
                             <?php } ?>
                    <?php }
                } ?>
                
            </div>
        </div>
    </div>
<?php
}
add_action('buzstores_mid_header_action','buzstores_mid_header');
/** Header Main Menu **/

function buzstores_main_header(){
    ?>
    <div class="main-nav-wrap">
        <div class="bs-container">
    		<nav id="site-navigation" class="main-navigation">
    			<div id="toggle" class="nav-toggle">
    	            <span class="one"> </span>
    	            <span class="two"> </span>
    	            <span class="three"> </span>
    	        </div>
    			<?php
    				wp_nav_menu( array(
    					'theme_location' => 'buzstores-menu-1',
    					'menu_id'        => 'primary-menu',
    				) );
    			
                if(buzstores_is_woocommerce_activated()){
                    ?><div class="login-reg-logout"><?php
                        if ( is_user_logged_in() ) { ?>
                          <a class="logout-header" href="<?php echo esc_url(wp_logout_url()); ?>"><?php esc_html_e('Logout','buzstores'); ?></a>
                        <?php }
                        
                        else { ?>
                     	  <a class="login-register" href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" title="<?php esc_attr_e('Login / Register','buzstores'); ?>"><?php esc_html_e('Login / Register','buzstores'); ?></a>
                        <?php }
                        
                        if (function_exists('YITH_WCWL')) {
                            $bs_wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
			                    <a class="wishlist-menu" href="<?php echo esc_url($bs_wishlist_url); ?>">
			                        <i class="fa fa-heart"></i>
                                    <?php echo "(" . absint(yith_wcwl_count_products()) . ")"; ?>
			                    </a>
		                 <?php }
                    ?></div><?php
                } ?>
    		</nav><!-- #site-navigation -->
        </div>
      </div><?php
}
add_action('buzstores_main_header_action','buzstores_main_header');

/** Breadcrumb Function **/
function buzstores_header_banner_x() {
	if(is_home() || is_front_page()) :
	else :
    $buzstores_breadcrumb_image = get_theme_mod('buzstores_breadcrumb_image') 
		?>
			<div class="header-banner-container" <?php if($buzstores_breadcrumb_image){ ?>style="background-image: url(<?php echo esc_url($buzstores_breadcrumb_image); ?>);" <?php } ?> >
                <div class="bs-container">
    				<div class="page-title-wrap">
    					<?php
    						if(is_archive()) {
    							the_archive_title( '<h1 class="page-title">', '</h1>' );
    							the_archive_description( '<div class="taxonomy-description">', '</div>' );
    						} elseif(is_single() || is_singular('page')) {
    							wp_reset_postdata();
    							the_title('<h1 class="page-title">', '</h1>');
    						} elseif(is_search()) {
                                ?>
                                <h1 class="page-title"><?php printf( esc_html_e( 'Search Results for: %s', 'buzstores' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                                <?php
                            } elseif(is_404()) {
                                ?>
                                <h1 class="page-title"><?php esc_html_e( '404 Error', 'buzstores' ); ?></h1>
                                <?php
                            }
    					?>
    					<?php buzstores_breadcrumbs(); ?>
    				</div>
                </div>
			</div>
		<?php
	endif;
}
add_action('buzstores_header_banner', 'buzstores_header_banner_x');

/** Breadcrumb Sanitize **/
function buzstores_sanitize_bradcrumb($input){
    $all_tags = array(
        'a'=>array(
            'href'=>array()
        )
     );
    return wp_kses($input,$all_tags);
    
}

/** Breadcrumb Titles **/
function buzstores_breadcrumbs() {
    global $post;
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

    $delimiter = '&gt;';

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $homeLink = esc_url( home_url() );

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1)
            echo '<div id="buzstores-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'buzstores') . '</a></div></div>';
    } else {

        echo '<div id="buzstores-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'buzstores') . '</a> ' . esc_html($delimiter) . ' ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0)
                echo get_category_parents($thisCat->parent, TRUE, ' ' . esc_html($delimiter) . ' ');
            echo '<span class="current">' . esc_html__('Archive by category','buzstores').' "' . esc_html(single_cat_title('', false)) . '"' . '</span>';
        } elseif (is_search()) {
            echo '<span class="current">' . esc_html__('Search results for','buzstores'). '"' . get_search_query() . '"' . '</span>';
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . esc_html($delimiter) . ' ';
            echo '<a href="' . esc_url(get_month_link(esc_attr(get_the_time('Y')), esc_attr(get_the_time('m')))) . '">' . esc_html(get_the_time('F')) . '</a> ' . esc_html($delimiter) . ' ';
            echo '<span class="current">' . esc_html(get_the_time('d')) . '</span>';
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">' . esc_html(esc_html('Y')) . '</a> ' . esc_html($delimiter) . ' ';
            echo '<span class="current">' . esc_html(get_the_time('F')) . '</span>';
        } elseif (is_year()) {
            echo '<span class="current">' . esc_html(get_the_time('Y')) . '</span>';
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_html($post_type->labels->singular_name) . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . esc_html($delimiter) . ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . esc_html($delimiter) . ' ');
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo buzstores_sanitize_bradcrumb($cats);
                if ($showCurrent == 1)
                    echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            if($post_type){
            echo '<span class="current">' . esc_html($post_type->labels->singular_name) . '</span>';
            }
        } elseif (is_attachment()) {
            if ($showCurrent == 1) echo ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo buzstores_sanitize_bradcrumb($breadcrumbs[$i]);
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . esc_html($delimiter). ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . esc_html($delimiter) . ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_tag()) {
            echo '<span class="current">' . esc_html__('Posts tagged','buzstores').' "' . esc_html(single_tag_title('', false)) . '"' . '</span>';
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo '<span class="current">' . esc_html__('Articles posted by ','buzstores'). esc_html($userdata->display_name) . '</span>';
        } elseif (is_404()) {
            echo '<span class="current">' . esc_html__('Error 404','buzstores') . '</span>';
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo esc_html__('Page', 'buzstores') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</div>';
    }
}