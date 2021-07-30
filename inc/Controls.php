<?php

namespace BeaverOverrides;

class Controls {


    private static $config_id;

    public static $default = [
        'beaver_colors' => [
            'global'    => '#ffffff',
            'primary'   => '#1e87f0',
            'secondary' => '#222222',
            'muted'     => '#f8f8f8',
        ],
        'beaver_padding' => [
            'top'   => '10px',
            'right'   => '10px',
            'bottom'   => '10px',
            'left'   => '10px',
        ]

        

    ];

    public function __construct( $config_id = null ) {

        self::$config_id = $config_id !== null ? $config_id : 'beaver-overrides';

        // convert the defaults to object based because they are easier to request
        // \DemoStyles\Controls::$defaults['breakpoint']['small'] vs \DemoStyles\Controls::$defaults->breakpoint->small
        self::$default = json_decode(json_encode(self::$default, JSON_FORCE_OBJECT));        

        add_action( 'init' , __CLASS__ . '::load_controls' );


    }


    public static function load_controls() {

        if ( !\function_exists( '\Kirki' ) ) return;
    
        self::add_config();
        self::add_panels();
        self::add_sections();
        self::add_controls();
    
    }


    private static function add_config() {

        \Kirki::add_config( self::$config_id, array(
            'capability'    => 'edit_theme_options',
            'option_type'   => 'theme_mod',
            'disable_output' => false,
        ) );

    }

    private static function add_panels() {

        \Kirki::add_panel( 'beaver-override-settings', array(
            'priority'    => 10,
            'title'       => esc_html__( 'Beaver Overrides', 'kirki' ),
            'description' => esc_html__( 'Override Beaver Builder Colors', 'kirki' ),
        ) ); 


    }

    private static function add_sections() {

        \Kirki::add_section( 'beaver-colors', array(
            'title'          => esc_html__( 'Colors', 'kirki' ),
            'description'    => esc_html__( 'Beaver Builder Colors', 'kirki' ),
            'panel'          => 'beaver-override-settings',
            'priority'       => 50,
        ) );  

        \Kirki::add_section( 'beaver-padding', array(
            'title'          => esc_html__( 'Padding', 'kirki' ),
            'description'    => esc_html__( 'Beaver Builder Paddings', 'kirki' ),
            'panel'          => 'beaver-override-settings',
            'priority'       => 50,
        ) );  


    }

    private static function add_controls() {


        /**
         * Section Colors
         */

  
        \Kirki::add_field( self::$config_id, [
            'type'        => 'multicolor',
            'settings'    => 'beaver_colors',
            'label'       => esc_html__( 'Background Colors', 'kirki' ),
            'section'     => 'beaver-colors',
            'priority'    => 10,
            'choices'     => [
                'global'    => esc_html__( 'Global', 'kirki' ),
                'primary'   => esc_html__( 'Primary', 'kirki' ),
                'secondary'  => esc_html__( 'Secondary', 'kirki' ),
                'muted'  => esc_html__( 'Muted', 'kirki' ),
            ],
            'default'     => [
                'global'    => self::$default->beaver_colors->global,
                'primary'    => self::$default->beaver_colors->primary,
                'secondary'    => self::$default->beaver_colors->secondary,
                'muted'    => self::$default->beaver_colors->muted,
            ],
        ] );

        \Kirki::add_field( self::$config_id, [
         'type'        => 'dimensions',
         'settings'    => 'beaver_padding',
         'label'       => esc_html__( 'General Padding', 'kirki' ),
         'description' => esc_html__( 'General inner Padding for Modules.', 'kirki' ),
         'section'     => 'beaver-padding',
         'default'     => [
             'top'  => self::$default->beaver_padding->top,
             'right'  => self::$default->beaver_padding->right,
             'bottom' => self::$default->beaver_padding->bottom,
             'left'    => self::$default->beaver_padding->left,
         ],
         'choices'     => [
             'labels' => [
                 'top'  => esc_html__( 'Top', 'kirki' ),
                 'right'  => esc_html__( 'Right', 'kirki' ),
                 'bottom'  => esc_html__( 'Bottom', 'kirki' ),
                 'left'  => esc_html__( 'Left', 'kirki' ),
             ],
         ],
        ] );


    }
    
    
}

