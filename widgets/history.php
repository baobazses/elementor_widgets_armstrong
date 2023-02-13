<?php

/**
 * History class.
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
 * History widget class.
 *
 * @since 1.0.0
 */
class History extends Widget_Base
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
        return 'history';
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
        return __('History', 'elementor-armstrong');
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
        return 'eicon-calendar';
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
        $scripts = ['history-script'];

        return $scripts;
    }

    /**
     * Enqueue styles.
     */
    public function get_style_depends()
    {
        $styles = ['history-style'];

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
    protected function register_controls()
    {
        /* --------- START CONTENT TAB --------- */
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-armstrong'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        /* ---- Repeater ---- */
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'event_date',
            [
                'label' => __('Date', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => date('Y'),
                'default' => date('Y'),
            ]
        );

        $repeater->add_control(
            'event_description',
            [
                'label' => __('Description', 'elementor-armstrong'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-armstrong'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'events',
            [
                'label' => __('Events', 'elementor-armstrong'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'event_date' => date('Y'),
                    ],
                    [
                        'event_date' => date('Y'),
                    ],
                ],
                'title_field' => '{{{ event_date }}}',
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
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'title_heading',
            [
                'label' => __('Title', 'elementor-armstrong'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
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
            'title_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'background-color: {{VALUE}}',
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
            'title_active_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .title-active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_active_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FF70E6',
                'selectors' => [
                    '{{WRAPPER}} .title-active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END TITLE COLOR TABS --------- */

        $this->add_control(
            'separator_heading',
            [
                'label' => __('Separator', 'elementor-armstrong'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        /* --------- START SEPARATOR COLOR TABS --------- */
        $this->start_controls_tabs(
            'separator_color_tabs'
        );
        /* ---- normal tab ---- */
        $this->start_controls_tab(
            'separator_color_normal_tab',
            [
                'label' => __('Normal', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .separator' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- active tab ---- */
        $this->start_controls_tab(
            'separator_color_active_tab',
            [
                'label' => __('Active', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'separator_active_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF2ED',
                'selectors' => [
                    '{{WRAPPER}} .separator-active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END DESCRIPTION COLOR TABS --------- */

        $this->add_control(
            'description_heading',
            [
                'label' => __('Description', 'elementor-armstrong'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        /* --------- START DESCRIPTION COLOR TABS --------- */
        $this->start_controls_tabs(
            'description_color_tabs'
        );
        /* ---- normal tab ---- */
        $this->start_controls_tab(
            'description_color_normal_tab',
            [
                'label' => __('Normal', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- active tab ---- */
        $this->start_controls_tab(
            'description_color_active_tab',
            [
                'label' => __('Active', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'description_active_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .description-active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END DESCRIPTION COLOR TABS --------- */

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

        if ($settings['events']) {
            echo '<div class="history-events-container">';
            if (count($settings['events']) > 1) {
?>
                <div class="history-navigation">
                    <div class="history-arrow prev-arrow" role="button" aria-label="Previous slide">
                        <div class="pagination-prev"></div>
                        <span class="elementor-screen-only">Précédent</span>
                    </div>
                    <div class="history-arrow next-arrow" role="button" aria-label="Next slide">
                        <div class="pagination-next"></div>
                        <span class="elementor-screen-only">Suivant</span>
                    </div>
                </div>
            <?php
            }
            echo '<div class="history-events-wrapper">';
            echo '<div class="history-events">';
            $id = 0;
            foreach ($settings['events'] as $item) {
            ?>
                <div class="history-event history-event-<?= $id ?>">
                    <div class="title <?= $id == 0 ? 'title-active' : '' ?>">
                        <?= $item['event_date'] ?>
                    </div>
                    <div class="separator <?= $id == 0 ? 'separator-active' : '' ?>"></div>
                    <div class="description <?= $id == 0 ? 'description-active' : '' ?>">
                        <?= $item['event_description'] ?>
                    </div>
                </div>
        <?php
                $id++;
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
        <# if ( settings.events.length ) { #>
            <div class="history-events-container">
                <# if ( settings.events.length> 1 ) { #>
                    <div class="history-navigation">
                        <div class="history-arrow prev-arrow" role="button" aria-label="Previous slide">
                            <i aria-hidden="true" class="eicon-chevron-left"></i>
                            <span class="elementor-screen-only">Précédent</span>
                        </div>
                        <div class="history-arrow next-arrow" role="button" aria-label="Next slide">
                            <i aria-hidden="true" class="eicon-chevron-right"></i>
                            <span class="elementor-screen-only">Suivant</span>
                        </div>
                    </div>
                    <# } #>
                        <# let id=0; #>
                            <div class="history-events-wrapper">
                                <div class="history-events">
                                    <# _.each( settings.events, function( item ) { #>
                                        <div class="history-event history-event-{{{ id }}}">
                                            <div class="title {{{ id == 0 ? 'title-active' : '' }}}">
                                                {{{ item.event_date }}}
                                            </div>
                                            <div class="separator {{{ id == 0 ? 'separator-active' : '' }}}"></div>
                                            <div class="description {{{ id == 0 ? 'description-active' : '' }}}">
                                                {{{ item.event_description }}}
                                            </div>
                                        </div>
                                        <# id++ #>
                                            <# }); #>
                                </div>
                            </div>
            </div>
            <# } #>
        <?php
    }
}
