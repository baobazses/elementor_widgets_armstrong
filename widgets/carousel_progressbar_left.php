<?php

/**
 * CarouselProgressBarLeft class.
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
 * CarouselProgressBarLeft widget class.
 *
 * @since 1.0.0
 */
class CarouselProgressBarLeft extends Widget_Base
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
        return 'carousel_progressbar_left';
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
        return __('Carousel with ProgressBar Left', 'elementor-armstrong');
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
        $scripts = ['carousel_progressbar_left-script'];

        return $scripts;
    }

    /**
     * Enqueue styles.
     */
    public function get_style_depends()
    {
        $styles = ['carousel_progressbar_left-style'];

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
                        'slide_first_line' => 'Lorem Ipsum',
                    ],
                ],
                'title_field' => '{{{ slide_first_line }}} {{{ slide_second_line }}}',
            ]
        );
        /* ---- end repeater ---- */

        $this->end_controls_section();
        /* --------- END CONTENT TAB --------- */

        /* --------- START NAVIGATION STYLE TAB --------- */
        $this->start_controls_section(
            'navigation_style_section',
            [
                'label' => __('Navigation', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'prev_arrow_heading',
            [
                'label' => __('Prev Arrow', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'prev_arrow_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .prev-arrow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'prev_arrow_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .prev-arrow' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'next_arrow_heading',
            [
                'label' => __('Next Arrow', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'next_arrow_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .next-arrow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'next_arrow_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .next-arrow' => 'background-color: {{VALUE}}',
                ],
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
            echo '<div class="carousel-progressbar-left-container">';
?>
            <div class="carousel-progressbar-left-navigation-container">
                <div class="navigation">
                    <?php if (count($settings['slides']) > 1) { ?>
                        <div class="navigation-arrows">
                            <div class="slide-arrow prev-arrow" role="button" aria-label="Previous slide">
                                <i aria-hidden="true" class="eicon-chevron-left"></i>
                                <span class="elementor-screen-only">Précédent</span>
                            </div>
                            <div class="slide-arrow next-arrow" role="button" aria-label="Next slide">
                                <i aria-hidden="true" class="eicon-chevron-right"></i>
                                <span class="elementor-screen-only">Suivant</span>
                            </div>
                        </div>
                        <div class="progress-bar-wrapper">
                            <div class="progress-bar" style="width: <?= 100 / count($settings['slides']) ?>%;"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            echo '<div class="carousel-progressbar-left-wrapper">';
            echo '<div class="slides">';
            foreach ($settings['slides'] as $item) {
            ?>
                <div class="slide">
                    <div class="slidetitle-container">
                        <div class="slidetitle slidetitle-first">
                            <?= $item['slide_first_line'] ?>
                        </div>
                        <?php
                        if ($item['slide_second_line']) {
                        ?>
                            <div class="slidetitle slidetitle-second">
                                <?= $item['slide_second_line'] ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="image" style="background-image : url('<?= $item['slide_image']['url'] ?>');">
                    </div>
                </div>
        <?php
            }
            echo '</div>';
            echo '</div>';
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
            <div class="carousel-progressbar-left-container">
                <div class="carousel-progressbar-left-navigation-container">
                    <div class="navigation">
                        <# if (settings.slides.length> 1) {#>
                            <div class="navigation-arrows">
                                <div class="slide-arrow prev-arrow" role="button" aria-label="Previous slide">
                                    <i aria-hidden="true" class="eicon-chevron-left"></i>
                                    <span class="elementor-screen-only">Précédent</span>
                                </div>
                                <div class="slide-arrow next-arrow" role="button" aria-label="Next slide">
                                    <i aria-hidden="true" class="eicon-chevron-right"></i>
                                    <span class="elementor-screen-only">Suivant</span>
                                </div>
                            </div>
                            <div class="progress-bar-wrapper">
                                <div class="progress-bar" style="width: {{{ 100 / settings.slides.length }}}%;"></div>
                            </div>
                    <# } #>
                        </div>
                    </div>
                            <div class="carousel-progressbar-left-wrapper">
                                <div class="slides">
                                    <# _.each( settings.slides, function( item ) { #>
                                        <div class="slide">
                                            <div class="slidetitle-container">
                                                <div class="slidetitle slidetitle-first">
                                                    {{{ item.slide_first_line }}}
                                                </div>
                                                <# if (item.slide_second_line) { #>
                                                    <div class="slidetitle slidetitle-second">
                                                        {{{ item.slide_second_line }}}
                                                    </div>
                                                    <# } #>
                                            </div>
                                            <div class="image" style="background-image : url('{{{ item.slide_image.url }}}');">
                                            </div>
                                        </div>
                                            <# }); #>
                                </div>
                            </div>
            </div>
            <# } #>
        <?php
    }
}
