<?php

/**
 * I Am class.
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
class IAm extends Widget_Base
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
        return 'i-am';
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
        return __('I am', 'elementor-armstrong');
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
        return 'eicon-button';
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
        $scripts = ['i-am-script'];

        return $scripts;
    }

    /**
     * Enqueue styles.
     */
    public function get_style_depends()
    {
        $styles = ['i-am-style'];

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
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        /* ---- Profil Repeater ---- */
        $profil_repeater = new \Elementor\Repeater();


        $profil_repeater->add_control(
            'profil_name',
            [
                'label' => __('Name', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Name', 'elementor-armstrong'),
                'default' => "Lorem Ipsum",
            ]
        );

        $profil_repeater->add_control(
            'profil_link',
            [
                'label' => __('Link', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'elementor-armstrong'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'profiles',
            [
                'label' => __('Profils', 'elementor-armstrong'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $profil_repeater->get_controls(),
                'default' => [
                    [
                        'profil_name' => "Lorem Ipsum",
                    ],
                    [
                        'profil_name' => "Dolor sit amet",
                    ],
                ],
                'title_field' => '{{{ profil_name }}}',
            ]
        );
        /* ---- END Profil repeater ---- */

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'elementor-armstrong'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Submit', 'elementor-armstrong'),
                'default' => "Submit",
            ]
        );

        $this->end_controls_section();
        /* --------- END CONTENT TAB --------- */



        /* --------- START I AM BLOC STYLE TAB --------- */
        $this->start_controls_section(
            'iam_style_section',
            [
                'label' => __('I am bloc', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'iam_bloc_typography',
                'selector' => '{{WRAPPER}} .iam_bloc',
            ]
        );

        $this->add_control(
            'iam_bloc_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iam_bloc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'iam_bloc_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iam_bloc' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
        /* --------- END I AM BLOC STYLE TAB --------- */

        /* --------- START SELECT STYLE TAB --------- */
        $this->start_controls_section(
            'select_style_section',
            [
                'label' => __('Select', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'select_typography',
                'selector' => '{{WRAPPER}} .iam_select',
            ]
        );

        $this->add_control(
            'select_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iam_select' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'select_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iam_select' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
        /* --------- END SELECT STYLE TAB --------- */

        /* --------- START BUTTON STYLE TAB --------- */
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __('Button', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .iam_button',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iam_button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iam_button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
        /* --------- END BUTTON STYLE TAB --------- */
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

        if ($settings['profiles']) {
?>
            <div class="iam_container">
                <h4 class="iam_bloc">JE SUIS</h4>
                <div class="select-wrapper">
                    <select id="i-am-select" class="iam_select">
                        <?php
                        foreach ($settings['profiles'] as $item) {
                        ?>
                            <option profil-url="<?= $item['profil_link']['url'] ?>" class="iam_select">
                                <?= $item['profil_name'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <a href="<?= $settings['profiles'][0]['profil_link']['url'] ?>" class="iam_button" id="i-am-button">
                        <?= $settings['button_text'] ?>
                    </a>
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
        <# if ( settings.profiles.length ) { #>
            <div class="iam_container">
                <h4 class="iam_bloc">JE SUIS</h4>
                <div class="select-wrapper">
                    <select id="i-am-select" class="iam_select">
                        <# _.each( settings.profiles, function( item ) { #>
                            <option profil-url="{{{ item.profil_link.url }}}" class="iam_select">
                                {{{ item.profil_name }}}
                            </option>
                            <# }); #>
                    </select>
                    <a href="{{{ settings.profiles[0].profil_link.url }}}" class="iam_button" id="i-am-button">
                        {{{ settings.button_text }}}
                    </a>
                </div>
            </div>
            <# } #>
        <?php
    }
}
