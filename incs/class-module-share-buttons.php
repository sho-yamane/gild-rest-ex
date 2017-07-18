<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_share_buttons {

    public function __construct() {
        add_filter('the_content', array($this, 'share_buttons' ));
    }

    public function share_buttons( $the_content ) {

        $instance = get_option( 'gre_settings' )['share_buttons'];

        if ( is_singular() && $instance['active'] ) {

            $active_num = 0;
            $return  = $the_content;

            if ( $instance['fb']['active'] || $instance['tw']['active'] || $instance['htb']['active'] ) {

                //count
                if( $instance['fb']['active'] ) $active_num++;
                if( $instance['tw']['active'] ) $active_num++;
                if( $instance['htb']['active'] ) $active_num++;

                $return .= '<div class="gre-share"><div class="gre-share-inner gre-share-num-' . $active_num . '">';

                if( $instance['fb']['active'] ) {
                    $fb_share_url = 'http://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '&amp;t=' . urlencode(the_title("","",0));
                    $return .= '<div class="share-link-conatiner share-fb"><a href="' . $fb_share_url .  '"><span class="share-txt">' . esc_attr($instance['fb']['text']) . '</span></a></div>';
                }

                if( $instance['tw']['active'] ) {
                    $tw_share_url = 'http://twitter.com/intent/tweet?text=' . urlencode(the_title("","",0)) . '&amp;' . urlencode(get_permalink()) . '&amp;url=' . urlencode(get_permalink());
                    $return .= '<div class="share-link-conatiner share-tw"><a href="' . $tw_share_url .  '"><span class="share-txt">' . esc_attr($instance['tw']['text']) . '</span></a></div>';
                }

                if( $instance['htb']['active'] ) {
                    $htb_share_url = 'http://b.hatena.ne.jp/add?mode=confirm&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(the_title("","",0));
                    $return .= '<div class="share-link-conatiner share-htb"><a href="' . $htb_share_url .  '"><span class="share-txt">' . esc_attr($instance['htb']['text']) . '</span></a></div>';
                }

                $return .= '</div></div>';

            }

            return $return;

        } else {

            return $the_content;

        }
    }

}
