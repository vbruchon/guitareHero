<?php
/* 
  Plugin Name: Shortcode Géolocate Multiple
  Description: Plugin fournissant des shortcodes map à plusieurs marker
  Author: Vivian
  Version: 1.0.0
*/

function cnalps_register_geolocate_multiple_shortcode($atts = [])
{
    extract(shortcode_atts(
        $atts = array_change_key_case((array) $atts, CASE_LOWER),
        $src = $atts['src']
    ));
    return "
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css'>        
        <script src='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js'></script>
        <link href='./style.css'>
    

        <div id='cnalps-map'style='height:800px'> $src </div>
        <script src ='wp-content/plugins/cnalps-geolocator-multiple/script.js'></script>
        ";
}

add_shortcode('CNAlpsGeolocateMultiple', 'cnalps_register_geolocate_multiple_shortcode');
