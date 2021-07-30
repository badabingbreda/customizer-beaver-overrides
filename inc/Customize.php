<?php

namespace BeaverOverrides;
use BeaverOverrides\Controls;
use \ToolboxCustomizer\CustomizerCss as TBC;


class Customize {

    public function __construct() {

        /**
         * Initialize the styles and creation of the css file(s) when needed
         */
        add_action( 'init' , __CLASS__ . '::myplugin_add_styles' );

    }


    public static function myplugin_add_styles() {

        // return early if toolbox_customizer_css doesn't exist
        if( !class_exists( 'ToolboxCustomizer\CustomizerCss' ) ) return;

        

        // initialize the toolbox customizer css
        $theme_css = new \ToolboxCustomizer\CustomizerCss(
            array(
        
                'use_compiler'          => 'scss',
        
                'file_prefix'           => 'beaver-overrides' ,                        // used for filenames and style-enqueue handler
                                                                                // {file_prefix}.css and {file_prefix}_temp.css
        
                'directory'             => 'css-beaver-overrides' ,                    // directory that is used to store the compiled css files in
                                                                                // in /wp-content/uploads/{directory}
        
                'version'               => -1,             // version for the css, probably the version of the plugin, use -1 to always reload when   file gets updated
        
                'path_to_less_file'     => BEAVEROVERRIDES_DIR . 'scss/',     // probably good practice to set this one also.
                                                                                // local dir-path, NOT an url please
            )
        );

        //add_filter( 'toolbox_customizer_css_demo-styles' , 'myplugin_my_variables' );
        add_filter( 'toolbox_customizer_css_beaver-overrides' , __CLASS__ . '::myplugin_my_variables' );


    }
        

    public static function myplugin_my_variables( $variables ) {

        return array_merge( $variables ,
    
            array(
    
                // add a variable called @fm_button_color
                // for it's value use toolbox_customizer_css::gtm( $theme_mod_name , $settings , $unit )    (..get theme mod..)
                //
                // theme_mod_name:      name of the theme mod to fetch
                // settings:            the settings for the return value
                //                      'value'     if defined us this value as the return value if theme mod does not exist
                //                      'filter'    if defined use this filter to return a value when theme mos does not exist. If filter has no hooked callbacks false will be returned.
                //                      'tostring'  if defined it will return the theme mod value to a string, otherwise it will return a keyword
                //  unit                append this unit measure at the end of the value if not empty
                //
    
                    'bo-global-color' => get_theme_mod( 'beaver_colors' , false ) ? get_theme_mod( 'beaver_colors' , false )['global'] : \BeaverOverrides\Controls::$default->beaver_colors->global,
                    'bo-primary-color' => get_theme_mod( 'beaver_colors' , false ) ? get_theme_mod( 'beaver_colors' , false )['primary'] : \BeaverOverrides\Controls::$default->beaver_colors->primary,
                    'bo-secondary-color' => get_theme_mod( 'beaver_colors' , false ) ? get_theme_mod( 'beaver_colors' , false )['secondary'] : \BeaverOverrides\Controls::$default->beaver_colors->secondary,
                    'bo-muted-color' => get_theme_mod( 'beaver_colors' , false ) ? get_theme_mod( 'beaver_colors' , false )['muted'] : \BeaverOverrides\Controls::$default->beaver_colors->muted,

                    'bo-padding-top' => get_theme_mod( 'beaver_padding' , false ) ? get_theme_mod( 'beaver_padding' , false )['top'] : \BeaverOverrides\Controls::$default->beaver_padding->top,
                    'bo-padding-right' => get_theme_mod( 'beaver_padding' , false ) ? get_theme_mod( 'beaver_padding' , false )['right'] : \BeaverOverrides\Controls::$default->beaver_padding->right,
                    'bo-padding-bottom' => get_theme_mod( 'beaver_padding' , false ) ? get_theme_mod( 'beaver_padding' , false )['bottom'] : \BeaverOverrides\Controls::$default->beaver_padding->bottom,
                    'bo-padding-left' => get_theme_mod( 'beaver_padding' , false ) ? get_theme_mod( 'beaver_padding' , false )['left'] : \BeaverOverrides\Controls::$default->beaver_padding->left,

                )
    
            );
        }

}


   //var_dump( get_theme_mod( 'uikit-breakpoints' , false  ) );



