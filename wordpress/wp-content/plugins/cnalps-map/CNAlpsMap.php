<?php
/*
  Plugin Name: Shortcode Personnalisé
  Description: Plugin fournissant des shortcodes
  Author: Vivian
  Version: 1.0.0
 */

function shortcode_simple_map()
{
    return '
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js"></script>
    
    <style> #cnalps-map { width: 100%; height: 300px; }</style>

    <div id="cnalps-map"></div>
    <script>
        let map = L.map("cnalps-map").setView([44.73028, 5.02356], 16);
    
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors"
        }).addTo(map);
    
        L.marker([44.73028, 5.02356]).addTo(map)
            .bindPopup("La Tour de Crest")
            .openPopup();
    </script>';
}

function cnalps_register_geolocate_shortcode($atts = [])
{
    extract(shortcode_atts(
        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array) $atts, CASE_LOWER),
        $latitude = $atts['latitude'],
        $longitude = $atts['longitude'],
        $zoom = $atts['zoom'],
        $desc = $atts['desc'],
    
    ));
    return '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js"></script>
        
        <style> #cnalps-map { width: 100%; height: 500px; }</style>
    
        <h1>Le Campus numérique in the Alps </h1>
        <div id="cnalps-map"></div>
        <script>
            let map = L.map("cnalps-map").setView([' . $latitude . ',' . $longitude . '],' . $zoom . ');
        
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "&copy; OpenStreetMap contributors"
            }).addTo(map);
            L.marker([' . $latitude . ',' . $longitude . ']).addTo(map)
                .bindPopup("'.$desc.'")
                .openPopup();
        </script>';
}


add_shortcode('simple_map', 'shortcode_simple_map');
add_shortcode('CNAlpsGeolocate', 'cnalps_register_geolocate_shortcode');
