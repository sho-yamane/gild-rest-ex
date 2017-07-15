<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_admin_notices {

    public function __construct() {
        add_action( 'admin_notices', array($this, 'my_admin_notices') );
    }

    public function my_admin_notices() {
        ?>
            <?php if ( $messages = get_transient( 'my-custom-admin-errors' ) ): ?>
                <div class="error">
                    <ul>
                        <?php foreach( $messages as $message ): ?>
                            <li><?php echo esc_html( $message ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php
    }

}
