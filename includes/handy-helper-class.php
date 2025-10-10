<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Handy_helper_Class {

    public static function handy_get_all_post($args ){
        $default_args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 5,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $query_args = wp_parse_args( $args, $default_args );

            // Execute the query
            $query = new WP_Query( $query_args );

            // Return the query object
            return $query;

    }

}



?>
