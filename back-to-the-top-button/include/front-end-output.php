<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php

// ========================================================================================================
// Get all the data and ouput it into the page
// ========================================================================================================

$getting_plugin_data = get_option($wp_options_name);

if( !empty($getting_plugin_data) ) {

    // ----------------------------------------------
    // breaking the string into to 2 variables. the array namd and vakue  
    // ----------------------------------------------  
    
    $break_array = explode("***", $getting_plugin_data);

    $item_name = explode("####", $break_array[0]);
    $key_name = explode("####", $break_array[1]);

    $array_count = count($key_name);

    // ----------------------------------------------
    // creating an organized array with all values
    // ----------------------------------------------      

    for($count_number = 0; $count_number < $array_count; $count_number++) {
    	$yy_array_top_btn[ $item_name[$count_number] ] = $key_name[$count_number];
    } // for($count_number = 0; $count_number < $array_count; $count_number++) {

    // ----------------------------------------------
    // gettting all the plugin data
    // ----------------------------------------------   

    $display_button_checkbox = esc_html($yy_array_top_btn['display_button_checkbox']);
    $background_color = esc_html($yy_array_top_btn['background_color']);
    $button_width = esc_html($yy_array_top_btn['button_width']);
    $button_height = esc_html($yy_array_top_btn['button_height']);
    $border_radius = esc_html($yy_array_top_btn['border_radius']);
    $horizontal_position = esc_html($yy_array_top_btn['horizontal_position']);
    $horizontal_spacing = esc_html($yy_array_top_btn['horizontal_spacing']);
    $vertical_position = esc_html($yy_array_top_btn['vertical_position']);
    $vertical_spacing = esc_html($yy_array_top_btn['vertical_spacing']);
    $button_z_index = intval($yy_array_top_btn['button_z_index']);
    $button_border = esc_html($yy_array_top_btn['button_border']);
    $icon_image_url = esc_url($yy_array_top_btn['icon_image_url']);
    
    // Handle backward compatibility for new fields
    $icon_type = isset($yy_array_top_btn['icon_type']) ? esc_html($yy_array_top_btn['icon_type']) : '';
    $icon_svg_url = isset($yy_array_top_btn['icon_svg_url']) ? esc_url($yy_array_top_btn['icon_svg_url']) : '';
    $icon_width = isset($yy_array_top_btn['icon_width']) ? intval($yy_array_top_btn['icon_width']) : 0;
    $icon_height = isset($yy_array_top_btn['icon_height']) ? intval($yy_array_top_btn['icon_height']) : 0;
    $hide_button_on_desktop = intval($yy_array_top_btn['hide_button_on_desktop']);
    $hide_button_on_mobile = intval($yy_array_top_btn['hide_button_on_mobile']);
    $mobile_width = intval($yy_array_top_btn['mobile_width']);
    $mobile_button_position_checkbox = esc_html($yy_array_top_btn['mobile_button_position_checkbox']);
    $mobile_horizontal_position = esc_html($yy_array_top_btn['mobile_horizontal_position']);
    $mobile_horizontal_spacing = esc_html($yy_array_top_btn['mobile_horizontal_spacing']);
    $mobile_vertical_position = esc_html($yy_array_top_btn['mobile_vertical_position']);
    $mobile_vertical_spacing = esc_html($yy_array_top_btn['mobile_vertical_spacing']);
    $smooth_scrolling_checkbox = esc_html($yy_array_top_btn['smooth_scrolling_checkbox']);
     
    $background_position = esc_attr($yy_array_top_btn['background_position']);
    $background_position = str_replace(array('/', '\\', '"', "'", "="), '', $background_position);


    // ----------------------------------------------
    // dealing with exclude or include pages
    // ----------------------------------------------

    if( !isset($yy_array_top_btn['exclude_option']) ) {
        $yy_array_top_btn['exclude_option'] = '';
    }

    if( !isset($yy_array_top_btn['exclude_ids']) ) {
        $yy_array_top_btn['exclude_ids'] = '';
    }

    $top_btn_exclude_option = esc_attr($yy_array_top_btn['exclude_option']);
    $exclude_ids = esc_attr($yy_array_top_btn['exclude_ids']);

    // creating an array with all the ids
    $top_btn_exclude_ids_array = [];
    $exclude_ids_explode = explode( ',', $exclude_ids);
    
    foreach($exclude_ids_explode as $exclude_id) {

        $exclude_id = intval( trim($exclude_id) );

        if( !empty($exclude_id) ) {
            $top_btn_exclude_ids_array[] = $exclude_id;
        } // if( !empty($exclude_id) ) {

    } // foreach($exclude_ids_explode as $exclude_id) {


    // making sure the back to top button active 
    if( $display_button_checkbox == 1 ) {
   
        // ----------------------------------------------
        // create button css code
        // ----------------------------------------------

        // Generate button HTML based on icon type
        $button_html_code = "";
        $button_html_code .= "<div class='yydev-back-to-top-warp'>";

            if ($icon_type === 'svg') {
                // For SVG, use img tag inside the button with SVG URL or default
                $current_svg_url = !empty($icon_svg_url) ? $icon_svg_url : plugins_url('images/back-to-top.svg', dirname(__FILE__));
                $svg_width = !empty($icon_width) ? intval($icon_width) : intval($button_width);
                $svg_height = !empty($icon_height) ? intval($icon_height) : intval($button_height);
                $button_html_code .= "<a href='#' class='yydev-back-to-top yydev-svg-icon'><img src='" . esc_url($current_svg_url) . "' width='" . esc_attr($svg_width) . "' height='" . esc_attr($svg_height) . "' alt='Back to Top' /></a>";
            } else {
                // Default behavior for images and default icon
                $button_html_code .= "<a href='#' class='yydev-back-to-top'><span></span></a>";
            }

        $button_html_code .= "</div><!--yydev-back-to-top-warp-->";

        // ----------------------------------------------
        // create button css code
        // ----------------------------------------------

        $button_style_code = '';

        // dealing with button style
        $button_style_code .= '<style>';
            $button_style_code .= '.yydev-back-to-top {';

                // Handle different icon types
                    if ($icon_type === 'svg') {
                        // For SVG icons, no background image
                        $button_style_code .= 'background:' . $background_color . ';';
                        $button_style_code .= 'position: relative;';
                        $button_style_code .= 'text-indent: 0;';
                    } else {
                    // Default behavior for images
                    $current_icon_url = !empty($icon_image_url) ? $icon_image_url : plugins_url('images/back-to-top.png', dirname(__FILE__));
                    $button_style_code .= 'background:' . $background_color . ' url(' . $current_icon_url .') no-repeat;';
                    
                    $current_background_position = "50% 43%";
                    if(!empty($background_position)) { $current_background_position = $background_position; }
                    $button_style_code .= 'background-position: ' .  $current_background_position . ';';
                    $button_style_code .= 'text-indent:-9999px;';
                }

                $button_style_code .= 'width:' . $button_width . 'px;';
                $button_style_code .= 'height:' . $button_height . 'px;';
                $button_style_code .= 'border-radius:' . $border_radius . ';';
                $button_style_code .= $horizontal_position . ':' . $horizontal_spacing . ';';
                $button_style_code .= $vertical_position . ':' . $vertical_spacing . ';';
                $button_style_code .= 'border:' . $button_border . ';';
                $button_style_code .= 'position: fixed;';
                $button_style_code .= 'display:none;';

                $current_button_z_index = "9999";
                if(!empty($button_z_index)) { $current_button_z_index = $button_z_index; }
                $button_style_code .= 'z-index:' . $current_button_z_index . ';';

                // if we hide this one desktop
                if($hide_button_on_desktop == 1) {
                    $button_style_code .= 'visibility: hidden !important';
                } else { // if($hide_button_on_desktop == 1) {
                    $button_style_code .= 'visibility: visible !important';
                } // } else { // if($hide_button_on_desktop == 1) {

           $button_style_code .= '}';

           // SVG specific styles
           if ($icon_type === 'svg') {
               $button_style_code .= '.yydev-back-to-top.yydev-svg-icon img {';
               $button_style_code .= 'position: absolute;';
               $button_style_code .= 'top: 50%;';
               $button_style_code .= 'left: 50%;';
               $button_style_code .= 'transform: translate(-50%, -50%);';
               $button_style_code .= 'max-width: 100%;';
               $button_style_code .= 'max-height: 100%;';
               $button_style_code .= 'object-fit: contain;';
               $button_style_code .= 'pointer-events: none;';
               $button_style_code .= '}';
               
               $button_style_code .= '.yydev-back-to-top.yydev-svg-icon {';
               $button_style_code .= 'overflow: hidden;';
               $button_style_code .= '}';
           }

           // dealing with button mobile style
           $button_style_code .= '@media only screen and (max-width: ' . $mobile_width . 'px) {';

                $button_style_code .= '.yydev-back-to-top {';

                    if($mobile_button_position_checkbox == 1 ) {
                        $button_style_code .= $horizontal_position . ':auto;';
                        $button_style_code .= $vertical_position . ':auto;';
                        $button_style_code .= $mobile_horizontal_position . ':' . $mobile_horizontal_spacing . ';';
                        $button_style_code .= $mobile_vertical_position . ':' . $mobile_vertical_spacing . ';';
                    } // if($mobile_button_position_checkbox == 1 ) {

                    // if the button is showed only on desktop
                    if($hide_button_on_mobile == 1) {
                        $button_style_code .= 'visibility: hidden !important';
                    } else { // if($hide_button_on_mobile == 1) {
                        $button_style_code .= 'visibility: visible !important';
                    } // } else { // if($hide_button_on_mobile == 1) {

                $button_style_code .= '}';

           $button_style_code .= '}';
       $button_style_code .= '</style>';

        // ----------------------------------------------
        // add css and javascript code to header
        // ----------------------------------------------   

        add_action( 'wp_footer', function() use ($button_style_code, $top_btn_exclude_option, $top_btn_exclude_ids_array) {
        	 
            $page_id = yydev_top_btn_find_page_id();
            $top_btn_exclude_option = $top_btn_exclude_option; // checking if we should exclude or include pages
            $exclude_ids = $top_btn_exclude_ids_array; // pages we should display on or ignore
            $output_menu_now = 1;

            // incase we exclude pages
            if( $top_btn_exclude_option === 'exclude' ) {

                // incase we choose to exclude an id
                if( in_array( $page_id, $exclude_ids) ) {
                    $output_menu_now = 0;
                } // if( in_array( $page_id, $exclude_ids) ) {

            } // if( $top_btn_exclude_option === 'exclude' ) {

            // incase we exclude pages
            if( $top_btn_exclude_option === 'include' ) {

                // incase we choose to include only on some pages
                if( !in_array( $page_id, $exclude_ids) ) {
                    $output_menu_now = 0;
                } // if( !in_array( $page_id, $exclude_ids) ) {

            } // if( $top_btn_exclude_option === 'exclude' ) {


            // checking if we should output the button
            if( $output_menu_now ) {

                // echo css code to page
                echo $button_style_code;

            } // if( $output_menu_now ) {          

        }, 9999); // add_action( 'wp_footer', function() use ($yydev_accessibility_html){

        // ----------------------------------------------
        // include javascript files
        // ----------------------------------------------   

        add_action('wp_enqueue_scripts', function() {

            $js_file_path = esc_url( plugin_dir_url(dirname(__FILE__)) ) . 'front-end/yydev-back-to-top.js';
            wp_enqueue_script( 'yydev-back-to-top_js', $js_file_path, array('jquery'), false, true);
        }, 99999999999999999); 

        // ----------------------------------------------
        // add the button html to footer
        // ---------------------------------------------- 

        add_action( 'wp_footer', function() use ($button_html_code, $top_btn_exclude_option, $top_btn_exclude_ids_array){
        	 
            $page_id = yydev_top_btn_find_page_id();
            $top_btn_exclude_option = $top_btn_exclude_option; // checking if we should exclude or include pages
            $exclude_ids = $top_btn_exclude_ids_array; // pages we should display on or ignore
            $output_menu_now = 1;

            // incase we exclude pages
            if( $top_btn_exclude_option === 'exclude' ) {

                // incase we choose to exclude an id
                if( in_array( $page_id, $exclude_ids) ) {
                    $output_menu_now = 0;
                } // if( in_array( $page_id, $exclude_ids) ) {

            } // if( $top_btn_exclude_option === 'exclude' ) {

            // incase we exclude pages
            if( $top_btn_exclude_option === 'include' ) {

                // incase we choose to include only on some pages
                if( !in_array( $page_id, $exclude_ids) ) {
                    $output_menu_now = 0;
                } // if( !in_array( $page_id, $exclude_ids) ) {

            } // if( $top_btn_exclude_option === 'exclude' ) {

            // checking if we should output the button
            if( $output_menu_now ) {
                // echo html button
                echo $button_html_code; 
            } // if( $output_menu_now ) {

        }); // add_action( 'wp_footer', function() use ($button_html_code){

    } // if( $display_button_checkbox == 1 ) {

} // if( !empty($getting_plugin_data) ) {

