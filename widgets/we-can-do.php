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
class WeCanDo extends Widget_Base
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
        return 'we-can-do';
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
        return __('We can do for you', 'elementor-armstrong');
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
        $scripts = ['we-can-do-script'];

        return $scripts;
    }

    /**
     * Enqueue styles.
     */
    public function get_style_depends()
    {
        $styles = ['we-can-do-style'];

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
            'profils_section',
            [
                'label' => __('Profils', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        /* ---- Profil Repeater ---- */
        $profil_repeater = new \Elementor\Repeater();

        $profil_repeater->add_control(
            'profil_name',
            [
                'label' => __('Name', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Name', 'elementor-armstrong'),
                'default' => "Lorem Ipsum",
            ]
        );

        $profil_repeater->add_control(
            'profil_slug',
            [
                'label' => __('Slug', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('name', 'elementor-armstrong'),
                'default' => "lorem_ipsum",
            ]
        );

        $this->add_control(
            'profiles',
            [
                'label' => __('Profils', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::REPEATER,
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
        $this->end_controls_section();
        /* ---- END Profil repeater ---- */

        /* ---- Argument Repeater ---- */
        $this->start_controls_section(
            'arguments_section',
            [
                'label' => __('Arguments', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $argument_repeater = new \Elementor\Repeater();

        $argument_repeater->add_control(
            'profil_slug',
            [
                'label' => __('Profil Slug', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('name', 'elementor-armstrong'),
                'default' => "lorem_ipsum",
            ]
        );

        $argument_repeater->add_control(
            'argument_title',
            [
                'label' => __('Title', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Title', 'elementor-armstrong'),
                'default' => "Lorem Ipsum",
            ]
        );

        $argument_repeater->add_control(
            'argument_icon',
            [
                'label' => __('Icon', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'diamond',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'diamond',
                        'square-full',
                    ],
                ],
            ]
        );

        $argument_repeater->add_control(
            'argument_description',
            [
                'label' => __('Description', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Fringilla a id id ut vel accumsan arcu ut. Vestibulum nunc scelerisque ac eget sit ac.', 'elementor-armstrong'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'arguments',
            [
                'label' => __('Arguments', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $argument_repeater->get_controls(),
                'default' => [
                    [
                        'argument_title' => "Praesent sapien",
                    ],
                    [
                        'argument_title' => "Massa convallis",
                    ],
                ],
                'title_field' => '{{{ profil_slug }}} - {{{ argument_title }}}',
            ]
        );
        /* ---- END Argument repeater ---- */

        $this->end_controls_section();
        /* --------- END CONTENT TAB --------- */

        /* --------- START PROFILE STYLE TAB --------- */
        $this->start_controls_section(
            'profile_style_section',
            [
                'label' => __('Profile', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'profile_title_typography',
                'selector' => '{{WRAPPER}} .profile_title',
            ]
        );

        $this->add_control(
            'profile_title_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .profile_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'profile_title_bakground_color',
            [
                'label' => __('Background Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .profile_title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
        /* --------- END PROFILE STYLE TAB --------- */

        /* --------- START ARGUMENT STYLE TAB --------- */
        $this->start_controls_section(
            'argument_style_section',
            [
                'label' => __('Argument', 'elementor-armstrong'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /* -- Argument Icon -- */
        $this->add_control(
            'argument_icon_heading',
            [
                'label' => __('Icon', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'argument_icon_size',
            [
                'label' => __('Icon Size', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 75,
                ],
                'selectors' => [
                    '{{WRAPPER}} .argument_icon' => 'width: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        /* -- Argument Title -- */
        $this->add_control(
            'argument_title_heading',
            [
                'label' => __('Title', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'argument_title_typography',
                'selector' => '{{WRAPPER}} .argument_title',
            ]
        );


        $this->add_control(
            'argument_title_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .argument_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        /* -- Argument Separator -- */
        $this->add_control(
            'argument_separator_heading',
            [
                'label' => __('Separator', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'argument_separator_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .argument_separator' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        /* -- Argument Description -- */
        $this->add_control(
            'argument_description_heading',
            [
                'label' => __('Description', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'argument_description_typography',
                'selector' => '{{WRAPPER}} .argument_description',
            ]
        );

        $this->add_control(
            'argument_description_color',
            [
                'label' => __('Color', 'elementor-armstrong'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .argument_description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
        /* --------- END ARGUMENT STYLE TAB --------- */
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
            <div class="we-can-do">
                <div class="select-wrapper">
                    <select id="we-can-do-select" class="profile_title">
                        <?php
                        foreach ($settings['profiles'] as $item) {
                        ?>
                            <option show-profil="profil-<?= $item['profil_slug'] ?>" class="profile_title">
                                <?= $item['profil_name'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <?php
                $first_element = true;
                foreach ($settings['profiles'] as $profil) {
                    if ($settings['arguments']) {
                ?>
                        <div class="arguments-wrapper<?= $first_element ? ' active' : '' ?>" id="profil-<?= $profil['profil_slug'] ?>">
                            <?php
                            foreach ($settings['arguments'] as $argument) {
                                if ($profil['profil_slug'] === $argument['profil_slug']) {
                            ?>
                                    <div class="argument">
                                        <img class="argument_icon" src="<?= $argument["argument_icon"]["value"]["url"] ?>" />
                                        <h4 class="argument_title">
                                            <?= $argument["argument_title"] ?>
                                        </h4>
                                        <div class="argument_separator"></div>
                                        <div class="argument_description">
                                            <?= $argument["argument_description"] ?>
                                        </div>
                                    </div>
                            <?php
                                    $first_element = false;
                                }
                            }
                            ?>
                        </div>
                <?php
                    }
                }
                ?>
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
            <div class="we-can-do">
                <div class="select-wrapper">
                    <select id="we-can-do-select" class="profile_title">
                        <# _.each( settings.profiles, function( item ) { #>
                            <option show-profil="profil-{{{ item.profil_slug }}}" class="profile_title">
                                {{{ item.profil_name }}}
                            </option>
                            <# }); #>
                    </select>
                </div>
                <# let first_element=true; #>
                    <# _.each( settings.profiles, function( profil ) { #>
                        <# if ( settings.arguments.length ) { #>
                            <div class="arguments-wrapper{{{ first_element ? ' active' : '' }}}" id="profil-{{{ profil.profil_slug }}}">
                                <# _.each( settings.arguments, function( argument ) { #>
                                    <# if ( profil.profil_slug==argument.profil_slug ) { #>
                                        <div class="argument">
                                            <img class="argument_icon" src="{{{ argument.argument_icon.value.url }}}" />
                                            <h4 class="argument_title">
                                                {{{ argument.argument_title }}}
                                            </h4>
                                            <div class="argument_separator"></div>
                                            <div class="argument_description">
                                                {{{ argument.argument_description }}}
                                            </div>
                                        </div>
                                        <# } #>
                                            <# }); #>
                            </div>
                            <# first_element=false; #>
                                <# } #>
                                    <# }); #>
            </div>
            <# } #>
        <?php
    }
}
