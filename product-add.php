<?php
    require_once(FECOMMERCE_PLUGIN_DIR . '/database/fecom-database-queries.php');

    if (isset( $_POST['submitted'] )) {

        $data = array();

        if(trim($_POST['product_name'] === '')){
            $nameError = 'Please enter product name';
            $hasError = true;
        }else{
            $data['product_name'] = $_POST['product_name'];
        }

        if(trim($_POST['product_price'] === '')){
            $priceError = 'Please enter product price';
            $hasError = true;
        }else{
            $data['product_price'] = $_POST['product_price'];
        }

        if(trim($_POST['product_explanation'] === '')){
            $explanationError = 'Please enter product explanation';
            $hasError = true;
        }else{
            $data['product_explanation'] = $_POST['product_explanation'];
        }

        if(trim($_POST['stockCheck'] === '')){
            $nameError = 'Please enter product stock';
            $hasError = true;
        }else{
            $data['stockCheck'] = $_POST['stockCheck'];
        }

        if(trim($_POST['productStatus'] === '')){
            $nameError = 'Please enter product status';
            $hasError = true;
        }else{
            $data['productStatus'] = $_POST['productStatus'];
        }

        if (!isset($_POST['productid']))
            insert_product($data);
        else
            update_product($_POST['productid'],$data);

        wp_redirect('/wp-admin/admin.php?page='. urlencode('fe-commerce/admin/views/product-add.php'));
        exit;
    }

    if (isset( $_GET['productid'] )){
        $product = get_product($_GET['productid']);
    }
    wp_nonce_field( basename( __FILE__ ), 'fecom_product_nonce' );

    ?>
        <h1>Add Product</h1>
        <br>
        <div>
            <form id="" action="/wp-admin/admin.php?page=<?php echo urlencode('fe-commerce/admin/views/product-add.php')?>" method="post" class="form">
                <div class="form-group row">
                        <label for="product_name" class="col-2 col-form-label">Product Name: </label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo isset($product) ? $product->name : ''?>"/>
                        </div>


                </div>
                <div class="form-group row">

                            <label for="product-price" class="col-2 col-form-label">Product Price: </label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="product_price" id="product-price" value="<?php echo isset($product) ? $product->price : ''?>">
                            </div>

                </div>


                <div class="form-group">
                    <label for="product_explanation" class="">Product Explanation</label>
                    <textarea class="form-control"  id="product_explanation" name="product_explanation" rows="3">
                        <?php echo isset($product) ? $product->explanation : ''?>
                    </textarea>
                </div>

                <div class="form-check">
                    <span class="col-2 col-form-label"> Stock Status   </span>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="stockCheck" id="stockCheckTrue" value="1" <?php echo isset($product) && ($product->stock == "1") ? 'checked' : ''?>>
                    Available
                  </label>
                  <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="stockCheck" id="stockCheckFalse" value="0" <?php echo isset($product) && ($product->stock == "0") ? 'checked' : ''?>>
                      Not Available
                    </label>
                </div>

                <div class="form-check">
                    <span class="col-2 col-form-label"> Product Status</span>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="productStatus" id="productStatusTrue" value="1" <?php echo isset($product) && ($product->situation == "1") ? 'checked' : ''?>>
                    Show
                  </label>
                  <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="productStatus" id="productStatusFalse" value="0" <?php echo isset($product) && ($product->situation == "0") ? 'checked' : ''?>>
                      Don't Show
                    </label>
                </div>

                <?php if (isset($product)) : ?>
                    <input type="hidden" name="productid" value="<?php echo $product->id?>">
                <?php endif;?>
                <button class="btn btn-info" type="submit" name="submitted" value="submitted">Save</button>
            </form>
        </div>
