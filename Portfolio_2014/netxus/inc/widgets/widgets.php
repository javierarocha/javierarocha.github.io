<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ThemeGrill
 * @subpackage Ample Pro
 * @since Ample 1.0
 */

/**
 * Register widget area.
 *
 */
add_action( 'widgets_init', 'ample_widgets_init' );
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function ample_widgets_init() {
   register_sidebar( array(
      'name'          => __( 'Right Sidebar', 'ample' ),
      'id'            => 'ample_right_sidebar',
      'description'   => __('Shows widgets at right side.', 'ample' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Left Sidebar', 'ample' ),
      'id'            => 'ample_left_sidebar',
      'description'   => __('Shows widgets at left side.', 'ample' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Business Sidebar', 'ample' ),
      'id'            => 'ample_business_sidebar',
      'description'   => __('Shows widgets on Business Page Template.', 'ample' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner-wrap clearfix">',
      'after_widget'  => '</div></div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Business Sidebar Two', 'ample' ),
      'id'            => 'ample_business_sidebar_two',
      'description'   => __('Shows widgets on Business Template Two.', 'ample' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner-wrap clearfix">',
      'after_widget'  => '</div></div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Business Sidebar Three', 'ample' ),
      'id'            => 'ample_business_sidebar_three',
      'description'   => __('Shows widgets on Business Template Three.', 'ample' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner-wrap clearfix">',
      'after_widget'  => '</div></div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Business Sidebar Four', 'ample' ),
      'id'            => 'ample_business_sidebar_four',
      'description'   => __('Shows widgets on Business Template Four.', 'ample' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner-wrap clearfix">',
      'after_widget'  => '</div></div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Business Sidebar Five', 'ample' ),
      'id'            => 'ample_business_sidebar_five',
      'description'   => __('Shows widgets on Business Template Five.', 'ample' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner-wrap clearfix">',
      'after_widget'  => '</div></div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   register_sidebar( array(
      'name'          => __( 'One Page Sidebar', 'ample' ),
      'id'            => 'ample_onepage_sidebar',
      'description'   => __('Shows widgets on One Page Template.', 'ample' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner-wrap clearfix">',
      'after_widget'  => '</div></div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   // Registering woocommerce sidebar
   if ( class_exists('woocommerce') ) {
      register_sidebar( array(
         'name'            => __( 'Shop Sidebar', 'ample' ),
         'id'              => 'ample_woocommerce_sidebar',
         'description'     => __( 'Widget area for WooCommerce Pages.', 'ample' ),
         'before_widget'   => '<aside id="%1$s" class="widget %2$s">',
         'after_widget'    => '</aside>',
         'before_title'    => '<h3 class="widget-title"><span>',
         'after_title'     => '</span></h3>'
      ) );
   }
   register_sidebar( array(
      'name'          => __( 'Error 404 Page Sidebar', 'ample' ),
      'id'            => 'ample_error_404_page_sidebar',
      'description'   => __('Shows widgets on Error 404 page.', 'ample' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Contact Page Sidebar', 'ample' ),
      'id'            => 'ample_contact_page_sidebar',
      'description'   => __('Shows widgets on Right/Left side of Contact page.', 'ample' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Footer Sidebar1', 'ample' ),
      'id'            => 'ample_footer_sidebar1',
      'description'   => __('Shows widgets on footer.', 'ample' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h5 class="widget-title">',
      'after_title'   => '</h5>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Footer Sidebar2', 'ample' ),
      'id'            => 'ample_footer_sidebar2',
      'description'   => __('Shows widgets on footer.', 'ample' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h5 class="widget-title">',
      'after_title'   => '</h5>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Footer Sidebar3', 'ample' ),
      'id'            => 'ample_footer_sidebar3',
      'description'   => __('Shows widgets on footer.', 'ample' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h5 class="widget-title">',
      'after_title'   => '</h5>'
   ) );
   register_sidebar( array(
      'name'          => __( 'Footer Sidebar4', 'ample' ),
      'id'            => 'ample_footer_sidebar4',
      'description'   => __('Shows widgets on footer.', 'ample' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h5 class="widget-title">',
      'after_title'   => '</h5>'
   ) );

   register_widget("ample_service_widget");
   register_widget("ample_portfolio_widget");
   register_widget("ample_call_to_action_widget");
   register_widget("ample_featured_posts_widget");
   register_widget("ample_testimonial_widget");
   register_widget("ample_our_clients_widget");
}

/**************************************************************************************/

/**
 * Featured recent work widget to show pages.
 */
class ample_service_widget extends WP_Widget {
   function __construct() {
      $widget_ops = array( 'classname' => 'widget_service_block', 'description' => __( 'Show your some pages as services.', 'ample' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: Service Widget', 'ample' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      for ( $i=1; $i<=6; $i++ ) {
         $var = 'page_id'.$i;
         $defaults[$var] = '';
      }
      $defaults['service_menu_id'] = '';
      $defaults['title'] = '';
      $defaults['text'] = '';
      $defaults['image'] = '';
      $defaults[ 'featured_image' ] = '0';
      $defaults[ 'new_tab' ] = '0';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $service_menu_id = esc_attr( $instance[ 'service_menu_id' ] );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance['text'] );
      $image = esc_url_raw( $instance['image'] );
      $featured_image = $instance['featured_image'] ? 'checked="checked"' : '';
      $new_tab = $instance['new_tab'] ? 'checked="checked"' : '';
      ?>
      <p><?php _e( 'Note: Enter the Service Section ID and use same for Menu item. Only used for One Page Sidebar.', 'ample' ); ?></p>
      <p>
      <p>
         <label for="<?php echo $this->get_field_id('service_menu_id'); ?>"><?php _e( 'Service Section ID:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id('service_menu_id'); ?>" name="<?php echo $this->get_field_name('service_menu_id'); ?>" type="text" value="<?php echo $service_menu_id; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','ample' ); ?>
      <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id( 'image' ); ?>"> <?php _e( 'Image:', 'ample' ); ?> </label> <br />

         <?php
         if ( $image  != '' ) :
            echo '<img id="' . $this->get_field_id( 'image' . 'preview' ) . '"src="' . $image . '"style="max-width: 250px;" /><br />';
         endif;
         ?>
         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $image; ?>" style="margin-top: 5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button_services" name="<?php echo $this->get_field_name( 'image' ); ?>" value="Upload Image" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'image' ); ?>' ); return false;"/>
      </p>

      <p>
         <?php
         $url = 'http://fontawesome.io/icons/';
         $link = sprintf( __( '<a href="%s" target="_blank">Refer here</a> For Icon Class', 'ample' ), esc_url( $url ) );
         echo $link;
         ?>
      </p>

      <p><?php _e('Select the page to display Title and Excerpt.', 'ample') ?></p>
      <?php
      for( $i=1; $i<=6; $i++) {
         if( $i%2 != 0 ){ ?>
            <p>
               <label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'ample' ); ?>:</label>
               <?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[ key($defaults) ] ) ); ?>
            </p>
         <?php }
         elseif( $i%2 == 0 ) { ?>
            <p>
               <label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Icon Class:', 'ample' ); ?></label>
               <input id="<?php echo $this->get_field_id( key($defaults) ); ?>" name="<?php echo $this->get_field_name( key($defaults) ); ?>" placeholder="fa-refresh" type="text" value="<?php echo $instance[ key($defaults) ]; ?>" />
            </p>
         <?php }
         next( $defaults );// forwards the key of $defaults array
      } ?>
      <p>
         <input class="checkbox" type="checkbox" <?php echo $featured_image; ?> id="<?php echo $this->get_field_id('featured_image'); ?>" name="<?php echo $this->get_field_name('featured_image'); ?>" /> <label for="<?php echo $this->get_field_id('featured_image'); ?>"><?php _e( 'Check to display Featured images instead of Icons.', 'ample' ); ?></label>
      </p>
      <p>
         <input class="checkbox" type="checkbox" <?php echo $new_tab; ?> id="<?php echo $this->get_field_id('new_tab'); ?>" name="<?php echo $this->get_field_name('new_tab'); ?>" /> <label for="<?php echo $this->get_field_id('new_tab'); ?>"><?php _e( 'Check to make Icon/Image and Title unclickable.', 'ample' ); ?></label>
      </p>
   <?php }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'service_menu_id' ] = strip_tags( $new_instance[ 'service_menu_id' ] );
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      for( $i=1; $i<=6; $i++ ) {
         $var = 'page_id'.$i;
         if( $i%2 != 0 )
            $instance[ $var] = absint( $new_instance[ $var ] );
         elseif( $i%2 == 0 )
            $instance[ $var ] = strip_tags( $new_instance[ $var ] );
      }
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
      $instance[ 'image' ] = esc_url_raw( $new_instance[ 'image' ] );
      $instance[ 'featured_image' ] = isset( $new_instance[ 'featured_image' ] ) ? 1 : 0;
      $instance[ 'new_tab' ] = isset( $new_instance[ 'new_tab' ] ) ? 1 : 0;

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $service_menu_id = isset( $instance[ 'service_menu_id' ] ) ? $instance[ 'service_menu_id' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
      $image = isset( $instance[ 'image' ] ) ? $instance[ 'image' ] : '';
      $featured_image = !empty( $instance[ 'featured_image' ] ) ? 'true' : 'false';
      $new_tab = !empty( $instance[ 'new_tab' ] ) ? 'true' : 'false';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'Ample Pro', 'TG: Service widget text' . $this->id, $text );
         icl_register_string( 'Ample Pro', 'TG: Service widget image' . $this->id, $image );
      }
      if ( function_exists( 'icl_t' ) ) {
         $text = icl_t( 'Ample Pro', 'TG: Service widget text'. $this->id, $text );
         $image = icl_t( 'Ample Pro', 'TG: Service widget image'. $this->id, $image );
      }

      $page_array = array();
      $icon = array();
      for( $i=1; $i<=6; $i++ ) {
         $var = 'page_id'.$i;
         if( $i%2 != 0 ){
            $page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';
            if( !empty( $page_id ) )
               array_push( $page_array, $page_id );// Push the page id in the array
         }
         elseif( $i%2 == 0 && !( empty( $page_id ) ) ) {
            $strn =  $instance[ $var ];
            array_push( $icon, $strn );
         }
      }
      $get_featured_pages = new WP_Query( array(
         'posts_per_page'        => -1,
         'post_type'             =>  array( 'page' ),
         'post__in'              => $page_array,
         'orderby'               => 'post__in'
      ) );
      echo $before_widget;

      $section_id = '';
      if( !empty( $service_menu_id ) )
         $section_id = 'id="' . $service_menu_id . '"';
      ?>

      <div <?php echo $section_id; ?> class="service-block">
         <div class="service-all-content">

         <?php if ( !empty( $title ) ) { ?>
            <div class="services-header">
               <?php echo $before_title . esc_html( $title ) . $after_title; ?>
               <div class="services-main-description">
                  <p>
                     <?php echo esc_textarea( $text ); ?>
                  </p>
                  <?php if( !empty( $image ) ) { ?>
                  <img title="<?php echo esc_attr($title); ?>" alt="<?php echo esc_attr($title); ?>" src="<?php echo $image; ?>">
                  <?php } ?>
               </div>
            </div>
         <?php }
         if ( !empty( $page_array ) ) : ?>
         <div class="services-content clearfix">
            <?php
            $count=0;
            while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();

               if ( $count ==  2 ) { $service_wrap_class = 'single-service tg-one-third tg-one-third-last'; }
               else { $service_wrap_class = 'single-service tg-one-third'; }
               ?>
               <div class="<?php echo $service_wrap_class; ?>">
                  <?php
                     if( !empty( $icon[ $count ] ) && $featured_image != 'true' ) { ?>
                        <div class="icons">
                           <?php if( $new_tab == 'false' ) { ?>
                              <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                           <?php } ?>
                              <i class="fa fa-aw <?php echo esc_html( $icon[ $count ] )?> fa-3x"></i>
                           <?php if( $new_tab == 'false' ) { ?>
                              </a>
                           <?php } ?>
                        </div>
                     <?php }
                     elseif( $featured_image == 'true' && has_post_thumbnail() ) {
                        $image = '';
                        $title_attribute = the_title_attribute( 'echo=0' );
                        $image .= '<figure class="post-featured-image">';
                        if( $new_tab == 'false' )
                           $image .= '<a href="' . get_permalink() . '" title="'. $title_attribute .'">';
                        $image .= get_the_post_thumbnail( $post->ID, 'ample-service-image', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
                        if( $new_tab == 'false' )
                           $image .= '</a>';
                        $image .= '</figure>';

                        echo $image;
                     }
                  ?>
                  <h5>
                     <?php if( $new_tab == 'false' ) { ?>
                        <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                     <?php }
                        echo esc_html( get_the_title() );
                     if( $new_tab == 'false' ) { ?>
                        </a>
                     <?php } ?>
                  </h5>
                  <?php the_excerpt(); ?>
               </div>
            <?php
            $count++;
            endwhile; ?>
         </div>
         <?php endif;
         // Reset Post Data
         wp_reset_query();
         ?>
         </div>
      </div>
      <?php echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Portfolio widget
 */
class ample_portfolio_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_portfolio_block', 'description' => __( 'Display portfolio by using specific category', 'ample') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Portfolio', 'ample' ), $widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['portfolio_menu_id'] = '';
      $tg_defaults['background_color'] = '#80abc8';
      $tg_defaults['background_image' ] = '';
      $tg_defaults['attachment' ] = 'scroll';
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['category'] = '';
      $tg_defaults['button_text'] = '';
      $tg_defaults['button_url' ] = '';

      $instance = wp_parse_args( (array) $instance, $tg_defaults );

      $portfolio_menu_id = esc_attr( $instance[ 'portfolio_menu_id' ] );
      $background_color = esc_attr( $instance[ 'background_color' ] );
      $background_image = esc_url_raw( $instance[ 'background_image' ] );
      $attachment =  $instance[ 'attachment' ];
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance[ 'text' ] );
      $number = $instance['number'];
      $category = $instance['category'];
      $button_text = esc_attr( $instance[ 'button_text' ] );
      $button_url = esc_url( $instance[ 'button_url' ] );
      ?>
      <p><?php _e( 'Note: Enter the Portfolio Section ID and use same for Menu item. Only used for One Page Sidebar.', 'ample' ); ?></p>

      <p>
         <label for="<?php echo $this->get_field_id('portfolio_menu_id'); ?>"><?php _e( 'Portfolio Section ID:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id('portfolio_menu_id'); ?>" name="<?php echo $this->get_field_name('portfolio_menu_id'); ?>" type="text" value="<?php echo $portfolio_menu_id; ?>" />
      </p>

      <p>
         <strong><?php _e( 'DESIGN SETTINGS :', 'ample' ); ?></strong><br />
         <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color:', 'ample' ); ?></label><br />
         <input class="my-color-picker" type="text" data-default-color="#80abc8" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo  $background_color; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php _e( 'Image:', 'ample' ); ?> </label> <br />

         <?php
         if ( $background_image  != '' ) :
            echo '<img id="' . $this->get_field_id( 'background_image' . 'preview') . '"src="' . $background_image . '"style="max-width: 250px;" /><br />';
         endif;
         ?>
         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo $background_image; ?>" style="margin-top: 5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button_portfolio" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="Upload Image" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'background_image' ); ?>' ); return false;"/>
      </p>

      <p>
         <?php _e( 'Background attachment:', 'ample' ); ?> <br />
         <input type="radio" <?php checked($attachment, 'scroll') ?> id="<?php echo $this->get_field_id( 'attachment' ); ?>" name="<?php echo $this->get_field_name( 'attachment' ); ?>" value="scroll" /><?php _e( 'Scroll', 'ample' );?>
         <input type="radio" <?php checked($attachment,'fixed') ?> id="<?php echo $this->get_field_id( 'attachment' ); ?>" name="<?php echo $this->get_field_name( 'attachment' ); ?>" value="fixed" style="margin-left: 20px;"/><?php _e( 'Fixed', 'ample' );?>
      </p>

      <strong><?php _e( 'OTHER SETTINGS :', 'ample' ); ?></strong><br />

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <?php _e( 'Description','ample' ); ?>
      <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'ample' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Redirect Link:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo $button_url; ?>" />
      </p>
      <p><?php _e( 'Note: Link to redirect. If empty than it will redirect to selected category.', 'ample' ); ?></p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'portfolio_menu_id' ] = strip_tags( $new_instance[ 'portfolio_menu_id' ] );
      $instance[ 'background_color' ] = $new_instance[ 'background_color' ];
      $instance[ 'background_image' ] = esc_url_raw( $new_instance[ 'background_image' ] );
      $instance[ 'attachment' ] = $new_instance[ 'attachment' ];
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance[ 'text' ];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'category' ] = $new_instance[ 'category' ];
      $instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
      $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $portfolio_menu_id = isset( $instance[ 'portfolio_menu_id' ] ) ? $instance[ 'portfolio_menu_id' ] : '';
      $background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
      $background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
      $attachment = isset( $instance[ 'attachment' ] ) ? $instance[ 'attachment' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
      $button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
      $button_url = isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '#';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'Ample Pro', 'TG: Portfolio widget text' . $this->id, $text );
         icl_register_string( 'Ample Pro', 'TG: Portfolio widget button text' . $this->id, $button_text );
         icl_register_string( 'Ample Pro', 'TG: Portfolio widget button url' . $this->id, $button_url );
      }
      if ( function_exists( 'icl_t' ) ) {
         $text = icl_t( 'Ample Pro', 'TG: Portfolio widget text'. $this->id, $text );
         $button_text = icl_t( 'Ample Pro', 'TG: Portfolio widget button text'. $this->id, $button_text );
         $button_url = icl_t( 'Ample Pro', 'TG: Portfolio widget button url'. $this->id, $button_url );
      }

      $get_featured_posts = new WP_Query( array(
         'posts_per_page'        => $number,
         'post_type'             => 'post',
         'category__in'          => $category
      ) );

      echo $before_widget;
      $image_style = '';
      if ( !empty( $background_image ) ) {
         $image_style .= 'background-image:url(' . $background_image . ');background-attachment:' . $attachment . ';background-repeat:no-repeat;background-size:cover;';
      }else {
         $image_style .= 'background-color:' . $background_color . ';';
      }

      $section_id = '';
      if( !empty( $portfolio_menu_id ) )
         $section_id = 'id="' . $portfolio_menu_id . '"';
      ?>

      <div <?php echo $section_id; ?> class="portfolio-container" style="<?php echo $image_style; ?>">
         <div class="portfolio-all-content">
         <?php  if( $category > 0 ) : ?>
         <div class="inner-wrap clearfix">
            <div class="portfolio-header">
               <?php
               if( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; }
               if( !empty( $text ) ) { ?> <div class="portfolio-main-description"><p> <?php echo esc_textarea( $text ); ?> </p></div> <?php }
               ?>
            </div>
            <div class="portfolio-content clearfix">
               <?php
               $i=1;
               while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
                  if ( $i % 4 == 0 ) { $class = 'tg-one-fourth tg-one-fourth-last'; }
                  elseif( ($i+1) % 4 == 0 ) { $class= 'tg-one-fourth tg-after-two-blocks-clearfix'; }
                  else { $class = 'tg-one-fourth'; }

                  if ( $i % 2 == 1 ) { $class .= ' '.'tg-column-odd'; }
                  else { $class .= ' '.'tg-column-even'; }
                  ?>
                  <div class="single-portfolio <?php echo $class; ?>">
                     <div class="single-portfolio-thumbnail">
                        <?php
                        if( has_post_thumbnail() ) {
                           the_post_thumbnail('ample-portfolio-image'); ?>
                           <div class="view-detail">
                              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><i class="fa fa-link"></i></a>
                           </div>

                           <div class="moving-box">
                              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                           </div>
                        <?php }
                        else { ?>
                           <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                        <?php } ?>
                     </div>
                  </div>
               <?php $i++;
               endwhile;
               if( !empty( $button_text ) ) {
                  if( !empty( $button_url ) )
                     $button_link = $button_url;
                  else
                     $button_link = get_category_link( $category ); ?>
                  <div class="clearfix"></div>
                  <div class="portfolio-view-more inner-wrap">
                     <a class="portfolio-button" href="<?php echo $button_link; ?>" title="<?php echo esc_attr( $button_text ); ?>"><span><?php echo esc_html( $button_text ); ?></span></a>
                  </div>
               <?php } ?>
            </div>
         </div>
         <?php endif; ?>
         </div>
      </div>
      <?php
      // Reset Post Data
      wp_reset_query();
      ?>
      <?php echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Featured Posts widget
 */
class ample_featured_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts_block', 'description' => __( 'Display latest posts or posts of specific category', 'ample') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts', 'ample' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['featured_menu_id'] = '';
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';

      $instance = wp_parse_args( (array) $instance, $tg_defaults );

      $featured_menu_id = esc_attr( $instance[ 'featured_menu_id' ] );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance[ 'text' ] );
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>

      <p><?php _e( 'Note: Enter the Featured Post Section ID and use same for Menu item. Only used for One Page Sidebar.', 'ample' ); ?></p>
      <p>
      <p>
         <label for="<?php echo $this->get_field_id('featured_menu_id'); ?>"><?php _e( 'Featured Post Section ID:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id('featured_menu_id'); ?>" name="<?php echo $this->get_field_name('featured_menu_id'); ?>" type="text" value="<?php echo $featured_menu_id; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','ample' ); ?>
      <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p>
         <input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'ample' );?><br />
         <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'ample' );?><br />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'ample' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;

      $instance[ 'featured_menu_id' ] = strip_tags( $new_instance[ 'featured_menu_id' ] );
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $featured_menu_id = isset( $instance[ 'featured_menu_id' ] ) ? $instance[ 'featured_menu_id' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'Ample Pro', 'TG: Featured post widget text' . $this->id, $text );
      }
      if ( function_exists( 'icl_t' ) ) {
         $text = icl_t( 'Ample Pro', 'TG: Featured post widget text'. $this->id, $text );
      }

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
      }

      echo $before_widget;

      $section_id = '';
      if( !empty( $featured_menu_id ) )
         $section_id = 'id="' . $featured_menu_id . '"';
      ?>

      <div <?php echo $section_id; ?> >
         <div class="blog-all-content">
            <div class="featured-posts-header">
               <?php if ( !empty( $title ) ) { ?>
                  <?php echo $before_title . esc_html( $title ) . $after_title; ?>
               <?php } ?>
               <?php if ( !empty( $text ) ) { ?>
                  <div class="featured-posts-main-description">
                     <p><?php echo esc_textarea( $text ); ?></p>
                  </div>
               <?php } ?>
            </div>

            <div class="featured-posts-content clearfix">
               <?php
               $i=1;
               while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
               ?>
                  <?php
                  if ( $i % 2 == 0 ) { $class = 'tg-one-half tg-one-half-last'; }
                  else { $class = 'tg-one-half'; }
                  if( $i % 2 ==  1 && $i > 1) { $class .= ' tg-featured-posts-clearfix'; }
                  ?>
                  <div class="single-post <?php echo $class; ?>">
                     <?php if( has_post_thumbnail() ) { ?>
                        <div class="single-post-image-wrap">
                           <?php
                           $image = '';
                           $title_attribute = the_title_attribute( 'echo=0' );
                           $image .= '<figure>';
                           $image .= '<a href="' . get_permalink() . '" title="'. $title_attribute .'">';
                           $image .= get_the_post_thumbnail( $post->ID, 'ample-featured-blog-small', array( 'title' => $title_attribute , 'alt' => $title_attribute ) ).'</a>';
                           $image .= '</figure>';

                           echo $image;
                           ?>
                        </div>
                     <?php } ?>
                     <div class="single-post-content">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h3>
                        <div class="entry-summary">
                           <?php the_excerpt(); ?>
                        </div>
                     </div>
                  </div>
               <?php $i++;
               endwhile; ?>
            </div>
         </div>
      </div><!-- #featured -->

      <?php
      // Reset Post Data
      wp_reset_query();
      echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Featured call to action widget.
 */
class ample_call_to_action_widget extends WP_Widget {
   function __construct() {
      $widget_ops = array( 'classname' => 'widget_call_to_action_block', 'description' => __( 'Use this widget to show the call to action section.', 'ample' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: Call To Action Widget', 'ample' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      $ample_defaults[ 'background_color' ] = '#80abc8';
      $ample_defaults[ 'background_image' ] = '';
      $ample_defaults[ 'bg_attachment' ] = 'scroll';
      $ample_defaults[ 'text_main' ] = '';
      $ample_defaults[ 'button_text' ] = '';
      $ample_defaults[ 'button_url' ] = '';

      $instance = wp_parse_args( (array) $instance, $ample_defaults );

      $background_color = esc_attr( $instance[ 'background_color' ] );
      $text_additional = esc_url_raw( $instance[ 'background_image' ] );
      $bg_attachment = $instance[ 'bg_attachment' ];
      $text_main = esc_textarea( $instance[ 'text_main' ] );
      $button_text = esc_attr( $instance[ 'button_text' ] );
      $button_url = esc_url( $instance[ 'button_url' ] );
      ?>
      <p>
         <strong><?php _e( 'DESIGN SETTINGS :', 'ample' ); ?></strong><br />
         <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color:', 'ample' ); ?></label><br />
         <input class="my-color-picker" type="text" data-default-color="#80abc8" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo  $background_color; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php _e( 'Image:', 'ample' ); ?> </label> <br />

         <?php
         if ( $instance[ 'background_image' ]  != '' ) :
            echo '<img id="' . $this->get_field_id( 'background_image' . 'preview') . '"src="' . $instance[ 'background_image' ] . '"style="max-width: 250px;" /><br />';
         endif;
         ?>
         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo $instance[ 'background_image' ]; ?>" style="margin-top: 5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button_action" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="Upload Image" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'background_image' ); ?>' ); return false;"/>
      </p>

      <p>
         <?php _e( 'Background attachment:', 'ample' ); ?><br />
         <input type="radio" <?php checked($bg_attachment, 'scroll') ?> id="<?php echo $this->get_field_id( 'bg_attachment' ); ?>" name="<?php echo $this->get_field_name( 'bg_attachment' ); ?>" value="scroll" /><?php _e( 'Scroll', 'ample' );?>
         <input type="radio" <?php checked($bg_attachment,'fixed') ?> id="<?php echo $this->get_field_id( 'bg_attachment' ); ?>" name="<?php echo $this->get_field_name( 'bg_attachment' ); ?>" value="fixed" style="margin-left: 20px;"/><?php _e( 'Fixed', 'ample' );?>
      </p>

      <strong><?php _e( 'OTHER SETTINGS :', 'ample' ); ?></strong><br />

      <?php _e( 'Call to Action Main Text','ample' ); ?>
      <textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('text_main'); ?>" name="<?php echo $this->get_field_name('text_main'); ?>"><?php echo $text_main; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e( 'Button Text:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e( 'Button Redirect Link:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;

      $instance['background_color'] =  $new_instance['background_color'];
      $instance['background_image'] =  esc_url_raw( $new_instance['background_image'] );
      $instance['bg_attachment'] =  $new_instance['bg_attachment'];

      if ( current_user_can('unfiltered_html') )
         $instance['text_main'] =  $new_instance['text_main'];
      else
         $instance['text_main'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text_main']) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
      $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
      $background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
      $bg_attachment = isset( $instance[ 'bg_attachment' ] ) ? $instance[ 'bg_attachment' ] : '';
      $text_main = empty( $instance[ 'text_main' ] ) ? '' : $instance[ 'text_main' ];
      $button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
      $button_url = isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '#';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'Ample Pro', 'TG: Call to action widget text' . $this->id, $text_main );
         icl_register_string( 'Ample Pro', 'TG: Call to action widget button text' . $this->id, $button_text );
         icl_register_string( 'Ample Pro', 'TG: Call to action widget button url' . $this->id, $button_url );
      }
      if ( function_exists( 'icl_t' ) ) {
         $text_main = icl_t( 'Ample Pro', 'TG: Call to action widget text'. $this->id, $text_main );
         $button_text = icl_t( 'Ample Pro', 'TG: Call to action widget button text'. $this->id, $button_text );
         $button_url = icl_t( 'Ample Pro', 'TG: Call to action widget button url'. $this->id, $button_url );
      }

      echo $before_widget;
      $bg_image_style = '';
      if ( !empty( $background_image ) ) {
         $bg_image_style .= 'background-image:url(' . $background_image . ');background-attachment:' . $bg_attachment . ';background-repeat:no-repeat;background-size:cover;';
         $bg_height = 'call-to-action-content-wrapper';
      }else {
         $bg_image_style .= 'background-color:' . $background_color . ';';
         $bg_height = 'call-to-action-content-wrapper no-bg-image';
      }?>
      <div class="<?php echo $bg_height; ?> clearfix" style="<?php echo $bg_image_style; ?>">
         <div class="inner-wrap">
            <?php if( !empty( $text_main ) ) { ?>
               <h3>
                  <?php echo esc_html( $text_main );

                  if( !empty( $button_text ) ) { ?>
                     <a class="call-to-action-button" href="<?php echo $button_url; ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
                  <?php } ?>
               </h3>
            <?php } ?>
         </div>
      </div>

      <?php echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Testimonial widget
 */
class ample_testimonial_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_testimonial_block', 'description' => __( 'Display Testimonial', 'ample' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: Testimonial', 'ample' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      $default_value[ 'testimonial_menu_id' ] = '';
      $default_value[ 'title' ] = '';
      $default_value[ 'description' ] = '';
      $default_value[ 'testimonial_num' ] = '2';

      for( $i=1; $i<=$default_value[ 'testimonial_num' ]; $i++ ) {
         $default_value[ 'text' . $i ] = '';
         $default_value[ 'person_name' . $i ] = '';
         $default_value[ 'byline' . $i ] = '';
         $default_value[ 'image' . $i ] = '';
      }

      $instance = wp_parse_args( (array) $instance, $default_value ); ?>
      <p><?php _e( 'Note: Enter the Testimonial Section ID and use same for Menu item. Only used for One Page Sidebar.', 'ample' ); ?></p>
      <p>
         <label for="<?php echo $this->get_field_id( key($instance) ); ?>"><?php _e( 'Testimonial Section ID:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id( key($instance) ); ?>" name="<?php echo $this->get_field_name( key($instance) ); ?>" type="text" value="<?php echo $instance[ key($instance) ]; ?>" />
      </p>

      <?php next( $instance ); ?>
      <p>
         <label for="<?php echo $this->get_field_id( key($instance) ); ?>"><?php _e( 'Title:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id( key($instance) ); ?>" name="<?php echo $this->get_field_name( key($instance) ); ?>" type="text" value="<?php echo $instance[ key($instance) ]; ?>" />
      </p>

      <?php next( $instance ); ?>
      <?php _e( 'Description:','ample' ); ?>
      <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( key($instance) ); ?>" name="<?php echo $this->get_field_name( key($instance) ); ?>"><?php echo $instance[ key($instance) ]; ?></textarea>

      <?php next( $instance ); ?>
      <p><?php _e( 'Note: Enter the number of testimonial and save it than enter the data in respective field.', 'ample' ); ?></p>
      <p>
         <label for="<?php echo $this->get_field_id( key($instance) ); ?>"><?php _e( 'No. of Testimonial:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id( key($instance) ); ?>" name="<?php echo $this->get_field_name( key($instance) ); ?>" type="text" value="<?php echo $instance[ key($instance) ]; ?>" />
      </p>

      <?php for( $i=1; $i<=$instance[ 'testimonial_num' ]; $i++) {

         next( $instance ); ?>
         <p><strong><?php _e( 'Testimonial ', 'ample'); echo $i; ?></strong><br/></p>

         <?php _e( 'Text:','ample'); ?>
         <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id( key($instance) ); ?>" name="<?php echo $this->get_field_name( key($instance) ); ?>"><?php echo  $instance[ key($instance) ]; ?></textarea>

         <?php next( $instance ); ?>
         <p>
            <label for="<?php echo $this->get_field_id( key($instance) ); ?>"><?php _e( 'Name:', 'ample' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( key($instance) ); ?>" name="<?php echo $this->get_field_name( key($instance) ); ?>" type="text" value="<?php echo esc_attr( $instance[ key($instance) ] ); ?>" />
         </p>

         <?php next( $instance ); ?>
         <p>
            <label for="<?php echo $this->get_field_id( key($instance) ); ?>"><?php _e( 'Byline:', 'ample' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( key($instance) ); ?>" name="<?php echo $this->get_field_name( key($instance) ); ?>" type="text" value="<?php echo esc_attr( $instance[ key($instance) ] ); ?>" />
         </p>

         <?php next( $instance ); ?>
         <p>
            <label for="<?php echo $this->get_field_id( key($instance) ); ?>"> <?php _e( 'Image:', 'ample' ); ?> </label> <br />

            <?php
            if ( $instance[ key($instance) ]  != '' ) :
               echo '<img id="' . $this->get_field_id( key($instance ) . 'preview') . '"src="' . $instance[ key($instance) ] . '"style="max-width: 150px;" /><br />';
            endif;
            ?>
            <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( key($instance) ); ?>" name="<?php echo $this->get_field_name( key($instance) ); ?>" value="<?php echo $instance[ key( $instance) ]; ?>" style="margin-top: 5px;"/>

            <input type="button" class="button button-primary custom_media_button" id="custom_media_button_testimonial" name="<?php echo $this->get_field_name( key( $instance) ); ?>" value="Upload Image" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( key($instance) ); ?>' ); return false;"/>
         </p>
      <?php }
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;

      $instance[ 'testimonial_menu_id' ] = strip_tags( $new_instance[ 'testimonial_menu_id' ]);
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      if ( current_user_can('unfiltered_html') )
         $instance['description'] =  $new_instance['description'];
      else
         $instance['description'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['description']) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'testimonial_num' ] = absint( $new_instance[ 'testimonial_num' ]);

      for( $i=1; $i<=$instance[ 'testimonial_num' ]; $i++) {
         if ( current_user_can('unfiltered_html') )
            $instance[ 'text' . $i ] =  $new_instance[ 'text' . $i ];
         else
            $instance[ 'text' . $i ] = stripslashes( wp_filter_post_kses( addslashes($new_instance[ 'text' . $i ]) ) ); // wp_filter_post_kses() expects slashed

         $instance[ 'person_name' . $i ] = strip_tags( $new_instance[ 'person_name' . $i ] );
         $instance[ 'byline' . $i ] = strip_tags( $new_instance[ 'byline' . $i ] );
         $instance[ 'image' . $i ] = esc_url_raw( $new_instance[ 'image' . $i ] );
      }
      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $description = isset( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';

      echo $before_widget;

      $section_id = '';
      if( !empty( $instance[ 'testimonial_menu_id' ] ) )
         $section_id = 'id="' . $instance[ 'testimonial_menu_id' ] . '"';
      ?>

      <div <?php echo $section_id ?> class="testimonial-slider testimonial-wrap">
         <div class="testimonials-all-content clearfix">

         <div class="testimonials-header">
            <?php if ( !empty( $title ) ) { ?>
               <?php echo $before_title . esc_html( $title ) . $after_title; ?>
            <?php } ?>
            <?php if ( !empty( $description ) ) { ?>
               <div class="testimonials-main-description">
                  <p><?php echo esc_textarea( $description ); ?></p>
               </div>
            <?php } ?>
         </div>

         <?php
         if ( $instance[ 'testimonial_num' ] >= 1 ) : ?>

            <?php
            for( $i=1; $i<=$instance[ 'testimonial_num' ]; $i++) {
               $text = 'text' . $i;
               $person_name = 'person_name' . $i;
               $byline = 'byline' . $i;
               $image = 'image' . $i;
               $class = '';
               if ( $i % 2 == 0 ) { $class = 'single-testimonial tg-one-half tg-one-half-last clearfix'; }
               else { $class = 'single-testimonial tg-one-half clearfix'; }
               if( !empty( $instance[ $text ] ) ) {
                  // For WPML plugin compatibility
                  if ( function_exists( 'icl_register_string' ) ) {
                     icl_register_string( 'Ample Pro', 'TG: Testimonial widget text' . $this->id .$i, $instance[ $text ] );
                     if( !empty( $instance[ $person_name ] ) ) {
                        icl_register_string( 'Ample Pro', 'TG: Testimonial widget person name' . $this->id .$i, $instance[ $person_name ] ); }
                     if( !empty( $instance[ $byline ] ) ) {
                        icl_register_string( 'Ample Pro', 'TG: Testimonial widget byline' . $this->id .$i, $instance[ $byline ] ); }
                     if( !empty( $instance[ $image ] ) ) {
                        icl_register_string( 'Ample Pro', 'TG: Testimonial widget image' . $this->id .$i, $instance[ $image ] ); }
                  }
                  if ( function_exists( 'icl_t' ) ) {
                     $instance[ $text ] = icl_t( 'Ample Pro', 'TG: Testimonial widget text'. $this->id .$i, $instance[ $text ] );
                     if( !empty( $instance[ $person_name ] ) ) {
                        $instance[ $person_name ] = icl_t( 'Ample Pro', 'TG: Testimonial widget person name'. $this->id .$i, $instance[ $person_name ] ); }
                     if( !empty( $instance[ $byline ] ) ) {
                        $instance[ $byline ] = icl_t( 'Ample Pro', 'TG: Testimonial widget byline'. $this->id .$i, $instance[ $byline ] ); }
                     if( !empty( $instance[ $image ] ) ) {
                        $instance[ $image ] = icl_t( 'Ample Pro', 'TG: Testimonial widget image'. $this->id .$i, $instance[ $image ] ); }
                  } ?>
                  <div class="<?php echo $class; ?>">
                     <div class="testimonial-image">
                        <?php if( !empty( $instance[ $image ] ) ) { ?>
                           <img src="<?php echo $instance[ $image ]; ?>" alt="<?php echo $instance[ $person_name ]; ?>">
                        <?php
                        } else { ?>
                           <span><i class="fa fa-aw fa-user"></i></span>
                        <?php } ?>
                     </div>
                     <div class="testimonial-content">
                        <p>
                           <?php echo esc_textarea( $instance[ $text ] ); ?>
                        </p>
                        <div class="profile-detail">
                           <span><strong><?php echo esc_html( $instance[ $person_name ] ); ?></strong></span>
                           <span><?php echo esc_html( $instance[ $byline ] ); ?></span>
                        </div>
                     </div>
                  </div>
               <?php }
            }
         endif;
         ?>
         </div>
      </div>
      <?php

      echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Clients images widget
 */
class ample_our_clients_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_our_clients', 'description' => __( 'Widget to show clients/partners images', 'ample') );
      $control_ops = array('width' => 200, 'height' => 250);
      parent::__construct( false, $name= __( 'TG: Our Clients', 'ample' ), $widget_ops, $control_ops );
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'client_menu_id' => '', 'client_title' => '', 'client_description' => '', 'client_num' => '5', 'image-1' => '', 'image-2' => '', 'image-3' => '', 'image-4' => '', 'image-5' => '', 'link-1' => '', 'link-2' => '', 'link-3' => '', 'link-4' => '', 'link-5' => '', 'hover-text1' => '', 'hover-text2' => '', 'hover-text3' => '', 'hover-text4' => '', 'hover-text5' => '' ) );

      for ( $i=1; $i<=$instance[ 'client_num' ]; $i++ ) {
         $image = 'image-'.$i;
         $link = 'link-'.$i;
         $hover_text = 'hover-text'.$i;
         $instance[ $image ] = esc_url_raw( $instance[ $image ] );
         $instance[ $link ] = esc_url( $instance[ $link ] );
         $instance[ $hover_text ] = strip_tags( $instance[ $hover_text ] );
      } ?>
      <p><?php _e( 'Note: Enter the Client Section ID and use same for Menu item. Only used for One Page Sidebar.', 'ample' ); ?></p>
      <p>
      <p>
         <label for="<?php echo $this->get_field_id( 'client_menu_id' ); ?>"><?php _e( 'Client Section ID:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id('client_menu_id'); ?>" name="<?php echo $this->get_field_name('client_menu_id'); ?>" type="text" value="<?php echo $instance[ 'client_menu_id' ]; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'client_title' ); ?>"><?php _e( 'Title:', 'ample' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'client_title' ); ?>" name="<?php echo $this->get_field_name( 'client_title' ); ?>" type="text" value="<?php echo $instance[ 'client_title' ]; ?>" />
      </p>

      <?php next( $instance ); ?>
      <?php _e( 'Description:','ample' ); ?>
      <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'client_description' ); ?>" name="<?php echo $this->get_field_name( 'client_description' ); ?>"><?php echo $instance[ 'client_description' ]; ?></textarea>

      <p><?php _e( 'Note: Enter the Client number (default will show fields for 5 clients) and save it than enter the data in respective field.', 'ample' ); ?></p>
      <p>
         <label for="<?php echo $this->get_field_id( 'client_num' ); ?>"><?php _e( 'Client number:', 'ample' ); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id( 'client_num' ); ?>" name="<?php echo $this->get_field_name( 'client_num' ); ?>" type="text" value="<?php echo $instance[ 'client_num' ]; ?>" />
      </p>

      <?php for ( $i=1; $i<=$instance[ 'client_num' ]; $i++ ) {
         $image = 'image-'.$i;
         $link = 'link-'.$i;
         $hover_text = 'hover-text'.$i;
         ?>
         <p>
            <label for="<?php echo $this->get_field_id( $image ); ?>"><?php _e( 'Image ', 'ample' ); echo $i; ?></label><br />
            <?php
            if ( $instance[ $image ]  != '' ) :
               echo '<img id="' . $this->get_field_id( $image . 'preview' ) . '"src="' . $instance[ $image ] . '"style="max-width: 150px;" /><br />';
            endif;
            ?>
            <input style="width:100%;" id="<?php echo $this->get_field_id( $image ); ?>" name="<?php echo $this->get_field_name( $image ); ?>" type="text" value="<?php echo $instance[ $image ]; ?>" style="margin-top: 5px;"/>

            <input type="button" class="button button-primary custom_media_button" id="custom_media_client" name="<?php echo $this->get_field_name( $image ); ?>" value="Upload Image" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image ); ?>' ); return false;"/>
         </p>
         <p><?php _e( 'Redirect Link ', 'ample' ); echo $i;?>
         <input style="width: 100%;" name="<?php echo $this->get_field_name( $link ); ?>" type="text" value="<?php if( isset ( $instance[ $link ] ) ) echo esc_url( $instance[ $link ] ); ?>" /></p>
         <p>
            <label for="<?php echo $this->get_field_id( $hover_text ); ?>"><?php _e( 'Hover Title Text ', 'ample' ); echo $i; ?></label>
            <input style="width: 100%;" id="<?php echo $this->get_field_id( $hover_text ); ?>" name="<?php echo $this->get_field_name( $hover_text ); ?>" type="text" value="<?php echo $instance[ $hover_text ]; ?>" />
         </p>
         <hr/>
      <?php } ?>
   <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'client_menu_id' ] = strip_tags( $new_instance[ 'client_menu_id' ] );
      $instance[ 'client_title' ] = strip_tags( $new_instance[ 'client_title' ] );

      if ( current_user_can('unfiltered_html') )
         $instance[ 'client_description' ] =  $new_instance[ 'client_description' ];
      else
         $instance[ 'client_description' ] = stripslashes( wp_filter_post_kses( addslashes($new_instance[ 'client_description' ]) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'client_num' ] = absint( $new_instance[ 'client_num' ] );

      for( $i=1; $i<=$instance[ 'client_num' ]; $i++ ) {
         $image = 'image-'.$i;
         $link = 'link-'.$i;
         $hover_text = 'hover-text'.$i;
         $instance[ $image ] = esc_url_raw( $new_instance[ $image ] );
         $instance[ $link ] = esc_url( $new_instance[ $link ] );
         $instance[ $hover_text ] = strip_tags( $new_instance[ $hover_text ] );
      }
      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = apply_filters( 'widget_title', isset( $instance[ 'client_title' ] ) ? $instance[ 'client_title' ] : '');
      $description = isset( $instance[ 'client_description' ] ) ? $instance[ 'client_description' ] : '';

      $image_array = array();
      $link_array = array();
      $hover_text_array = array();

      for( $i=1; $i<=$instance[ 'client_num' ]; $i++ ) {
         $j = $i -1;
         $image = 'image-'.$i;
         $link = 'link-'.$i;
         $hover_text = 'hover-text'.$i;
         $image = isset( $instance[ $image ] ) ? $instance[ $image ] : '';
         $link = isset( $instance[ $link ] ) ? $instance[ $link ] : '';
         $hover_text = isset( $instance[ $hover_text ] ) ? $instance[ $hover_text ] : '';
         array_push( $image_array, $image );
         array_push( $link_array, $link );
         array_push( $hover_text_array, $hover_text );
         // For WPML plugin compatibility
         if ( function_exists( 'icl_register_string' ) ) {
            if( !empty( $image ) ) {
               icl_register_string( 'Ample Pro', 'TG: Our Clients image' . $this->id . $j , $image_array[$j] );

               if( !empty( $link ) ) {
                  icl_register_string( 'Ample Pro', 'TG: Our Clients link' . $this->id . $j , $link_array[$j] );
               }
               if( !empty( $hover_text ) ) {
                  icl_register_string( 'Ample Pro', 'TG: Our Clients hover' . $this->id . $j , $hover_text_array[$j] );
               }
            }
         }
      }

      echo $before_widget;

      $section_id = '';
      if( !empty( $instance[ 'client_menu_id' ] ) )
         $section_id = 'id="' . $instance[ 'client_menu_id' ] . '"';
      ?>

      <div <?php echo $section_id ?> class="client-list">
         <div class="clients-all-content clearfix">

            <div class="clients-header">
               <?php if ( !empty( $title ) ) { ?>
                  <?php echo $before_title . esc_html( $title ) . $after_title; ?>
               <?php } ?>
               <?php if ( !empty( $description ) ) { ?>
                  <div class="clients-main-description">
                     <p><?php echo esc_textarea( $description ); ?></p>
                  </div>
               <?php } ?>
            </div>

            <?php
            if ( !empty( $image_array ) ) {
               $output = '';
               $output .= '<ul class="client-slider">';
               for( $i=1; $i<=$instance[ 'client_num' ]; $i++ ) {
                  $j = $i - 1;
                  if( !empty( $image_array[$j] ) ) {
                     $output .= '<li>';
                     // For WPML plugin compatibility
                     if ( function_exists( 'icl_t' ) ) {
                        $image_array[$j] = icl_t( 'Ample Pro', 'TG: Our Clients image' . $this->id . $j , $image_array[$j] );
                     }
                     if( !empty( $hover_text_array[$j] ) ) {
                        if ( function_exists( 'icl_t' ) ) {
                           $hover_text_array[$j] = icl_t( 'Ample Pro', 'TG: Our Clients hover' . $this->id . $j , $hover_text_array[$j] );
                        }
                     }

                     if( !empty( $link_array[$j] ) ) {
                        if ( function_exists( 'icl_t' ) ) {
                           $link_array[$j] = icl_t( 'Ample Pro', 'TG: Our Clients link' . $this->id . $j , $link_array[$j] );
                        }

                        $output .= '<a href="'.$link_array[$j].'" title="'.$hover_text_array[$j].'" target="_blank"><img src="'.$image_array[$j].'" alt="'.$hover_text_array[$j].'"></a>';
                     }
                     else {
                        $output .= '<img src="'.$image_array[$j].'" alt="'.$hover_text_array[$j].'">';
                     }
                     $output .=  '</li>';
                  }
               }
               $output .= '</ul>';
               echo $output;
            }
            ?>
         </div>
      </div>
      <?php
      echo $after_widget;
   }
}