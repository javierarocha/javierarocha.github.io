<?php
/**
 * Ample functions and definitions
 *
 * @package ThemeGrill
 * @subpackage Ample Pro
 * @since Ample 1.0
 */

if ( ! function_exists( 'ample_option' ) ) :
/**
 * Ample options
 */
function ample_option( $name, $default = false ) {

  $ample_options = get_option( 'ample' );

  if( isset( $ample_options[$name] ) ) {
     return $ample_options[$name];
  }
  else {
     return $default;
  }
}
endif;

add_action( 'wp_enqueue_scripts', 'ample_scripts' );
/**
 * Enqueue scripts and styles.
 */
function ample_scripts() {
   // Load bxslider CSS
   wp_enqueue_style( 'ample-bxslider', get_template_directory_uri().'/js/jquery.bxslider/jquery.bxslider.css', array(), '4.0' );

   // Load Google Fonts
   $ample_googlefonts = array();
   array_push( $ample_googlefonts, ample_option( 'ample_site_title_font', 'Roboto+Slab:700,400' ) );
   array_push( $ample_googlefonts, ample_option( 'ample_site_tagline_font', 'Roboto+Slab:700,400' ) );
   array_push( $ample_googlefonts, ample_option( 'ample_primary_menu_font', 'Roboto:400,300,100' ) );
   array_push( $ample_googlefonts, ample_option( 'ample_titles_font', 'Roboto+Slab:700,400' ) );
   array_push( $ample_googlefonts, ample_option( 'ample_content_font', 'Roboto:400,300,100' ) );

   $ample_googlefonts = array_unique( $ample_googlefonts );
   $ample_googlefonts = implode("|", $ample_googlefonts);

   wp_enqueue_style( 'ample-google-fonts', '//fonts.googleapis.com/css?family='.$ample_googlefonts );

   // Load fontawesome
   wp_enqueue_style( 'ample-fontawesome', get_template_directory_uri().'/font-awesome/css/font-awesome.min.css', array(), '4.2.0' );

   /**
   * Loads our main stylesheet.
   */
   wp_enqueue_style( 'ample-style', get_stylesheet_uri() );

   if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
   }

   // Register bxslider Script
   wp_register_script( 'ample-bxslider', get_template_directory_uri() . '/js/jquery.bxslider/jquery.bxslider.min.js', array( 'jquery' ), false, true );

   $slider = 0;
   $num_of_slides = ample_option( 'ample_slider_number', '4' );
   for($i=1; $i<=$num_of_slides; $i++) {
      $slider_image = ample_option('ample_slider_image' . $i, '');
      if ( !empty($slider_image)) $slider++;
   }

   if ( ($slider > 1) && ample_option( 'ample_activate_slider', '0' ) == '1' && ( is_front_page() || ample_option( 'ample_slider_status', 'front_page' ) == 'all_page' ) ) {
   wp_enqueue_script( 'ample-slider', get_template_directory_uri() . '/js/slider-setting.js', array( 'ample-bxslider' ), false, true );
   }
   wp_enqueue_script( 'ample-custom', get_template_directory_uri() . '/js/theme-custom.js', array( 'jquery' ), false, true );

   wp_enqueue_script( 'ample-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), false, true );

   wp_enqueue_script( 'ample-smooth-scroll', get_template_directory_uri() . '/js/jquery.malihu.PageScroll2id.min.js', array( 'jquery' ), false, true );

   $enable_sticky_menu = ample_option( 'ample_activate_sticky_menu', '0' );
   wp_localize_script(
      'ample-custom',
      'ampleScriptParam',
      array( 'enable_sticky_menu' => $enable_sticky_menu ) );
}

/**************************************************************************************/

// Add admin scripts
add_action('admin_enqueue_scripts', 'ample_image_uploader');

function ample_image_uploader() {
   //For image uploader
   wp_enqueue_media();
   wp_enqueue_script('ample-script', get_template_directory_uri() . '/js/image-uploader.js', false, '1.0', true);

   //Enqueuing some styles.
   wp_enqueue_style( 'ample-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css' );

   //For Color Picker
   wp_enqueue_style( 'wp-color-picker' );
   wp_enqueue_script('ample-color-picker', get_template_directory_uri() . '/js/color-picker.js', array( 'wp-color-picker' ), false);
}

/**************************************************************************************/

add_action( 'pre_get_posts', 'ample_exclude_category' );
/**
 * Function to exclude category
 */
function ample_exclude_category( $query ) {
   $ample_hide_categories = array();
   $ample_cat_num = ample_option( 'ample_hide_category', '');
   if( !empty( $ample_cat_num ) ) {
      if( is_array( $ample_cat_num ) ) {
         foreach( $ample_cat_num as $key => $value ) {
            if( $value ) {
               array_push( $ample_hide_categories, $key );
            }
         }
      }
      else {
         $ample_hide_categories = explode( ',', $ample_cat_num );
      }
   }

   if ( $query->is_home() && $query->is_main_query() ) {
      $query->set( 'category__not_in', $ample_hide_categories );
   }
}

/**************************************************************************************/

// Adding the support for the entry-title tag for Google Rich Snippets
function ample_add_mod_hatom_data($content) {
   $title = get_the_title();
   if (is_single()) {
      $content .= '<div class="extra-hatom-entry-title"><span class="entry-title">' . $title . '</span></div>';
   }
   return $content;
}

add_filter('the_content', 'ample_add_mod_hatom_data');

/**************************************************************************************/

if ( ! function_exists( '_wp_render_title_tag' ) ) :
/**
 * Add backwards compatibility of title tag for older versions
 */
add_action( 'wp_head', 'ample_render_title' );

function ample_render_title() { ?>
   <title><?php wp_title( '|', true, 'right' ); ?></title>
<?php }
endif;


/****************************************************************************************/

if ( ! function_exists( 'ample_font_size_range_generator' ) ) :
/**
 * Function to generate font size range for font size options.
 */
function ample_font_size_range_generator( $start_range, $end_range ) {
   $range_string = array();
   for( $i = $start_range; $i <= $end_range; $i++ ) {
      $range_string[$i] = $i;
   }
   return $range_string;
}
endif;

/**************************************************************************************/

/* Register shortcodes. */
add_action( 'init', 'ample_add_shortcodes' );
/**
 * Creates new shortcodes for use in any shortcode-ready area.  This function uses the add_shortcode()
 * function to register new shortcodes with WordPress.
 *
 * @uses add_shortcode() to create new shortcodes.
 */
function ample_add_shortcodes() {
   /* Add theme-specific shortcodes. */
   add_shortcode( 'the-year', 'ample_the_year_shortcode' );
   add_shortcode( 'site-link', 'ample_site_link_shortcode' );
   add_shortcode( 'wp-link', 'ample_wp_link_shortcode' );
   add_shortcode( 'tg-link', 'ample_themegrill_link_shortcode' );
}

/**
 * Shortcode to display the current year.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function ample_the_year_shortcode() {
   return date( 'Y' );
}

/**
 * Shortcode to display a link back to the site.
 *
 * @uses get_bloginfo() Gets the site link
 * @return string
 */
function ample_site_link_shortcode() {
   return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}

/**
 * Shortcode to display a link to WordPress.org.
 *
 * @return string
 */
function ample_wp_link_shortcode() {
   return '<a href="'.esc_url( 'http://wordpress.org' ).'" target="_blank" title="' . esc_attr__( 'WordPress', 'ample' ) . '"><span>' . __( 'WordPress', 'ample' ) . '</span></a>';
}

/**
 * Shortcode to display a link to ample.com.
 *
 * @return string
 */
function ample_themegrill_link_shortcode() {
   return '<a href="'.esc_url( 'http://themegrill.com' ).'" target="_blank" title="'.esc_attr__( 'ThemeGrill', 'ample' ).'" ><span>'.__( 'ThemeGrill', 'ample') .'</span></a>';
}
add_action( 'ample_footer_copyright', 'ample_footer_copyright', 10 );
/**
 * Function to show the footer info, copyright information
 */
if ( ! function_exists( 'ample_footer_copyright' ) ) :
function ample_footer_copyright() {
   $default_footer_value = ample_option( 'ample_footer_editor', __( 'Copyright &copy; ', 'ample' ).'[the-year] [site-link] '.__( 'Theme by: ', 'ample' ).'[tg-link] '.__( 'Powered by: ', 'ample' ).'[wp-link]' );
   $ample_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';
   echo do_shortcode( $ample_footer_copyright );
}
endif;

/**************************************************************************************/

add_action( 'admin_head', 'ample_favicon' );
add_action( 'wp_head', 'ample_favicon' );
/**
 * Fav icon for the site
 */
function ample_favicon() {
   if ( ample_option( 'ample_activate_favicon', '0' ) == '1' ) {
      $ample_favicon = ample_option( 'ample_favicon', '' );
      $ample_favicon_output = '';
      if ( !empty( $ample_favicon ) ) {
         $ample_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $ample_favicon ).'" type="image/x-icon" />';
      }
      echo $ample_favicon_output;
   }
}

/**************************************************************************************/

add_filter( 'excerpt_length', 'ample_excerpt_length' );
/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function ample_excerpt_length( $length ) {
   $excerpt_length = ample_option( 'ample_excerpt_words', '40' );
   return $excerpt_length;
}

add_filter( 'excerpt_more', 'ample_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function ample_continue_reading() {
   return '<a class="more-link" href="'.get_permalink().'" title="'.the_title_attribute('echo=0'). '"><span>'.ample_option( 'ample_read_more_text', __( 'Read more', 'ample' ) ).'</span></a>';
}

/****************************************************************************************/

/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be medium from thumbnail to be used in WordPress gallery as a default size
 */
function ample_gallery_atts( $out, $pairs, $atts ) {
   $atts = shortcode_atts( array(
   'size' => 'medium',
   ), $atts );

   $out['size'] = $atts['size'];

   return $out;
}
add_filter( 'shortcode_atts_gallery', 'ample_gallery_atts', 10, 3 );

/**************************************************************************************/

add_filter( 'body_class', 'ample_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function ample_body_class( $classes ) {
   global $post;

   if( $post ) { $layout_meta = get_post_meta( $post->ID, 'ample_page_layout', true ); }

   if( is_home() ) {
      $queried_id = get_option( 'page_for_posts' );
      $layout_meta = get_post_meta( $queried_id, 'ample_page_layout', true );
   }

   if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }

   $ample_default_layout = ample_option( 'ample_default_layout', 'right_sidebar' );
   $ample_default_page_layout = ample_option( 'ample_pages_default_layout', 'right_sidebar' );
   $ample_default_post_layout = ample_option( 'ample_single_posts_default_layout', 'right_sidebar' );
   $ample_default_woo_layout = ample_option( 'ample_woocommerce_layout', 'right_sidebar' );

   if( $layout_meta == 'default_layout' ) {
      if( is_page() ) {
         if( $ample_default_page_layout == 'right_sidebar' ) { $classes[] = ''; }
         elseif( $ample_default_page_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
         elseif( $ample_default_page_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
         elseif( $ample_default_page_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
         elseif( $ample_default_page_layout == 'both_sidebar' ) { $classes[] = 'both-sidebar'; }
      }
      elseif( is_single() ) {
         if( $ample_default_post_layout == 'right_sidebar' ) { $classes[] = ''; }
         elseif( $ample_default_post_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
         elseif( $ample_default_post_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
         elseif( $ample_default_post_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
         elseif( $ample_default_post_layout == 'both_sidebar' ) { $classes[] = 'both-sidebar'; }
      }
      elseif( function_exists( 'ample_is_in_woocommerce_page' ) && ample_is_in_woocommerce_page() ) {
         if( $ample_default_woo_layout == 'right_sidebar' ) { $classes[] = ''; }
         elseif( $ample_default_woo_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
         elseif( $ample_default_woo_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
         elseif( $ample_default_woo_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
         elseif( $ample_default_woo_layout == 'both_sidebar' ) { $classes[] = 'both-sidebar'; }
      }
      elseif( $ample_default_layout == 'right_sidebar' ) { $classes[] = ''; }
      elseif( $ample_default_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
      elseif( $ample_default_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
      elseif( $ample_default_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
      elseif( $ample_default_layout == 'both_sidebar' ) { $classes[] = 'both-sidebar'; }
   }
   elseif( $layout_meta == 'right_sidebar' ) { $classes[] = ''; }
   elseif( $layout_meta == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
   elseif( $layout_meta == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
   elseif( $layout_meta == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
   elseif( $layout_meta == 'both_sidebar' ) { $classes[] = 'both-sidebar'; }

   if( ample_option( 'ample_site_layout', 'wide' ) == 'wide' ) {
      $classes[] = 'wide';
   }
   else {
      $classes[] = '';
   }

   if( is_page_template( 'page-templates/template-business.php' ) ) {
      $classes[] = 'business-template';
   }

   if( ample_option( 'ample_activate_sticky_menu', '0' ) == '1' ) {
      $classes[] = 'one-page-menu-active';
   }

   return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'ample_both_sidebar_select' ) ) :
/**
 * Fucntion to select the sidebar
 */
function ample_both_sidebar_select() {
   global $post;

   if( $post ) { $layout_meta = get_post_meta( $post->ID, 'ample_page_layout', true ); }

   if( is_home() ) {
      $queried_id = get_option( 'page_for_posts' );
      $layout_meta = get_post_meta( $queried_id, 'ample_page_layout', true );
   }

   if( empty( $layout_meta ) || is_archive() || is_search() ) {
      $layout_meta = 'default_layout';
   }

   $ample_default_layout = ample_option( 'ample_default_layout', 'right_sidebar' );
   $ample_default_page_layout = ample_option( 'ample_pages_default_layout', 'right_sidebar' );
   $ample_default_post_layout = ample_option( 'ample_single_posts_default_layout', 'right_sidebar' );
   $ample_default_woo_layout = ample_option( 'ample_woocommerce_layout', 'right_sidebar' );

   if( $layout_meta == 'default_layout' ) {
      if( is_page() ) {
         if ( $ample_default_page_layout == 'both_sidebar' ) { get_sidebar( 'both' ); }
      }
      elseif( is_single() ) {
         if ( $ample_default_post_layout == 'both_sidebar' ) { get_sidebar( 'both' ); }
      }
      elseif( function_exists( 'ample_is_in_woocommerce_page' ) && ample_is_in_woocommerce_page() ) {
         if ( $ample_default_woo_layout == 'both_sidebar' ) { get_sidebar( 'both' ); }
      }
      elseif ( $ample_default_layout == 'both_sidebar' ) { get_sidebar( 'both' ); }
   }
   elseif( $layout_meta == 'both_sidebar' ) { get_sidebar( 'both' ); }
}
endif;


/****************************************************************************************/

if ( ! function_exists( 'ample_sidebar_select' ) ) :
/**
 * Fucntion to select the sidebar
 */
function ample_sidebar_select() {
   global $post;

   if( $post ) { $layout_meta = get_post_meta( $post->ID, 'ample_page_layout', true ); }

   if( is_home() ) {
      $queried_id = get_option( 'page_for_posts' );
      $layout_meta = get_post_meta( $queried_id, 'ample_page_layout', true );
   }

   if( empty( $layout_meta ) || is_archive() || is_search() ) {
      $layout_meta = 'default_layout';
   }

   $ample_default_layout = ample_option( 'ample_default_layout', 'right_sidebar' );
   $ample_default_page_layout = ample_option( 'ample_pages_default_layout', 'right_sidebar' );
   $ample_default_post_layout = ample_option( 'ample_single_posts_default_layout', 'right_sidebar' );

   if( $layout_meta == 'default_layout' ) {
      if( is_page() ) {
         if( $ample_default_page_layout == 'right_sidebar' || $ample_default_page_layout == 'both_sidebar' ) { get_sidebar(); }
         elseif ( $ample_default_page_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
      }
      elseif( is_single() ) {
         if( $ample_default_post_layout == 'right_sidebar' || $ample_default_post_layout == 'both_sidebar' ) { get_sidebar(); }
         elseif ( $ample_default_post_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
      }
      elseif( $ample_default_layout == 'right_sidebar' || $ample_default_layout == 'both_sidebar' ) { get_sidebar(); }
      elseif ( $ample_default_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
   }
   elseif( $layout_meta == 'right_sidebar' || $layout_meta == 'both_sidebar' ) { get_sidebar(); }
   elseif( $layout_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }
}
endif;

/**************************************************************************************/

if ( ! function_exists( 'ample_meta_select' ) ) :
/**
 * Fucntion to select Meta
 */
function ample_meta_select() {
   if ( 'post' == get_post_type() ) : ?>
      <div class="entry-meta clearfix">
         <span class="author vcard"><i class="fa fa-aw fa-user"></i>
            <span class="fn"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
         </span>

         <?php
         $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
         if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
         }
         $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
         );
         printf( __( '<span class="entry-date"><i class="fa fa-aw fa-calendar-o"></i> <a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'ample' ),
            esc_url( get_permalink() ),
            esc_attr( get_the_time() ),
            $time_string
         ); ?>

         <?php if( has_category() ) { ?>
            <span class="category"><i class="fa fa-aw fa-folder-open"></i><?php the_category(', '); ?></span>
         <?php } ?>

         <?php if ( comments_open() ) { ?>
            <span class="comments"><i class="fa fa-aw fa-comment"></i><?php comments_popup_link( __( 'No Comments', 'ample' ), __( '1 Comment', 'ample' ), __( '% Comments', 'ample' ), '', __( 'Comments Off', 'ample' ) ); ?></span>
         <?php } ?>
      </div>
   <?php endif;
}
endif;

/**************************************************************************************/

add_action('admin_init','ample_textarea_sanitization_change', 100);
/**
 * Override the default textarea sanitization.
 */
function ample_textarea_sanitization_change() {
   remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
   add_filter( 'of_sanitize_textarea', 'ample_sanitize_textarea_custom' );
}

/**
 * sanitize the input
 */
function ample_sanitize_textarea_custom($input) {
   $output = wp_filter_nohtml_kses( $input );
   return $output;
}

/**************************************************************************************/

if ( ! function_exists( 'ample_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function ample_comment( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment;
   switch ( $comment->comment_type ) :
      case 'pingback' :
      case 'trackback' :
      // Display trackbacks differently than normal comments.
   ?>
   <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
      <p><?php _e( 'Pingback:', 'ample' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'ample' ), '<span class="edit-link">', '</span>' ); ?></p>
   <?php
         break;
      default :
      // Proceed with normal comments.
      global $post;
   ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment">
         <header class="comment-meta comment-author vcard">
            <?php
               echo get_avatar( $comment, 74 );
               printf( '<div class="comment-author-link"><i class="fa fa-user"></i>%1$s%2$s</div>',
                  get_comment_author_link(),
                  // If current post author is also comment author, make it known visually.
                  ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'ample' ) . '</span>' : ''
               );
               printf( '<div class="comment-date-time"><i class="fa fa-calendar-o"></i>%1$s</div>',
                  sprintf( __( '%1$s at %2$s', 'ample' ), get_comment_date(), get_comment_time() )
               );
               printf( '<a class="comment-permalink" href="%1$s"><i class="fa fa-link"></i>Permalink</a>', esc_url( get_comment_link( $comment->comment_ID ) ) );
               edit_comment_link();
            ?>
         </header><!-- .comment-meta -->

         <?php if ( '0' == $comment->comment_approved ) : ?>
            <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ample' ); ?></p>
         <?php endif; ?>

         <section class="comment-content comment">
            <?php comment_text(); ?>
            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'ample' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
         </section>

      </article><!-- #comment -->
   <?php
      break;
   endswitch; // end comment_type check
}
endif;

/**************************************************************************************/

add_action('wp_head', 'ample_custom_css');
/**
 * Hooks the Custom Internal CSS to head section
 */
function ample_custom_css() {
   $ample_internal_css = '';
   $primary_color = ample_option( 'ample_primary_color', '#80abc8' );
   if( $primary_color != '#80abc8' ) {
      $ample_internal_css = ' blockquote{border-left:3px solid '.$primary_color.'}.ample-button,button,input[type=button],input[type=reset],input[type=submit]{background-color:'.$primary_color.'}a{color:'.$primary_color.'}.main-navigation .menu>ul>li.current_page_ancestor,.main-navigation .menu>ul>li.current_page_item,.main-navigation .menu>ul>li:hover,.main-navigation ul.menu>li.current-menu-ancestor,.main-navigation ul.menu>li.current-menu-item,.main-navigation ul.menu>li:hover{border-top:2px solid '.$primary_color.'}.big-slider .entry-title a:hover,.main-navigation a:hover,.main-navigation li.menu-item-has-children:hover>a:after,.main-navigation li.page_item_has_children:hover>a:after,.main-navigation ul li ul li a:hover,.main-navigation ul li ul li:hover>a,.main-navigation ul li.current-menu-ancestor a,.main-navigation ul li.current-menu-ancestor a:after,.main-navigation ul li.current-menu-item a,.main-navigation ul li.current-menu-item a:after,.main-navigation ul li.current-menu-item ul li a:hover,.main-navigation ul li.current_page_ancestor a,.main-navigation ul li.current_page_ancestor a:after,.main-navigation ul li.current_page_item a,.main-navigation ul li.current_page_item a:after,.main-navigation ul li:hover>a{color:'.$primary_color.'}.slide-next,.slide-prev{background-color:'.$primary_color.'}.header-post-title-container{ background-color:'.$primary_color.'}#secondary .widget li a,#tertiary .widget li a,.fa.search-top,.widget_service_block h5 a:hover{color:'.$primary_color.'}.services-header h2{border-bottom:4px solid '.$primary_color.'}.single-post-content a,.single-post-content .entry-title a:hover,.single-service i{color:'.$primary_color.'}.single-service:hover .icons,.moving-box a{background-color:'.$primary_color.'}#site-title a:hover,.hentry .entry-title a:hover,.single-header h2,.single-page p a{color:'.$primary_color.'}.more-link span{border:1px solid '.$primary_color.'}.more-link span:hover{background-color:'.$primary_color.'}#comments i,.comments-area .comment-author-link a:hover,.comments-area a.comment-edit-link:hover,.comments-area a.comment-permalink:hover,.comments-area article header cite a:hover,.entry-meta .fa,.entry-meta a:hover,.nav-next a,.nav-previous a,.next a,.previous a{color:'.$primary_color.'}.comments-area .comment-author-link span{background-color:'.$primary_color.'}#colophon .copyright-info a:hover,#colophon .footer-nav ul li a:hover,#colophon a:hover,.comment .comment-reply-link:before,.comments-area article header .comment-edit-link:before,.copyright-info ul li a:hover,.footer-widgets-area a:hover,.menu-toggle:before,a#scroll-up i{color:'.$primary_color.'}.one-page-menu-active .main-navigation div ul li a:hover, .one-page-menu-active .main-navigation div ul li.current-one-page-menu-item a { color: '.$primary_color.'; }.woocommerce #content input.button,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce-page #content input.button,.woocommerce-page #respond input#submit,.woocommerce-page a.button,.woocommerce-page button.button,.woocommerce-page input.button{color:'.$primary_color.';border:1px solid '.$primary_color.'}.woocommerce #content input.button:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce-page #content input.button:hover,.woocommerce-page #respond input#submit:hover,.woocommerce-page a.button:hover,.woocommerce-page button.button:hover,.woocommerce-page input.button:hover{background-color:'.$primary_color.'}.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt{color:'.$primary_color.'}.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover{background-color:'.$primary_color.'}.woocommerce ul.products li.product .price{color:'.$primary_color.'}.woocommerce .woocommerce-message{border-top-color:'.$primary_color.'}.woocommerce .woocommerce-message::before,.woocommerce div.product p.price,.woocommerce div.product span.price{color:'.$primary_color.'}';
   }
   // Header Title Bar Background Image
   if( ample_option( 'ample_header_title_background_image' ) ) {
      $ample_internal_css .= ' .header-post-title-container { background-image: url("'.ample_option( 'ample_header_title_background_image' ).'");background-size:cover; }';
   }
   // Header Section Background Image
   if( ample_option( 'ample_header_background_image') ) {
      if( ample_option( 'ample_header_background_image_full_width', '0' ) == 1 ) {
      $ample_internal_css .= ' .main-head-wrap { background-image: url("'.ample_option( 'ample_header_background_image' ).'");background-size:cover; }';
      } else {
      $ample_internal_css .= ' .header { background-image: url("'.ample_option( 'ample_header_background_image' ).'");background-size:cover; }';
      }
   }
   // Hide Top Border of Primary Menu
   if( ample_option( 'ample_hide_menu_top_border' ) ) {
      $ample_internal_css .= ' .main-navigation ul.menu > li.current-menu-item, .main-navigation ul.menu > li.current-menu-ancestor, .main-navigation .menu > ul > li.current_page_item, .main-navigation .menu > ul > li.current_page_ancestor, .main-navigation ul.menu > li:hover, .main-navigation .menu > ul > li:hover { border-top: 2px solid transparent;margin-top: -2px; }';
   }
   // Google Fonts
   if( ample_option( 'ample_site_title_font', 'Roboto+Slab:700,400' ) != 'Roboto+Slab:700,400' ) {
      $ample_internal_css .= ' #site-title a { font-family: "'.ample_option( 'ample_site_title_font', 'Roboto+Slab:700,400' ).'"; }';
   }
   if( ample_option( 'ample_site_tagline_font', 'Roboto+Slab:700,400' ) != 'Roboto+Slab:700,400' ) {
      $ample_internal_css .= ' #site-description { font-family: "'.ample_option( 'ample_site_tagline_font', 'Roboto+Slab:700,400' ).'"; }';
   }
   if( ample_option( 'ample_primary_menu_font', 'Roboto:400,300,100' ) != 'Roboto:400,300,100' ) {
      $ample_internal_css .= ' .main-navigation li { font-family: "'.ample_option( 'ample_primary_menu_font', 'Roboto:400,300,100' ).'"; }';
   }
   if( ample_option( 'ample_titles_font', 'Roboto+Slab:700,400' ) != 'Roboto+Slab:700,400' ) {
      $ample_internal_css .= ' h1, h2, h3, h4, h5, h6 { font-family: "'.ample_option( 'ample_titles_font', 'Roboto+Slab:700,400' ).'"; }';
   }
   if( ample_option( 'ample_content_font', 'Roboto:400,300,100' ) != 'Roboto:400,300,100' ) {
      $ample_internal_css .= ' body, button, input, select, textarea, p, .entry-meta, .read-more, .more-link { font-family: "'.ample_option( 'ample_content_font', 'Roboto:400,300,100' ).'"; }';
   }

   //Font size option
   $ample_fonts_size_custom = ample_font_size_func();

   foreach ($ample_fonts_size_custom as $ample_font) {

      $ample_font_size_setting = $ample_font['ample_font_size_setting'];
      foreach ($ample_font_size_setting as $ample_font_size_css) {

         if( ample_option( $ample_font_size_css['id'], $ample_font_size_css['default'] ) != $ample_font_size_css['default'] ) {
            $ample_internal_css .= $ample_font_size_css['custom_css'] . '{ font-size: '.ample_option( $ample_font_size_css['id'], $ample_font_size_css['default'] ).'px; }';
         }
      }
   } // End of Font Size Options

   // Color Options
   $ample_color_custom = ample_color_func();

   foreach ($ample_color_custom as $ample_color) {

      $ample_color_settings = $ample_color['ample_color_settings'];
      foreach ($ample_color_settings as $ample_color_css) {

         if( ample_option( $ample_color_css['id'], $ample_color_css['default'] ) != $ample_color_css['default'] ) {
            $ample_internal_css .= $ample_color_css['color_custom_css'] . ample_option( $ample_color_css['id'], $ample_color_css['default'] ).'; }';
            if( array_key_exists( 'color_custom_css_two', $ample_color_css ) ) {
               $ample_internal_css .= $ample_color_css['color_custom_css_two'] . ample_option( $ample_color_css['id'], $ample_color_css['default'] ).'; }';
            }
         }
      }
   } // End of Color Options

   if( !empty( $ample_internal_css ) ) {
      ?>
      <style type="text/css"><?php echo $ample_internal_css; ?></style>
      <?php
   }

   $ample_custom_css = ample_option( 'ample_custom_css', '' );
   if( !empty( $ample_custom_css ) ) {
      ?>
      <style type="text/css"><?php echo $ample_custom_css; ?></style>
      <?php
   }
}

/**************************************************************************************/

/**
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'ample_wrapper_start', 10);
add_action('woocommerce_before_main_content', 'ample_inner_wrapper_start', 15);
add_action('woocommerce_after_main_content', 'ample_inner_wrapper_end', 10);
add_action('woocommerce_sidebar', 'ample_wrapper_end', 20);

function ample_wrapper_start() {
   echo '<div class="single-page"> <div class="inner-wrap">';
}

function ample_inner_wrapper_start() {
   echo '<div id="primary"><div id="content">';
}

function ample_inner_wrapper_end() {
   echo '</div>';
   ample_both_sidebar_select();
   echo '</div>';
}

function ample_wrapper_end() {
   echo '</div></div>';
}

add_theme_support( 'woocommerce' );

if ( ! function_exists( 'ample_woo_related_products_limit' ) ) {

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */
function ample_woo_related_products_limit() {
   global $product;
   $args = array(
      'posts_per_page' => 4,
      'columns' => 4,
      'orderby' => 'rand'
   );
   return $args;
}
}
add_filter( 'woocommerce_output_related_products_args', 'ample_woo_related_products_limit' );


if ( class_exists('woocommerce') && !function_exists( 'ample_is_in_woocommerce_page' ) ):
/*
 * woocommerce - conditional to check if woocommerce related page showed
 */
function ample_is_in_woocommerce_page() {
return ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() ) ? true : false;
}
endif;
?>