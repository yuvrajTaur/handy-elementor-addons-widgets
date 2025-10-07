<?php

/**
 * Plugin Name: Handy Elementor Addons & Widgets
 * Description: A powerful Elementor addons plugin with custom widgets and controls.
 * Version: 1.0.0
 * Author: xoptimize
 * Text Domain: handy-elementor-addons-widgets
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

if (defined('HANDY_VERSION')) {
    return;
}

// Define constants for later use
define('HANDY_VERSION', '1.0.0');
define('HANDY_FILE', __FILE__);
define('HANDY_DIR', plugin_dir_path(HANDY_FILE));
define('HANDY_URL', plugin_dir_url(HANDY_FILE));

    if (!class_exists('Handy_Elementor_Addons_Widgets')) {

    /**
    * Class Handy_Elementor_Addons_Widgets
    */

    final class Handy_Elementor_Addons_Widgets {

        private function __construct()
        {
            // Register activation/deactivation hooks
            // register_activation_hook(HANDY_FILE, array($this, 'handy_activate'));

            // Check if Elementor is activated
            add_action('plugins_loaded', array($this, 'handy_elementor_missing_notice'));



            /* Include required files */
            $this->handy_includes();
        }

        /**
         * Plugin instance.
         *
         * @var Handy_Elementor_Addons_Widgets
         * @access private
         */

        private static $instance = null;
        
        /**
         * Get plugin instance.
         *
         * @return Handy_Elementor_Addons_Widgets
         * @static
         */
        public static function get_instance()
        {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /*
        |--------------------------------------------------------------------------
        | Run when activate plugin.
        |--------------------------------------------------------------------------
        */

        // public function handy_activate()
        // {
       
         
        // }

        /*
        |--------------------------------------------------------------------------
        | plugin loaded 
        |--------------------------------------------------------------------------
        */
        
        public function handy_plugins_loaded()
        {
            // Notice if the Elementor is not active
            if (!did_action('elementor/loaded')) {
                add_action('admin_notices', array($this, 'handy_elementor_missing_notice'));
                return;
            }
            
        }        
        
        /*
        |--------------------------------------------------------------------------
        | Admin notice for missing Elementor
        |--------------------------------------------------------------------------
        */

        public function handy_elementor_missing_notice()
        {
            if (!is_plugin_active('elementor/elementor.php')): ?>
            <div class="notice notice-warning is-dismissible">
                <p><?php echo '<a href="https://wordpress.org/plugins/elementor/"  target="_blank" >' . esc_html__('Elementor Page Builder', 'handy-elementor-addons-widgets') . '</a>' . wp_kses_post(__(' must be installed and activated for "<strong>Handy Elementor Addons & Widgets</strong>" to work', 'handy-elementor-addons-widgets')); ?></p>
            </div>
            <?php
        endif;

        }
        

        /*
        |--------------------------------------------------------------------------
        | Load required files
        |--------------------------------------------------------------------------
        */

        public function handy_includes(){

         require HANDY_DIR . 'includes/handy-elementor-register.php';
         require HANDY_DIR . 'templates/handy-post-grid.php';

        }


    }

    function Handy_Elementor_Addons_Widgets()
    {
        return Handy_Elementor_Addons_Widgets::get_instance();
    }

    Handy_Elementor_Addons_Widgets();

    }
?>