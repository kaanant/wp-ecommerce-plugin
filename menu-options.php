<?php

    #require_once(FECOMMERCE_PLUGIN_DIR . '/database/fecom-database-queries.php');


    function fecom_admin_menu_pages(){

        $page_title = 'Fe-Commerce';
        $menu_title = 'Fe-Commerce';
        $capability = 'manage_options';
        $menu_slug = FECOMMERCE_PLUGIN_DIR . '';
        $function = 'fecommerce_homepage_callback';

        add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);


        $submenu_product_page_title = 'Product List';
        $submenu_product_title = 'Product List';
        $capability = 'manage_options';
        $submenu_product_menu_slug = '/fe-commerce/product-list.php';
        $submenu_product_function = 'fecommerce_product_list_callback';
        $submenu_product_link = 'fe-commerce/views/product-list.php';
        add_submenu_page($menu_slug, $submenu_product_page_title, $submenu_product_title, $capability, $submenu_product_menu_slug, $submenu_product_function);

        $submenu_product_page_title = 'Add Product';
        $submenu_product_title = 'Add Product';
        $capability = 'manage_options';
        $submenu_product_menu_slug = '/fe-commerce/product-add.php';
        $submenu_product_function = 'fecommerce_product_add_callback';
        $submenu_product_link = 'fe-commerce/views/product-add.php';
        add_submenu_page($menu_slug, $submenu_product_page_title, $submenu_product_title, $capability, $submenu_product_menu_slug, $submenu_product_function);

        $submenu_order_page_title = 'Order List';
        $submenu_order_title = 'Order List';
        $capability = 'manage_options';
        $submenu_order_menu_slug = '/fecommerce/order-list.php';
        $submenu_order_function = 'fecommerce_order_list_callback';

        add_submenu_page($menu_slug, $submenu_order_page_title, $submenu_order_title, $capability, $submenu_order_menu_slug, $submenu_order_function);
    }

    add_action('admin_menu', 'fecom_admin_menu_pages');

    function fecommerce_homepage_callback(){
        /*
        *
        *
        *   TRY TO INCLUDE HTML FROM ANOTHER FILE
        *
        *
        */
        include(FECOMMERCE_PLUGIN_DIR.'welcome.php');

    }

    function fecommerce_product_list_callback(){

        /*
        *
        *
        *   TRY TO INCLUDE HTML FROM ANOTHER FILE
        *
        *
        */
        include(FECOMMERCE_PLUGIN_DIR.'/product-list.php');

    }

    function fecommerce_order_list_callback(){

        /*
        *
        *
        *   TRY TO INCLUDE HTML FROM ANOTHER FILE
        *
        *
        */

        #require_once(FECOMMERCE_PLUGIN_URL . 'product-list.php');

        include(FECOMMERCE_PLUGIN_DIR.'/order-list.php');

    }

    function fecommerce_product_add_callback(){

        include(FECOMMERCE_PLUGIN_DIR.'/product-add.php');
    }




?>
