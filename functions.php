<?php

// Support Featured Images
add_theme_support( 'post-thumbnails' );

// WordPress Titles
add_theme_support( 'title-tag' );

// Add scripts and stylesheets
function add_scripts() {
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' );
}

add_action( 'wp_enqueue_scripts', 'add_scripts' );

// Add Google Fonts
function add_google_fonts() {
				wp_register_style('NotoSans', 'https://fonts.googleapis.com/css?family=Noto+Sans:400,600,700,800');
				wp_enqueue_style( 'NotoSans');
		}

add_action('wp_print_styles', 'add_google_fonts');

// Remore <p> surrounding <img> tags - https://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
function filter_ptags_on_images($content){
  return preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

// Remore <p> surrounding <iframe> tags - based on https://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
function filter_ptags_on_iframes($content){
  return preg_replace('/<p>\\s*?(<a .*?><iframe.*?><\\/a>|<iframe.*?>)?\\s*<\\/p>/s', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_iframes');

function remove_wordpress_version() {
  return '';
}
add_filter('the_generator', 'remove_wordpress_version');



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



// ~~~~~~~~~~ Custom Breadcrumbs. Adapted from (Stuart, 2013) ~~~~~~~~~~
//
// Stuart. (2013). Wordpress: creating breadcrumbs without a plugin. Retrieved from
// https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
//

// Breadcrumbs
function custom_breadcrumbs() {
       
  // Settings
  $breadcrums_id      = '';
  $breadcrums_class   = 'breadcrumbs';
  $home_title         = 'Home';
    
  // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
  $custom_taxonomy    = 'product_cat';
      
  // Get the query & post information
  global $post,$wp_query;
      
  // Do not display on the homepage
  if ( !is_front_page() ) {
      
    // Build the breadcrums
    echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
        
    // Home page
    echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        
    if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
          
      echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
          
    } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
          
      // If post is a custom post type
      $post_type = get_post_type();
        
      // If it is a custom post type display name and link
      if($post_type != 'post') {
            
        $post_type_object = get_post_type_object($post_type);
        $post_type_archive = get_post_type_archive_link($post_type);
      
        echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
        
      }
        
      $custom_tax_name = get_queried_object()->name;
      echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
          
    } else if ( is_single() ) {
          
        // If post is a custom post type
        $post_type = get_post_type();
          
        // If it is a custom post type display name and link
        if($post_type != 'post') {
              
            $post_type_object = get_post_type_object($post_type);
            $post_type_archive = get_post_type_archive_link($post_type);
          
            echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
          
        }
          
        // Get post category info
        $category = get_the_category();
          
        if(!empty($category)) {
          
            // Get last category post is in
            $last_category = end(array_values($category));
              
            // Get parent any categories and create array
            $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
            $cat_parents = explode(',',$get_cat_parents);
              
            // Loop through parent categories and store in variable $cat_display
            $cat_display = '';
            foreach($cat_parents as $parents) {
                $cat_display .= '<li class="item-cat">'.$parents.'</li>';
            }
          
        }
          
        // If it's a custom post type within a custom taxonomy
        $taxonomy_exists = taxonomy_exists($custom_taxonomy);
        if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                
            $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
            $cat_id         = $taxonomy_terms[0]->term_id;
            $cat_nicename   = $taxonomy_terms[0]->slug;
            $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
            $cat_name       = $taxonomy_terms[0]->name;
            
        }
          
        // Check if the post is in a category
        if(!empty($last_category)) {
            echo $cat_display;
            echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
        // Else if post is in a custom taxonomy
        } else if(!empty($cat_id)) {
              
            echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
            echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
          
        } else {
              
            echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
        }
          
    } else if ( is_category() ) {
            
        // Category page
        echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
            
    } else if ( is_page() ) {
            
        // Standard page
        if( $post->post_parent ){
                
            // If child page, get parents 
            $anc = get_post_ancestors( $post->ID );
                
            // Get parents in the right order
            $anc = array_reverse($anc);
                
            // Parent page loop
            if ( !isset( $parents ) ) $parents = null;
            foreach ( $anc as $ancestor ) {
                $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
            }
                
            // Display parent pages
            echo $parents;
                
            // Current page
            echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                
        } else {
                
            // Just display current page if not parents
            echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                
        }
            
    } else if ( is_tag() ) {
            
        // Tag page
            
        // Get tag information
        $term_id        = get_query_var('tag_id');
        $taxonomy       = 'post_tag';
        $args           = 'include=' . $term_id;
        $terms          = get_terms( $taxonomy, $args );
        $get_term_id    = $terms[0]->term_id;
        $get_term_slug  = $terms[0]->slug;
        $get_term_name  = $terms[0]->name;
            
        // Display the tag name
        echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . ucwords($get_term_name) . '</strong></li>';
        
    } elseif ( is_day() ) {
            
        // Day archive
            
        // Year link
        echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            
        // Month link
        echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            
        // Day display
        echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
            
    } else if ( is_month() ) {
            
        // Month Archive
            
        // Year link
        echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            
        // Month display
        echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
            
    } else if ( is_year() ) {
            
        // Display year archive
        echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
            
    } else if ( is_author() ) {
            
        // Auhor archive
            
        // Get the author information
        global $author;
        $userdata = get_userdata( $author );
            
        // Display author name
        echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
        
    } else if ( get_query_var('paged') ) {
            
        // Paginated archives
        echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
            
    } else if ( is_search() ) {
        
        // Search results page
        echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
        
    } elseif ( is_404() ) {
            
        // 404 page
        echo '<li>' . 'Error 404' . '</li>';
    }
    echo '</ul>';
  }
}
