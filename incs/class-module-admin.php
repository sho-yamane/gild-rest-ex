<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_admin_menu {

    public function __construct() {
        add_action('admin_menu', array($this, 'menu_add'));
    }

    public function menu_add() {

        add_menu_page(
            __( 'My Admin', 'gird-rest-ex' ),
            __( 'My Admin', 'gird-rest-ex' ),
            'administrator',
            'my-custom-admin',
            array( &$this, 'my_custom_admin' ),
            'dashicons-admin-generic'
        );

        add_submenu_page(
            'my-custom-admin',
            __( 'My Submenu', 'gird-rest-ex' ),
            __( 'My Submenu', 'gird-rest-ex' ),
            'manage_options',
            'my-submenu',
            array( &$this, 'my_submenu' )
        );

    }

    public function my_custom_admin() {
        ?>
            <div class="wrap">
                <h2>My Admin</h2>
            </div>
        <?php
    }

    public function my_submenu() {
        ?>
            <div class="wrap">
                <h2>My Submenu</h2>
            </div>
            <form id="my-submenu-form" method="post" action="">
                <?php wp_nonce_field( 'my-nonce-key', 'my-submenu' ); ?>
                <p>
                    <?php echo esc_html( __( 'E-mail', 'girdrest-ex' ) );?>
                    <input type="text" name="my-data" value="<?php echo esc_attr( get_option( 'my-data' ) );?>">
                </p>
                <p>
                    <input
                        type="submit"
                        value="<?php echo esc_attr( __( 'Save', 'my-custom-admin' ) );?>"
                        class="button button-primary button-large"
                    >
                </p>
            </form>
        <?php
    }

}
