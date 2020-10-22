<?php

  add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

  function my_theme_enqueue_styles() {
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', filemtime(get_template_directory() . '/style.css') );
  }

  set_theme_mod('beckett_recent_projects_count', 12);

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


  add_filter( 'register_post_type_args', function ($args, $post_type) {
    if ($post_type === 'project') {
      $args['show_in_rest'] = true;
    }

    return $args;
  }, 20, 2 );

  function mack_create_custom_image_size($sizes){
    $custom_sizes = ['extra_large' => 'Extra Large'];

    return array_merge( $sizes, $custom_sizes );
  }


  function mack_setup_theme() {
    add_image_size( 'extra_large', 1800, 0, false );
    add_filter('image_size_names_choose', 'mack_create_custom_image_size');
  }

  add_action( 'after_setup_theme', 'mack_setup_theme' );
