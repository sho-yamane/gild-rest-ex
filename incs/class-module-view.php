<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_view {

    public $version = '';

    public function __construct() {
        $data = get_file_data( __FILE__, array( 'version' => 'Version' ) );
        $version = $data['version'];
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_head-' . gildrest_ex_admin_menu::$hook , array( $this, 'enqueue_admin_scripts' ) );
    }

    public function enqueue_scripts() {
        wp_enqueue_style( 'gildrest-ex-styles', plugins_url('gild-rest-ex/assets/css/ex-style.min.css'), array(), $this->version );
        wp_enqueue_script( 'gildrest-ex-scripts', plugins_url('gild-rest-ex/assets/js/ex-app.min.js'), array(), $this->version, true );
    }

    public function enqueue_admin_scripts() {
        wp_enqueue_style( 'gildrest-ex-styles2', plugins_url('gild-rest-ex/assets/css/ex-admin.min.css'), array(), $this->version );
        wp_enqueue_script( 'gildrest-ex-scripts2', plugins_url('gild-rest-ex/assets/js/ex-admin.min.js'), array(), $this->version, true );
    }

}
