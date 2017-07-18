<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_widget_sns_links extends WP_Widget {

    public $plg_dir = '';

    public function __construct() {

        // description
        $widget_ops = array( 'description' => 'SNS Links add.' );

        // plugin path
        if ( empty( $this->plg_dir ) ) {
            $this->plg_dir = WP_PLUGIN_URL . '/gild-rest-ex';
        }

        // Widget Insert
        parent::__construct( false, $name = 'GildRestEx:SNSLinks', $widget_ops );

    }

    public function widget( $args, $instance ) {

        extract( $args );

        $title          = apply_filters( 'gre_wsl_title', $instance['title'] );
        $fb_active      = apply_filters( 'gre_wsl_fb_active', $instance['fb_active']['active'] );
        $fb_url         = apply_filters( 'gre_wsl_fb_url', $instance['fb_url'] );
        $tw_url         = apply_filters( 'gre_wsl_tw_url', $instance['tw_url'] );
        $insta_url      = apply_filters( 'gre_wsl_insta_url', $instance['insta_url'] );
        $line_url       = apply_filters( 'gre_wsl_line_url', $instance['line_url'] );
        $active         = array(
                            'tw' => ($instance['tw_active']['active']) ? true : false,
                            'insta' => ($instance['insta_active']['active']) ? true : false,
                            'line' => ($instance['line_active']['active']) ? true : false,
                            );
        $active_num     = 0;

        foreach ($active as $value) {
            if ( $value ) {
                $active_num++;
            }
        }

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        ?>

            <div class="sns-links-container">

                <?php if ( $fb_active ) : ?>
                    <div class="sns-links-top sns-link-fb" id="pagePlugin">
                        <iframe
                            src="https://www.facebook.com/plugins/page.php?href=<?php echo $fb_url ?>&tabs&width=280&height=154&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=271254226254903"
                            width="280"
                            height="154"
                            style="border:none;overflow:hidden"
                            scrolling="no"
                            frameborder="0"
                            allowTransparency="true">
                        </iframe>
                    </div>
                <?php endif; ?>

                <?php if ($active_num !== 0) : ?>
                    <div class="sns-links-bottom sns-links-<?php echo $active_num; ?>">
                        <?php if ($active['tw']) : ?>
                            <div class="sns-link sns-link-tw">
                                <a href="<?php echo $tw_url;?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($active['insta']) : ?>
                            <div class="sns-link sns-link-insta">
                                <a href="<?php echo $insta_url;?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($active['line']) : ?>
                            <div class="sns-link sns-link-line">
                                <a href="<?php echo $line_url;?>"><img src="<?php echo $this->plg_dir . '/assets/img/line-icon.svg'; ?> "></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>

        <?php

        echo $after_widget;

    }

    public function form( $instance ) {

        // define default value
        $defaults = array(
            'title'         => __('Follow me!!' , 'gildrest-ex'),
            'fb_active'     => array( 'active' => false ),
            'fb_url'        => '',
            'tw_active'     => array( 'active' => false ),
            'tw_url'        => '',
            'line_active'   => array( 'active' => false ),
            'line_url'      => '',
            'insta_active'  => array( 'active' => false ),
            'insta_url'     => '',
        );

        $instance = wp_parse_args( $instance, $defaults );

        ?>

            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><b><?php _e('Title' , 'gildrest-ex'); ?></b></label>
                <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
            </p>

            <p>
                <b><?php _e('Facebook Page' , 'gildrest-ex'); ?></b><br>

                <input
                    type="checkbox"
                    class="checkbox"
                    <?php echo ($instance['fb_active']['active']) ? 'checked="checked"' : ''; ?>
                    id="<?php echo $this->get_field_id( 'fb_active' ); ?>"
                    name="<?php echo $this->get_field_name( 'fb_active' ); ?>"
                />
                <label for="<?php echo $this->get_field_id( 'fb_active' ); ?>">
                    <?php _e('Display facebook page link', 'gildrest-ex'); ?>
                </label>

                <br>

                <label for="<?php echo $this->get_field_id('fb_url'); ?>">
                    <?php _e('Facebook page link url', 'gildrest-ex'); ?>
                </label>
                <input
                    id="<?php echo $this->get_field_id('fb_url'); ?>"
                    name="<?php echo $this->get_field_name('fb_url'); ?>"
                    type="text"
                    class="widefat"
                    placeholder="https://www.facebook.com/FacebookJapan/"
                    value="<?php echo esc_attr($instance['fb_url']); ?>"
                />
            </p>

            <p>
                <b><?php _e('Twitter' , 'gildrest-ex'); ?></b><br>

                <input
                    type="checkbox"
                    class="checkbox"
                    <?php echo ($instance['tw_active']['active']) ? 'checked="checked"' : ''; ?>
                    id="<?php echo $this->get_field_id( 'tw_active' ); ?>"
                    name="<?php echo $this->get_field_name( 'tw_active' ); ?>"
                />
                <label for="<?php echo $this->get_field_id( 'tw_active' ); ?>">
                    <?php _e('Display twitter link', 'gildrest-ex'); ?>
                </label>

                <br>

                <label for="<?php echo $this->get_field_id('tw_url'); ?>">
                    <?php _e('Twitter link url', 'gildrest-ex'); ?>
                </label>
                <input
                    id="<?php echo $this->get_field_id('tw_url'); ?>"
                    name="<?php echo $this->get_field_name('tw_url'); ?>"
                    type="text"
                    class="widefat"
                    placeholder="https://twitter.com/Twitter"
                    value="<?php echo esc_attr($instance['tw_url']); ?>"
                />
            </p>

            <p>
                <b><?php _e('Instagram' , 'gildrest-ex'); ?></b><br>

                <input
                    type="checkbox"
                    class="checkbox"
                    <?php echo ($instance['insta_active']['active']) ? 'checked="checked"' : ''; ?>
                    id="<?php echo $this->get_field_id( 'insta_active' ); ?>"
                    name="<?php echo $this->get_field_name( 'insta_active' ); ?>"
                />
                <label for="<?php echo $this->get_field_id( 'insta_active' ); ?>">
                    <?php _e('Display instagram link', 'gildrest-ex'); ?>
                </label>

                <br>

                <label for="<?php echo $this->get_field_id('insta_url'); ?>">
                    <?php _e('Instagram link url', 'gildrest-ex'); ?>
                </label>
                <input
                    id="<?php echo $this->get_field_id('insta_url'); ?>"
                    name="<?php echo $this->get_field_name('insta_url'); ?>"
                    type="text"
                    class="widefat"
                    placeholder="https://www.instagram.com/instagram/"
                    value="<?php echo esc_attr($instance['insta_url']); ?>"
                />
            </p>

            <p>
                <b><?php _e('LINE@(Japanese messenger)' , 'gildrest-ex'); ?></b><br>

                <input
                    type="checkbox"
                    class="checkbox"
                    <?php echo ($instance['line_active']['active']) ? 'checked="checked"' : ''; ?>
                    id="<?php echo $this->get_field_id( 'line_active' ); ?>"
                    name="<?php echo $this->get_field_name( 'line_active' ); ?>"
                />
                <label for="<?php echo $this->get_field_id( 'line_active' ); ?>">
                    <?php _e('Display LINE@ link', 'gildrest-ex'); ?>
                </label>

                <br>

                <label for="<?php echo $this->get_field_id('line_url'); ?>">
                    <?php _e('LINE@ link url', 'gildrest-ex'); ?>
                </label>
                <input
                    id="<?php echo $this->get_field_id('line_url'); ?>"
                    name="<?php echo $this->get_field_name('line_url'); ?>"
                    type="text"
                    class="widefat"
                    placeholder="https://line.me/R/ti/p/%40sample"
                    value="<?php echo esc_attr($instance['line_url']); ?>"
                />
            </p>

        <?php

    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title']                      = ($this->magicquotes) ? htmlspecialchars( stripslashes(strip_tags( $new_instance['title'] )), ENT_QUOTES ) : htmlspecialchars( strip_tags( $new_instance['title'] ), ENT_QUOTES );

        $instance['fb_active']['active']        = $new_instance['fb_active'];
        $instance['fb_url']                     = esc_url( $new_instance['fb_url'], array( 'http', 'https' ) );

        $instance['tw_active']['active']        = $new_instance['tw_active'];
        $instance['tw_url']                     = esc_url( $new_instance['tw_url'], array( 'http', 'https' ) );

        $instance['insta_active']['active']     = $new_instance['insta_active'];
        $instance['insta_url']                  = esc_url( $new_instance['insta_url'], array( 'http', 'https' ) );

        $instance['line_active']['active']      = $new_instance['line_active'];
        $instance['line_url']                   = esc_url( $new_instance['line_url'], array( 'http', 'https' ) );

        update_option('gildrest_ex_widget_sns_links', $instance);

        return $instance;

    }

}

class gildrest_ex_widget_sns_links_set {

    public function __construct() {
        add_action( 'widgets_init', function(){ register_widget( 'gildrest_ex_widget_sns_links' ); });
    }

}
