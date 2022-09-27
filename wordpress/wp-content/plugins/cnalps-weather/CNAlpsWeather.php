<?php

/**
 *Plugin Name: CNAlpsWeather
 *Plugin URI: URI de la page
 *Description: Un simple plugin pour afficher la météo
 *Author: Vivian
 *Version: 1.0.0
 */


class CNAlpsWeather extends Wp_Widget
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
             $options);
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        //if title is present
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        //output
        echo __('Bienvenue sur le widget CNAlps Weather', 'text_domain');

        echo $args['after_widget'];
    }
}
function cnalps_register_weather_widget()
{
    register_widget('CNAlpsWeather');
}

add_action('widgets_init', 'cnalps_register_weather_widget');

