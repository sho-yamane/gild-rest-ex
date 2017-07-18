<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_admin_menu_init {

    public function __construct() {
        add_action( 'admin_init', array($this, 'admin_init' ) );
    }

    public function admin_init() {
        if ( isset( $_POST['gre-settings-menu'] ) && $_POST['gre-settings-menu'] ) {
            if ( check_admin_referer( 'my-nonce-key', 'gre-settings-menu' ) ) {

                $e = new WP_Error();

                $settings = get_option( 'gre_settings' );

                if ( isset( $_POST['gre_settings_share_buttons_active'] ) && $_POST['gre_settings_share_buttons_active'] ) {
                    $settings['share_buttons']['active'] = $_POST['gre_settings_share_buttons_active'];
                } else  {
                    $settings['share_buttons']['active'] = false;
                }


                if ( isset( $_POST['gre_settings_share_buttons_fb_active'] ) && $_POST['gre_settings_share_buttons_fb_active'] ) {
                    $settings['share_buttons']['fb']['active'] = $_POST['gre_settings_share_buttons_fb_active'];
                } else  {
                    $settings['share_buttons']['fb']['active'] = false;
                }

                if ( isset( $_POST['gre_settings_share_buttons_fb_text'] ) && $_POST['gre_settings_share_buttons_fb_text'] ) {
                    $settings['share_buttons']['fb']['text'] = trim( $_POST['gre_settings_share_buttons_fb_text'] );
                } else {
                    $settings['share_buttons']['fb']['text'] = __( 'Share', 'girdrest-ex' );
                }

                if ( isset( $_POST['gre_settings_share_buttons_tw_active'] ) && $_POST['gre_settings_share_buttons_tw_active'] ) {
                    $settings['share_buttons']['tw']['active'] = $_POST['gre_settings_share_buttons_tw_active'];
                } else  {
                    $settings['share_buttons']['tw']['active'] = false;
                }

                if ( isset( $_POST['gre_settings_share_buttons_tw_text'] ) && $_POST['gre_settings_share_buttons_tw_text'] ) {
                    $settings['share_buttons']['tw']['text'] = trim( $_POST['gre_settings_share_buttons_tw_text'] );
                } else {
                    $settings['share_buttons']['tw']['text'] = __( 'Tweet', 'girdrest-ex' );
                }

                if ( isset( $_POST['gre_settings_share_buttons_htb_active'] ) && $_POST['gre_settings_share_buttons_htb_active'] ) {
                    $settings['share_buttons']['htb']['active'] = $_POST['gre_settings_share_buttons_htb_active'];
                } else  {
                    $settings['share_buttons']['htb']['active'] = false;
                }

                if ( isset( $_POST['gre_settings_share_buttons_htb_text'] ) && $_POST['gre_settings_share_buttons_htb_text'] ) {
                    $settings['share_buttons']['htb']['text'] = trim( $_POST['gre_settings_share_buttons_htb_text'] );
                } else {
                    $settings['share_buttons']['htb']['text'] = __( 'Bookmark', 'girdrest-ex' );
                }

                /*if ( isset( $_POST['e-mail'] ) && $_POST['e-mail'] ) {
                    if ( is_email( trim( $_POST['e-mail'] ) ) ) {
                        update_option( 'gre_set_email1', trim( $_POST['e-mail'] ) );
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
                    update_option( 'gre_set_email1', '' );
                }*/

                /*if ( isset( $_POST['e-mail2'] ) && $_POST['e-mail2'] ) {
                    if ( is_email( trim( $_POST['e-mail2'] ) ) ) {
                        update_option( 'gre_set_email2', trim( $_POST['e-mail2'] ) );
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
                    update_option( 'gre_set_email2', '' );
                }*/

                update_option( 'gre_settings', $settings );

                wp_safe_redirect( menu_page_url( 'gre-settings-admin', false ) );

            }//check_admin_referer
        }
    }

}
