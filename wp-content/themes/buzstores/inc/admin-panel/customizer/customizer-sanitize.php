<?php
/** Customizer Category List Sanitize **/
function buzstores_sanitize_post_cat_list($input){
    $buzstores_cat_list = buzstores_Category_list();
    if(array_key_exists($input,$buzstores_cat_list)){
        return $input;
    }
    else{
        return '';
    }
}

/** Customizer Checkbox Sanitize **/
function buzstores_sanitize_checkbox($input){
    if($input == 1){
        return 1;
    }
    else{
        return '';
    }
}

/** Sanitize Hide Show Switch **/
function buzstores_sanitize_hide_show( $input ) {
    $valid_keys = array(
            'show'  => esc_html__( 'Show', 'buzstores' ),
            'hide'   => esc_html__( 'Hide', 'buzstores' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}