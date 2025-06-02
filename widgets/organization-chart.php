<?php

/**
 * Organization chart class.
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
 * OrganizationChart widget class.
 *
 * @since 1.0.0
 */
class OrganizationChart extends Widget_Base
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
        return 'organization-chart';
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
        return __('Organization Chart', 'elementor-armstrong');
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
        return 'eicon-person';
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
        return [];
    }

    /**
     * Enqueue styles.
     */
    public function get_style_depends()
    {
        $styles = ['organization-chart-style'];

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
            'member_photo',
            [
                'label' => __('Photo', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'member_title',
            [
                'label' => __('Heading', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'President',
            ]
        );

        $repeater->add_control(
            'member_name',
            [
                'label' => __('Firstname Name', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'John Doe',
                'default' => 'John Doe',
            ]
        );

        $repeater->add_control(
            'member_company',
            [
                'label' => __('Company', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'Company',
                'default' => 'Google',
            ]
        );

        $repeater->add_control(
            'member_phone',
            [
                'label' => __('Phone', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => '01 33 33 33 33',
            ]
        );

        $repeater->add_control(
            'member_mobile_phone',
            [
                'label' => __('Mobile Phone', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => '07 33 33 33 33',
            ]
        );

        $repeater->add_control(
            'member_mail',
            [
                'label' => __('Email', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'john.doe@example.com',
            ]
        );

        $repeater->add_control(
            'member_website',
            [
                'label' => __('Website', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'www.google.com',
            ]
        );

        $repeater->add_control(
            'member_website_link',
            [
                'label' => __('Website Link', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'https://www.google.com/',
            ]
        );

        $this->add_control(
            'members',
            [
                'label' => __('Members', 'elementor-armstrong'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'member_name' => 'John Doe',
                        'member_company' => 'Google',
                    ],
                ],
                'title_field' => '{{{ member_name }}}, {{{ member_company }}}',
            ]
        );
        /* ---- end repeater ---- */

        $this->add_control(
            'show_photo',
            [
                'label' => __('Show Members photos', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementor-armstrong'),
                'label_off' => __('Hide', 'elementor-armstrong'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
        /* --------- END CONTENT TAB --------- */


        /* --------- START BOX STYLE TAB --------- */
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => __('Box', 'elementor-armstrong'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'box_bg_background_color',
            [
                'label' => __('Color of the background', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'default' => '#E8E3D9',
                'selectors' => [
                    '{{WRAPPER}} .member .member_content::after' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        /* --------- START BOX COLOR TABS --------- */
        $this->start_controls_tabs(
            'box_color_tabs'
        );
        /* ---- normal tab ---- */
        $this->start_controls_tab(
            'box_color_normal_tab',
            [
                'label' => __('Normal', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'box_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .member .member_content' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .member .member_thumbnail::after' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- hover tab ---- */
        $this->start_controls_tab(
            'box_color_hover_tab',
            [
                'label' => __('Hover', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'box_hover_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .member:hover .member_content' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .member:hover .member_thumbnail::after' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END BOX COLOR TABS --------- */

        $this->end_controls_section();
        /* --------- END BOX STYLE TAB --------- */


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
                'label' => __('Heading', 'elementor-armstrong'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .member .member_title',
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
                    '{{WRAPPER}} .member .member_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- hover tab ---- */
        $this->start_controls_tab(
            'title_color_hover_tab',
            [
                'label' => __('Hover', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member:hover .member_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END TITLE COLOR TABS --------- */

        $this->add_control(
            'name_heading',
            [
                'label' => __('Name', 'elementor-armstrong'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .member .member_name',
            ]
        );

        /* --------- START NAME COLOR TABS --------- */
        $this->start_controls_tabs(
            'name_color_tabs'
        );
        /* ---- normal tab ---- */
        $this->start_controls_tab(
            'name_color_normal_tab',
            [
                'label' => __('Normal', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member .member_name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- hover tab ---- */
        $this->start_controls_tab(
            'name_color_hover_tab',
            [
                'label' => __('Hover', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'name_hover_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member:hover .member_name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END NAME COLOR TABS --------- */

        $this->add_control(
            'company_heading',
            [
                'label' => __('Company', 'elementor-armstrong'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'company_typography',
                'selector' => '{{WRAPPER}} .member .member_company',
            ]
        );

        /* --------- START COMPANY COLOR TABS --------- */
        $this->start_controls_tabs(
            'company_color_tabs'
        );
        /* ---- normal tab ---- */
        $this->start_controls_tab(
            'company_color_normal_tab',
            [
                'label' => __('Normal', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'company_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member .member_company' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- hover tab ---- */
        $this->start_controls_tab(
            'company_color_hover_tab',
            [
                'label' => __('Hover', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'company_hover_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member:hover .member_company' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END COMPANY COLOR TABS --------- */

        $this->add_control(
            'phone_heading',
            [
                'label' => __('Phone', 'elementor-armstrong'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'phone_typography',
                'selector' => '{{WRAPPER}} .member .member_phone',
            ]
        );

        /* --------- START PHONE COLOR TABS --------- */
        $this->start_controls_tabs(
            'phone_color_tabs'
        );
        /* ---- normal tab ---- */
        $this->start_controls_tab(
            'phone_color_normal_tab',
            [
                'label' => __('Normal', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'phone_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member .member_phone a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- hover tab ---- */
        $this->start_controls_tab(
            'phone_color_hover_tab',
            [
                'label' => __('Hover', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'phone_hover_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member:hover .member_phone a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END PHONE COLOR TABS --------- */

        $this->add_control(
            'mail_heading',
            [
                'label' => __('Email', 'elementor-armstrong'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mail_typography',
                'selector' => '{{WRAPPER}} .member .member_mail',
            ]
        );

        /* --------- START MAIL COLOR TABS --------- */
        $this->start_controls_tabs(
            'mail_color_tabs'
        );
        /* ---- normal tab ---- */
        $this->start_controls_tab(
            'mail_color_normal_tab',
            [
                'label' => __('Normal', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'mail_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member .member_mail a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- hover tab ---- */
        $this->start_controls_tab(
            'mail_color_hover_tab',
            [
                'label' => __('Hover', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'mail_hover_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member:hover .member_mail a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END MAIL COLOR TABS --------- */

        $this->add_control(
            'website_heading',
            [
                'label' => __('Website', 'elementor-armstrong'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'website_typography',
                'selector' => '{{WRAPPER}} .member .member_website',
            ]
        );

        /* --------- START WEBSITE COLOR TABS --------- */
        $this->start_controls_tabs(
            'website_color_tabs'
        );
        /* ---- normal tab ---- */
        $this->start_controls_tab(
            'website_color_normal_tab',
            [
                'label' => __('Normal', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'website_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member .member_website a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END normal tab ---- */
        /* ---- hover tab ---- */
        $this->start_controls_tab(
            'website_color_hover_tab',
            [
                'label' => __('Hover', 'elementor-armstrong'),
            ]
        );

        $this->add_control(
            'website_hover_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .member:hover .member_website a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        /* ---- END active tab ---- */
        $this->end_controls_tabs();
        /* --------- END WEBSITE COLOR TABS --------- */

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

        if ($settings['members'] && count($settings['members']) > 0) : ?>
            <div class="group_members">
                <?php foreach ($settings['members'] as $item) : ?>
                    <div class="member">
                        <?php if ('yes' === $settings['show_photo']) : ?>
                            <div class="member_thumbnail">
                                <?php if ($item['member_photo'] && $item['member_photo']['url']) : ?>
                                    <img src="<?= $item['member_photo']['url'] ?>" alt="Photo de <?= $item['member_name'] ?>" />
                                <?php else : ?>
                                    <div class="none"></div>
                                <?php endif ?>
                            </div>
                        <?php endif; ?>
                        <div class="member_content <?= 'yes' === $settings['show_photo'] ? "" : " no_photo"; ?>">
                            <div class="member_title">
                                <?= $item['member_title'] ?>
                            </div>
                            <div class="member_name">
                                <?= $item['member_name'] ?>
                            </div>
                            <div class="member_company">
                                <?= $item['member_company'] ?>
                            </div>
                            <div class="member_phone">
                                <a href="tel:<?= $item['member_phone'] ?>">
                                    <?= $item['member_phone'] ?>
                                </a>
                            </div>
                            <div class="member_phone">
                                <a href="tel:<?= $item['member_mobile_phone'] ?>">
                                    <?= $item['member_mobile_phone'] ?>
                                </a>
                            </div>
                            <div class="member_mail">
                                <a href="mailto:<?= $item['member_mail'] ?>">
                                    <?= $item['member_mail'] ?>
                                </a>
                            </div>
                            <div class="member_website">
                                <a href="<?= $item['member_website_link'] ?>" target="_blank">
                                    <?= $item['member_website'] ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif;
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
        <# if ( settings.members.length && settings.members.length> 0 ) { #>
            <div class="group_members">
                <# _.each( settings.members, function( item ) { var image={ id: item.member_photo.id, url: item.member_photo.url, size: settings.image_size, dimension: settings.image_custom_dimension, model: view.getEditModel() }; var image_url=elementor.imagesManager.getImageUrl( image ); #>
                    <div class="member">
                        <# if ( 'yes'===settings.show_photo ) { #>
                            <div class="member_thumbnail">
                                <# if ( image_url ) { #>
                                    <img src="{{{ image_url }}}" alt="Photo de {{{ item.member_name }}}" />
                                    <# } else { #>
                                        <div class="none"></div>
                                        <# } #>
                            </div>
                            <# } #>
                                <div class="member_content  {{{ 'yes'===settings.show_photo ? '' : 'no_photo' }}}">
                                    <div class="member_title">
                                        {{{ item.member_title }}}
                                    </div>
                                    <div class="member_name">
                                        {{{ item.member_name }}}
                                    </div>
                                    <div class="member_company">
                                        {{{ item.member_company }}}
                                    </div>
                                    <div class="member_phone">
                                        <a href="tel:{{{ item.member_phone }}}">
                                            {{{ item.member_phone }}}
                                        </a>
                                    </div>
                                    <div class="member_phone">
                                        <a href="tel:{{{ item.member_mobile_phone }}}">
                                            {{{ item.member_mobile_phone }}}
                                        </a>
                                    </div>
                                    <div class="member_mail">
                                        <a href="mailto:{{{ item.member_mail_link }}}">
                                            {{{ item.member_mail }}}
                                        </a>
                                    </div>
                                    <div class="member_website">
                                        <a href="{{{ item.member_website }}}" target="_blank">
                                            {{{ item.member_website }}}
                                        </a>
                                    </div>
                                </div>
                    </div>
                    <# }); #>
            </div>
            <# } #>
        <?php
    }
}
