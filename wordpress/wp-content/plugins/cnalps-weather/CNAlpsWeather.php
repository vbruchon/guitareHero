<?php

/**
 *Plugin Name: CNAlpsWeather
 *Plugin URI: URI de la page
 *Description: Un simple plugin pour afficher la météo
 *Author: Vivian
 *Version: 1.0.0
 */

class CNAlpsWeather extends WP_Widget
{
    function __construct()
    {
        $options = array(
            'classname'   => 'CNAlpsWeather',
            'description' => 'Minimalistic weather widget'
        );
        parent::__construct(
            /* Widget ID */
            'CNAlpsWeather',
            /* Widget Name */
            'CNAlps Weather Widget',
            /* Widget Description/options */
            $options
        );
    }

    public function widget($args, $instance)
    {
/*         $title = apply_filters('widget_title', $instance['title']);
 */        $city = $instance['city'];
        $country = $instance['country'];
        $url = "https://www.weatherwp.com/api/common/publicWeatherForLocation.php?city=$city&country=$country&language=french";
        echo $args['before_widget'];
        //if title is present
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        //output
        $response = wp_remote_get($url); //Équivalent à fetch en JS curl en php
        $response_json = json_decode(wp_remote_retrieve_body($response));
        /**
         * json_decode => encode la réponse à l'appelle à l'api en JSON
         * wp_remote_retrieve_body => Pour récupérer uniquement le corps(data qui nous intéresse) de la réponse.
         */
        $place = $response_json->status_message;
        $temp = $response_json->temp;
        $icon = $response_json->icon;
        $desc = $response_json->description;

        echo __(
            "<style>
                .cnalps-weather-widget{background-color: #fff; padding:15px; border-radius: 50px; width: 120%;}
                .weather-title h2{color: black; text-align: center; padding-top: 15px;}
                .weather-title img{padding: 5px 15px 15px 15px;}
                .weather-info{color: black; text-align: center}
                .weather-info strong{font-size: 120%;}
            </style>

            <div class=\"cnalps-weather-widget\"> 
                <div class=\"weather-title\">
                    <h2>$place </h2>
                    <img src=\"$icon\">
                </div>
                <div class=\"weather-info\">
                    <p>Actuellement il fait une température de : <strong>$temp °C </strong></p>
                    <p>Le temps est : $desc </p>
                </div>
        </div>"
        );

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $city = $instance['city'];
        $country = $instance['country'];
?>

        <p>
            <label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('City:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo esc_attr($city); ?>" />

            <label for="<?php echo $this->get_field_id('country'); ?>"><?php _e('Pays (en anglais):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('country'); ?>" name="<?php echo $this->get_field_name('country'); ?>" type="text" value="<?php echo esc_attr($country); ?>" />
        </p>

<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();

        $instance['city'] = (!empty($new_instance['city'])) ? strip_tags($new_instance['city']) : '';
        $instance['country'] = (!empty($new_instance['country'])) ? strip_tags($new_instance['country']) : '';

        return $instance;
    }
}

function cnalps_register_weather_widget()
{
    register_widget('CNAlpsWeather');
}

add_action('widgets_init', 'cnalps_register_weather_widget');
?>