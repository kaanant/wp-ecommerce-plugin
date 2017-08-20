<?php


    function get_products(){
        global $wpdb;

        $results = $wpdb->get_results( 'SELECT * FROM wp_fecom_product');

        #$query = "SELECT * FROM $wpdb->wp_fecom_product";
        #$products = $wpdb->get_results();

        return $results;

    }


    function get_product($id){
        global $wpdb;

        $product = $wpdb->get_row( $wpdb->prepare(
            "SELECT * FROM wp_fecom_product
            WHERE id = %d" ,
            $id
            ));

        #$query = "SELECT * FROM $wpdb->wp_fecom_product";
        #$products = $wpdb->get_results();

        return $product;

    }

    function insert_product($data)
    {
        global $wpdb;

        $table = 'wp_fecom_product';

        $wpdb->insert(
            $table,
            array(
                'price' => $data['product_price'],
                'stock' => $data['stockCheck'],
                'situation' => $data['productStatus'],
                'name' => $data['product_name'],
                'explanation' => $data['product_explanation']
            ),
            array(
                '%d',
                '%d',
                '%d',
                '%s',
                '%s'
            )
            );
    }

    function update_product($id,$data){
        global $wpdb;

        $table = 'wp_fecom_product';

        $wpdb->update(
                $table,
                array(
                    'price' => $data['product_price'],
                    'stock' => $data['stockCheck'],
                    'situation' => $data['productStatus'],
                    'name' => $data['product_name'],
                    'explanation' => $data['product_explanation']
                ),
                array(
                    'id' => $id
                ),
                array(
                    '%d',
                    '%d',
                    '%d',
                    '%s',
                    '%s'
                ),
                array(
                    '%d'
                )
            );
    }



?>
