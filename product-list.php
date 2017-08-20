<?php

    include(FECOMMERCE_PLUGIN_DIR . "/database/fecom-database-queries.php");

    $products = get_products();

    ?>

    <div class="container">
        <h1>Product List</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
                    </div>
                    <table class="table table-hover" id="dev-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Show</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product) :?>
                            <tr>
                                <td><?php echo $product->id ?></td>
                                <td><?php echo $product->name ?></td>
                                <td><?php echo $product->price ?></td>
                                <td><?php echo $product->stock ? 'available' : 'not available'?></td>
                                <td><?php echo $product->situation ? 'show' : 'hidden' ?></td>
                                <td id="product-edit" data-id=""> <a href="/wp-admin/admin.php?page=<?php echo urlencode('fe-commerce/admin/views/product-add.php')?>&productid=<?php echo $product->id ?>" class="btn btn-info">Edit</a></td>
                                <td id="product-delete" data-id=""> <a href="/wp-admin/admin.php?page=<?php echo urlencode('fe-commerce/admin/views/product-delete.php')?>&productid=<?php echo $product->id ?>" class="btn btn-danger">Delete</a></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="/wp-admin/admin.php?page=<?php echo urlencode('fe-commerce/admin/views/product-add.php')?>" class="btn btn-info">Add Product</a>
    </div>
