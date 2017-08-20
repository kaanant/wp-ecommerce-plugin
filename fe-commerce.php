<?php

    defined( 'ABSPATH' ) OR exit;
    /*
    Plugin Name: FE-Commerce Plugin
    Plugin URI:  https://github.com/kaanant/wp-ecommerce-plugin.git
    Description: Basic WordPress E-Commerce Plugin Which contains simple e commerce sites functions
    Version:     1.1.1
    Author:      Kaan ANT
    Author URI:  https://github.com/kaanant/
    */

    /*
        comment
    */

    define( 'FE-COMMERCE_VERSION', '1.1.1' );
    define( 'FE-COMMERCE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );



    require_once( dirname(__FILE__) . '/product.php' );
    require_once( dirname(__FILE__) . '/product-fields.php' );
    require_once( dirname(__FILE__) . '/product-render-admin.php' );
    require_once( dirname(__FILE__) . '/fecom-global-variables.php');
    require_once( dirname(__FILE__) . '/menu-options.php');
    require_once( dirname(__FILE__) . '/database/fecom-create-database-tables.php');

    function fecom_plugin_activation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';

        check_admin_referer( "activate-plugin_{$plugin}" );

        # Uncomment the following line to see the function in action
        # exit( var_dump( $_GET ) );
    }

    function fecom_plugin_deactivation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "deactivate-plugin_{$plugin}" );

        # Uncomment the following line to see the function in action
        # exit( var_dump( $_GET ) );
    }


    /* adding custom js and css to post page*/
    function fecom_admin_enqueue_scripts()
    {
        global $pagenow, $typenow;

        if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && ($typenow == 'product')){
            wp_enqueue_style( 'fecom-admin-css', plugins_url( '/templates/css/bootstrap.min.css', __FILE__ ) );
            wp_enqueue_style( 'fecom-admin-boostrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/templates/css/bootstrap.min.css ');
            wp_enqueue_script( 'fecom-admin-js',   plugins_url( '/templates/js/bootstrap.min.js', __FILE__ ), array( 'jquery', 'jquery-ui-datepicker'), 20170815, true ); ## dependencies, version, add_footer
        }

        if ( ($pagenow == 'edit.php') && ($typenow == 'product')){
            wp_enqueue_style( 'fecom-admin-css', plugins_url( '/templates/css/bootstrap.min.css', __FILE__ ) );
            wp_enqueue_style( 'fecom-admin-boostrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css ');
            wp_enqueue_script( 'fecom-admin-js',   plugins_url( '/templates/js/bootstrap.min.js', __FILE__ ), array( 'jquery', 'jquery-ui-datepicker'), 20170815, true ); ## dependencies, version, add_footer
            wp_enqueue_script( 'fecom-product-render-js',   plugins_url( '/templates/js/product-render-admin.min.js', __FILE__ ), $in_footer=true); ## dependencies, version, add_footer

        }

        if ( ($pagenow == 'admin.php') ){
            wp_enqueue_style( 'fecom-admin-css', plugins_url( '/templates/css/bootstrap.min.css', __FILE__ ) );
            wp_enqueue_style( 'fecom-admin-boostrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css ');
            wp_enqueue_script( 'fecom-admin-js',   plugins_url( '/templates/js/bootstrap.min.js', __FILE__ ), $add_footer = true ); ## dependencies, version, add_footer
            #wp_enqueue_script( 'fecom-product-render-js',   plugins_url( 'admin/js/product-render-admin.min.js', __FILE__ ), $in_footer=true); ## dependencies, version, add_footer

        }

    }
    add_action('admin_enqueue_scripts', 'fecom_admin_enqueue_scripts');

    function fecom_add_submenu_page(){
            add_submenu_page( 'edit.php?post_type=product', 'Product List', 'Product List', 'manage_options', 'product_list', 'fecom_add_submenu_page_callback' );
    }

    add_action('admin_menu', 'fecom_add_submenu_page');

    function get_custom_post_type_template( $archive_template ) {
         global $post;

         if ( is_post_type_archive ( 'product' ) ) {
              $archive_template = dirname( __FILE__ ) . '/templates/fecom-archive.php';
         }
         return $archive_template;
    }

    add_filter( 'archive_template', 'get_custom_post_type_template' ) ;

    register_activation_hook( __FILE__, 'jal_install' );

    register_activation_hook(   __FILE__, 'fecom_plugin_activation' );
    register_deactivation_hook( __FILE__, 'fecom_plugin_deactivation' );




?>
