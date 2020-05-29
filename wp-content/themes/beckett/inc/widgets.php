<?php

global $ttrust_config;

$ttrust_config['name'] = "Beckett";


/* /////////////////////////////////////////////////////////////////////
//  Define Widgetized Areas
/////////////////////////////////////////////////////////////////////*/
register_sidebar(array(
	'name' => 'Home Template',
	'id' => 'home_content',
	'description' => __('This is the widget area that appears in the home page template.', 'themetrust'),
	'before_widget' => '<div id="%1$s" class="%2$s home-box widget-box small"><div class="inside">',
	'after_widget' => '</div></div>',
	'before_title' => '<span class="widget-title">',
	'after_title' => '</span>'
));

register_sidebar(array(
	'name' => 'Sidebar',
	'id' => 'sidebar_default',
	'description' => __('This is the default widget area for the sidebar. This will be displayed if the other sidebars have not been populated with widgets.', 'themetrust'),
	'before_widget' => '<div id="%1$s" class="%2$s sidebar-box widget-box small"><div class="inside">',
	'after_widget' => '</div></div>',
	'before_title' => '<span class="widget-title">',
	'after_title' => '</span>'
));

register_sidebar(array(
	'name' => 'Page Sidebar',
	'id' => 'sidebar_pages',
	'description' => __('Widget area for the sidebar on pages.', 'themetrust'),
	'before_widget' => '<div id="%1$s" class="%2$s sidebar-box widget-box small"><div class="inside">',
	'after_widget' => '</div></div>',
	'before_title' => '<span class="widget-title">',
	'after_title' => '</span>'
));

register_sidebar(array(
	'name' => 'Post Sidebar',
	'id' => 'sidebar_posts',
	'description' => __('Widget area for the sidebar on posts.', 'themetrust'),
	'before_widget' => '<div id="%1$s" class="%2$s sidebar-box widget-box small"><div class="inside">',
	'after_widget' => '</div></div>',
	'before_title' => '<span class="widget-title">',
	'after_title' => '</span>'
));

register_sidebar(array(
	'name' => 'Footer',
	'id' => 'footer_default',
	'description' => __('This is the default widget area for the footer. This will be displayed if the other footers have not been populated with widgets.', 'themetrust'),
	'before_widget' => '<div id="%1$s" class="small one-third %2$s footer-box widget-box small"><div class="inside">',
	'after_widget' => '</div></div>',
	'before_title' => '<span class="widget-title">',
	'after_title' => '</span>'
));

register_sidebar(array(
	'name' => 'Home Page Footer',
	'id' => 'footer_home',
	'description' => __('Widget area for the footer on the home page.', 'themetrust'),
	'before_widget' => '<div id="%1$s" class="one-third %2$s footer-box widget-box small"><div class="inside">',
	'after_widget' => '</div></div>',
	'before_title' => '<span class="widget-title">',
	'after_title' => '</span>'
));

register_sidebar(array(
	'name' => 'Page Footer',
	'id' => 'footer_pages',
	'description' => __('Widget area for the footer on pages.', 'beckett'),
	'before_widget' => '<div id="%1$s" class="one-third %2$s footer-box widget-box small"><div class="inside">',
	'after_widget' => '</div></div>',
	'before_title' => '<span class="widget-title">',
	'after_title' => '</span>'
));

register_sidebar(array(
	'name' => 'Post Footer',
	'id' => 'footer_posts',
	'description' => __('Widget area for the footer on posts.', 'beckett'),
	'before_widget' => '<div id="%1$s" class="one-third %2$s footer-box widget-box small"><div class="inside">',
	'after_widget' => '</div></div>',
	'before_title' => '<span class="widget-title">',
	'after_title' => '</span>'
));

register_sidebar(array(
	'name' => 'Portfolio Footer',
	'id' => 'footer_portfolio',
	'description' => __('Widget area for the footer on portfolio pages.', 'themetrust'),
	'before_widget' => '<div id="%1$s" class="%2$s footer-box widget-box small"><div class="inside">',
	'after_widget' => '</div></div>',
	'before_title' => '<span class="widget-title">',
	'after_title' => '</span>'
));


/* Allow widgets to use shortcodes */
add_filter('widget_text', 'do_shortcode');



/*/////////////////////////////////////////////////////////////////////
//  Recent Posts
/////////////////////////////////////////////////////////////////////*/

class TTrust_Recent_Posts extends WP_Widget {


	public function __construct(){

		global $ttrust_config;

		$widget_ops = array('classname' => 'ttrust_recent_posts', 'description' => __('Display recent posts from any category.', 'themetrust'));

		parent::__construct(
			'ttrust_recent_post_widget', // Base ID
			$ttrust_config['name'] .' '.__( 'Recent Posts', 'themetrust' ), // Name
			$widget_ops // Args
		);

	}

	public function widget($args, $instance) {

		global $ttrust_theme_name, $options;

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 10 )
			$number = 10;

		$rp_cat = $instance['rp_cat'];

		$r = new WP_Query(array('cat' => $rp_cat, 'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		if ($r->have_posts()) :
			?>
			<?php echo $args['before_widget']; ?>
			<?php echo $args['before_title'] . $title . $args['after_title']; ?>

			<ul class="widgetList">
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
					<li class="clearfix">
						<p class="title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></p>
						<span class="meta"><?php the_time(get_option('date_format')); ?> </span>
					</li>
				<?php endwhile; ?>
			</ul>

			<?php echo $args['after_widget']; ?>


			<?php
			wp_reset_query();
		endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['rp_cat'] = $new_instance['rp_cat'];

		return $instance;
	}

	public function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Posts';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;

		if (isset($instance['rp_cat'])) :
			$rp_cat = $instance['rp_cat'];
		endif;


		if (isset($instance['show_post'])) :
			$show_post = $instance['show_post'];
		endif;


		$pn_categories_obj = get_categories('hide_empty=0');
		$pn_categories = array(); ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'themetrust'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('rp_cat'); ?>"><?php _e('Category', 'themetrust'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('rp_cat'); ?>" name="<?php echo $this->get_field_name('rp_cat'); ?>">
				<option value=""><?php _e('All', 'themetrust'); ?></option>
				<?php foreach ($pn_categories_obj as $pn_cat) {
					echo '<option value="'.$pn_cat->cat_ID.'" '.selected($pn_cat->cat_ID, $rp_cat).'>'.$pn_cat->cat_name.'</option>';
				} ?>
			</select></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'themetrust'); ?></label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
			<small><?php _e('10 max', 'themetrust'); ?></small></p>
		<?php
	}
}

register_widget('TTrust_Recent_Posts');


/*/////////////////////////////////////////////////////////////////////
//  Flickr
/////////////////////////////////////////////////////////////////////*/

class TTrust_Flickr extends WP_Widget {

	public function __construct() {

		global $ttrust_config;

		$widget_ops = array('classname' => 'widget_ttrust_flickr', 'description' => 'Display flickr photos.');

		parent::__construct(
			'ttrust_flickr_widget', // Base ID
			$ttrust_config['name'].' '.__( 'Flickr', 'themetrust' ), // Name
			$widget_ops // Args
		);

	}

	public function widget($args, $instance) {

		global $options;

		$title	= empty($instance['title']) ? 'Flickr' : apply_filters('widget_title', $instance['title']);
		$user	=  $instance['user'];

		if ( !$nr = (int) $instance['flickr_nr'] )
			$nr = 6;
		else if ( $nr < 1 )
			$nr = 3;
		else if ( $nr > 15 )
			$nr = 15;

		?>
		<?php echo $args['before_widget']; ?>
		<?php echo $args['before_title'] . $title . $args['after_title']; ?>

		<div id="flickrBox" class="clearfix"></div>

		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready(function($){
				$('#flickrBox').jflickrfeed({
					limit: <?php echo $nr; ?>,
					qstrings: {
						id: '<?php echo $user; ?>'
					},
					itemTemplate:
					'<div class="flickrImage">' +
					'<a href="{{link}}" title="{{title}}">' +
					'<img src="{{image_s}}" alt="{{title}}" />' +
					'</a>' +
					'</div>'
				});
			});
			//]]>
		</script>

		<?php echo $args['after_widget']; ?>
		<?php
	}

	public function update($new_instance, $old_instance) {

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['user'] = strip_tags($new_instance['user']);
		$instance['flickr_nr'] = (int) $new_instance['flickr_nr'];

		return $new_instance;
	}

	public function form($instance) {

		global $options;

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '', 'flickr_nr' => '') );
		$title = strip_tags($instance['title']);
		$user = $instance['user'];
		if (!$nr = (int) $instance['flickr_nr']) $nr = 6;
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'themetrust'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Flickr ID:', 'themetrust'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('flickr_nr'); ?>"><?php _e('Number of photos:', 'themetrust'); ?></label>
			<input id="<?php echo $this->get_field_id('flickr_nr'); ?>" name="<?php echo $this->get_field_name('flickr_nr'); ?>" type="text" value="<?php echo $nr; ?>" size="3" /><br />
			<small><?php _e('(15 max)'); ?></small>
		</p>

		<?php
	}

}

register_widget('TTrust_Flickr');


/*/////////////////////////////////////////////////////////////////////
//  Testimonials
/////////////////////////////////////////////////////////////////////*/

class TTrust_Testimonials extends WP_Widget {

	public function __construct() {

		global $ttrust_config;

		$widget_ops = array('classname' => 'ttrust_testimonials', 'description' => __('Display a random testimonial.', 'themetrust'));

		parent::__construct(
			'ttrust_testimonials_widget', // Base ID
			$ttrust_config['name'].' '.__( 'Testimonials', 'themetrust' ), // Name
			$widget_ops // Args
		);

	}

	public function widget($args, $instance) {

		global $ttrust_theme_name, $options;

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Testimonials' : $instance['title']);


		$r = new WP_Query(array('post_type' => "testimonial", 'showposts' => 1, 'nopaging' => 0, 'post_status' => 'publish', 'orderby' => 'rand'));
		if ($r->have_posts()) :
			?>
			<?php echo $args['before_widget']; ?>
			<?php echo $args['before_title'] . $title . $args['after_title']; ?>


			<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<div class="clearfix">
				<?php the_post_thumbnail("ttrust_post_thumb_small", array('class' => '', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
				<?php the_content(); ?>
				<span class="title"><span>- <?php the_title(); ?></span></span>
			</div>
		<?php endwhile; ?>

			<?php echo $args['after_widget']; ?>

			<?php
			wp_reset_query();
		endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	public function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Testimonials';
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'themetrust'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<?php
	}
}

register_widget('TTrust_Testimonials');

/* /////////////////////////////////////////////////////////////////////
//  Mini Feature Widget
/////////////////////////////////////////////////////////////////////*/

class TTrust_Service extends WP_Widget {

	function __construct() {

		global $ttrust_config, $options;

		$widget_ops = array('classname' => 'ttrust_Service', 'description' => __('Highlight a service with text and an icon.', 'themetrust'));

		parent::__construct(
			'ttrust_service_widget', // Base ID
			$ttrust_config['name'].' '.__( 'Service', 'themetrust' ), // Name
			$widget_ops // Args
		);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$text = apply_filters( 'widget_text', $instance['text'], $instance );
		$icon = $instance['icon'];

		$link = $instance['link'];

		echo $args['before_widget'];

		if ($icon) :
			echo '<i class="fa '.$icon.'"></i>';
		endif;

		if (substr($link,0,4)=='http') :
			$url = $link;
		else :
			$url = get_permalink($link);
		endif;
		?>

		<?php
		if (!empty($title)):
			if (!empty($link)) :
				echo $args['before_title'] .'<a href="'.$url.'">'.$title.'</a>'. $args['after_title'];
			else :
				echo $args['before_title'] . $title . $args['after_title'];
			endif;
		endif;

		?>

		<?php echo wpautop($text); ?>
		<?php

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['link'] = strip_tags($new_instance['link']);

		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {

		global $ttrust_theme, $ttrust_short, $ttrust_version, $ttrust_domain, $options;

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$icon = isset($instance['icon']) ? $instance['icon'] : "";

		$text = format_to_edit($instance['text']);
		$link = isset($instance['link']) ? $instance['link'] : "";

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'themetrust'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Font Awesome Icon:', 'themetrust'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo esc_attr($icon); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'themetrust'); ?></label>
			<textarea class="widefat" rows="5" cols="10" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea><br /><small>(HTML allowed - will be wrapped by p-tags)</small></p>

		<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'themetrust'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /><br /><small>(Enter URL or post/page ID)</small></p>


		<?php
	}
}

register_widget('TTrust_Service');



function beckett_get_widgets_count( $sidebar_id )
{
	$sidebars_widgets = wp_get_sidebars_widgets();
	return (int) count( (array) $sidebars_widgets[ $sidebar_id ] );
}

function beckett_has_active_sidebar()
{
	if(is_archive() && is_active_sidebar('sidebar_posts')) : return true;
	elseif(is_home() && is_active_sidebar('sidebar_posts')) : return true;
	elseif(is_single() && is_active_sidebar('sidebar_posts')) : return true;
	elseif(is_page() && is_active_sidebar('sidebar_pages') ) : return true;
	elseif(is_search() && is_active_sidebar('sidebar_posts')) : return true;
	elseif(is_front_page() && is_active_sidebar('sidebar_home')) : return true;
	elseif(dynamic_sidebar('sidebar')) : return true;
	else :
		return false;
	endif;
}
?>