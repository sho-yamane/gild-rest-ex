<?php
/*
Plugin Name: GildRest Ex
Plugin URI: https://test.com
Author: Sho Yamane
Author URI: https://profiles.wordpress.org/shoyamane
Version: 1.0
Description: Test
License: GNU General Public License v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

// Include
require_once dirname( __FILE__ ) . '/incs/defines.php';
require_once dirname( __FILE__ ) . '/incs/functions.php';
require_once dirname( __FILE__ ) . '/incs/class-module-core.php';

// new
//  admin
new gildrest_ex_admin_menu_init();
new gildrest_ex_admin_notices();
new gildrest_ex_admin_menu();

//  widget
new gildrest_ex_widget_new_posts_set();

//  shortcode
new gildrest_ex_shortcode();

//  view
new gildrest_ex_view();
