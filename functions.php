<?php

// Support Featured Images
add_theme_support( 'post-thumbnails' );

// WordPress Titles
add_theme_support( 'title-tag' );

// Add scripts and stylesheets
function startwordpress_scripts() {
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' );
}

add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );

// Add Google Fonts
function startwordpress_google_fonts() {
				wp_register_style('NotoSans', 'http://fonts.googleapis.com/css?family=Noto+Sans:400,600,700,800');
				wp_enqueue_style( 'NotoSans');
		}

add_action('wp_print_styles', 'startwordpress_google_fonts');


// ~~~~~~~~~~ Custom Post Types ~~~~~~~~~~

// project - Custom Post Type
function create_project() {
	register_post_type( 'project',
			array(
			'labels' => array(
					'name' => __( 'Projects' ),
					'singular_name' => __( 'Project' ),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array(
					'title',
					'editor',
					'thumbnail',
				  //'custom-fields',
          'revisions'
			), 
			'taxonomies'   => array(
				'post_tag',
				//'category',
			)
	));
  //register_taxonomy_for_object_type( 'category', 'project' );
	register_taxonomy_for_object_type( 'post_tag', 'project' );
}
add_action( 'init', 'create_project' );





// ~~~~~~~~~~ Custom Fields ~~~~~~~~~~

// For project

add_action("admin_init", "admin_init");
add_action('save_post', 'save_extra_fields');

function admin_init(){
  add_meta_box("projInfo-meta", "Project Details", "meta_options", "project", "side", "low");
}
  
  
function meta_options(){
  global $post;
  $custom = get_post_custom($post->ID);
  $tagline = $custom["tagline"][0];
  $location = $custom["location"][0];
  $for = $custom["for"][0];
  $date = $custom["date"][0];
  $url = $custom["url"][0];
  $key_color = $custom["key_color"][0];
?>
<div class="inside">
  <p>
    <label for="tagline">Tagline (max 100 chars):</label>
    <input type="text" maxlength="100" style="width:100%;" id="tagline" name="tagline" value="<?php echo $tagline; ?>" />
  </p>
  <p>
    <label for="location">Location:</label>
    <input type="text" maxlength="35" style="width:100%;" id="location" name="location" value="<?php echo $location; ?>" />
  </p>
  <p>
    <label for="for">For:</label>
    <input type="text" maxlength="35" style="width:100%;" id="location" name="for" value="<?php echo $for; ?>" />
  </p>
  <p>
    <label for="date">Date:</label>
    <input type="date" style="width:100%;" id="date" name="date" value="<?php echo $date; ?>" />
  </p>
  <p>
    <label for="url">URL:</label>
    <input type="url" style="width:100%;" id="url" name="url" value="<?php echo $url; ?>" />
  </p>
  <p>
    <label for="key_color">Colour:</label>
    <input type="color" maxlength="6" style="width:100%;" id="key_color" name="key_color" value="<?php echo $key_color; ?>" />
  </p>
</div>
<?php
}
 
 
function save_extra_fields(){
  global $post;
  update_post_meta($post->ID, "tagline", $_POST["tagline"]);
  update_post_meta($post->ID, "location", $_POST["location"]);
  update_post_meta($post->ID, "for", $_POST["for"]);
  update_post_meta($post->ID, "date", $_POST["date"]);
  update_post_meta($post->ID, "url", $_POST["url"]);
  update_post_meta($post->ID, "key_color", $_POST["key_color"]);
}

