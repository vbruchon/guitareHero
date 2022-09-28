<?php
/* 
  Plugin Name: Shortcode Géolocate Multiple
  Description: Plugin fournissant des shortcodes map à plusieurs marker
  Author: Vivian
  Version: 1.0.0
*/

function cnalps_register_geolocate_multiple_shortcode($atts)
{
    extract(shortcode_atts(
        $atts = array_change_key_case((array) $atts, CASE_LOWER),
        $src = $atts['src']
    ));
    $response = wp_remote_get($src);
    $response_json = json_decode(wp_remote_retrieve_body($response));

    $lat = $response_json[0]->lat;
    $lon = $response_json[0]->lon;


    var_dump($response_json);
    var_dump($response_json[0]);
    


    return '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js"></script>
        
        <style> #cnalps-map { width: 100%; height: 500px; }</style>
    
        <h1>Le Campus numérique in the Alps </h1>
        <div id="cnalps-map"></div>
        <script>
        
        let map = L.map("cnalps-map").setView([' . $lat . ',' . $lon . '], 6);

        let respJson = '.$response_json.';
        console.log(respJson);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "&copy; OpenStreetMap contributors"
            }).addTo(map);
            
            
            for ('.$i .' = 0; '. $i .'  < respJson.length; '.$i++.' ){
                L.marker([' . $response_json[$i]->lat . ',' . $response_json[$i]->lon . ']).addTo(map)
                '.var_dump($i ,$response_json[$i]->lat, $response_json[$i]->lon);'
            }

        </script>';
}

add_shortcode('CNAlpsGeolocateMultiple', 'cnalps_register_geolocate_multiple_shortcode');


/* 
} *//* 


/* L.marker([' . $lat . ',' . $lon . ']).addTo(map)
            L.marker([' . $response_json[1]->lat . ',' . $response_json[1]->lon . ']).addTo(map) 


        let map = L.map("cnalps-map").setView([45.5836 , 4.6946], 16);

L.marker([' . $latitude . ',' . $longitude . ']).addTo(map)
.bindPopup("'.$desc.'")
.openPopup();
 */










/* function cnalps_register_geolocate_multiple_shortcode($atts)
{
    extract(shortcode_atts(
        $atts = array_change_key_case((array) $atts, CASE_LOWER),
        $src = $atts['src'],
        $latitude = $atts['latitude'],
        $longitude = $atts['longitude'],
        $zoom = $atts['zoom'],
        $src_json = json_decode(wp_remote_retrieve_body($src))
    ));
    print_r($src_json);
    return '
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js"></script>

    <style> #cnalps-map { width: 100%; height: 500px; }</style>

    <h1>Le Campus numérique in the Alps </h1>
    <div id="cnalps-map"></div>
    <script>
        let map = L.map("cnalps-map").setView([44.73028, 5.02356], 16);    

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors"
        }).addTo(map);

        L.marker([' . $latitude . ',' . $longitude . ']).addTo(map)
            .bindPopup("' . $desc . '")
            .openPopup();
    </script>';
} */
