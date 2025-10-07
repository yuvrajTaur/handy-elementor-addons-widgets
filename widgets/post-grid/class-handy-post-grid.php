<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;



class Handy_Post_Grid_Widget extends Widget_Base {
    
    public function get_name() {
        return 'handy_post_grid';
    }
    
    public function get_title() {
        return __( 'Handy Post Grid', 'handy-elementor-addons-widgets' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_style_depends() {
        return [ 'handy-post-grid' ];
    }

    public function get_categories() {
        return [ 'handy_category' ];
    }

    protected function register_controls() {

        /**
         * Grid Layout Controls!
         */

        $this->start_controls_section(
            'handy_section_post_grid_layout',
            [
                'label' => __( 'Layout', 'handy-elementor-addons-widgets' ),
            ]
        );

        $this->add_control('handy_post_query', [
                'label' => esc_html__('Source', 'handy-elementor-addons-widgets'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post',
                'options' => [
                    'post' => esc_html__('Posts', 'handy-elementor-addons-widgets'),
                    'page' => esc_html__('Pages', 'handy-elementor-addons-widgets'),
                ],
        ]);


        $this->add_control(
            'handy_post_grid_columns',
            [
                'label' => esc_html__( 'Columns', 'handy-elementor-addons-widgets' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'handy-col-1' => [
                        'title'  => esc_html__('One', 'handy-elementor-addons-widgets'),
                        'text'   => '1'
                    ],
                    'handy-col-2' => [
                        'title'  => esc_html__('Two', 'handy-elementor-addons-widgets'),
                        'text'   => '2'
                    ],
                    'handy-col-3' => [
                        'title'  => esc_html__('Three', 'handy-elementor-addons-widgets'),
                        'text'   => '3'
                    ],
                    'handy-col-4' => [
                        'title'  => esc_html__('Four', 'handy-elementor-addons-widgets'),
                        'text'   => '4'
                    ],
                    'handy-col-5' => [
                        'title'  => esc_html__('Five', 'handy-elementor-addons-widgets'),
                        'text'   => '5'
                    ],
                    'handy-col-6' => [
                        'title'  => esc_html__('Six', 'handy-elementor-addons-widgets'),
                        'text'   => '6'
                    ],
                ],
                'default' => 'handy-col-4',
                'toggle' => true,
                'prefix_class' => 'handys-class-', 
            ]
        );


        $this->add_control(
            'handy_post_grid_per_page',
            [
                'label'   => __( 'Posts per Page', 'handy-elementor-addons-widgets' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 4,
                'min'     => 1,
                'max'     => 50,
            ]
        );

        $this->add_control(
			'handy_title_heading',
			[
				'label'     => esc_html__( 'Title', 'handy-elementor-addons-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'handy_show_title',
            [
                'label'        => __('Show', 'handy-elementor-addons-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'handy-elementor-addons-widgets'),
                'label_off'    => __('No', 'handy-elementor-addons-widgets'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
			'handy_excerpt_heading',
			[
				'label'     => esc_html__( 'Excerpt', 'handy-elementor-addons-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
       $this->add_control(
            'handy_show_excerpt',
            [
                'label'        => __('Show', 'handy-elementor-addons-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'handy-elementor-addons-widgets'),
                'label_off'    => __('No', 'handy-elementor-addons-widgets'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'handy_excerpt_length',
            [
                'label'     => __('Length', 'handy-elementor-addons-widgets'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 10,
                'condition' => [
                    'handy_show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'handy_excerpt_expanison_indicator',
            [
                'label'       => esc_html__('Expansion Indicator', 'handy-elementor-addons-widgets'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active'      =>true ],
                'ai'          => [ 'active'      =>false ],
                'label_block' => false,
                'default'     => esc_html__('...', 'handy-elementor-addons-widgets'),
                'condition'   => [
                    'handy_show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'handy_read_more_text_heading',
			[
				'label'     => esc_html__( 'Read More Text', 'handy-elementor-addons-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'handy_show_read_more_button',
            [
                'label'        => __('Show', 'handy-elementor-addons-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'handy-elementor-addons-widgets'),
                'label_off'    => __('No', 'handy-elementor-addons-widgets'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'handy_read_more_button_text',
            [
                'label'       => esc_html__('Text', 'handy-elementor-addons-widgets'),
                'type'        => Controls_Manager::TEXT,
                'ai'          => [ 'active' => false ],
                'label_block' => false,
                'default'     => esc_html__('Read More', 'handy-elementor-addons-widgets'),
                'condition'   => [
                    'handy_show_read_more_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
			'handy_meta_data_heading',
			[
				'label'     => esc_html__( 'Meta Data', 'handy-elementor-addons-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'handy_show_meta',
            [
                'label'        => __('Show', 'handy-elementor-addons-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'handy-elementor-addons-widgets'),
                'label_off'    => __('No', 'handy-elementor-addons-widgets'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'handy_meta_position',
            [
                'label'   => esc_html__('Meta Position', 'handy-elementor-addons-widgets'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'meta-entry-footer',
                'options' => [
                    'meta-entry-header' => esc_html__('Entry Header', 'handy-elementor-addons-widgets'),
                    'meta-entry-footer' => esc_html__('Entry Footer', 'handy-elementor-addons-widgets'),
                ],
                'condition' => [
                    'handy_show_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'handy_show_avatar',
            [
                'label'        => __('Avatar', 'handy-elementor-addons-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'handy-elementor-addons-widgets'),
                'label_off'    => __('Hide', 'handy-elementor-addons-widgets'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'handy_show_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'handy_show_author',
            [
                'label'        => __('Author Name', 'handy-elementor-addons-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'handy-elementor-addons-widgets'),
                'label_off'    => __('Hide', 'handy-elementor-addons-widgets'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'handy_show_meta' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'handy_section_post_grid_image',
            [
                'label' => __( 'Image', 'handy-elementor-addons-widgets' ),
            ]
        );

        $this->add_control(
            'handy_show_image',
            [
                'label'        => __('Show', 'handy-elementor-addons-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'handy-elementor-addons-widgets'),
                'label_off'    => __('No', 'handy-elementor-addons-widgets'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image',
                'exclude'   => ['custom'],
                'default'   => 'medium',
                'condition' => [
                    'handy_show_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'handy_postgrid_image_height',
            [
                'label'      => __('Height', 'handy-elementor-addons-widgets'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .handy-post-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'handy_show_image' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Grid Style Controls!
         */
        $this->start_controls_section(
            'handy_section_post_grid_style',
            [
                'label' => __('Item', 'handy-elementor-addons-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
  
        $this->add_control(
            'handy_post_grid_bg_color',
            [
                'label' => __('Background Color', 'handy-elementor-addons-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .handy-post-content' => 'background-color: {{VALUE}}',
                ],

            ]
        );

        $this->add_responsive_control(
            'handy_post_grid_spacing',
            [
                'label' => esc_html__('Space Between Items', 'handy-elementor-addons-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    10,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .handy-post-grid .handy-post-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'handy_post_grid_border',
                'label' => esc_html__('Border', 'handy-elementor-addons-widgets'),
                'selector' => '{{WRAPPER}} .handy-post-card',
            ]
        );

        $this->add_control(
            'handy_post_grid_border_radius',
            [
                'label' => esc_html__('Border Radius', 'handy-elementor-addons-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 8,
                    'right' => 8,
                    'bottom' => 8,
                    'left' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .handy-post-card' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'handy_post_grid_box_shadow',
                'selector' => '{{WRAPPER}} .handy-post-card',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'handy_section_post_grid_thumbnail_style',
            [
                'label' => __( 'Image', 'handy-elementor-addons-widgets' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        
        $this->add_control(
            'handy_post_grid_thumbnail_radius',
            [
                'label' => esc_html__('Thumbnail Radius', 'handy-elementor-addons-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 8,
                    'right' => 8,
                    'bottom' => 8,
                    'left' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .handy-post-image' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section();

         /**
         * Style tab: Meta Date style
         */
        $this->start_controls_section(
            'handy_post_grid_meta_date_style',
            [
                'label' => __('Meta Date', 'handy-elementor-addons-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'handy_show_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'handy_post_grid_meta_color_date',
            [
                'label' => __('Date Color', 'handy-elementor-addons-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => 'ffffffff',
                'selectors' => [
                    '{{WRAPPER}} .handy-post-meta .handy-post-date' => 'color: {{VALUE}}',
                ],
                'condition' => [
	                'handy_show_meta' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'handy_post_grid_meta_alignment',
            [
                'label' => __('Alignment', 'handy-elementor-addons-widgets'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'handy-elementor-addons-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'handy-elementor-addons-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'handy-elementor-addons-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .handy-post-meta' => 'justify-content: {{VALUE}}; align-items: center;',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'handy_post_grid_meta_typography',
				'selector' => '{{WRAPPER}} .handy-post-meta',
			]
		);
       
        $this->add_control(
            'handy_post_grid_meta_date_margin',
            [
                'label' => __('Margin', 'handy-elementor-addons-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .handy-post-meta .handy-post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        
        $this->end_controls_section();

        
         /**
         * Style tab: content style
         */
        $this->start_controls_section(

            'handy_post_grid_content_style',
            [
                'label' => __('Content', 'handy-elementor-addons-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'handy_post_grid_title_style',
            [
                'label' => __( 'Title', 'handy-elementor-addons-widgets' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'handy_post_grid_title_color',
            [
                'label' => __( 'Color', 'handy-elementor-addons-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#303133',
                'selectors' => [
                    '{{WRAPPER}} .handy-post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'handy_post_grid_title_hover_color',
            [
                'label' => __( 'Hover Color', 'handy-elementor-addons-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#23527c',
                'selectors' => [
                    '{{WRAPPER}} .handy-post-title:hover, 
                    {{WRAPPER}} .handy-post-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'handy_post_grid_title_alignment',
            [
                'label' => __( 'Alignment', 'handy-elementor-addons-widgets' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'handy-elementor-addons-widgets' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'handy-elementor-addons-widgets' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'handy-elementor-addons-widgets' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .handy-post-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'handy_post_grid_title_typography',
                'label'    => __( 'Title Typography', 'handy-elementor-addons-widgets' ),
                'selector' => '{{WRAPPER}} .handy-post-title, {{WRAPPER}} .handy-post-title a',
            ]
        );

        $this->add_responsive_control(
            'handy_post_grid_title_margin',
            [
                'label' => __( 'Margin', 'handy-elementor-addons-widgets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .handy-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'handy_post_grid_excerpt_style',
            [
                'label' => __( 'Excerpt Style', 'handy-elementor-addons-widgets' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'handy_post_grid_excerpt_color',
            [
                'label' => __( 'Color', 'handy-elementor-addons-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .handy-post-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'handy_post_grid_excerpt_alignment',
            [
                'label' => __( 'Alignment', 'handy-elementor-addons-widgets' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'handy-elementor-addons-widgets' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'handy-elementor-addons-widgets' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'handy-elementor-addons-widgets' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'handy-elementor-addons-widgets' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .handy-post-excerpt' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'handy_post_grid_excerpt_typography',
                'label'    => __( 'Excerpt Typography', 'handy-elementor-addons-widgets' ),
                'selector' => '{{WRAPPER}} .handy-post-excerpt',
            ]
        );

        $this->add_control(
            'handy_post_grid_content_height',
            [
                'label' => __( 'Height', 'handy-elementor-addons-widgets' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['max' => 300],
                    '%'  => ['max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .handy-post-card .handy-post-content' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'handy_post_grid_excerpt_margin',
            [
                'label' => __( 'Margin', 'handy-elementor-addons-widgets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .handy-post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }


    protected function render() {
        
        $settings = $this->get_settings_for_display();

        echo Handy_render_Post_Grid::handy_post_grid_widget_render($settings);
    
    }
}

