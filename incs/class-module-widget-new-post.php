<?php

if (! defined('ABSPATH')) {
    exit;
}

class gildrest_ex_widget_new_posts extends WP_Widget {

    public $plg_dir = '';

    public function __construct() {

        // description
        $widget_ops = array( 'description' => 'Thumbnails in new articles.' );

        // plugin path
        if ( empty( $this->plg_dir ) ) {
            $this->plg_dir = WP_PLUGIN_URL . '/gild-rest-ex';
        }

        // no thumbnail
        $this->no_thumbnail = apply_filters( 'gre_wnp_thumb', $this->plg_dir . '/assets/img/no-image.jpg' );

        // Widget Insert
        parent::__construct( false, $name = 'GildRestEx:NewPosts', $widget_ops );

    }

    public function widget( $args, $instance ) {

        extract( $args );

        $title      = apply_filters( 'gre_wnp_title', $instance['title'] );
        $width      = apply_filters( 'gre_wnp_width', $instance['width'] );
        $height     = apply_filters( 'gre_wnp_height', $instance['height'] );
        $number     = apply_filters( 'gre_wnp_number', $instance['number'] );
        $ignore     = apply_filters( 'gre_wnp_ignore', $instance['ignore_check']['active'] );
        $cat        = apply_filters( 'gre_wnp_cat', $instance['cat'] );
        if ( ! empty( $instance['post_type'] ) ) {
            $post_type = apply_filters( 'gre_wnp_post_type', $instance['post_type'] );
        } else {
            $post_type = apply_filters( 'gre_wnp_post_type', 'post' );
        }

        $sticky     = get_option( 'sticky_posts' );
        if ( $ignore ) {
            $gre_wnp_query = new WP_Query( array(
                'post_type' => $post_type,
                'post_status' => 'publish',
                'cat' => $cat,
                'posts_per_page' => $number,
                'ignore_sticky_posts' => 0,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
        } else {
            $gre_wnp_query = new WP_Query( array(
                'post_type' => $post_type,
                'post_status' => 'publish',
                'cat' => $cat,
                'posts_per_page' => $number,
                'post_not_in' => $sticky,
                'ignore_sticky_posts' => 1,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
        }

        //start_widget_code
        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        ?>
            <ul class="gre-wnp-lists">

                <?php if ( $gre_wnp_query->have_posts() ) : ?>
                    <?php while ( $gre_wnp_query->have_posts() ) : ?>
                        <?php
                            $gre_wnp_query->the_post();
                            $date = ( $instance['date']['active'] == true )
                                ? '<time class="date" datetime="' . get_the_time('c') . '">' . get_the_time( get_option( 'date_format' ) ) . '</time>'
                                : '';
                            if ( has_post_thumbnail() ) {
                                $thumb_id  = get_post_thumbnail_id();
                                $thumb_url = wp_get_attachment_image_src($thumb_id);
                                $thumb_url = $thumb_url[0];
                            } else {
                                $thumb_url = $this->no_thumbnail;
                            }
                        ?>
                        <li class="gre-wnp-list">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php esc_attr( the_title() ); ?>">
                                <div class="inner">
                                    <div class="inner-left">
                                        <div class="thumb" style="background-image: url(<?php echo esc_url( $thumb_url ); ?>); width: <?php echo esc_attr( $width . 'px' ); ?>; height: <?php echo esc_attr( $height . 'px' ); ?>;"></div>
                                    </div>
                                    <div class="inner-right">
                                        <?php if ( ! empty($date) ) : ?>
                                            <?php echo $date; ?>
                                        <?php endif; ?>
                                        <div class="title">
                                            <?php the_title(); ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p><?php _e( 'no post', 'gildrest-ex' ); ?></p>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        <?php

        echo $after_widget;

    }

    public function form( $instance ) {

        // define default value
        $defaults = array(
            'title'         => __('Latest Posts' , 'gildrest-ex'),
            'width'         => 84,
            'height'        => 63,
            'number'        => 5,
            'date'          => array( 'active' => false ),
            'ignore_check'  => array( 'active' => false ),
            'cat'           => null,
            'post_type'     => 'post',
        );

        $instance = wp_parse_args( $instance, $defaults );

        ?>

            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><b><?php _e('Title' , 'gildrest-ex'); ?></b></label>
                <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
            </p>

            <p>
                <b><?php _e('Thumbnail Size' , 'gildrest-ex'); ?></b><br>
                <label for="<?php echo $this->get_field_id('width'); ?>">
                    <?php _e('Width' , 'gildrest-ex'); ?>
                </label>
                <input
                    id="<?php echo $this->get_field_id('width'); ?>"
                    name="<?php echo $this->get_field_name( 'width' ); ?>"
                    type="text"
                    style="width:50px"
                    value="<?php echo esc_attr($instance['width']); ?>"
                /> px
                <br>
                <label for="<?php echo $this->get_field_id('height'); ?>">
                    <?php _e('Height' , 'gildrest-ex'); ?>
                </label>
                <input
                    id="<?php echo $this->get_field_id('height'); ?>"
                    name="<?php echo $this->get_field_name('height'); ?>"
                    type="text"
                    style="width:50px;"
                    value="<?php echo esc_attr($instance['height']); ?>"
                /> px
            </p>

            <p>
                <b><?php _e('Show posts' , 'gildrest-ex'); ?></b><br>
                <input
                    style="width:30px;"
                    id="<?php echo $this->get_field_id('number'); ?>"
                    name="<?php echo $this->get_field_name('number'); ?>"
                    type="text"
                    value="<?php echo esc_attr($instance['number']); ?>"
                />
                <label for="<?php echo $this->get_field_id('number'); ?>">
                    <?php _e('Posts' , 'gildrest-ex'); ?>
                </label>
            </p>

            <?php
                $args = array(
                    'public'   => true,
                );
                $output = 'objects';
                $operator = 'and';
                $post_types = get_post_types( $args, $output, $operator );
            ?>

            <p>
                <b><?php _e('Post types' , 'gildrest-ex'); ?></b><br>
                <?php foreach ( $post_types as $post_type ) : ?>
                    <?php if( $post_type->name !== 'attachment' ) : ?>
                        <input
                            type="radio"
                            id="<?php echo $this->get_field_name($post_type->name); ?>"
                            name="<?php echo $this->get_field_name('post_type'); ?>"
                            value="<?php echo $post_type->name; ?>"
                            <?php echo ( $instance['post_type'] == $post_type->name ) ? 'checked="checked"' : ''; ?>
                        />
                        <label for="<?php echo $this->get_field_name($post_type->name); ?>">
                            <?php echo $post_type->labels->singular_name . '(' . $post_type->name . ')'; ?>
                        </label>　
                    <?php endif; ?>
                <?php endforeach; ?>
            </p>

            <?php if( $instance['post_type'] == 'post' ) : ?>
                <p>
                    <b><?php _e('Display cateories', 'gildrest-ex'); ?></b><br>
                    <label for="<?php echo $this->get_field_id('cat'); ?>">
                        <?php _e('Categoryies ID', 'gildrest-ex'); ?>
                    </label>
                    <input
                        id="<?php echo $this->get_field_id('cat'); ?>"
                        name="<?php echo $this->get_field_name('cat'); ?>"
                        type="text"
                        class="widefat"
                        value="<?php echo esc_attr($instance['cat']); ?>"
                    />
                    <span>
                        <a target="_blank" href="<?php echo get_bloginfo('url') . '/wp-admin/edit-tags.php?taxonomy=category'; ?>">
                            <?php _e('Check the category ID' , 'gildrest-ex'); ?>
                        </a>
                    </span>
                </p>
            <?php endif; ?>

            <p>

                <b><?php _e('Showing Items' , 'gildrest-ex'); ?></b>

                <br>

                <input
                    type="checkbox"
                    class="checkbox"
                    <?php echo ($instance['date']['active']) ? 'checked="checked"' : ''; ?>
                    id="<?php echo $this->get_field_id( 'date' ); ?>"
                    name="<?php echo $this->get_field_name( 'date' ); ?>"
                />
                <label for="<?php echo $this->get_field_id( 'date' ); ?>">
                    <?php _e('Display date', 'gildrest-ex'); ?>
                </label>

                <br>

                <input
                    type="checkbox"
                    class="checkbox"
                    <?php echo ($instance['ignore_check']['active']) ? 'checked="checked"' : ''; ?>
                    id="<?php echo $this->get_field_id( 'ignore_check' ); ?>"
                    name="<?php echo $this->get_field_name( 'ignore_check' ); ?>"
                />
                <label for="<?php echo $this->get_field_id( 'ignore_check' ); ?>">
                    <?php _e('Display sticky post', 'gildrest-ex'); ?>
                </label>

            </p>


        <?php //html output end.

    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title']                  = ($this->magicquotes) ? htmlspecialchars( stripslashes(strip_tags( $new_instance['title'] )), ENT_QUOTES ) : htmlspecialchars( strip_tags( $new_instance['title'] ), ENT_QUOTES );
        $instance['width']                  = is_numeric($new_instance['width']) ? $new_instance['width'] : 10;
        $instance['height']                 = is_numeric($new_instance['height']) ? $new_instance['height'] : 10;
        $instance['number']                 = is_numeric($new_instance['number']) ? $new_instance['number'] : 5;

        if( preg_match( "/^[0-9]|,|-/", $new_instance['cat'] ) ) {
            $instance['cat']                = $new_instance['cat'];
        } else {
            $instance['cat']                = "";
        }

        $instance['date']['active']         = $new_instance['date'];
        $instance['ignore_check']['active'] = $new_instance['ignore_check']['active'];
        $instance['post_type']              = !empty($new_instance['post_type']) ? $new_instance['post_type'] : 'post';

        update_option('gildrest_ex_widget_new_posts', $instance);

        return $instance;

    }

}

class gildrest_ex_widget_new_posts_set {

    public function __construct() {
        add_action( 'widgets_init', function(){ register_widget( 'gildrest_ex_widget_new_posts' ); });
    }

}
