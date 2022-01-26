<?php

/**
 * VerticalCarousel class.
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
 * VerticalCarousel widget class.
 *
 * @since 1.0.0
 */
class VerticalCarousel extends Widget_Base
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
        return 'vertical_carousel';
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
        return __('Vertical Carousel', 'elementor-armstrong');
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
        return 'eicon-slider-vertical';
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
        $scripts = ['vertical_carousel-script'];

        return $scripts;
    }

    /**
     * Enqueue styles.
     */
    public function get_style_depends()
    {
        $styles = ['vertical_carousel-style'];

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
            'slide_title',
            [
                'label' => __('Title', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Lorem Ipsum',
            ]
        );

        $repeater->add_control(
            'slide_content',
            [
                'label' => __('Content', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => __('Default description', 'elementor-armstrong'),
                'placeholder' => __('Type your description here', 'elementor-armstrong'),
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

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'slide_image_dimension', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'medium-large',
            ]
        );

        $repeater->add_control(
            'slide_image_position',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => __('Image Position', 'elementor-armstrong'),
                'options' => [
                    'image_top' => __('Top', 'elementor-armstrong'),
                    'image_left' => __('Left', 'elementor-armstrong'),
                    'image_bottom' => __('Bottom', 'elementor-armstrong'),
                    'image_right' => __('Right', 'elementor-armstrong'),
                ],
                'default' => 'image_top',
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
                        'slide_title' => 'Lorem Ipsum',
                    ],
                    [
                        'slide_title' => 'Dolor sit amet',
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );
        /* ---- end repeater ---- */

        $this->end_controls_section();
        /* --------- END CONTENT TAB --------- */

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


        /* --------- START TITLE COLOR TABS --------- */
        $this->start_controls_tabs(
            'title_color_tabs'
        );
        /* ---- normal tab ---- */
        $this->start_controls_tab(
            'title_color_normal_tab',
            [
                'label' => __('Normal', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'slide_title_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#687A82',
                'selectors' => [
                    '{{WRAPPER}} .slidetitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'slide_title_icon_color',
            [
                'label' => __('Icon Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#687A82',
                'selectors' => [
                    '{{WRAPPER}} .slidetitle_icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_title_icon_size',
            [
                'label' => __('Icon Size', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label_block' => true,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slidetitle_icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- active tab ---- */
        $this->start_controls_tab(
            'title_color_active_tab',
            [
                'label' => __('Active', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'slide_title_active_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .slidetitle-active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'slide_title_icon_active_color',
            [
                'label' => __('Icon Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .slidetitle_icon-active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_title_icon_active_size',
            [
                'label' => __('Icon Size', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label_block' => true,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slidetitle_icon-min_size' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END TITLE COLOR TABS --------- */

        $this->add_responsive_control(
            'slide_title_icon_spacing',
            [
                'label' => __('Icon Spacing', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label_block' => true,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slidetitle_container' => 'column-gap: {{SIZE}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .slide_content',
            ]
        );

        $this->add_control(
            'slide_description_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide_content' => 'color: {{VALUE}}',
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
            <div class="vertical-carousel-container">
                <div class="vertical-carousel-navigation">
                    <?php
                    $id = 0;
                    foreach ($settings['slides'] as $item) {
                    ?>
                        <div class="slidetitle_container" slide-to="slide-<?= $id ?>">
                            <div class="slidetitle_icon-container slidetitle_icon-min_size">
                                <div class="slidetitle_icon <?= $id == 0 ? 'slidetitle_icon-min_size slidetitle_icon-active' : '' ?>"></div>
                            </div>
                            <div class="slidetitle <?= $id == 0 ? 'slidetitle-active' : '' ?>"><?= $item['slide_title'] ?></div>
                        </div>
                    <?php
                        $id++;
                    }
                    ?>
                </div>
                <div class="slides">
                    <?php
                    $id = 0;
                    foreach ($settings['slides'] as $item) {
                    ?>
                        <div class="slide slide-<?= $id ?> <?= $item['slide_image_position'] ?> <?= $id == 0 ? 'slide-active' : '' ?>">
                            <div class="slide_image">
                                <?= \Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'slide_image_dimension', 'slide_image'); ?>
                            </div>
                            <div class="slide_content">
                                <?= $item['slide_content'] ?>
                            </div>
                        </div>
                    <?php
                        $id++;
                    }
                    ?>
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
        <# if ( settings.slides.length ) { #>
            <div class="vertical-carousel-container">
                <div class="vertical-carousel-navigation">
                    <# let id=0; #>
                        <# _.each( settings.slides, function( item ) { #>
                            <div class="slidetitle_container" slide-to="slide-{{{ id }}}">
                                <div class="slidetitle_icon-container slidetitle_icon-min_size">
                                    <div class="slidetitle_icon {{{ id == 0 ? 'slidetitle_icon-min_size slidetitle_icon-active' : '' }}}"></div>
                                </div>
                                <div class="slidetitle {{{ id == 0 ? 'slidetitle-active' : '' }}}"> {{{ item.slide_title }}}</div>
                            </div>
                            <# id++; #>
                                <# }); #>
                </div>
                <div class="slides">
                    <# id=0; #>
                        <# _.each( settings.slides, function( item ) { #>
                            <# let image={ id: item.slide_image.id, url: item.slide_image.url, size: item.slide_image_dimension_size, dimension: item.slide_image_dimension_custom_dimension, model: view.getEditModel() }; let image_url=elementor.imagesManager.getImageUrl( image ); #>
                                <div class="slide slide-{{{ id }}} {{{ item.slide_image_position }}} {{{ id == 0 ? 'slide-active' : '' }}}">
                                    <div class="slide_image">
                                        <img src="{{{ image_url }}}" />
                                    </div>
                                    <div class="slide_content">
                                        {{{ item.slide_content }}}
                                    </div>
                                </div>
                                <# id++; #>
                                    <# }); #>
                </div>
            </div>
            <# } #>
        <?php
    }
}
