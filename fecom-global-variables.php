<?php

    if (!defined('FECOMMERCE_THEME_DIR'))
        define('FECOMMERCE_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());

    if (!defined('FECOMMERCE_PLUGIN_NAME'))
        define('FECOMMERCE_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

    if (!defined('FECOMMERCE_PLUGIN_DIR'))
        define('FECOMMERCE_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . FECOMMERCE_PLUGIN_NAME);

    if (!defined('FECOMMERCE_PLUGIN_URL'))
        define('FECOMMERCE_PLUGIN_URL', WP_PLUGIN_URL . '/' . FECOMMERCE_PLUGIN_NAME);


?>
