<?php

/**
 * CarouselProgressBar class.
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
 * CarouselProgressBar widget class.
 *
 * @since 1.0.0
 */
class CarouselProgressBar extends Widget_Base
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
        return 'carousel_progressbar';
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
        return __('Carousel with ProgressBar', 'elementor-armstrong');
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
        return 'eicon-carousel';
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
        $scripts = ['carousel_progressbar-script'];

        return $scripts;
    }

    /**
     * Enqueue styles.
     */
    public function get_style_depends()
    {
        $styles = ['carousel_progressbar-style'];

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

        /* ---- Repeater ---- */
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slide_first_line',
            [
                'label' => __('Title first line', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Lorem Ipsum',
            ]
        );

        $repeater->add_control(
            'slide_second_line',
            [
                'label' => __('Title second line', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'slide_description',
            [
                'label' => __('Description', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'slide_image',
            [
                'label' => __('Image', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Slides', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_first_line' => 'Lorem Ipsum',
                    ],
                    [
                        'slide_first_line' => 'Lorem',
                        'slide_second_line' => 'Ipsum',
                    ],
                ],
                'title_field' => '{{{ slide_first_line }}} {{{ slide_second_line }}}',
            ]
        );
        /* ---- end repeater ---- */

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
                'min' => 0,
                'max' => 60000,
                'step' => 1,
                'default' => 300,
                'selectors' => [
                    '{{WRAPPER}} .slide-transition' => 'transition-duration : {{VALUE}}ms;',
                ],
            ]
        );

        $this->add_control(
            'image_autoplay',
            [
                'label' => __('Auto Play speed', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 60000,
                'step' => 1,
                'default' => 5000,
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
            'slide_width',
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
                    'size' => 339,
                ],
                'selectors' => [
                    '{{WRAPPER}} .image_size' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_height',
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
                    'size' => 495,
                ],
                'selectors' => [
                    '{{WRAPPER}} .image_size' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_transition_type',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => __('Animation on hover', 'elementor-armstrong'),
                'label_block' => true,
                'options' => [
                    'none' => __('None', 'elementor-armstrong'),
                    'zoom' => __('Zoom', 'elementor-armstrong'),
                    'rotate' => __('Rotate', 'elementor-armstrong'),
                ],
                'default' => 'none',
            ]
        );

        $this->end_controls_section();
        /* --------- END IMAGE STYLE TAB --------- */

        /* --------- START NAVIGATION STYLE TAB --------- */
        $this->start_controls_section(
            'navigation_style_section',
            [
                'label' => __('Navigation', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'progress_bar_heading',
            [
                'label' => __('Progress Bar', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'progress_bar_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .progress-bar' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'progress_bar_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#687A82',
                'selectors' => [
                    '{{WRAPPER}} .progress-bar-wrapper' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
        /* --------- END NAVIGATION STYLE TAB --------- */

        /* --------- START CONTENT STYLE TAB --------- */
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => __('Content', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'slide_title_heading',
            [
                'label' => __('Title', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slide_title_typography',
                'selector' => '{{WRAPPER}} .slidetitle',
            ]
        );

        $this->add_control(
            'slide_title_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slidetitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'slide_title_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slidetitle' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_title_padding',
            [
                'label' => __('Padding', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slidetitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'slide_description_heading',
            [
                'label' => __('Description', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slide_description_typography',
                'selector' => '{{WRAPPER}} .slidedescription',
            ]
        );

        $this->add_control(
            'slide_description_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slidedescription' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'slide_description_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slidedescription' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_description_padding',
            [
                'label' => __('Padding', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slidedescription' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

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

        if ($settings['slides']) {
?>
            <div class="carousel-progressbar-container" autoplay="<?= $settings['image_autoplay'] ?>">
                <?php
                echo '<div class="carousel-progressbar-wrapper">';
                echo '<div class="slides">';
                foreach ($settings['slides'] as $item) {
                ?>
                    <div class="slide image_size">
                        <div class="slidetitle slidetitle-first slide-transition">
                            <?= $item['slide_first_line'] ?>
                        </div>
                        <?php
                        if ($item['slide_second_line']) {
                        ?>
                            <div class="slidetitle slidetitle-second slide-transition">
                                <?= $item['slide_second_line'] ?>
                            </div>
                        <?php } ?>
                        <?php
                        if ($item['slide_description']) {
                        ?>
                            <div class="slidedescription">
                                <?= $item['slide_description'] ?>
                            </div>
                        <?php } ?>
                        <div class="slide_image <?= $settings['image_transition_type'] ?> slide-transition" style="background-image : url('<?= $item['slide_image']['url'] ?>');"></div>
                    </div>
                <?php
                }
                echo '</div>';
                echo '</div>';
                if (count($settings['slides']) > 1) { ?>
                    <div class="carousel-progressbar-navigation-container">
                        <div class="progress-bar-wrapper">
                            <div class="progress-bar" style="width: <?= 100 / count($settings['slides']) ?>%;"></div>
                        </div>
                    </div>
            <?php
                }
                echo '</div>';
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
            <# if ( settings.slides.length ) { #>
                <div class="carousel-progressbar-container" autoplay="{{{ settings.image_autoplay }}}">
                    <div class="carousel-progressbar-wrapper">
                        <div class="slides">
                            <# _.each( settings.slides, function( item ) { #>
                                <div class="slide image_size">
                                    <div class="slidetitle slidetitle-first slide-transition">
                                        {{{ item['slide_first_line'] }}}
                                    </div>
                                    <# if (item.slide_second_line) { #>
                                        <div class="slidetitle slidetitle-second slide-transition">
                                            {{{ item['slide_second_line'] }}}
                                        </div>
                                        <# } #>
                                            <# if (item.slide_description) { #>
                                                <div class="slidedescription">
                                                    {{{ item['slide_description'] }}}
                                                </div>
                                                <# } #>
                                                    <div class="slide_image {{{ settings.image_transition_type }}} slide-transition" style="background-image : url('{{{ item.slide_image.url }}}');"></div>
                                </div>
                                <# }); #>
                        </div>
                    </div>
                    <# if (settings.slides.length> 1) {#>
                <div class="carousel-progressbar-navigation-container">
                            <div class="progress-bar-wrapper">
                                <div class="progress-bar" style="width: {{{ 100 / settings.slides.length }}}%;"></div>
                            </div>
                    </div>
                    <# } #>
            </div>
            <# } #>
        <?php
        }
    }
