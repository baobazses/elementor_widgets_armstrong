<?php

/**
 * ImageTitleDescription class.
 *
 * @category   Class
 * @package    ElementorArmstrong
 * @subpackage WordPress
 * @author     Armstrong <dev@armstrong.space>
 * @copyright  2021 Armstrong
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @since      1.0.0
 * php version 7.3.9
 */

namespace ElementorArmstrong\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * ImageTitleDescription widget class.
 *
 * @since 1.0.0
 */
class ImageTitleDescription extends Widget_Base
{
    /**
     * Class constructor.
     *
     * @param array $data Widget data.
     * @param array $args Widget arguments.
     */
    public function __construct($data = array(), $args = null)
    {
        parent::__construct($data, $args);
    }

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'image_title_description';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Image with Title and Description', 'elementor-armstrong');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-image-rollover';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return array('armstrong');
    }

    /**
     * Enqueue scripts.
     */
    public function get_script_depends()
    {
        $scripts = ['image_title_description-script'];

        return $scripts;
    }

    /**
     * Enqueue styles.
     */
    public function get_style_depends()
    {
        $styles = ['image_title_description-style'];

        return $styles;
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls()
    {
        /* --------- START CONTENT TAB --------- */
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Image', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Lorem ipsum',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-armstrong'),
            ]
        );

        $this->end_controls_section();
        /* --------- END CONTENT TAB --------- */

        /* --------- START ADDITIONAL OPTIONS TAB --------- */
        $this->start_controls_section(
            'additional_options_section',
            [
                'label' => __('Additional options', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'image_transition',
			[
				'label' => __('Animation speed', 'elementor-armstrong'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 60000,
				'step' => 1,
				'default' => 500,
                'selectors' => [
                    '{{WRAPPER}} .image-transition' => 'transition-duration : {{VALUE}}ms;',
                ],
			]
		);


        $this->end_controls_section();
        /* --------- END ADDITIONAL OPTIONS TAB --------- */

        /* --------- START IMAGE STYLE TAB --------- */
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => __('Image', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Width', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label_block' => true,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
				'default' => [
					'size' => 300,
				],
                'selectors' => [
                    '{{WRAPPER}} .image-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Height', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label_block' => true,
                'size_units' => ['px', '%',  'vw'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
				'default' => [
					'size' => 415,
				],
                'selectors' => [
                    '{{WRAPPER}} .image-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        /* --------- END IMAGE STYLE TAB --------- */

        /* --------- START CONTENT STYLE TAB --------- */
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => __('Content', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /* ---- Start Title Style ---- */
        $this->add_control(
            'image_title_heading',
            [
                'label' => __('Title', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'image_title_typography',
                'selector' => '{{WRAPPER}} .image_title',
            ]
        );

        $this->add_control(
            'image_title_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'image_title_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image_title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_title_padding',
            [
                'label' => __('Padding', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .image_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        /* ---- End Title Style ---- */

        /* ---- Start Description Style ---- */
        $this->add_control(
            'image_description_heading',
            [
                'label' => __('Description', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'image_description_typography',
                'selector' => '{{WRAPPER}} .image_description',
            ]
        );

        $this->add_control(
            'image_description_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image_description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'image_description_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image_description' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_description_padding',
            [
                'label' => __('Padding', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .image_description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        /* ---- End Description Style ---- */

        $this->end_controls_section();
        /* --------- END CONTENT STYLE TAB --------- */
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if ($settings['image']) {
?>
            <div class="image-container image-transition" style="background-image : url('<?= $settings['image']['url'] ?>');">
                <div class="image-content">
                    <?php if ($settings['title']) { ?>
                        <div class="image_title image-transition"><?= $settings['title'] ?></div>
                    <?php } ?>
                    <?php if ($settings['description']) { ?>
                        <div class="image_description image-transition"><?= $settings['description'] ?></div>
                    <?php } ?>
                </div>
            </div>
        <?php
        }
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function content_template()
    {
        ?>
        <# if ( settings.image ) { #>
            <div class="image-container image-transition" style="background-image : url('{{{ settings.image.url }}}');"">
                <div class="image-content">
                <# if (settings.title) { #>
                    <div class="image_title image-transition">{{{ settings.title }}}</div>
                    <# } #>
                        <# if (settings.description) { #>
                            <div class="image_description image-transition">{{{ settings.description }}}</div>
                            <# } #>
            </div>
            </div>
            <# } #>
        <?php
    }
}
