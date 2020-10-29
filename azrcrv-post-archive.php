<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name: Post Archive
 * Description: Posts Archive (multi-site compatible) based on Ozh Tweet Archive Theme; archive can be displayed in a widget, post or page.
 * Version: 1.2.0
 * Author: azurecurve
 * Author URI: https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/post-archive/
 * Text Domain: post-archive
 * Domain Path: /languages
 * ------------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.html.
 * ------------------------------------------------------------------------------
 */

// Prevent direct access.
if (!defined('ABSPATH')){
	die();
}

// include plugin menu
require_once(dirname( __FILE__).'/pluginmenu/menu.php');
add_action('admin_init', 'azrcrv_create_plugin_menu_pa');

// include update client
require_once(dirname(__FILE__).'/libraries/updateclient/UpdateClient.class.php');

/**
 * Setup registration activation hook, actions, filters and shortcodes.
 *
 * @since 1.0.0
 *
 */
// add actions
add_action('admin_menu', 'azrcrv_pa_create_admin_menu');
add_action('widgets_init', 'azrcrv_pa_create_widget');
add_action('plugins_loaded', 'azrcrv_pa_load_languages');

// add filters
add_filter('plugin_action_links', 'azrcrv_pa_add_plugin_action_link', 10, 2);
add_filter('the_posts', 'azrcrv_pa_check_for_shortcode', 10, 2);
add_filter('codepotent_update_manager_image_path', 'azrcrv_pa_custom_image_path');
add_filter('codepotent_update_manager_image_url', 'azrcrv_pa_custom_image_url');

// add shortcodes
add_shortcode('post-archive', 'azrcrv_pa_display_shortcode');
add_shortcode('posts-archive', 'azrcrv_pa_display_shortcode');
add_shortcode('POST-ARCHIVE', 'azrcrv_pa_display_shortcode');
add_shortcode('POSTS-ARCHIVE', 'azrcrv_pa_display_shortcode');

/**
 * Load language files.
 *
 * @since 1.0.0
 *
 */
function azrcrv_pa_load_languages() {
    $plugin_rel_path = basename(dirname(__FILE__)).'/languages';
    load_plugin_textdomain('post-archive', false, $plugin_rel_path);
}

/**
 * Check if shortcode on current page and then load css and jqeury.
 *
 * @since 1.0.0
 *
 */
function azrcrv_pa_check_for_shortcode($posts){
    if (empty($posts)){
        return $posts;
	}
	
	// array of shortcodes to search for
	$shortcodes = array(
						'post-archive','posts-archive','POST-ARCHIVE','POSTS-ARCHIVE'
						);
	
    // loop through posts
    $found = false;
    foreach ($posts as $post){
		// loop through shortcodes
		foreach ($shortcodes as $shortcode){
			// check the post content for the shortcode
			if (has_shortcode($post->post_content, $shortcode)){
				$found = true;
				// break loop as shortcode found in page content
				break 2;
			}
		}
	}
 
    if ($found){
		// as shortcode found call functions to load css and jquery
        azrcrv_pa_load_css();
    }
    return $posts;
}

/**
 * Load CSS.
 *
 * @since 1.0.0
 *
 */
function azrcrv_pa_load_css(){
	wp_enqueue_style('azrcrv-pa', plugins_url('assets/css/style.css', __FILE__), '', '1.0.0');
}

/**
 * Custom plugin image path.
 *
 * @since 1.2.0
 *
 */
function azrcrv_pa_custom_image_path($path){
    if (strpos($path, 'azrcrv-post-archive') !== false){
        $path = plugin_dir_path(__FILE__).'assets/pluginimages';
    }
    return $path;
}

/**
 * Custom plugin image url.
 *
 * @since 1.2.0
 *
 */
function azrcrv_pa_custom_image_url($url){
    if (strpos($url, 'azrcrv-post-archive') !== false){
        $url = plugin_dir_url(__FILE__).'assets/pluginimages';
    }
    return $url;
}

/**
 * Add Post Archive action link on plugins page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_pa_add_plugin_action_link($links, $file){
	static $this_plugin;

	if (!$this_plugin){
		$this_plugin = plugin_basename(__FILE__);
	}

	if ($file == $this_plugin){
		$settings_link = '<a href="'.admin_url('admin.php?page=azrcrv-pa').'"><img src="'.plugins_url('/pluginmenu/images/Favicon-16x16.png', __FILE__).'" style="padding-top: 2px; margin-right: -5px; height: 16px; width: 16px;" alt="azurecurve" />'.esc_html__('Settings' ,'post-archive').'</a>';
		array_unshift($links, $settings_link);
	}

	return $links;
}

/**
 * Add to menu.
 *
 * @since 1.0.0
 *
 */
function azrcrv_pa_create_admin_menu(){
	//global $admin_page_hooks;
	
	add_submenu_page("azrcrv-plugin-menu"
						,esc_html__("Post Archive Settings", "post-archive")
						,esc_html__("Post Archive", "post-archive")
						,'manage_options'
						,'azrcrv-pa'
						,'azrcrv_pa_display_options');
}

/**
 * Display Settings page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_pa_display_options(){
	if (!current_user_can('manage_options')){
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'post-archive'));
    }
	
	// Retrieve plugin configuration options from database
	$options = get_option('azrcrv-pa');
	?>
	<div id="azrcrv-pa-general" class="wrap">
			<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		<p>
			<?php esc_html_e('The Posts Archive plugin allows a post archive to be displayed using the plugins widget or in posts and pages through the use of the <strong>post-archive</strong> shortcode. ', 'post-archive'); ?>
		</p>
	</div>
	<?php
}

/**
 * Create post archive widget.
 *
 * @since 1.0.0
 *
 */
function azrcrv_pa_create_widget(){
	register_widget('azrcrv_pa_register_archive');
}

/**
 * Create widget class.
 *
 * @since 1.0.0
 *
 */
class azrcrv_pa_register_archive extends WP_Widget {
	/**
	 * Widget constructor.
	 *
	 * @since 1.0.0
	 */
	function __construct(){
		add_action('wp_enqueue_scripts', array($this, 'enqueue'));
		
		// Widget creation function
		parent::__construct('azrcrv-pa',
							 'Post Archive by azurecurve',
							 array('description' =>
									esc_html__('Displays Posts Archive', 'post-archive')));
	}

	/**
	 * enqueue function.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue(){
		// Enqueue Styles
		wp_enqueue_style('azrcrv-pa', plugins_url('assets/css/style.css', __FILE__), '', '1.0.0');
	}

	/**
	 * Display widget form in admin.
	 *
	 * @since 1.0.0
	 */
	function form($instance){
		// Retrieve previous values from instance
		// or set default values if not present
		$widget_title = (!empty($instance['azc_pa_title']) ? 
							esc_attr($instance['azc_pa_title']) :
							esc_html__('Posts Archive', 'post-archive'));
		?>

		<!-- Display field to specify title  -->
		<p>
			<label for="<?php echo 
						$this->get_field_id('azc_pa_title'); ?>">
			<?php echo 'Widget Title:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id('azc_pa_title'); ?>"
					name="<?php echo $this->get_field_name('azc_pa_title'); ?>"
					value="<?php echo $widget_title; ?>" />			
			</label>
		</p> 

		<?php
	}

	/**
	 * Validate user input.
	 *
	 * @since 1.0.0
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['azc_pa_title'] =
			strip_tags($new_instance['azc_pa_title']);

		return $instance;
	}
	
	/**
	 * Display post archive widget on front end.
	 *
	 * @since 1.0.0
	 */
	function widget ($args, $instance){
		// Extract members of args array as individual variables
		extract($args);

		// Display widget title
		echo $before_widget;
		echo $before_title;
		$widget_title = (!empty($instance['azc_pa_title']) ? 
					esc_attr($instance['azc_pa_title']) :
					esc_html__('Posts Archive', 'post-archive'));
		echo apply_filters('widget_title', $widget_title);
		echo $after_title; 

		global $wpdb;
		
		$where = "WHERE post_type = 'post' AND post_status = 'publish'";
		$query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY YEAR DESC, MONTH ASC";
		$_archive = $wpdb->get_results($query);

		$last_year  = (int) $_archive[0]->year;
		$first_year = (int) $_archive[ count($_archive) - 1 ]->year;

		$archive    = array();
		$max        = 0;
		$year_total = array();
		
		foreach($_archive as $data){
			if(!isset($year_total[ $data->year ])){
				$year_total[ $data->year ] = 0;
			}
			$archive[ $data->year ][ $data->month ] = $data->posts;
			$year_total[ $data->year ] += $data->posts;
			$max = max($max, $data->posts);
		}
		unset($_archive);

		for ($year = $last_year; $year >= $first_year; $year--){
			echo '<div class="azrcrv-pa-widget-archive-year">';
			echo '<span class="azrcrv-pa-widget-archive-year-label">'.$year;
			if(isset($year_total[$year])){
				echo '<span class="azrcrv-pa-widget-archive-year-count">'.$year_total[$year].' '.esc_html__('posts', 'post-archive').'</span>';
			}
			echo '</span>';
			echo '<ol class="azrcrv-pa-widget-ordered-list">';
			for ($month = 1; $month <= 12; $month++){
				$num = isset($archive[ $year ][ $month ]) ? $archive[ $year ][ $month ] : 0;
				$empty = $num ? 'azrcrv-pa-widget-not-empty' : 'azrcrv-pa-widget-empty';
				echo "<li class='$empty'>";
				$height = 100 - max(floor($num / $max * 100), 20);
				if($num){
					$url = get_month_link($year, $month);
					$m = str_pad($month, 2, "0", STR_PAD_LEFT);
					echo "<a href='".esc_url($url)."' title='$m/$year : $num ".esc_html__('posts', 'post-archive')."'><span class='azrcrv-pa-widget-bar-wrap'><span class='azrcrv-pa-widget-bar' style='height:$height%'></span></span>";
					echo "<span class='azrcrv-pa-widget-label'>".$m."</span>";
					echo "</a>";
				}
				echo '</li>';
			}
			echo '</ol>';
			echo "</div>";
		}
		// Reset post data query
		wp_reset_query();

		echo $after_widget;
	}
}

/**
 * Display post archive in shortcode.
 *
 * @since 1.0.0
 *
 */
function azrcrv_pa_display_shortcode($atts){
	global $wpdb;
	
	$output = '';
	
	$where = "WHERE post_type = 'post' AND post_status = 'publish'";
	$query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY YEAR DESC, MONTH ASC";
	$_archive = $wpdb->get_results($query);

	$last_year  = (int) $_archive[0]->year;
	$first_year = (int) $_archive[ count($_archive) - 1 ]->year;

	$archive    = array();
	$max        = 0;
	$year_total = array();
	
	foreach($_archive as $data){
		if(!isset($year_total[ $data->year ])){
			$year_total[ $data->year ] = 0;
		}
		$archive[ $data->year ][ $data->month ] = $data->posts;
		$year_total[ $data->year ] += $data->posts;
		$max = max($max, $data->posts);
	}
	unset($_archive);
	
	for ($year = $last_year; $year >= $first_year; $year--){
		$output .= '<div class="azrcrv-pa-page-archive-year">';
		$output .=  '<span class="azrcrv-pa-page-archive-year-label">'.$year;
		if(isset($year_total[$year])){
			$output .=  '<span class="azrcrv-pa-page-archive-year-count">'.$year_total[$year].' '.esc_html__('posts', 'post-archive').'</span>';
		}
		$output .=  '</span>';
		$output .=  '<ol class="azrcrv-pa-page-ordered-list">';
		for ($month = 1; $month <= 12; $month++){
			$num = isset($archive[ $year ][ $month ]) ? $archive[ $year ][ $month ] : 0;
			$empty = $num ? 'azrcrv-pa-page-not-empty' : 'azrcrv-pa-page-empty';
			$output .=  "<li class='$empty'>";
			$height = 100 - max(floor($num / $max * 100), 20);
			if($num){
				$url = get_month_link($year, $month);
				$m = str_pad($month, 2, "0", STR_PAD_LEFT);
				$output .=  "<a href='".esc_url($url)."' title='$m/$year : $num ".esc_html__('posts', 'post-archive')."'><span class='azrcrv-pa-page-bar-wrap'><span class='azrcrv-pa-page-bar' style='height:$height%'></span></span>";
				$output .=  "<span class='azrcrv-pa-page-label'>".$m."</span>";
				$output .=  "</a>";
			}
			$output .=  '</li>';
		}
		$output .=  '</ol>';
		$output .=  "</div>";
	}
	// Reset post data query
	wp_reset_query();
	
	return $output;
}

?>