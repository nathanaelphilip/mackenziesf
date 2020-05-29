<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script('mackenze', get_stylesheet_directory_uri() . '/mackenzie.js', ['jquery'], false , true);
});


add_action('wp_head', function () {
?>
<script src="https://use.typekit.net/jqj1itp.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<link type="text/css" rel="stylesheet" href="//fast.fonts.net/cssapi/077b2f5b-d07e-47ab-b435-363871b5b5be.css"/>
<?php
}, 999);
