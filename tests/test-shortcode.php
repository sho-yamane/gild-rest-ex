<?php

class shortcode_test extends WP_UnitTestCase {

    function test_twitter() {
        $html = do_shortcode( '[twitter]@sho_yamane[/twitter]' );
        $this->assertEquals( '<a href="https://twitter.com/sho_yamane">@sho_yamane</a>', $html );
        $html = do_shortcode( '[twitter]sho_yamane[/twitter]' );
        $this->assertEquals( '<a href="https://twitter.com/sho_yamane">@sho_yamane</a>', $html );
    }

}
