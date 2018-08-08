<?php
/**
 * Custom Classes
 */
 
if ( class_exists( 'WP_Customize_Control' ) ) {
    
    /** Switch Button **/
    class buzstores_Customize_Switch_Control extends WP_Customize_Control {

		public $type = 'switch';

		public function render_content() {
	?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
		        <div class="switch_button">
		        	<?php 
		        		$show_choices = $this->choices;
		        		foreach ( $show_choices as $key => $value ) {
		        			echo '<span class="switch_part '.esc_attr($key).'" data-switch="'.esc_attr($key).'">'. esc_html($value).'</span>';
		        		}
		        	?>
                  	<input type="hidden" id="switch_button" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" />
                </div>
            </label>
	<?php
		}
	}
    
    /**  buzstores Pro Link **/
    class buzstores_Pro_Link_Section extends WP_Customize_Section {

        public $type = 'buzstores-pro';

        public $pro_text = '';

        public $pro_url = '';

        public function json() {
            $json = parent::json();
            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );
            return $json;
        }
        protected function render_template() { ?>

            <li id="custom-section-{{ data.id }}" class="custom-section control-section control-section-{{ data.type }} cannot-expand">
                <h3 class="custom-section-title">
                    {{ data.title }}
                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button button-custom alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
        <?php }
    }
    /**
     * Theme info
     */
    class buzstores_Theme_Info extends WP_Customize_Control {
        public function render_content(){

            $our_theme_infos = array(
                'demo' => array(
                   'link' => esc_url( 'http://buzthemes.com/demo/buzstores/' ),
                   'text' => esc_html__( 'View Demo', 'buzstores' ),
                ),
                'documentation' => array(
                   'link' => esc_url( 'https://buzthemes.com/doc/buzstore/' ),
                   'text' => esc_html__( 'Documentation', 'buzstores' ),
                ),
                'support' => array(
                   'link' => esc_url( 'https://buzthemes.com/forums/forum/buzstores-2/' ),
                   'text' => esc_html__( 'Support', 'buzstores' ),
                ),
            );
            foreach ( $our_theme_infos as $our_theme_info ) {
                echo '<p><a target="_blank" href="' . $our_theme_info['link'] . '" >' . esc_html( $our_theme_info['text'] ) . ' </a></p>';
            }
        ?>
        	<label>
        	    <h2 class="customize-title"><?php echo esc_html( $this->label ); ?></h2>
        	    <span class="customize-text_editor_desc">                 
        	        <ul class="admin-pro-feature-list">   
                        <li><span><?php esc_html_e('One Click Demo Import','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('Modern and elegant design','buzstores'); ?> </span></li>
                        <li><span><?php esc_html_e('5 Homepage Layouts','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('100% Responsive theme','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('Awesome Countdown Section','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('Advanced Typography','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('Breadcrumb Settings','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('Highly configurable home page','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('19 Inbuilt Widgets','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('Pricing Table  Section','buzstores'); ?> </span></li>
                        <li><span><?php esc_html_e('Awesome Footer','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('FAQ Section','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('3 Beautiful Slider Layout','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('Four Footer Widget Areas','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('Sidebar Options','buzstores'); ?> </span></li>
        	            <li><span><?php esc_html_e('Translation ready','buzstores'); ?> </span></li>
                        <li><span><?php esc_html_e('Useful Shortcodes','buzstores'); ?> </span></li>
        	        </ul>
        	        <?php $buzstores_pro_link = 'https://buzthemes.com/demo/buzstores-pro/'; ?>
        	        <a href="<?php echo esc_url($buzstores_pro_link); ?>" class="button button-primary buynow" target="_blank"><?php esc_html_e('Buy Now','buzstores'); ?></a>
        	    </span>
        	</label>
        <?php
        }
    }
}
