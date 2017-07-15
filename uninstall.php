<?php

if (! defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

delete_option('gildrest_ex_widget_new_posts');
