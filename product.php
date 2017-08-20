<?php

    /*<-- PRODUCT POST TYPE ARGS-->*/
    function fecom_register_product_post_type(){

        $singular = 'Product';
        $plural = 'Products';

        $labels = array(
            'name'                   => $plural,
            'singular_name'          => $singular,
            'add_name'               => 'Add New '.$singular ,
            'add_new_item'           => 'Add New '.$singular,
            'edit'                   => 'Edit',
            'edit_item'              => 'Edit ' . $singular,
            'new_item'               => 'New ' . $singular,
            'view'                   => 'View ' . $singular,
            'view_item'              => 'View ' . $singular,
            'search_tearm'           => 'Search ' . $singular,
            'not_found'              => 'No ' . $plural . ' found',
            'not_found_in_trash'     => 'No ' . $plural . ' found in trash',
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_in_nav_menus'   => false,
            'show_ui'   => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => false,
            'menu_position'     => 10,
            'menu_icon'         => 'dashicons-products',
            'can_export'        => true,
            'delete_with_user'  => false,
            'hierarchical'      => false,
            'has_archive'       => true,
            'query_var'         => true,
            'capability_type'   => 'post',
            'rewrite'           => array(
                'slug' => 'products ',
                'with_front' => true,
                'pages' => true,
                'feeds' => true
            ),

            // custom parts->>
            'supports' => array(
                'title',
            ),
        );

        register_post_type('product',$args);
    }

    add_action('init', 'fecom_register_product_post_type');
    /*<!-- PRODUCT POST TYPE ARGS--!>*/


    /*<-- PRODUCT TAXONOMY ARGS-->*/

    function fecom_register_product_taxonomy() {


        $plural = 'Categories';
        $singular =  'Category';

        $labels = array(
            'name'                       => $plural,
            'singular_name'              => $singular,
            'search_items'               => 'Search ' . $plural,
            'popular_items'              => 'Popular ' . $plural,
            'all_items'                  => 'All ' . $plural,
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'Edit ' . $singular,
            'update_item'                => 'Update ' . $singular,
            'add_new_item'               => 'Add New ' . $singular,
            'new_item_name'              => 'New ' . $singular . ' Name',
            'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
            'add_or_remove_items'        => 'Add or remove ' . $plural,
            'choose_from_most_used'      => 'Choose from the most used ' . $plural,
            'not_found'                  => 'No ' . $plural . ' found.',
            'menu_name'                  => $plural,

        );

        $args = array(
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'location'),

        );

        register_taxonomy( 'location', 'product', $args);
    }
    add_action('init', 'fecom_register_product_taxonomy');

    function fecom_event_table_head($data) {
            $data['product_price'] = 'Price';
            $data['stockCheck'] = 'Stock';
            $data['productStatus'] = 'Status';
            return $data;
    }
    add_filter('manage_product_posts_columns', 'fecom_event_table_head');


    function fecom_event_table_content( $column_name, $post_id ) {
        if ($column_name == 'product_price') {
            echo get_post_meta( $post_id, 'product_price', true );
        }
        if ($column_name == 'stockCheck') {
            echo get_post_meta( $post_id, 'stockCheck', true );
        }
        if ($column_name == 'productStatus') {
            echo get_post_meta( $post_id, 'productStatus', true );
        }

    }

    add_action( 'manage_product_posts_custom_column', 'fecom_event_table_content' , 10 ,2);

    /*<!-- PRODUCT TAXONOMY ARGS--!>*/


    function add_my_post_types_to_query( $query ) {
        if ( is_home() && $query->is_main_query() )
            $query->set( 'post_type', array( 'post', 'product' ) );
        return $query;
    }

    add_action( 'pre_get_posts', 'add_my_post_types_to_query' );


?>
