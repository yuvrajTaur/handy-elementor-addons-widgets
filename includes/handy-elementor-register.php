<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

class Handy_Elementor_Register  {

	public function __construct() {

		// Add a custom category for panel widgets
        add_action( 'elementor/elements/categories_registered', array( $this, 'handy_register_custom_category' ) );

        // Register new widgets
		add_action( 'elementor/widgets/register', array( $this, 'handy_widgets_registered' ) );

        // add_action('elementor/frontend/after_register_scripts', [$this, 'register_widget_scripts']);
        add_action('elementor/frontend/after_register_styles', [$this, 'handy_register_widget_styles']);

	}

    /*
    |--------------------------------------------------------------------------
    | add the custom category
    |--------------------------------------------------------------------------
    */
    public function handy_register_custom_category( $elements_manager ) {
        $elements_manager->add_category(
            'handy_category',
            [
                'title' => esc_html__( 'Handy Addons', 'handy-elementor-addons-widgets' ),
                'icon' => 'fa fa-header',
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Register new widgets
    |--------------------------------------------------------------------------
    */
    public function handy_widgets_registered( $widgets_manager ) {
        $this->handy_widgets_includes( $widgets_manager );
    }

    
    /*
    |--------------------------------------------------------------------------
    | Include Widgets files
    |--------------------------------------------------------------------------
    */
    private function handy_widgets_includes( $widgets_manager ) {
        $widgets = [
            'post-grid/class-handy-post-grid'           => 'Handy_Post_Grid_Widget',
        ];
        
        foreach ( $widgets as $file_slug => $class ) {
            $file = HANDY_DIR . 'widgets/' . $file_slug . '.php';
            if ( file_exists( $file ) ) {
                require_once $file;
                if ( class_exists( $class ) ) {
                    $widgets_manager->register( new $class() );
                }
            }
        }
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | Register and Enqueue CSS/JS
    |--------------------------------------------------------------------------
    */
    public static function handy_post_grid_enqueue_assets($scripts, $file) {
        $register_func = 'wp_register_' . $file;  
        $enqueue_func = 'wp_enqueue_' . $file;    
        $folder = ($file === 'script') ? 'js' : 'css'; 
        
        foreach ($scripts as $handle => $data) {
            // Build the URL to the CSS or JS file
            $url = HANDY_URL . ($data['path'] === '' ? 'assets/' . $folder : $data['path']) . '/' . $data['file'];

            // Set dependencies if available, defaults to an empty array
            $deps = isset($data['deps']) ? $data['deps'] : [];

            // Set media type (true for scripts, 'all' or custom media for styles)
            $in_footer_or_media = ($file === 'script') ? true : (isset($data['media']) ? $data['media'] : 'all');
            
            // Register the style or script
            $register_func($handle, $url, $deps, HANDY_VERSION, $in_footer_or_media);
            
            // If 'enqueue' is true, enqueue the style or script
            if (!empty($data['enqueue'])) {
                $enqueue_func($handle);
            }
        }
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | Register and Enqueue CSS
    |--------------------------------------------------------------------------
    */
    public function handy_register_widget_styles(){
      $styles = [ 'handy-post-grid' => [ 'file' => 'handy-post-grid.css', 'enqueue' => false, 'path' => '']
    ];
     
        Handy_Elementor_Register::handy_post_grid_enqueue_assets($styles, 'style');
    }

}
new Handy_Elementor_Register ();
