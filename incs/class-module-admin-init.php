<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_admin_menu_init {

    public function __construct() {
        add_action( 'admin_init', array($this, 'admin_init' ) );
    }

    public function admin_init() {
        if ( isset( $_POST['my-submenu'] ) && $_POST['my-submenu'] ) {
            if ( check_admin_referer( 'my-nonce-key', 'my-submenu' ) ) {

                $e = new WP_Error();

                if ( isset( $_POST['my-data'] ) && $_POST['my-data'] ) {
                    if ( is_email( trim( $_POST['my-data'] ) ) ) {
                        update_option( 'my-data', trim( $_POST['my-data'] ) );
                    } else {
                        $e->add(
                            'error',
                            __( 'Please enter a vaild email address.', 'girdrest-ex' )
                        );
                        set_transient(
                            'my-custom-admin-errors',
                            $e->get_error_messages(), 10
                        );
                    }
                } else  {
                    update_option( 'my-data', '' );
                }

                wp_safe_redirect( menu_page_url( 'my-submenu', false ) );

            }
        }
    }

}
