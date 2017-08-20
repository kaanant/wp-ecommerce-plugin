<?php

/*<-- PRODUCT FIELDS-->*/


function fecom_add_custom_product_metaboxes(){

    add_meta_box(
        'fecom_custom_product_mb',
        'Product Information',
        'fecom_custom_product_mb_callback',
        'product'
    );
}

add_action( 'add_meta_boxes', 'fecom_add_custom_product_metaboxes' );

function fecom_custom_product_mb_callback($post){

    wp_nonce_field( basename( __FILE__ ), 'fecom_product_nonce' );
    $fecom_product_stored_meta = get_post_meta($post->ID);

    ?>

        <div>
            <!---<div class="form-group row">
                    <label for="product_name" class="col-2 col-form-label">Product Name: </label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="product_name" id="product_name" value="<?php if ( ! empty ( $fecom_product_stored_meta['product_name'] ) )
                                                                                            echo esc_attr( $fecom_product_stored_meta['product_name'][0] ); ?>"/>
                    </div>


            </div>!--->
            <div class="form-group row">

                        <label for="product-price" class="col-2 col-form-label">Product Price: </label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="product_price" id="product-price" value="<?php if ( ! empty ( $fecom_product_stored_meta['product_price'] ) )
                                                                                                echo esc_attr( $fecom_product_stored_meta['product_price'][0] ); ?>">
                        </div>

            </div>


            <div class="form-group">
                <label for="product_explanation" class="">Product Explanation</label>
                <textarea class="form-control"  id="product_explanation" name="product_explanation" rows="3">
                    <?php if ( ! empty ( $fecom_product_stored_meta['product_explanation'] ) )
                        echo esc_attr( $fecom_product_stored_meta['product_explanation'][0] ); ?>
                </textarea>
            </div>

            <div class="form-check">
                <span class="col-2 col-form-label"> Stock Status   </span>
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="stockCheck" id="stockCheckTrue" value="available" checked>
                Available
              </label>
              <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="stockCheck" id="stockCheckFalse" value="non-available">
                  Not Available
                </label>
            </div>

            <div class="form-check">
                <span class="col-2 col-form-label"> Product Status</span>
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="productStatus" id="productStatusTrue" value="active" checked>
                Active
              </label>
              <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="productStatus" id="productStatusFalse" value="passive">
                  Passive
                </label>
            </div>



        </div>




    <?php

}



/*<!-- PRODUCT FIELDS--!>*/



/* Product Store Check */
function fecom_product_meta_save( $post_id ){

    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST['fecom_product_nonce'] ) && wp_verify_nonce( $_POST['fecom_product_nonce'], basename(__FILE__) ) ) ? 'true' : 'false';


    if ($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }

    if ( isset( $_POST['product_name'] ) ) {

        update_post_meta( $post_id, 'product_name', sanitize_text_field($_POST['product_name'] ) ); //santize for secure
    }
    if ( isset( $_POST['product_price'] ) ) {

        update_post_meta( $post_id, 'product_price', sanitize_text_field($_POST['product_price'] ) ); //santize for secure
    }
    if ( isset( $_POST['product_explanation'] ) ) {

        update_post_meta( $post_id, 'product_explanation', sanitize_text_field($_POST['product_explanation'] ) ); //santize for secure
    }

    if ( isset( $_POST['stockCheck'] ) ) {

        update_post_meta( $post_id, 'stockCheck', sanitize_text_field($_POST['stockCheck'] ) ); //santize for secure
    }

    if ( isset( $_POST['productStatus'] ) ) {

        update_post_meta( $post_id, 'productStatus', sanitize_text_field($_POST['productStatus'] ) ); //santize for secure
    }

}

add_action( 'save_post', 'fecom_product_meta_save');
/*! Procut Store Chech */




?>
