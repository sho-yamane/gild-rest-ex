<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_shortcode {

    public function __construct() {
        add_shortcode( 'twitter', array($this, 'twitter_shortcode' ) );
    }

    public function twitter_shortcode( $p, $content ) {

        $content = str_replace( '@', '', $content );

        if ( !preg_match( "/^[0-9a-z_]{1,15}$/i", $content ) ) {
            return;
        }

        return sprintf(
            '<a href="https://twitter.com/%s">@%s</a>',
            esc_attr( $content ),
            esc_html( $content )
        );

    }
}
