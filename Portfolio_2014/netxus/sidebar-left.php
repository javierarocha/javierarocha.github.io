<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package ThemeGrill
 * @subpackage Ample Pro
 * @since Ample 1.0
 */
?>

<div id="tertiary" class="sidebar">
   <?php do_action( 'ample_before_sidebar' );

   if( is_page_template( 'page-templates/template-contact.php' ) ) {
      $sidebar = 'ample_contact_page_sidebar';
   }
   elseif( function_exists( 'ample_is_in_woocommerce_page' ) && ample_is_in_woocommerce_page() ) {
      $sidebar = 'ample_woocommerce_sidebar';
   }
   else {
      $sidebar = 'ample_left_sidebar';
   }

   if ( ! dynamic_sidebar( $sidebar ) ) :

      if( $sidebar == 'ample_contact_page_sidebar' ) {
         $sidebar_display = __('Contact Page', 'ample');
      }
      elseif( $sidebar == 'ample_woocommerce_sidebar' ) {
         $sidebar_display = __('WooCommerce', 'ample');
      }
      else {
         $sidebar_display = __('Left', 'ample');
      }
      the_widget( 'WP_Widget_Text',
         array(
            'title'  => __( 'Example Widget', 'ample' ),
            'text'   => sprintf( __( 'This is an example widget to show how the %s sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets is added than this will be replaced by those widgets', 'ample' ), $sidebar_display, current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
            'filter' => true,
         ),
         array(
            'before_widget' => '<section class="widget widget_text">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
         )
      );
   endif;

   do_action( 'ample_after_sidebar' ); ?>
</div>