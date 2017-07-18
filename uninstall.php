<?php

if (! defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

delete_option('gildrest_ex_widget_new_posts');
delete_option('gildrest_ex_widget_sns_links');
delete_option('gre_setting');
