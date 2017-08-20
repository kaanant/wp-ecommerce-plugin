<?php

    function fecom_add_submenu_page_callback(){
        $args = array(
            'post_type' => 'product',
            'orderby'   => 'menu_order',
            'order'     => 'ASC',
            'no_found_rows' => true,
            'update_post-term_cache' => false,
            'post_per_post' => 10,
        );

        $products = (new WP_Query($args))->get_posts();

        echo '<pre>';
        foreach ($products as $key => $value) {
            //var_dump($value);
            var_dump(get_post_meta($value->ID));
        }
        echo '</pre>';
    }
?>
