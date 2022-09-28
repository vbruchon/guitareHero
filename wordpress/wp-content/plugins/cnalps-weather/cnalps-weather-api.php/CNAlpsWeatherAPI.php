<?php

/**
 *Plugin Name: CNAlpsWeatherAPI
 *Plugin URI: URI de la page
 *Description: Un plugin pour afficher la météo grâce à du json
 *Author: Vivian
 *Version: 1.0.0
 */


class CNAlpsWeatherAPI extends WP_Widget
{
    function __construct()
    {
        $options = array(
            'classname'   => 'CNAlpsWeatherAPI',
            'description' => 'complex weather with api widget'
        );
        parent::__construct(
            /* Widget ID */
            'CNAlpsWeatherAPI',
            /* Widget Name */
            'CNAlps Weather API Widget',
            /* Widget Description/options */
            $options
        );
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        //if title is present
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        //output
        echo __(
            '<div class="cnalps-weather-widget"> 
            <div class="weather-title">La météo à' . " " . $instance['city'] . ' en ' . $instance['country'] . '</div>
        </div>'
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

            <label for="<?php echo $this->get_field_id('country'); ?>"><?php _e('Pays:'); ?></label>
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

function cnalps_register_weather_api_widget()
{
    register_widget('CNAlpsWeather');
}

add_action('widgets_init', 'cnalps_register_weather_widget');













$place = $response_json['status_message'];
        $temp = $response_json['temp'];
        $icon = $response_json['icon'];
        $desc = $response_json['description'];
        var_dump($response_json);
            
        echo __(
            '<div class="cnalps-weather-widget"> 
                <div class=\"weather-title\">
                    <h2>' . $place . '</h2>
                    <img src=\"'.$icon.'\">
                </div>
                <div class=\"weather-info\">
                    <p>Actuellement il fait une température de : '.$temp.' °C</p>
                    <p>Le temps est : '.$desc.'</p>
                </div>
        </div>'
        );