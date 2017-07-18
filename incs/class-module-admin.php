<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_admin_menu {

    public static $hook = 'toplevel_page_gre-settings-admin';

    public function __construct() {
        add_action('admin_menu', array($this, 'menu_add'));
    }

    public function menu_add() {

        add_menu_page(
            __( 'GildRest Ex Settings', 'gird-rest-ex' ),
            __( 'GildRest Ex Settings', 'gird-rest-ex' ),
            'administrator',
            'gre-settings-admin',
            array( &$this, 'gildrest_ex_admin' ),
            'dashicons-admin-generic'
        );

    }

    public function gildrest_ex_admin() {

        // define default value
        $instance = get_option( 'gre_settings' );

        $defaults = array(
            'share_buttons' => array(
                'active' => 'on',
                'fb' => array(
                    'active'    => false,
                    'text'      => __( 'Share', 'girdrest-ex' )
                ),
                'tw' => array(
                    'active'    => false,
                    'text'      => __( 'Tweet', 'girdrest-ex' )
                ),
                'htb' => array(
                    'active'    => false,
                    'text'      => __( 'Bookmark', 'girdrest-ex' )
                )
            )
        );

        $instance = array_replace_recursive( $defaults, $instance );

        ?>
            <div class="gre-settings">

                <h2><?php _e( 'GildRest Ex settings', 'girdrest-ex' ); ?></h2>

                <form id="gre-settings-menu" method="post" action="">

                    <?php wp_nonce_field( 'my-nonce-key', 'gre-settings-menu' ); ?>

                    <div class="gre-settings-inner">
                        <h3><?php _e( 'Share buttons', 'girdrest-ex' ); ?></h3>
                        <table class="settings-table">
                            <tr>
                                <th>
                                    <?php _e( 'Use share buttons?', 'girdrest-ex' ); ?>
                                </th>
                                <td>
                                    <input
                                        type="checkbox"
                                        class="checkbox"
                                        <?php
                                            echo ( $instance['share_buttons']['active'] ) ? 'checked="checked"' : '';
                                        ?>
                                        id="gre_settings_share_buttons_active"
                                        name="gre_settings_share_buttons_active"
                                    />
                                    <label for="gre_settings_share_buttons_active">
                                        <?php _e('Use', 'gildrest-ex'); ?>
                                    </label>
                                </td>
                            </tr>
                        </table>
                        <!--Share Buttons Facebook-->
                        <h4><?php _e( 'Facebook share button', 'girdrest-ex' ); ?></h4>
                        <table class="settings-table">
                            <tr>
                                <th>
                                    <?php _e( 'Display Facebook share button', 'girdrest-ex' ); ?>
                                </th>
                                <td>
                                    <input
                                        type="checkbox"
                                        class="checkbox"
                                        <?php
                                            echo ( $instance['share_buttons']['fb']['active'] ) ? 'checked="checked"' : '';
                                        ?>
                                        id="gre_settings_share_buttons_fb_active"
                                        name="gre_settings_share_buttons_fb_active"
                                    />
                                    <label for="gre_settings_share_buttons_fb_active">
                                        <?php _e('Display', 'gildrest-ex'); ?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <?php _e( 'Facebook share button text', 'girdrest-ex' ); ?>
                                </th>
                                <td>
                                    <input
                                        type="text"
                                        name="gre_settings_share_buttons_fb_text"
                                        value="<?php echo esc_attr( $instance['share_buttons']['fb']['text'] );?>"
                                    />
                                </td>
                            </tr>
                        </table>
                        <!--Share Buttons twitter-->
                        <h4><?php _e( 'Twitter share button', 'girdrest-ex' ); ?></h4>
                        <table>
                            <tr>
                                <th>
                                    <?php _e( 'Display Twitter share button', 'girdrest-ex' ); ?>
                                </th>
                                <td>
                                    <input
                                        type="checkbox"
                                        class="checkbox"
                                        <?php
                                            echo ( $instance['share_buttons']['tw']['active'] ) ? 'checked="checked"' : '';
                                        ?>
                                        id="gre_settings_share_buttons_tw_active"
                                        name="gre_settings_share_buttons_tw_active"
                                    />
                                    <label for="gre_settings_share_buttons_tw_active">
                                        <?php _e('Display', 'gildrest-ex'); ?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <?php _e( 'Twitter share button text', 'girdrest-ex' ); ?>
                                </th>
                                <td>
                                    <input
                                        type="text"
                                        name="gre_settings_share_buttons_tw_text"
                                        value="<?php echo esc_attr( $instance['share_buttons']['tw']['text'] );?>"
                                    />
                                </td>
                            </tr>
                        </table>
                        <!--Share Buttons hatena-->
                        <h4><?php _e( 'Hatena button(Japanese bookmark service)', 'girdrest-ex' ); ?></h4>
                        <table>
                            <tr>
                                <th>
                                    <?php _e( 'Display Hatena button', 'girdrest-ex' ); ?>
                                </th>
                                <td>
                                    <input
                                        type="checkbox"
                                        class="checkbox"
                                        <?php
                                            echo ( $instance['share_buttons']['htb']['active'] ) ? 'checked="checked"' : '';
                                        ?>
                                        id="gre_settings_share_buttons_htb_active"
                                        name="gre_settings_share_buttons_htb_active"
                                    />
                                    <label for="gre_settings_share_buttons_htb_active">
                                        <?php _e('Display', 'gildrest-ex'); ?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <?php _e( 'Hatena button text', 'girdrest-ex' ); ?>
                                </th>
                                <td>
                                    <input
                                        type="text"
                                        name="gre_settings_share_buttons_htb_text"
                                        value="<?php echo esc_attr( $instance['share_buttons']['htb']['text'] );?>"
                                    />
                                </td>
                            </tr>
                        </table>
                    </div>

                    <p>
                        <input
                            type="submit"
                            value="<?php echo esc_attr( __( 'Save', 'my-custom-admin' ) );?>"
                            class="button button-primary button-large"
                        >
                    </p>

                </form>

            </div>

            <div class="dump">
                <?php var_dump( $instance ); ?>
            </div>

        <?php

    }

}
