<?php
/**
 * Define fields for Widgets.
 * 
 * @package buzstores
 */

function buzstores_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
	$buzstores_pagelist[0] = array(
        'value' => 0,
        'label' => esc_html__('--choose--','buzstores')
    );
    $arg = array('posts_per_page'   => -1);
    $buzstores_pages = get_pages($arg);
    foreach($buzstores_pages as $buzstores_page) :
        $buzstores_pagelist[$buzstores_page->ID] = array(
            'value' => $buzstores_page->ID,
            'label' => $buzstores_page->post_title
        );
    endforeach;
    //print_r($widget_field);
	extract( $widget_field );
	
	switch( $buzstores_widgets_field_type ) {
	
		// Standard text field
		case 'text' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>"><?php echo esc_html($buzstores_widgets_title); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $buzstores_widgets_name )); ?>" type="text" value="<?php echo esc_attr($athm_field_value); ?>" />
				
				<?php if( isset( $buzstores_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($buzstores_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>"><?php echo esc_html($buzstores_widgets_title); ?>:</label>
				<textarea class="widefat" rows="6" id="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $buzstores_widgets_name )); ?>"><?php echo esc_html($athm_field_value); ?></textarea>
			</p>
			<?php
			break;
			
		// Checkbox field
		case 'checkbox' : ?>
			<p>
				<input id="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $buzstores_widgets_name )); ?>" type="checkbox" value="1" <?php checked( '1', $athm_field_value ); ?>/>
				<label for="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>"><?php echo esc_html($buzstores_widgets_title); ?></label>

				<?php if( isset( $buzstores_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($buzstores_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
            
		//Multi checkboxes
        case 'multicheckboxes' :
            
            if( isset( $buzstores_widgets_title ) ) { ?>
                <label><?php echo esc_html( $buzstores_widgets_title ); ?>:</label>
            <?php }
            echo '<div class="buzstores-multiple-checkbox">';
                foreach ( $buzstores_widgets_field_options as $athm_option_name => $athm_option_title) {
                    if( isset( $athm_field_value[$athm_option_name] ) ) {
                        $athm_field_value[$athm_option_name] = 1;
                    }else{
                        $athm_field_value[$athm_option_name] = 0;
                    }                
                ?>
                    <p>
                        <input id="<?php echo esc_attr( $instance->get_field_id( $buzstores_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $buzstores_widgets_name ) ).'['.esc_attr( $athm_option_name ).']'; ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value[$athm_option_name]); ?>/>
                        <label for="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"><?php echo esc_html( $athm_option_title ); ?></label>
                    </p>
                <?php
                    }
            echo '</div>';
                if (isset($buzzstore_widgets_description)) {
            ?>
                    <small><em><?php echo esc_html($buzzstore_widgets_description); ?></em></small>
            <?php
                }
            
            break;
		
		// Select field
		case 'select' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>"><?php echo esc_html($buzstores_widgets_title); ?>:</label>
				<select name="<?php echo esc_attr($instance->get_field_name( $buzstores_widgets_name )); ?>" id="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>" class="widefat">
					<?php
					foreach ( $buzstores_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo esc_attr($athm_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html($athm_option_title); ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $buzstores_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($buzstores_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		case 'number' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>"><?php echo esc_html($buzstores_widgets_title); ?>:</label><br />
				<input name="<?php echo esc_attr($instance->get_field_name( $buzstores_widgets_name )); ?>" type="number" step="1" min="1" id="<?php echo esc_attr($instance->get_field_id( $buzstores_widgets_name )); ?>" value="<?php echo esc_attr($athm_field_value); ?>" class="small-text" />
				
				<?php if( isset( $buzstores_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($buzstores_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

        case 'upload' :

            $output = '';
            $id = esc_attr($instance->get_field_id($buzstores_widgets_name));
            $class = '';
            $int = '';
            $value = esc_html($athm_field_value);
            $name = esc_attr($instance->get_field_name($buzstores_widgets_name));


            if ($value) {
                $class = ' has-file';
            }
            $output .= '<div class="sub-option widget-upload">';
            $output .= '<label for="' . esc_attr($instance->get_field_id($buzstores_widgets_name)) . '">' . esc_html($buzstores_widgets_title) . '</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_attr__('No file chosen', 'buzstores') . '" />' . "\n";
            if (function_exists('wp_enqueue_media')) {
                
                    $output .= '<input id="upload-' . $id . '" class="upload-button button" type="button" value="' . esc_attr__('Upload', 'buzstores') . '" />' . "\n";

            } else {
                $output .= '<p><i>' . esc_html__('Upgrade your version of WordPress for full media support.', 'buzstores') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";

            if ($value != '') {
                $remove = '<a class="remove-image remove-screenshot">'.esc_html__('Remove','buzstores').'</a>';
                $attachment_id = attachment_url_to_postid($value);

                $image_array = wp_get_attachment_image_src($attachment_id, 'medium');
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . esc_url($image_array[0]) . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = esc_html__('View File', 'buzstores');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;
	}
	
}

function buzstores_widgets_updated_field_value( $widget_field, $new_field_value ) {
    
	extract( $widget_field );
	
	// Allow only integers in number fields
	if( $buzstores_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
	}
    elseif ($buzstores_widgets_field_type == 'multicheckboxes') {
         return wp_kses_post($new_field_value);
    } 
    elseif( $buzstores_widgets_field_type == 'textarea' ) {
        
		if( !isset( $buzstores_widgets_allowed_tags ) ) {
			$buzstores_widgets_allowed_tags = '<p><strong><em><a>';
		}
		return strip_tags( $new_field_value, $buzstores_widgets_allowed_tags );
		
	}
    else {
		return strip_tags( $new_field_value );
	}

}