<?php
/**
 * Ample Pro Theme Customizer
 *
 * @package ThemeGrill
 * @subpackage Ample Pro
 * @since Ample 1.0.3
 */

function ample_customize_register($wp_customize) {

	// Header Options Area
   $wp_customize->add_panel('ample_header', array(
   	'title' => __('Header', 'ample'),
      'capabitity' => 'edit_theme_options',
      'priority' => 300
   ));

   // Header Logo upload option
	$wp_customize->add_section('ample_header_logo', array(
		'title'     => __( 'Header Logo', 'ample' ),
		'priority'  => 10,
		'panel' => 'ample_header'
	));

	$wp_customize->add_setting('ample[ample_header_logo_image]', array(
		'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_sanitize_url',
      'sanitize_js_callback' => 'ample_sanitize_js_url'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control($wp_customize, 'ample[ample_header_logo_image]', array(
			'label' 		=> __( 'Upload logo for your header.', 'ample' ),
			'section' 	=> 'ample_header_logo',
			'settings' 	=> 'ample[ample_header_logo_image]'
		))
	);
	// Header logo and text display type option
	$wp_customize->add_section('ample_header_logo_text', array(
		'title'     => __( 'Show', 'ample' ),
		'priority'  => 20,
		'panel' => 'ample_header'
	));

	$wp_customize->add_setting('ample[ample_show_header_logo_text]', array(
      'default' => 'text_only',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_radio_sanitize'
   ));
   $wp_customize->add_control('ample[ample_show_header_logo_text]', array(
      'type' => 'radio',
      'label' => __('Choose the option that you want.', 'ample'),
      'section' => 'ample_header_logo_text',
      'choices' => array(
         'logo_only'    => __( 'Header Logo Only', 'ample' ),
	      'text_only'    => __( 'Header Text Only', 'ample' ),
	      'both'         => __( 'Show Both', 'ample' ),
	      'none'         => __( 'Disable', 'ample' )
      )
   ));

   // Header Top bar activate option
   $wp_customize->add_section('ample_activate_top_header_bar_setting', array(
      'priority' => 22,
      'title' => __('Activate Header Top Bar', 'ample'),
      'panel' => 'ample_header'
   ));

	$wp_customize->add_setting('ample[ample_activate_top_header_bar]', array(
		'default' => 0,
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_sanitize_checkbox'
	));
	$wp_customize->add_control('ample[ample_activate_top_header_bar]', array(
		'type' => 'checkbox',
		'label' => __( 'Check to show top header bar. The top header bar includes Social icons area and Small text area.', 'ample' ),
		'section' => 'ample_activate_top_header_bar_setting'
	));

	class AMPLE_Editor_Control extends WP_Customize_Control {

		public $type = 'ample_editor_control';

		public function render_content() {
			static $i = 1; ?>

			<script type="text/javascript">
				(function($) {
					wp.customizerCtrlEditor = {

						init: function() {

							$(window).load(function() {

								$('textarea.wp-editor-area').each(function() {
									var tArea = $(this),
										id = tArea.attr('id'),
										name =  tArea.attr('name'),
										input = $('input[data-customize-setting-link="' + name + '"]'),
										editor = tinyMCE.get(id),
										setChange,
										content;

									if (editor) {
										editor.on('change', function(e) {
											editor.save();
											content = editor.getContent();
											clearTimeout(setChange);
											setChange = setTimeout(function() {
												input.val(content).trigger('change');
											}, 500);
										});
									}

									tArea.css({
										visibility: 'visible'
									}).on('keyup', function() {
										content = tArea.val();
										clearTimeout(setChange);
										setChange = setTimeout(function() {
											input.val(content).trigger('change');
										}, 500);
									});
								});
							});
						}
					};
					wp.customizerCtrlEditor.init();
				})(jQuery);
			</script>

			<label>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
			</label>

			<?php
			$settings = array(
				'textarea_name' => $this->id,
				'teeny'         => true,
			);
			$new_id = str_replace( array( '[', ']' ), '', $this->id );
			wp_editor( htmlspecialchars_decode( $this->value() ), $new_id, $settings );
			do_action( 'admin_footer' );
			if( $i == 2 ) {
				do_action( 'admin_print_footer_scripts' );
			}
			$i++;
		}
	}

	// Header area small text option
   $wp_customize->add_section('ample_header_info_text_setting', array(
      'priority' => 24,
      'title' => __('Header Info Text', 'ample'),
      'panel' => 'ample_header'
   ));

	$wp_customize->add_setting('ample[ample_header_info_text]', array(
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_editor_sanitize'
	));
	$wp_customize->add_control(
		new AMPLE_Editor_Control($wp_customize,'ample[ample_header_info_text]', array(
			'label' => __( 'You can add phone numbers, other contact info here as you like. This box also accepts shortcodes.', 'ample' ),
			'section' => 'ample_header_info_text_setting',
			'setting' => 'ample[ample_header_info_text]'
		))
	);

   // Header Title Bar Background Image upload option
	$wp_customize->add_section('ample_header_title_bar', array(
		'title'     => __( 'Header Title Bar Background Image', 'ample' ),
		'priority'  => 30,
		'panel' => 'ample_header'
	));
	$wp_customize->add_setting('ample[ample_header_title_background_image]', array(
		'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_sanitize_url',
      'sanitize_js_callback' => 'ample_sanitize_js_url'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control($wp_customize, 'ample[ample_header_title_background_image]', array(
			'label' 		=> __( 'Upload Background Image for Header Title Bar.', 'ample' ),
			'section' 	=> 'ample_header_title_bar',
			'settings' 	=> 'ample[ample_header_title_background_image]'
		))
	);

	// Header Image Position
	$wp_customize->add_section('ample_header_image_position_setting', array(
		'title'     => __( 'Header Image Position', 'ample' ),
		'priority'  => 40,
		'panel' => 'ample_header'
	));

	$wp_customize->add_setting('ample[ample_header_image_position]', array(
      'default' => 'above',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_radio_sanitize'
   ));
   $wp_customize->add_control('ample[ample_header_image_position]', array(
      'type' => 'radio',
      'label' => __('Choose top header image display position.', 'ample'),
      'section' => 'ample_header_image_position_setting',
      'choices' => array(
         'above' => __( 'Position Above (Default): Display the Header image just above the site title and main menu part.', 'ample' ),
         'below' => __( 'Position Below: Display the Header image just below the site title and main menu part.', 'ample' )
      )
   ));

	// Header Background Image upload option
	$wp_customize->add_section('ample_header_background_image_setting', array(
		'title'     => __( 'Header Background Image', 'ample' ),
		'priority'  => 50,
		'panel' => 'ample_header'
	));
	$wp_customize->add_setting('ample[ample_header_background_image]', array(
		'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_sanitize_url',
      'sanitize_js_callback' => 'ample_sanitize_js_url'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control($wp_customize, 'ample[ample_header_background_image]', array(
			'label' 		=> __( 'Header contain Logo, Site Title, Tagline and Menu.', 'ample' ),
			'section' 	=> 'ample_header_background_image_setting',
			'settings' 	=> 'ample[ample_header_background_image]'
		))
	);

	$wp_customize->add_setting('ample[ample_header_background_image_full_width]', array(
		'default' => 0,
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_sanitize_checkbox'
	));
	$wp_customize->add_control('ample[ample_header_background_image_full_width]', array(
		'type' => 'checkbox',
		'label' => __( 'Check to display header background image inside inner-wrap ', 'ample' ),
		'section' => 'ample_header_background_image_setting'
	));
	// End of the Header Options

 /**************************************************************************************/

 	// Design Options Area
   $wp_customize->add_panel('ample_design_options', array(
   	'title' => __('Design', 'ample'),
      'capabitity' => 'edit_theme_options',
      'priority' => 310
   ));

   // Site Layout
	$wp_customize->add_section('ample_site_layout_setting', array(
		'title'     => __( 'Site Layout', 'ample' ),
		'priority'  => 10,
		'panel' => 'ample_design_options'
	));

	$wp_customize->add_setting('ample[ample_site_layout]', array(
      'default' => 'wide',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_radio_sanitize'
   ));
   $wp_customize->add_control('ample[ample_site_layout]', array(
      'type' => 'radio',
      'label' => __('Choose your site layout. The change is reflected in whole site.', 'ample'),
      'section' => 'ample_site_layout_setting',
      'choices' => array(
         'wide' => __( 'Wide layout', 'ample' ),
         'box' => __( 'Boxed layout', 'ample' )
      )
   ));

   // Radio Image Custom Control
   class AMPLE_Image_Radio_Control extends WP_Customize_Control {

 		public function render_content() {

			if ( empty( $this->choices ) )
				return;

			$name = '_customize-radio-' . $this->id;

			?>
			<style>
				#ample-img-container .ample-radio-img-img {
					border: 3px solid #DEDEDE;
					margin: 0 5px 5px 0;
					cursor: pointer;
					border-radius: 3px;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
				}
				#ample-img-container .ample-radio-img-selected {
					border: 3px solid #AAA;
					border-radius: 3px;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
				}
				input[type=checkbox]:before {
					content: '';
					margin: -3px 0 0 -4px;
				}
			</style>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<ul class="controls" id = 'ample-img-container'>
			<?php
				foreach ( $this->choices as $value => $label ) :
					$class = ($this->value() == $value)?'ample-radio-img-selected ample-radio-img-img':'ample-radio-img-img';
					?>
					<li style="display: inline;">
					<label>
						<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
						<img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo $class; ?>' />
					</label>
					</li>
					<?php
				endforeach;
			?>
			</ul>
			<script type="text/javascript">

				jQuery(document).ready(function($) {
					$('.controls#ample-img-container li img').click(function(){
						$('.controls#ample-img-container li').each(function(){
							$(this).find('img').removeClass ('ample-radio-img-selected') ;
						});
						$(this).addClass ('ample-radio-img-selected') ;
					});
				});

			</script>
			<?php
		}
	}

   // Default layout
	$wp_customize->add_section('ample_default_layout_setting', array(
		'title' => __( 'Default layout', 'ample' ),
		'priority' => 20,
  		'panel' => 'ample_design_options'
	));

	$wp_customize->add_setting('ample[ample_default_layout]', array(
      'default' => 'right_sidebar',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_radio_sanitize'
   ));
   $wp_customize->add_control(
   	new AMPLE_Image_Radio_Control($wp_customize, 'ample[ample_default_layout]', array(
	      'type' => 'radio',
	      'label' => __('Select default layout. This layout will be reflected in whole site archives, search etc. The layout for a single post and page can be controlled from below options.', 'ample'),
	      'section' => 'ample_default_layout_setting',
	      'choices' => array(
				'right_sidebar'	=> get_template_directory_uri() . '/inc/admin/images/right-sidebar.png',
				'left_sidebar'		=> get_template_directory_uri() . '/inc/admin/images/left-sidebar.png',
				'no_sidebar_full_width'		=> get_template_directory_uri() . '/inc/admin/images/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered'		=> get_template_directory_uri() . '/inc/admin/images/no-sidebar-content-centered-layout.png',
				'both_sidebar' => get_template_directory_uri() . '/inc/admin/images/both-sidebar.png'
			)
		))
   );

   // Default layout for pages only
	$wp_customize->add_section('ample_pages_default_layout_setting', array(
		'title' => __( 'Default layout for pages only', 'ample' ),
		'priority' => 30,
  		'panel' => 'ample_design_options'
	));

	$wp_customize->add_setting('ample[ample_pages_default_layout]', array(
      'default' => 'right_sidebar',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_radio_sanitize'
   ));
   $wp_customize->add_control(
   	new AMPLE_Image_Radio_Control($wp_customize, 'ample[ample_pages_default_layout]', array(
	      'type' => 'radio',
	      'label' => __('Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'ample'),
	      'section' => 'ample_pages_default_layout_setting',
	      'choices' => array(
				'right_sidebar'	=> get_template_directory_uri() . '/inc/admin/images/right-sidebar.png',
				'left_sidebar'		=> get_template_directory_uri() . '/inc/admin/images/left-sidebar.png',
				'no_sidebar_full_width'		=> get_template_directory_uri() . '/inc/admin/images/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered'		=> get_template_directory_uri() . '/inc/admin/images/no-sidebar-content-centered-layout.png',
				'both_sidebar' => get_template_directory_uri() . '/inc/admin/images/both-sidebar.png'
			)
		))
   );

	// Default layout for single posts only
	$wp_customize->add_section('ample_single_posts_default_layout_setting', array(
		'title' => __( 'Default layout for single posts only', 'ample' ),
		'priority' => 40,
  		'panel' => 'ample_design_options'
	));

	$wp_customize->add_setting('ample[ample_single_posts_default_layout]', array(
      'default' => 'right_sidebar',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_radio_sanitize'
   ));
   $wp_customize->add_control(
   	new AMPLE_Image_Radio_Control($wp_customize, 'ample[ample_single_posts_default_layout]', array(
	      'type' => 'radio',
	      'label' => __('Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'ample'),
	      'section' => 'ample_single_posts_default_layout_setting',
	      'choices' => array(
				'right_sidebar'	=> get_template_directory_uri() . '/inc/admin/images/right-sidebar.png',
				'left_sidebar'		=> get_template_directory_uri() . '/inc/admin/images/left-sidebar.png',
				'no_sidebar_full_width'		=> get_template_directory_uri() . '/inc/admin/images/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered'		=> get_template_directory_uri() . '/inc/admin/images/no-sidebar-content-centered-layout.png',
				'both_sidebar' => get_template_directory_uri() . '/inc/admin/images/both-sidebar.png'
			)
		))
   );

   // Custom CSS setting
   class AMPLE_Custom_CSS_Control extends WP_Customize_Control {

      public $type = 'custom_css';

      public function render_content() {
      ?>
         <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
         </label>
      <?php
      }
   }

   $wp_customize->add_section('ample_custom_css_setting', array(
      'priority' => 60,
      'title' => __('Custom CSS', 'ample'),
      'panel' => 'ample_design_options'
   ));

   $wp_customize->add_setting('ample[ample_custom_css]', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'wp_filter_nohtml_kses',
      'sanitize_js_callback' => 'wp_filter_nohtml_kses'
   ));
   $wp_customize->add_control(
   	new AMPLE_Custom_CSS_Control($wp_customize, 'ample[ample_custom_css]', array(
	      'label' => __('Write your custom css.', 'ample'),
	      'section' => 'ample_custom_css_setting',
	      'settings' => 'ample[ample_custom_css]'
   	))
   );
   // End of the Design Options

 /**************************************************************************************/

	/* Social Link Area */
   $wp_customize->add_panel('ample_social_link_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 315,
      'title' => __('Social Links', 'ample')
   ));

   // Social links activate option
   $wp_customize->add_section('ample_activate_social_links_setting', array(
      'priority' => 10,
      'title' => __('Activate Social Links Area', 'ample'),
      'panel' => 'ample_social_link_options'
   ));

	$wp_customize->add_setting('ample[ample_activate_social_links]', array(
		'default' => 0,
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_sanitize_checkbox'
	));
	$wp_customize->add_control('ample[ample_activate_social_links]', array(
		'type' => 'checkbox',
		'label' => __( 'Check to activate social links area. You also need to activate the Header Top Bar section in Header options to show this Social Links area.', 'ample' ),
		'section' => 'ample_activate_social_links_setting'
	));

   $social_links = array( 'facebook', 'twitter', 'google-plus', 'instagram', 'skype', 'gitHub', 'linkedIn', 'pinterest', 'wordpress', 'youtube' );

	for($i=1; $i<=10; $i++) {
      $j = $i - 1;
	   $wp_customize->add_section('ample_icon_class_setting'. $i, array(
	      'priority' => 20 + $i,
	      'title' => __( 'Social Link ', 'ample' ) . $i,
	      'panel' => 'ample_social_link_options'
	   ));

	   $wp_customize->add_setting('ample[ample_icon_class'. $i.']', array(
			'default' => '',
	      'capability' => 'edit_theme_options',
      	'type' => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		));
		$wp_customize->add_control('ample[ample_icon_class'. $i.']', array(
			'label'	=> __( 'Add any font awesome icon class. Example ', 'ample' ) . $social_links[$j],
			'section'	=> 'ample_icon_class_setting'. $i
		));

		$wp_customize->add_setting('ample[ample_social_icon_link' . $i.']', array(
			'default' => '',
	      'capability' => 'edit_theme_options',
      	'type' => 'option',
			'sanitize_callback' => 'ample_sanitize_url',
	      'sanitize_js_callback' => 'ample_sanitize_js_url'
		));
		$wp_customize->add_control('ample[ample_social_icon_link' . $i.']', array(
			'label'	=> __( 'Add Link', 'ample' ),
			'section'	=> 'ample_icon_class_setting'. $i
		));

		$wp_customize->add_setting('ample[ample_social_new_tab' . $i. ']', array(
			'default' => 0,
	      'capability' => 'edit_theme_options',
      	'type' => 'option',
	      'sanitize_callback' => 'ample_sanitize_checkbox'
		));
		$wp_customize->add_control('ample[ample_social_new_tab' . $i. ']', array(
			'type' => 'checkbox',
			'label' => __( 'Check to open in new tab', 'ample' ),
			'section' => 'ample_icon_class_setting'. $i
		));
	}
	// End of the Social Links Options

 /**************************************************************************************/

	/* Slider Options Area */
   $wp_customize->add_panel('ample_slider_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 320,
      'title' => __('Slider', 'ample'),
   ));

   // Slider activate option
	$wp_customize->add_section('ample_activate_slider_setting', array(
		'title'     => __( 'Activate slider', 'ample' ),
		'priority'  => 10,
		'panel' => 'ample_slider_options'
	));

	$wp_customize->add_setting('ample[ample_activate_slider]',	array(
		'default' => 0,
      'capability' => 'edit_theme_options',
      'type' => 'option',
		'sanitize_callback' => 'ample_sanitize_checkbox'
	));
	$wp_customize->add_control('ample[ample_activate_slider]',	array(
		'type' => 'checkbox',
		'label' => __('Check to activate slider.', 'ample' ),
		'section' => 'ample_activate_slider_setting'
	));

	// Slider status option
	$wp_customize->add_section('ample_slider_status_setting', array(
		'title'     => __( 'Slider Status', 'ample' ),
		'priority'  => 12,
		'panel' => 'ample_slider_options'
	));

	$wp_customize->add_setting('ample[ample_slider_status]', array(
		'default' => 'front_page',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_radio_sanitize'
	));
	$wp_customize->add_control('ample[ample_slider_status]', array(
		'label' => __( 'Choose the slider status that you want.', 'ample' ),
		'type' => 'radio',
		'section' => 'ample_slider_status_setting',
		'choices' => array(
         'front_page'	=> __( 'Slider on Front page', 'ample' ),
         'all_page'	=> __( 'Slider on all pages', 'ample' ),
      )
	));

	// Slider Setting
	$wp_customize->add_section('ample_slider_setting', array(
		'title'     => __( 'Slider Settings', 'ample' ),
		'priority'  => 14,
		'panel' => 'ample_slider_options'
	));

	$wp_customize->add_setting('ample[ample_slider_transition_effect]', array(
		'default' => 'fade',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_radio_sanitize'
	));
	$wp_customize->add_control('ample[ample_slider_transition_effect]', array(
		'label' => __( 'Slider transition effect. Choose the transition effect that you like. Default is "fade".', 'ample' ),
		'type' => 'select',
		'section' => 'ample_slider_setting',
		'choices' => array(
         'fade'         => __( 'Fade', 'ample' ),
         'horizontal'   => __( 'Horizontal', 'ample' ),
         'vertical'     => __( 'Vertical', 'ample' )
      )
	));

	// Slider transition delay time
	$wp_customize->add_setting('ample[ample_slider_transition_delay]', array(
		'default' => '4',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_integer_sanitize'
	));
	$wp_customize->add_control('ample[ample_slider_transition_delay]', array(
		'label' => __( 'Slider transition delay time. Add number in seconds. Default is 4.', 'ample' ),
		'section' => 'ample_slider_setting'
	));

	// Slider transition length time
	$wp_customize->add_setting('ample[ample_slider_transition_length]', array(
		'default' => '1',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_integer_sanitize'
	));
	$wp_customize->add_control('ample[ample_slider_transition_length]', array(
		'label' => __( 'Slider transition length time. Add number in seconds. Default is 1.', 'ample' ),
		'section' => 'ample_slider_setting'
	));

	// Number of slider
	$wp_customize->add_setting('ample[ample_slider_number]', array(
		'default' => '4',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_integer_sanitize'
	));
	$wp_customize->add_control('ample[ample_slider_number]', array(
		'label' => __( 'Number of slides Enter the number of slides you want then click "Save Options".', 'ample' ),
		'section' => 'ample_slider_setting'
	));

	// Slider image as link option
	$wp_customize->add_setting('ample_slider_image_link_option',	array(
		'default' => 0,
      'capability' => 'edit_theme_options',
      'type' => 'option',
		'sanitize_callback' => 'ample_sanitize_checkbox'
	));
	$wp_customize->add_control('ample_slider_image_link_option',	array(
		'type' => 'checkbox',
		'label' => __('Check to make the slider images link back to respective links.', 'ample' ),
		'section' => 'ample_slider_setting'
	));

	$num_of_slides = ample_option( 'ample_slider_number', '4' );

	// Slide options
	for( $i=1; $i<=$num_of_slides; $i++) {
		// Slider Image upload
		$wp_customize->add_section('ample_slider_image_setting'.$i, array(
			'title'	=> sprintf( __( 'Slider #%1$s', 'ample' ), $i ),
			'priority'	=> $i+50,
			'panel' => 'ample_slider_options'
		));

		$wp_customize->add_setting('ample[ample_slider_image'.$i.']', array(
			'default' => '',
	      'capability' => 'edit_theme_options',
      	'type' => 'option',
	      'sanitize_callback' => 'ample_sanitize_url',
	      'sanitize_js_callback' => 'ample_sanitize_js_url'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control($wp_customize, 'ample[ample_slider_image'.$i.']', array(
				'label' 		=> __( 'Upload image', 'ample' ),
				'section' 	=> 'ample_slider_image_setting'.$i,
				'settings' 	=> 'ample[ample_slider_image'.$i.']'
			))
		);

		// Slider Title
		$wp_customize->add_setting('ample[ample_slider_title'.$i.']', array(
			'default' => '',
	      'capability' => 'edit_theme_options',
      	'type' => 'option',
	      'sanitize_callback' => 'wp_filter_nohtml_kses'

		));
		$wp_customize->add_control('ample[ample_slider_title'.$i.']', array(
			'label'	=> __( 'Enter title for this slide', 'ample' ),
			'section'	=> 'ample_slider_image_setting'.$i,
			'settings' 	=> 'ample[ample_slider_title'.$i.']'
		));

		// Button Text
		$wp_customize->add_setting('ample[ample_slider_button_text'.$i.']', array(
			'default' => '',
	      'capability' => 'edit_theme_options',
      	'type' => 'option',
	      'sanitize_callback' => 'wp_filter_nohtml_kses'

		));
		$wp_customize->add_control('ample[ample_slider_button_text'.$i.']', array(
			'label'	=> __( 'Enter button text', 'ample' ),
			'section' 	=> 'ample_slider_image_setting'.$i,
			'settings' 	=> 'ample[ample_slider_button_text'.$i.']'
		));

		// Button Link
		$wp_customize->add_setting('ample[ample_slider_link'.$i.']', array(
			'default' => '',
	      'capability' => 'edit_theme_options',
      	'type' => 'option',
			'sanitize_callback' => 'ample_sanitize_url',
	      'sanitize_js_callback' => 'ample_sanitize_js_url'

		));
		$wp_customize->add_control('ample[ample_slider_link'.$i.']', array(
			'label'	=> __( 'Enter link to redirect', 'ample' ),
			'section'	=> 'ample_slider_image_setting'.$i,
			'settings'	=> 'ample[ample_slider_link'.$i.']'
		));
	}
	// End of the Slider Options

 /**************************************************************************************/

	/* Additional Options Area */
   $wp_customize->add_panel('ample_additional_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 330,
      'title' => __('Additional', 'ample')
   ));

   // One Page
	$wp_customize->add_section('ample_activate_sticky_menu_setting', array(
		'title'     => __( 'One Page Settings', 'ample' ),
		'priority'  => 5,
		'panel' => 'ample_additional_options'
	));

	$wp_customize->add_setting('ample[ample_activate_sticky_menu]',	array(
		'default' => 0,
      'capability' => 'edit_theme_options',
      'type' => 'option',
		'sanitize_callback' => 'ample_sanitize_checkbox'
	));
	$wp_customize->add_control('ample[ample_activate_sticky_menu]',	array(
		'type' => 'checkbox',
		'label' => __('Activate one page style menu', 'ample' ),
		'section' => 'ample_activate_sticky_menu_setting'
	));

	// Favicon Activate Option
	$wp_customize->add_section('ample_favicon_setting', array(
		'title'     => __( 'Favicon', 'ample' ),
		'priority'  => 10,
  		'panel' => 'ample_additional_options'
	));

	$wp_customize->add_setting('ample[ample_activate_favicon]',	array(
		'default' => 0,
      'capability' => 'edit_theme_options',
      'type' => 'option',
		'sanitize_callback' => 'ample_sanitize_checkbox'
	));
	$wp_customize->add_control('ample[ample_activate_favicon]',	array(
		'type' => 'checkbox',
		'label' => __('Check to activate favicon. Upload fav icon from below option', 'ample' ),
		'section' => 'ample_favicon_setting'
	));

	// Fav icon upload option
	$wp_customize->add_setting('ample[ample_favicon]', array(
		'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_sanitize_url',
      'sanitize_js_callback' => 'ample_sanitize_js_url'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control($wp_customize, 'ample[ample_favicon]', array(
			'label' 		=> __( 'Upload favicon for your site.', 'ample' ),
			'section' 	=> 'ample_favicon_setting',
			'settings' 	=> 'ample[ample_favicon]'
		))
	);

	// Multicheck Custom Control
	class AMPLE_Controls_MultiCheck_Control extends WP_Customize_Control {

		public $type = 'multicheck';

		public function render_content() { ?>

			<script type="text/javascript">

				jQuery( document ).ready( function() {
					jQuery( '.customize-control-multicheck input[type="checkbox"]' ).on( 'change', function() {
							checkbox_values = jQuery( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
								function() { return this.value; }
							).get().join( ',' );
							jQuery( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
						}
					);
				} );
			</script>

			<?php if ( empty( $this->choices ) ) {
				return;
			}

			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>

			<?php $multi_values = ( ! is_array( $this->value() ) ) ? explode( ',', $this->value() ) : $this->value(); ?>

			<ul>
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<li>
						<label>
							<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
							<?php echo esc_html( $label ); ?>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>

			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
		<?php }
	}

	// Pull all the categories into an array
   $options_categories = array();
   $options_categories_obj = get_categories();
   foreach ($options_categories_obj as $category) {
      $options_categories[$category->cat_ID] = $category->cat_name;
   }

	// Select category to hide from Post Page
	$wp_customize->add_section('ample_hide_category_setting', array(
		'title'     => __( 'Category to hide from Blog', 'ample' ),
		'priority'  => 20,
  		'panel' => 'ample_additional_options'
	));

	$wp_customize->add_setting('ample[ample_hide_category]',	array(
		'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'wp_filter_nohtml_kses'
	));
	$wp_customize->add_control(
		new AMPLE_Controls_MultiCheck_Control($wp_customize, 'ample[ample_hide_category]', array(
			'label' => __('Select a Category or Categories to hide its posts from Blog page.', 'ample' ),
			'section' => 'ample_hide_category_setting',
			'setting' => 'ample[ample_hide_category]',
			'choices' => $options_categories
		))
	);

	// Display excerpt/content in blog and archives
	$wp_customize->add_section('ample_toggle_excerpt_full_post', array(
		'title'     => __( 'Excerpts or Full Posts Option', 'ample' ),
		'priority'  => 30,
		'panel' => 'ample_additional_options'
	));

	$wp_customize->add_setting('ample[ample_toggle_excerpt_full_post_setting]', array(
		'default' => 'full_post',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_radio_sanitize'
	));
	$wp_customize->add_control('ample[ample_toggle_excerpt_full_post_setting]', array(
		'label' => __( 'Toggle between displaying excerpts and full posts on your blog and archives.', 'ample' ),
		'type' => 'radio',
		'section' => 'ample_toggle_excerpt_full_post',
		'choices' => array(
         'full_post' => __( 'Show full post content', 'ample' ),
         'excerpt'   => __( 'Show excerpt', 'ample' )
      )
	));

	// Excerpt Options
	$wp_customize->add_section('ample_excerpt_words_setting', array(
		'title'     => __( 'Excerpt Length', 'ample' ),
		'priority'  => 40,
  		'panel' => 'ample_additional_options'
	));

	$wp_customize->add_setting('ample[ample_excerpt_words]', array(
		'default' => '40',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_integer_sanitize'
	));
	$wp_customize->add_control('ample[ample_excerpt_words]', array(
		'label' 		=> __( 'Enter the number of Words you wish to show on excerpt. Default value is 40 words.', 'ample' ),
		'section' 	=> 'ample_excerpt_words_setting'
	));

	// Change Read more text
	$wp_customize->add_section('ample_read_more_text_setting', array(
		'title'     => __( 'Excerpt Read More Text', 'ample' ),
		'priority'  => 50,
  		'panel' => 'ample_additional_options'
	));

	$wp_customize->add_setting('ample[ample_read_more_text]', array(
		'default' => 'Read more',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'wp_filter_nohtml_kses'
	));
	$wp_customize->add_control('ample[ample_read_more_text]', array(
		'label' 		=> __( 'Replace the default Read more text with your own words', 'ample' ),
		'section' 	=> 'ample_read_more_text_setting'
	));

	// Allow Comments on Pages
	$wp_customize->add_section('ample_allow_comment_on_page_setting', array(
		'title'     => __( 'Allow Comments on Pages', 'ample' ),
		'priority'  => 60,
		'panel' => 'ample_additional_options'
	));

	$wp_customize->add_setting('ample[ample_allow_comment_on_page]',	array(
		'default' => 0,
      'capability' => 'edit_theme_options',
      'type' => 'option',
		'sanitize_callback' => 'ample_sanitize_checkbox'
	));
	$wp_customize->add_control('ample[ample_allow_comment_on_page]',	array(
		'type' => 'checkbox',
		'label' => __('Check to display Comment on pages', 'ample' ),
		'section' => 'ample_allow_comment_on_page_setting'
	));

	// Menu Top Border
	$wp_customize->add_section('ample_hide_menu_top_border_setting', array(
		'title'     => __( 'Hide Menu Top Border', 'ample' ),
		'priority'  =>70,
		'panel' => 'ample_additional_options'
	));

	$wp_customize->add_setting('ample[ample_hide_menu_top_border]',	array(

		'default' => 0,
      'capability' => 'edit_theme_options',
      'type' => 'option',
		'sanitize_callback' => 'ample_sanitize_checkbox'
	));
	$wp_customize->add_control('ample[ample_hide_menu_top_border]',	array(
		'type' => 'checkbox',
		'label' => __('Check to hide the top bar of Primary Menu', 'ample' ),
		'section' => 'ample_hide_menu_top_border_setting'
	));

	// Footer editor option
	$wp_customize->add_section('ample_footer_editor_setting', array(
		'title'	=> __( 'Footer Copyright Editor', 'ample' ),
		'priority'  => 80,
  		'panel' => 'ample_additional_options'
	));

	$wp_customize->add_setting('ample[ample_footer_editor]', array(
		'default' => __( 'Copyright &copy; ', 'ample' ).'[the-year] [site-link] '.__( 'Theme by: ', 'ample' ).'[tg-link] '.__( 'Powered by: ', 'ample' ).'[wp-link]',
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_editor_sanitize'
	));
	$wp_customize->add_control(
		new AMPLE_Editor_Control($wp_customize,'ample[ample_footer_editor]', array(
			'label' 		=> __( 'Edit the Copyright information in your footer. You can also use shortcodes [the-year], [site-link], [wp-link], [tg-link] for current year, your site link, WordPress site link and ThemeGrill site link respectively.', 'ample' ),
			'section' 	=> 'ample_footer_editor_setting',
			'setting' => 'ample[ample_footer_editor]'
		))
	);
	// End of the Additional Options

 /**************************************************************************************/

	// Start of the Typography Option
   $wp_customize->add_panel('ample_typography_options', array(
      'priority' => 340,
      'title' => __('Typography', 'ample'),
      'capability' => 'edit_theme_options'
   ));

   // Font family options
   $wp_customize->add_section('ample_google_fonts_settings', array(
      'priority' => 1,
      'title' => __('Google Font Options', 'ample'),
      'panel' => 'ample_typography_options'
   ));

   $ample_fonts = array(
      'ample_site_title_font' => array(
         'id' => 'ample[ample_site_title_font]',
         'default' => 'Roboto+Slab:700,400',
         'title'=> __('Site title font. Default is "Roboto Slab".', 'ample')
      ),
      'ample_site_tagline_font' => array(
         'id' => 'ample[ample_site_tagline_font]',
         'default' => 'Roboto+Slab:700,400',
         'title'=> __('Site tagline font. Default is "Roboto Slab".', 'ample')
      ),
      'ample_primary_menu_font' => array(
         'id' => 'ample[ample_primary_menu_font]',
         'default' => 'Roboto:400,300,100',
         'title'=> __('Primary menu font. Default is "Roboto".', 'ample')
      ),
      'ample_titles_font' => array(
         'id' => 'ample[ample_titles_font]',
         'default' => 'Roboto+Slab:700,400',
         'title'=> __('All Titles font. Default is "Roboto Slab".', 'ample')
      ),
      'ample_content_font' => array(
         'id' => 'ample[ample_content_font]',
         'default' => 'Roboto:400,300,100',
         'title'=> __('Content font and for others. Default is "Roboto".', 'ample')
      )
   );

   foreach ($ample_fonts as $ample_font) {

      $wp_customize->add_setting($ample_font['id'], array(
         'default' => $ample_font['default'],
         'capability' => 'edit_theme_options',
      	'type' => 'option',
         'sanitize_callback' => 'ample_font_sanitize'
      ));

      $ample_google_fonts_choices = ample_google_fonts();

      $wp_customize->add_control($ample_font['id'], array(
         'label' => $ample_font['title'],
         'type' => 'select',
         'settings' => $ample_font['id'],
         'section' => 'ample_google_fonts_settings',
         'choices' => $ample_google_fonts_choices
      ));
   }

   // Font Size Option
	$ample_fonts_size_options = ample_font_size_func();

   foreach ($ample_fonts_size_options as $ample_section) {

      $wp_customize->add_section($ample_section['section_id'], array(
	      'title' => $ample_section['title'],
	      'panel' => 'ample_typography_options'
      ));

      $ample_section_id = $ample_section['section_id'];
      $ample_font_size_setting = $ample_section['ample_font_size_setting'];

	   foreach ($ample_font_size_setting as $ample_font_setting) {

	      $wp_customize->add_setting('ample['.$ample_font_setting['id'].']', array(
            'default' => $ample_font_setting['default'],
            'capability' => 'edit_theme_options',
      		'type' => 'option',
            'sanitize_callback' => 'ample_radio_sanitize'
         ));

	      $wp_customize->add_control('ample['.$ample_font_setting['id'].']', array(
            'label' => $ample_font_setting['label'],
            'type' => 'select',
            'settings' => 'ample['.$ample_font_setting['id'].']',
            'section' => $ample_section_id,
            'choices' => $ample_font_setting['choice']
         ));
	   }
	}
   // End of the Typography Options

 /**************************************************************************************/

   /* Start of the Color Options */
	$wp_customize->add_panel('ample_color_options', array(
      'priority' => 350,
      'title' => __('Color', 'ample'),
      'capability' => 'edit_theme_options'
   ));
   // Primary Color Option
	$wp_customize->add_section('ample_primary_color_setting', array(
	   'title' => 'Primary Color Option',
	   'panel' => 'ample_color_options'
	));
	$wp_customize->add_setting('ample[ample_primary_color]', array(
	   'default' => '#80abc8',
	   'capability' => 'edit_theme_options',
      'type' => 'option',
	   'sanitize_callback' => 'ample_color_option_hex_sanitize',
	   'sanitize_js_callback' => 'ample_color_escaping_option_sanitize'
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'ample[ample_primary_color]', array(
	      'label' => 'This will reflect in links, buttons and many others. Choose a color to match your site.',
	      'settings' => 'ample[ample_primary_color]',
	      'section' => 'ample_primary_color_setting'
	   ))
	);

	$ample_colors_options = ample_color_func();

   foreach ($ample_colors_options as $ample_color_section) {

      $wp_customize->add_section($ample_color_section['section_id'], array(
	      'title' => $ample_color_section['title'],
	      'panel' => 'ample_color_options'
      ));

      $ample_color_section_id = $ample_color_section['section_id'];
      $ample_color_settings = $ample_color_section['ample_color_settings'];

	   foreach ($ample_color_settings as $ample_color_setting) {

	      $wp_customize->add_setting('ample['.$ample_color_setting['id'].']', array(
            'default' => $ample_color_setting['default'],
            'capability' => 'edit_theme_options',
      		'type' => 'option',
            'sanitize_callback' => 'ample_color_option_hex_sanitize',
            'sanitize_js_callback' => 'ample_color_escaping_option_sanitize'
         ));

	      $wp_customize->add_control(
	      	new WP_Customize_Color_Control($wp_customize, 'ample['.$ample_color_setting['id'].']', array(
	            'label' => $ample_color_setting['label'],
	            'settings' => 'ample['.$ample_color_setting['id'].']',
	            'section' => $ample_color_section_id
	         ))
	      );
	   }
	}
   // End of the Color Options

 /**************************************************************************************/

	/* Start of the WooCommerce Options */
	if ( class_exists('woocommerce') ) {
		// WooCommerce Archive Page layout
		$wp_customize->add_panel('ample_woocommerce_options', array(
	      'priority' => 360,
	      'title' => __('WooCommerce', 'ample'),
	      'capability' => 'edit_theme_options'
	   ));

		$wp_customize->add_section('ample_woocommerce_layout_setting', array(
			'title' => __( 'Archive Page Layout', 'ample' ),
			'priority' => 10,
	  		'panel' => 'ample_woocommerce_options'
		));

		$wp_customize->add_setting('ample[ample_woocommerce_layout]', array(
	      'default' => 'right_sidebar',
	      'capability' => 'edit_theme_options',
      	'type' => 'option',
	      'sanitize_callback' => 'ample_radio_sanitize'
	   ));
	   $wp_customize->add_control(
	   	new AMPLE_Image_Radio_Control($wp_customize, 'ample[ample_woocommerce_layout]', array(
		      'type' => 'radio',
		      'label' => __('Select woocommerce layout. This layout will be reflected in woocommerce archive page only.', 'ample'),
		      'section' => 'ample_woocommerce_layout_setting',
		      'choices' => array(
               'right_sidebar' => get_template_directory_uri() . '/inc/admin/images/right-sidebar.png',
               'left_sidebar' => get_template_directory_uri() . '/inc/admin/images/left-sidebar.png',
               'no_sidebar_full_width' => get_template_directory_uri() . '/inc/admin/images/no-sidebar-full-width-layout.png',
               'no_sidebar_content_centered' => get_template_directory_uri() . '/inc/admin/images/no-sidebar-content-centered-layout.png',
               'both_sidebar' => get_template_directory_uri() . '/inc/admin/images/both-sidebar.png'
            )
			))
	   );
	}

 /**************************************************************************************/

   // Theme important links started
   class AMPLE_Important_Links extends WP_Customize_Control {

      public $type = "ample-important-links";

      public function render_content() {
         //Add Theme instruction, Support Forum, Demo Link, Rating Link
         $important_links = array(
            'support' => array(
               'link' => esc_url('http://themegrill.com/support-forum/'),
               'text' => __('Free Support', 'ample'),
            ),
            'documentation' => array(
               'link' => esc_url('http://themegrill.com/theme-instruction/ample-pro/'),
               'text' => __('Documentation', 'ample'),
            ),
            'demo' => array(
               'link' => esc_url('http://demo.themegrill.com/ample-pro/'),
               'text' => __('View Demo', 'ample'),
            )
         );
         foreach ($important_links as $important_link) {
            echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr($important_link['text']) . ' </a></p>';
         }
      }

   }

   $wp_customize->add_section('ample_important_links', array(
      'priority' => 700,
      'title' => __('About Ample Pro', 'ample'),
   ));

   /**
    * This setting has the dummy Sanitization function as it contains no value to be sanitized
    */
   $wp_customize->add_setting('ample[ample_important_links]', array(
      'capability' => 'edit_theme_options',
      'type' => 'option',
      'sanitize_callback' => 'ample_links_sanitize'
   ));

   $wp_customize->add_control(
   	new AMPLE_Important_Links($wp_customize, 'important_links', array(
	      'section' => 'ample_important_links',
	      'settings' => 'ample[ample_important_links]'
   	))
   );
   // Theme Important Links Ended

 /**************************************************************************************/

 	// Checkbox sanitization
 	function ample_sanitize_checkbox($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }
 	// URL sanitization
   function ample_sanitize_url( $input ) {
		$input = esc_url_raw( $input );
		return $input;
	}
	function ample_sanitize_js_url ( $input ) {
		$input = esc_url( $input );
		return $input;
	}
   // Color sanitization
   function ample_sanitize_hex_color($color) {
      if ($unhashed = sanitize_hex_color_no_hash($color))
         return '#' . $unhashed;

      return $color;
   }
   function ample_sanitize_escaping($input) {
      $input = esc_attr($input);
      return $input;
   }
   // Radio/Select sanitization
   function ample_radio_sanitize( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
	// Sanitization of links
   function ample_links_sanitize() {
      return false;
   }
   // Editor sanitization
   function ample_editor_sanitize( $input) {
      if( isset( $input ) ) {
         $input =  stripslashes( wp_filter_post_kses( addslashes( $input ) ) );
      }
      return $input;
   }

   function ample_integer_sanitize($input) {
      if( is_numeric( $input ) ) {
        return intval( $input );
      }
      else
         return 4;
   }
   // Google Font Sanitization
   function ample_font_sanitize( $input, $setting ) {

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
	// Color sanitization
   function ample_color_option_hex_sanitize($color) {
      if ($unhashed = sanitize_hex_color_no_hash($color))
         return '#' . $unhashed;

      return $color;
   }

   function ample_color_escaping_option_sanitize($input) {
      $input = esc_attr($input);
      return $input;
   }
}
add_action('customize_register', 'ample_customize_register');

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

if ( ! function_exists( 'ample_font_size_func' ) ) :
/**
 * Function that contain Font Size customze setting
 */
function ample_font_size_func() {
	$ample_fonts_size_options = array(
      'ample_header_font_size_setting' => array(
         'section_id' => 'ample_header_font_size_setting',
         'title'=> __('Header Font Size Options', 'ample'),
         'ample_font_size_setting' => array(
	      	'ample_header_top_bar_font_size' => array(
		         'id' => 'ample_header_top_bar_font_size',
		         'default' => '15',
		         'label'=> __('Header Top Bar Font Size. Default is 15px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 8, 22 ),
		         'custom_css' => ' .small-info-text p'
			   ),
		      'ample_site_title_font_size' => array(
		         'id' => 'ample_site_title_font_size',
		         'default' => '34',
		         'label'=> __('Site title font size. Default is 34px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 25, 45 ),
		         'custom_css' => '  #site-title a'
		   	),
		      'ample_tagline_font_size' => array(
		         'id' => 'ample_tagline_font_size',
		         'default' => '13',
		         'label'=> __('Site tagline font size. Default is 13px.'),
		         'choice' => ample_font_size_range_generator( 5, 20 ),
		         'custom_css' => ' #site-description'
			   ),
		      'ample_primary_menu_font_size' => array(
		         'id' => 'ample_primary_menu_font_size',
		         'default' => '14',
		         'label'=> __('Primary menu. Default is 14px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 8, 22 ),
		         'custom_css' => '  .main-navigation ul.menu li a'
		   	),
		      'ample_primary_sub_menu_font_size' => array(
		         'id' => 'ample_primary_sub_menu_font_size',
		         'default' => '14',
		         'label'=> __('Primary sub menu. Default is 14px.'),
		         'choice' => ample_font_size_range_generator( 8, 22 ),
		         'custom_css' => ' .main-navigation ul.menu li ul.sub-menu li a'
			   )
   		)
   	),
      'ample_slider_font_size_setting' => array(
         'section_id' => 'ample_slider_font_size_setting',
         'title'=> __('Slider Font Size Options', 'ample'),
		   'ample_font_size_setting' => array(
		      'ample_slider_title_font_size' => array(
		         'id' => 'ample_slider_title_font_size',
		         'default' => '40',
		         'label'=> __('Slider title. Default is 40px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 30, 50 ),
		         'custom_css' => ' .big-slider .entry-title'
		      ),
		      'ample_slider_button_font_size' => array(
		         'id' => 'ample_slider_button_font_size',
		         'default' => '16',
		         'label'=> __('Slider button. Default is 16px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 8, 24 ),
		         'custom_css' => ' .slider-button'
		      )
		   )
      ),
		'ample_title_font_size_setting' => array(
         'section_id' => 'ample_title_font_size_setting',
         'title'=> __('Titles Related Font Size Options', 'ample'),
		   'ample_font_size_setting' => array(
		   	'ample_h1_title_font_size' => array(
		         'id' => 'ample_h1_title_font_size',
		         'default' => '30',
		         'label'=> __('Heading h1 tag. Default is 30px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 22, 38 ),
		         'custom_css' => ' h1'
		      ),
		      'ample_h2_title_font_size' => array(
		         'id' => 'ample_h2_title_font_size',
		         'default' => '28',
		         'label'=> __('Heading h2 tag. Default is 28px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 20, 36 ),
		         'custom_css' => ' h2'
		      ),
		      'ample_h3_title_font_size' => array(
		         'id' => 'ample_h3_title_font_size',
		         'default' => '26',
		         'label'=> __('Heading h3 tag. Default is 26px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 18, 34 ),
		         'custom_css' => ' h3'
		      ),
		      'ample_h4_title_font_size' => array(
		         'id' => 'ample_h4_title_font_size',
		         'default' => '24',
		         'label'=> __('Heading h4 tag. Default is 24px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 16, 32 ),
		         'custom_css' => ' h4'
		      ),
		      'ample_h5_title_font_size' => array(
		         'id' => 'ample_h5_title_font_size',
		         'default' => '22',
		         'label'=> __('Heading h5 tag. Default is 22px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 14, 30 ),
		         'custom_css' => ' h5'
		      ),
		      'ample_h6_title_font_size' => array(
		         'id' => 'ample_h6_title_font_size',
		         'default' => '19',
		         'label'=> __('Heading h6 tag. Default is 19px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 10, 28 ),
		         'custom_css' => ' h6'
		      ),
		      'ample_widget_titles_font_size' => array(
		         'id' => 'ample_widget_titles_font_size',
		         'default' => '26',
		         'label'=> __('Widget Titles. Default is 26px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 18, 34 ),
		         'custom_css' => ' h3.widget-title, #secondary .widget-title, #tertiary .widget-title'
		      ),
		      'ample_widget_description_font_size' => array(
		         'id' => 'ample_widget_description_font_size',
		         'default' => '16',
		         'label'=> __('Widget Description. Default is 16px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 8, 24 ),
		         'custom_css' => ' .widget .services-main-description p, .widget .portfolio-main-description p, .widget .featured-posts-main-description p, .widget .testimonials-main-description p, .widget .clients-main-description p'
		      ),
		      'ample_call_to_action_widget_title_font_size' => array(
		         'id' => 'ample_call_to_action_widget_title_font_size',
		         'default' => '26',
		         'label'=> __('TG: Call to Action widget text. Default is 26px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 18, 34 ),
		         'custom_css' => ' .call-to-action-content-wrapper h3'
		      ),
		      'ample_header_title_bar_font_size' => array(
		         'id' => 'ample_header_title_bar_font_size',
		         'default' => '24',
		         'label'=> __('Header Title Bar. Default is 24px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 16, 35 ),
		         'custom_css' => ' .header-post-title-class'
		      ),
		      'ample_posts_page_title_font_size' => array(
		         'id' => 'ample_posts_page_title_font_size',
		         'default' => '24',
		         'label'=> __('Post Title of Posts Page. Default is 24px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 16, 32 ),
		         'custom_css' => ' .hentry .entry-title'
		      ),
		      'ample_comment_title_font_size' => array(
		         'id' => 'ample_comment_title_font_size',
		         'default' => '22',
		         'label'=> __('Comment Title. Default is 22px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 14, 30 ),
		         'custom_css' => ' .comments-title'
		      )
   		)
   	),
		'ample_content_font_size_setting' => array(
         'section_id' => 'ample_content_font_size_setting',
         'title'=> __('Content Font Size Options', 'ample'),
		   'ample_font_size_setting' => array(
		   	'ample_content_font_size' => array(
		         'id' => 'ample_content_font_size',
		         'default' => '15',
		         'label'=> __('Content font size, also applies to other text like in search fields, post comment button etc. Default is 15px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 8, 24 ),
		         'custom_css' => ' body, button, input, select, textarea, p, dl, .ample-button, input[type="reset"], input[type="button"], input[type="submit"], button, .previous a, .next a, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, #secondary .widget, .error-404 .widget'
		      ),
		      'ample_post_meta_font_size' => array(
		         'id' => 'ample_post_meta_font_size',
		         'default' => '14',
		         'label'=> __('Post meta font size. Default is 14px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 8, 22 ),
		         'custom_css' => ' .entry-meta'
		      )
		   )
		),
		'ample_footer_font_size_setting' => array(
         'section_id' => 'ample_footer_font_size_setting',
         'title'=> __('Footer Font Size Options', 'ample'),
		   'ample_font_size_setting' => array(
		   	'ample_footer_widget_titles_font_size' => array(
		         'id' => 'ample_footer_widget_titles_font_size',
		         'default' => '22',
		         'label'=> __('Footer widget Titles. Default is 22px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 14, 30 ),
		         'custom_css' => ' #colophon .widget-title'
		      ),
		      'ample_footer_widget_content_font_size' => array(
		         'id' => 'ample_footer_widget_content_font_size',
		         'default' => '13',
		         'label'=> __('Footer widget content font size. Default is 13px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 8, 22 ),
		         'custom_css' => ' .footer-widgets-area, #colophon .footer-widgets-area a'
		      ),
		      'ample_footer_copyright_text_font_size' => array(
		         'id' => 'ample_footer_copyright_text_font_size',
		         'default' => '13',
		         'label'=> __('Footer copyright text font size. Default is 13px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 5, 20 ),
		         'custom_css' => ' #colophon .copyright, #colophon .copyright a'
		      ),
		      'ample_small_footer_menu_font_size' => array(
		         'id' => 'ample_small_footer_menu_font_size',
		         'default' => '13',
		         'label'=> __('Footer small menu. Default is 13px.', 'ample'),
		         'choice' => ample_font_size_range_generator( 5, 20 ),
		         'custom_css' => ' #colophon .menu-footer-menu-container, #colophon .menu-footer-menu-container a'
		      )
		   )
		)
	);
	return $ample_fonts_size_options;
}
endif;

/**************************************************************************************/

if ( ! function_exists( 'ample_color_func' ) ) :
/**
 * Function that contain Color customze setting
 */
function ample_color_func() {
	$ample_color_options = array(
      'ample_header_color_settings' => array(
         'section_id' => 'ample_header_color_settings',
         'title'=> __('Header Color Options', 'ample'),
         'ample_color_settings' => array(
	      	'ample_header_background_color' => array(
		         'id' => 'ample_header_background_color',
		         'default' => '#ffffff',
		         'label'=> __('Header background color. Default is #ffffff.', 'ample'),
		         'color_custom_css' => '.header { background-color: '
			   ),
			   'ample_site_title_text_color' => array(
		         'id' => 'ample_site_title_text_color',
		         'default' => '#666666',
		         'label'=> __('Site Title. Default is #666666.', 'ample'),
		         'color_custom_css' => ' #site-title a { color: '
			   ),
		      'ample_site_tagline_text_color' => array(
		         'id' => 'ample_site_tagline_text_color',
		         'default' => '#888888',
		         'label'=> __('Site Tagline. Default is #888888.', 'ample'),
		         'color_custom_css' => ' #site-description { color: '
			   ),
		      'ample_primary_menu_background_color' => array(
		         'id' => 'ample_primary_menu_background_color',
		         'default' => '#ffffff',
		         'label'=> __('Primary menu background color. Default is #ffffff.', 'ample'),
		         'color_custom_css' => ' .main-navigation { background-color: '
			   ),
			   'ample_primary_menu_selected_color' => array(
		         'id' => 'ample_primary_menu_selected_color',
		         'default' => '#80abc8',
		         'label'=> __('Primary menu selected/hovered item text color. Default is #80abc8.', 'ample'),
		         'color_custom_css' => ' .main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current-menu-item a::after, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current-menu-ancestor a::after, .main-navigation ul li.current_page_item a::after, .main-navigation ul li.current_page_item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current_page_ancestor a::after, .main-navigation ul li:hover > a, .main-navigation li.menu-item-has-children:hover > a::after, .main-navigation li.page_item_has_children:hover > a::after,  .main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover { color: ',
		         'color_custom_css_two' => ' .main-navigation ul.menu > li.current-menu-item, .main-navigation ul.menu > li.current-menu-ancestor, .main-navigation .menu > ul > li.current_page_item, .main-navigation .menu > ul > li.current_page_ancestor, .main-navigation ul.menu > li:hover, .main-navigation .menu > ul > li:hover { border-top: 2px solid '
			   ),
			   'ample_primary_menu_text_color' => array(
		         'id' => 'ample_primary_menu_text_color',
		         'default' => '#666666',
		         'label'=> __('Primary menu (unselected/unhovered) text color. Default is #666666.', 'ample'),
		         'color_custom_css' => ' .main-navigation a, .main-navigation ul li ul li a,.main-navigation ul li.current-menu-item ul li a { color: '
			   ),
			   'ample_primary_menu_selected_background_color' => array(
		         'id' => 'ample_primary_menu_selected_background_color',
		         'default' => '#ffffff',
		         'label'=> __('Primary menu selected/hovered item background color. Default is #ffffff.', 'ample'),
		         'color_custom_css' => ' .main-navigation ul.menu > li.current-menu-item, .main-navigation ul.menu > li.current-menu-ancestor, .main-navigation .menu > ul > li.current_page_item, .main-navigation .menu > ul > li.current_page_ancestor, .main-navigation ul.menu > li:hover, .main-navigation .menu > ul > li:hover,  .main-navigation ul li ul li:hover { background-color: '
			   ),
			   'ample_header_top_bar_background_color' => array(
		         'id' => 'ample_header_top_bar_background_color',
		         'default' => '#ffffff',
		         'label'=> __('Header top bar background color. Default is #ffffff.', 'ample'),
		         'color_custom_css' => ' #header-meta { background-color: '
			   ),
			   'ample_top_bar_text_color' => array(
		         'id' => 'ample_top_bar_text_color',
		         'default' => '#666666',
		         'label'=> __('Header top bar text color. Default is #666666.', 'ample'),
		         'color_custom_css' => ' .small-info-text p { color: '
			   )
   		)
   	),
		'ample_slider_color_settings' => array(
         'section_id' => 'ample_slider_color_settings',
         'title'=> __('Slider Part Color Options', 'ample'),
         'ample_color_settings' => array(
	      	'ample_slider_title_color' => array(
		         'id' => 'ample_slider_title_color',
		         'default' => '#ffffff',
		         'label'=> __('Slider title text color. Default is #ffffff.', 'ample'),
		         'color_custom_css' => ' .big-slider .entry-title a { color: '
			   ),
		      'ample_slider_title_hover_color' => array(
		         'id' => 'ample_slider_title_hover_color',
		         'default' => '#80abc8',
		         'label'=> __('Slider title hover text color. Default is #80abc8.', 'ample'),
		         'color_custom_css' => ' .big-slider .entry-title a:hover { color: '
			   ),
		      'ample_slider_button_text_color' => array(
		         'id' => 'ample_slider_button_text_color',
		         'default' => '#ffffff',
		         'label'=> __('Slider button text color. Default is #ffffff.', 'ample'),
		         'color_custom_css' => ' .slider-button { color: '
			   ),
		      'ample_slider_button_background_color' => array(
		         'id' => 'ample_slider_button_background_color',
		         'default' => '',
		         'label'=> __('Slider button hover background color. Default is none.', 'ample'),
		         'color_custom_css' => ' .slider-button:hover { background-color: '
			   )
   		)
   	),
		'ample_content_color_settings' => array(
         'section_id' => 'ample_content_color_settings',
         'title'=> __('Content Part Color Options', 'ample'),
         'ample_color_settings' => array(
	      	'ample_title_bar_background_color' => array(
		         'id' => 'ample_title_bar_background_color',
		         'default' => '#80abc8',
		         'label'=> __('Header Title Bar background color. Default is #80abc8.', 'ample'),
		         'color_custom_css' => ' .header-post-title-container { background-color: '
			   ),
		      'ample_header_title_color' => array(
		         'id' => 'ample_header_title_color',
		         'default' => '#ffffff',
		         'label'=> __('Header Title Bar text color. Default is #ffffff.', 'ample'),
		         'color_custom_css' => ' .header-post-title-class, .breadcrumb { color: '
			   ),
		      'ample_header_title_link_color' => array(
		         'id' => 'ample_header_title_link_color',
		         'default' => '#b1b6b6',
		         'label'=> __('Header Title Bar link text color. Default is #b1b6b6.', 'ample'),
		         'color_custom_css' => ' .breadcrumb a { color: '
			   ),
		      'ample_content_text_color' => array(
		         'id' => 'ample_content_text_color',
		         'default' => '#888888',
		         'label'=> __('Content section text color. Default is #888888.', 'ample'),
		         'color_custom_css' => ' body, button, input, select, textarea, p { color: '
			   ),
		      'ample_post_page_title_color' => array(
		         'id' => 'ample_post_page_title_color',
		         'default' => '#666666',
		         'label'=> __('Post title color for Posts Page. Default is #666666.', 'ample'),
		         'color_custom_css' => ' .hentry .entry-title a { color: '
			   ),
		      'ample_post_meta_color' => array(
		         'id' => 'ample_post_meta_color',
		         'default' => '#888888',
		         'label'=> __('Post meta color. Default is #888888.', 'ample'),
		         'color_custom_css' => ' .entry-meta a { color: '
			   ),
		      'ample_readmore_text_color' => array(
		         'id' => 'ample_readmore_text_color',
		         'default' => '#80abc8',
		         'label'=> __('Read more text color. Default is #80abc8.', 'ample'),
		         'color_custom_css' => ' .more-link span { color: '
			   ),
		      'ample_readmore_background_color' => array(
		         'id' => 'ample_readmore_background_color',
		         'default' => '#ffffff',
		         'label'=> __('Read more background color. Default is #ffffff.', 'ample'),
		         'color_custom_css' => ' .more-link span { background-color: '
			   ),
		      'ample_sidebar_widget_title_color' => array(
		         'id' => 'ample_sidebar_widget_title_color',
		         'default' => '#666666',
		         'label'=> __('Left and Right sidebar widget title color. Default is #666666.', 'ample'),
		         'color_custom_css' => ' #secondary .widget-title, #tertiary .widget-title { color: '
			   )
   		)
   	),
		'ample_footer_color_settings' => array(
         'section_id' => 'ample_footer_color_settings',
         'title'=> __('Footer Part Color Options', 'ample'),
         'ample_color_settings' => array(
	      	'ample_footer_background_color' => array(
		         'id' => 'ample_footer_background_color',
		         'default' => '#1f2021',
		         'label'=> __('Footer background color. Default is #1f2021.', 'ample'),
		         'color_custom_css' => ' #colophon { background-color: '
			   ),
		      'ample_footer_widget_background_color' => array(
		         'id' => 'ample_footer_widget_background_color',
		         'default' => '#1f2021',
		         'label'=> __('Footer widget background color. Default is #1f2021.', 'ample'),
		         'color_custom_css' => ' #colophon .tg-one-fourth { background-color: '
			   ),
		      'ample_footer_widget_title_color' => array(
		         'id' => 'ample_footer_widget_title_color',
		         'default' => '#b1b6b6',
		         'label'=> __('Footer widget title color. Default is #b1b6b6.', 'ample'),
		         'color_custom_css' => ' #colophon .widget-title  { color: '
			   ),
		      'ample_footer_content_color' => array(
		         'id' => 'ample_footer_content_color',
		         'default' => '#777777',
		         'label'=> __('Footer content color. Default is #777777.', 'ample'),
		         'color_custom_css' => ' #colophon, #colophon .footer-widgets-area  { color: '
			   ),
		      'ample_footer_link_color' => array(
		         'id' => 'ample_footer_link_color',
		         'default' => '#b1b6b6',
		         'label'=> __('Footer content link text color. Default is #b1b6b6.', 'ample'),
		         'color_custom_css' => ' #colophon a, #colophon .copyright-info a, #colophon .footer-nav ul li a  { color: '
			   )
   		)
   	)
	);
	return $ample_color_options;
}
endif;

/**************************************************************************************/

if ( ! function_exists( 'ample_google_fonts' ) ) :
/**
 * Google Font addition
 */
function ample_google_fonts() {

   $ample_googlefonts = array(
   "ABeeZee" => "ABeeZee",
   "Abel" => "Abel",
   "Abril Fatface" => "Abril+Fatface",
   "Aclonica" => "Aclonica",
   "Acme" => "Acme",
   "Actor" => "Actor",
   "Adamina" => "Adamina",
   "Advent Pro" => "Advent+Pro",
   "Aguafina Script" => "Aguafina+Script",
   "Akronim" => "Akronim",
   "Aladin" => "Aladin",
   "Aldrich" => "Aldrich",
   "Alegreya" => "Alegreya",
   "Alegreya SC" => "Alegreya+SC",
   "Alex Brush" => "Alex+Brush",
   "Alfa Slab One" => "Alfa+Slab+One",
   "Alice" => "Alice",
   "Alike" => "Alike",
   "Alike Angular" => "Alike+Angular",
   "Allan" => "Allan",
   "Allerta" => "Allerta",
   "Allerta Stencil" => "Allerta+Stencil",
   "Allura" => "Allura",
   "Almendra" => "Almendra",
   "Almendra Display" => "Almendra+Display",
   "Almendra SC" => "Almendra+SC",
   "Amarante" => "Amarante",
   "Amaranth" => "Amaranth",
   "Amatic SC" => "Amatic+SC",
   "Amethysta" => "Amethysta",
   "Anaheim" => "Anaheim",
   "Andada" => "Andada",
   "Andika" => "Andika",
   "Angkor" => "Angkor",
   "Annie Use Your Telescope" => "Annie+Use+Your+Telescope",
   "Anonymous Pro" => "Anonymous+Pro",
   "Antic" => "Antic",
   "Antic Didone" => "Antic+Didone",
   "Antic Slab" => "Antic+Slab",
   "Anton" => "Anton",
   "Arapey" => "Arapey",
   "Arbutus" => "Arbutus",
   "Arbutus Slab" => "Arbutus+Slab",
   "Architects Daughter" => "Architects+Daughter",
   "Archivo Black" => "Archivo+Black",
   "Archivo Narrow" => "Archivo+Narrow",
   "Arimo" => "Arimo",
   "Arizonia" => "Arizonia",
   "Armata" => "Armata",
   "Artifika" => "Artifika",
   "Arvo" => "Arvo",
   "Asap" => "Asap",
   "Asset" => "Asset",
   "Astloch" => "Astloch",
   "Asul" => "Asul",
   "Atomic Age" => "Atomic+Age",
   "Aubrey" => "Aubrey",
   "Audiowide" => "Audiowide",
   "Autour One" => "Autour+One",
   "Average" => "Average",
   "Average Sans" => "Average+Sans",
   "Averia Gruesa Libre" => "Averia+Gruesa+Libre",
   "Averia Libre" => "Averia+Libre",
   "Averia Sans Libre" => "Averia+Sans+Libre",
   "Averia Serif Libre" => "Averia+Serif+Libre",
   "Bad Script" => "Bad+Script",
   "Balthazar" => "Balthazar",
   "Bangers" => "Bangers",
   "Basic" => "Basic",
   "Battambang" => "Battambang",
   "Baumans" => "Baumans",
   "Bayon" => "Bayon",
   "Belgrano" => "Belgrano",
   "Belleza" => "Belleza",
   "BenchNine" => "BenchNine",
   "Bentham" => "Bentham",
   "Berkshire Swash" => "Berkshire+Swash",
   "Bevan" => "Bevan",
   "Bigelow Rules" => "Bigelow+Rules",
   "Bigshot One" => "Bigshot+One",
   "Bilbo" => "Bilbo",
   "Bilbo Swash Caps" => "Bilbo+Swash+Caps",
   "Bitter" => "Bitter",
   "Black Ops One" => "Black+Ops+One",
   "Bokor" => "Bokor",
   "Bonbon" => "Bonbon",
   "Boogaloo" => "Boogaloo",
   "Bowlby One" => "Bowlby+One",
   "Bowlby One SC" => "Bowlby+One+SC",
   "Brawler" => "Brawler",
   "Bree Serif" => "Bree+Serif",
   "Bubblegum Sans" => "Bubblegum+Sans",
   "Bubbler One" => "Bubbler+One",
   "Buda" => "Buda",
   "Buenard" => "Buenard",
   "Butcherman" => "Butcherman",
   "Butterfly Kids" => "Butterfly+Kids",
   "Cabin" => "Cabin",
   "Cabin Condensed" => "Cabin+Condensed",
   "Cabin Sketch" => "Cabin+Sketch",
   "Caesar Dressing" => "Caesar+Dressing",
   "Cagliostro" => "Cagliostro",
   "Calligraffitti" => "Calligraffitti",
   "Cambo" => "Cambo",
   "Candal" => "Candal",
   "Cantarell" => "Cantarell",
   "Cantata One" => "Cantata+One",
   "Cantora One" => "Cantora+One",
   "Capriola" => "Capriola",
   "Cardo" => "Cardo",
   "Carme" => "Carme",
   "Carrois Gothic" => "Carrois+Gothic",
   "Carrois Gothic SC" => "Carrois+Gothic+SC",
   "Carter One" => "Carter+One",
   "Caudex" => "Caudex",
   "Cedarville Cursive" => "Cedarville+Cursive",
   "Ceviche One" => "Ceviche+One",
   "Changa One" => "Changa+One",
   "Chango" => "Chango",
   "Chau Philomene One" => "Chau+Philomene+One",
   "Chela One" => "Chela+One",
   "Chelsea Market" => "Chelsea+Market",
   "Chenla" => "Chenla",
   "Cherry Cream Soda" => "Cherry+Cream+Soda",
   "Cherry Swash" => "Cherry+Swash",
   "Chewy" => "Chewy",
   "Chicle" => "Chicle",
   "Chivo" => "Chivo",
   "Cinzel" => "Cinzel",
   "Cinzel Decorative" => "Cinzel+Decorative",
   "Clicker Script" => "Clicker+Script",
   "Coda" => "Coda",
   "Coda Caption" => "Coda+Caption",
   "Codystar" => "Codystar",
   "Combo" => "Combo",
   "Comfortaa" => "Comfortaa",
   "Coming Soon" => "Coming+Soon",
   "Concert One" => "Concert+One",
   "Condiment" => "Condiment",
   "Content" => "Content",
   "Contrail One" => "Contrail+One",
   "Convergence" => "Convergence",
   "Cookie" => "Cookie",
   "Copse" => "Copse",
   "Corben" => "Corben",
   "Courgette" => "Courgette",
   "Cousine" => "Cousine",
   "Coustard" => "Coustard",
   "Covered By Your Grace" => "Covered+By+Your+Grace",
   "Crafty Girls" => "Crafty+Girls",
   "Creepster" => "Creepster",
   "Crete Round" => "Crete+Round",
   "Crimson Text" => "Crimson+Text",
   "Croissant One" => "Croissant+One",
   "Crushed" => "Crushed",
   "Cuprum" => "Cuprum",
   "Cutive" => "Cutive",
   "Cutive Mono" => "Cutive+Mono",
   "Damion" => "Damion",
   "Dancing Script" => "Dancing+Script",
   "Dangrek" => "Dangrek",
   "Dawning of a New Day" => "Dawning+of+a+New+Day",
   "Days One" => "Days+One",
   "Delius" => "Delius",
   "Delius Swash Caps" => "Delius+Swash+Caps",
   "Delius Unicase" => "Delius+Unicase",
   "Della Respira" => "Della+Respira",
   "Denk One" => "Denk+One",
   "Devonshire" => "Devonshire",
   "Didact Gothic" => "Didact+Gothic",
   "Diplomata" => "Diplomata",
   "Diplomata SC" => "Diplomata+SC",
   "Domine" => "Domine",
   "Donegal One" => "Donegal+One",
   "Doppio One" => "Doppio+One",
   "Dorsa" => "Dorsa",
   "Dosis" => "Dosis",
   "Dr Sugiyama" => "Dr+Sugiyama",
   "Droid Sans" => "Droid+Sans",
   "Droid Sans Mono" => "Droid+Sans+Mono",
   "Droid Serif" => "Droid+Serif",
   "Duru Sans" => "Duru+Sans",
   "Dynalight" => "Dynalight",
   "EB Garamond" => "EB+Garamond",
   "Eagle Lake" => "Eagle+Lake",
   "Eater" => "Eater",
   "Economica" => "Economica",
   "Electrolize" => "Electrolize",
   "Elsie" => "Elsie",
   "Elsie Swash Caps" => "Elsie+Swash+Caps",
   "Emblema One" => "Emblema+One",
   "Emilys Candy" => "Emilys+Candy",
   "Engagement" => "Engagement",
   "Englebert" => "Englebert",
   "Enriqueta" => "Enriqueta",
   "Erica One" => "Erica+One",
   "Esteban" => "Esteban",
   "Euphoria Script" => "Euphoria+Script",
   "Ewert" => "Ewert",
   "Exo" => "Exo",
   "Expletus Sans" => "Expletus+Sans",
   "Fanwood Text" => "Fanwood+Text",
   "Fascinate" => "Fascinate",
   "Fascinate Inline" => "Fascinate+Inline",
   "Faster One" => "Faster+One",
   "Fasthand" => "Fasthand",
   "Federant" => "Federant",
   "Federo" => "Federo",
   "Felipa" => "Felipa",
   "Fenix" => "Fenix",
   "Finger Paint" => "Finger+Paint",
   "Fjalla One" => "Fjalla+One",
   "Fjord One" => "Fjord+One",
   "Flamenco" => "Flamenco",
   "Flavors" => "Flavors",
   "Fondamento" => "Fondamento",
   "Fontdiner Swanky" => "Fontdiner+Swanky",
   "Forum" => "Forum",
   "Francois One" => "Francois+One",
   "Freckle Face" => "Freckle+Face",
   "Fredericka the Great" => "Fredericka+the+Great",
   "Fredoka One" => "Fredoka+One",
   "Freehand" => "Freehand",
   "Fresca" => "Fresca",
   "Frijole" => "Frijole",
   "Fruktur" => "Fruktur",
   "Fugaz One" => "Fugaz+One",
   "GFS Didot" => "GFS+Didot",
   "GFS Neohellenic" => "GFS+Neohellenic",
   "Gabriela" => "Gabriela",
   "Gafata" => "Gafata",
   "Galdeano" => "Galdeano",
   "Galindo" => "Galindo",
   "Gentium Basic" => "Gentium+Basic",
   "Gentium Book Basic" => "Gentium+Book+Basic",
   "Geo" => "Geo",
   "Geostar" => "Geostar",
   "Geostar Fill" => "Geostar+Fill",
   "Germania One" => "Germania+One",
   "Gilda Display" => "Gilda+Display",
   "Give You Glory" => "Give+You+Glory",
   "Glass Antiqua" => "Glass+Antiqua",
   "Glegoo" => "Glegoo",
   "Gloria Hallelujah" => "Gloria+Hallelujah",
   "Goblin One" => "Goblin+One",
   "Gochi Hand" => "Gochi+Hand",
   "Gorditas" => "Gorditas",
   "Goudy Bookletter 1911" => "Goudy+Bookletter+1911",
   "Graduate" => "Graduate",
   "Grand Hotel" => "Grand+Hotel",
   "Gravitas One" => "Gravitas+One",
   "Great Vibes" => "Great+Vibes",
   "Griffy" => "Griffy",
   "Gruppo" => "Gruppo",
   "Gudea" => "Gudea",
   "Habibi" => "Habibi",
   "Hammersmith One" => "Hammersmith+One",
   "Hanalei" => "Hanalei",
   "Hanalei Fill" => "Hanalei+Fill",
   "Handlee" => "Handlee",
   "Hanuman" => "Hanuman",
   "Happy Monkey" => "Happy+Monkey",
   "Headland One" => "Headland+One",
   "Henny Penny" => "Henny+Penny",
   "Herr Von Muellerhoff" => "Herr+Von+Muellerhoff",
   "Holtwood One SC" => "Holtwood+One+SC",
   "Homemade Apple" => "Homemade+Apple",
   "Homenaje" => "Homenaje",
   "IM Fell DW Pica" => "IM+Fell+DW+Pica",
   "IM Fell DW Pica SC" => "IM+Fell+DW+Pica+SC",
   "IM Fell Double Pica" => "IM+Fell+Double+Pica",
   "IM Fell Double Pica SC" => "IM+Fell+Double+Pica+SC",
   "IM Fell English" => "IM+Fell+English",
   "IM Fell English SC" => "IM+Fell+English+SC",
   "IM Fell French Canon" => "IM+Fell+French+Canon",
   "IM Fell French Canon SC" => "IM+Fell+French+Canon+SC",
   "IM Fell Great Primer" => "IM+Fell+Great+Primer",
   "IM Fell Great Primer SC" => "IM+Fell+Great+Primer+SC",
   "Iceberg" => "Iceberg",
   "Iceland" => "Iceland",
   "Imprima" => "Imprima",
   "Inconsolata" => "Inconsolata",
   "Inder" => "Inder",
   "Indie Flower" => "Indie+Flower",
   "Inika" => "Inika",
   "Irish Grover" => "Irish+Grover",
   "Istok Web" => "Istok+Web",
   "Italiana" => "Italiana",
   "Italianno" => "Italianno",
   "Jacques Francois" => "Jacques+Francois",
   "Jacques Francois Shadow" => "Jacques+Francois+Shadow",
   "Jim Nightshade" => "Jim+Nightshade",
   "Jockey One" => "Jockey+One",
   "Jolly Lodger" => "Jolly+Lodger",
   "Josefin Sans" => "Josefin+Sans",
   "Josefin Slab" => "Josefin+Slab",
   "Joti One" => "Joti+One",
   "Judson" => "Judson",
   "Julee" => "Julee",
   "Julius Sans One" => "Julius+Sans+One",
   "Junge" => "Junge",
   "Jura" => "Jura",
   "Just Another Hand" => "Just+Another+Hand",
   "Just Me Again Down Here" => "Just+Me+Again+Down+Here",
   "Kameron" => "Kameron",
   "Karla" => "Karla",
   "Kaushan Script" => "Kaushan+Script",
   "Kavoon" => "Kavoon",
   "Keania One" => "Keania+One",
   "Kelly Slab" => "Kelly+Slab",
   "Kenia" => "Kenia",
   "Khmer" => "Khmer",
   "Kite One" => "Kite+One",
   "Knewave" => "Knewave",
   "Kotta One" => "Kotta+One",
   "Koulen" => "Koulen",
   "Kranky" => "Kranky",
   "Kreon" => "Kreon",
   "Kristi" => "Kristi",
   "Krona One" => "Krona+One",
   "La Belle Aurore" => "La+Belle+Aurore",
   "Lancelot" => "Lancelot",
   "Lato" => "Lato",
   "League Script" => "League+Script",
   "Leckerli One" => "Leckerli+One",
   "Ledger" => "Ledger",
   "Lekton" => "Lekton",
   "Lemon" => "Lemon",
   "Libre Baskerville" => "Libre+Baskerville",
   "Life Savers" => "Life+Savers",
   "Lilita One" => "Lilita+One",
   "Limelight" => "Limelight",
   "Linden Hill" => "Linden+Hill",
   "Lobster" => "Lobster",
   "Lobster Two" => "Lobster+Two",
   "Londrina Outline" => "Londrina+Outline",
   "Londrina Shadow" => "Londrina+Shadow",
   "Londrina Sketch" => "Londrina+Sketch",
   "Londrina Solid" => "Londrina+Solid",
   "Lora" => "Lora",
   "Love Ya Like A Sister" => "Love+Ya+Like+A+Sister",
   "Loved by the King" => "Loved+by+the+King",
   "Lovers Quarrel" => "Lovers+Quarrel",
   "Luckiest Guy" => "Luckiest+Guy",
   "Lusitana" => "Lusitana",
   "Lustria" => "Lustria",
   "Macondo" => "Macondo",
   "Macondo Swash Caps" => "Macondo+Swash+Caps",
   "Magra" => "Magra",
   "Maiden Orange" => "Maiden+Orange",
   "Mako" => "Mako",
   "Marcellus" => "Marcellus",
   "Marcellus SC" => "Marcellus+SC",
   "Marck Script" => "Marck+Script",
   "Margarine" => "Margarine",
   "Marko One" => "Marko+One",
   "Marmelad" => "Marmelad",
   "Marvel" => "Marvel",
   "Mate" => "Mate",
   "Mate SC" => "Mate+SC",
   "Maven Pro" => "Maven+Pro",
   "McLaren" => "McLaren",
   "Meddon" => "Meddon",
   "MedievalSharp" => "MedievalSharp",
   "Medula One" => "Medula+One",
   "Megrim" => "Megrim",
   "Meie Script" => "Meie+Script",
   "Merienda" => "Merienda",
   "Merienda One" => "Merienda+One",
   "Merriweather" => "Merriweather",
   "Merriweather Sans" => "Merriweather+Sans",
   "Metal" => "Metal",
   "Metal Mania" => "Metal+Mania",
   "Metamorphous" => "Metamorphous",
   "Metrophobic" => "Metrophobic",
   "Michroma" => "Michroma",
   "Milonga" => "Milonga",
   "Miltonian" => "Miltonian",
   "Miltonian Tattoo" => "Miltonian+Tattoo",
   "Miniver" => "Miniver",
   "Miss Fajardose" => "Miss+Fajardose",
   "Modern Antiqua" => "Modern+Antiqua",
   "Molengo" => "Molengo",
   "Molle" => "Molle",
   "Monda" => "Monda",
   "Monofett" => "Monofett",
   "Monoton" => "Monoton",
   "Monsieur La Doulaise" => "Monsieur+La+Doulaise",
   "Montaga" => "Montaga",
   "Montez" => "Montez",
   "Montserrat" => "Montserrat",
   "Montserrat Alternates" => "Montserrat+Alternates",
   "Montserrat Subrayada" => "Montserrat+Subrayada",
   "Moul" => "Moul",
   "Moulpali" => "Moulpali",
   "Mountains of Christmas" => "Mountains+of+Christmas",
   "Mouse Memoirs" => "Mouse+Memoirs",
   "Mr Bedfort" => "Mr+Bedfort",
   "Mr Dafoe" => "Mr+Dafoe",
   "Mr De Haviland" => "Mr+De+Haviland",
   "Mrs Saint Delafield" => "Mrs+Saint+Delafield",
   "Mrs Sheppards" => "Mrs+Sheppards",
   "Muli" => "Muli",
   "Mystery Quest" => "Mystery+Quest",
   "Neucha" => "Neucha",
   "Neuton" => "Neuton",
   "New Rocker" => "New+Rocker",
   "News Cycle" => "News+Cycle",
   "Niconne" => "Niconne",
   "Nixie One" => "Nixie+One",
   "Nobile" => "Nobile",
   "Nokora" => "Nokora",
   "Norican" => "Norican",
   "Nosifer" => "Nosifer",
   "Nothing You Could Do" => "Nothing+You+Could+Do",
   "Noticia Text" => "Noticia+Text",
   "Nova Cut" => "Nova+Cut",
   "Nova Flat" => "Nova+Flat",
   "Nova Mono" => "Nova+Mono",
   "Nova Oval" => "Nova+Oval",
   "Nova Round" => "Nova+Round",
   "Nova Script" => "Nova+Script",
   "Nova Slim" => "Nova+Slim",
   "Nova Square" => "Nova+Square",
   "Numans" => "Numans",
   "Nunito" => "Nunito",
   "Odor Mean Chey" => "Odor+Mean+Chey",
   "Offside" => "Offside",
   "Old Standard TT" => "Old+Standard+TT",
   "Oldenburg" => "Oldenburg",
   "Oleo Script" => "Oleo+Script",
   "Oleo Script Swash Caps" => "Oleo+Script+Swash+Caps",
   "Open Sans" => "Open+Sans",
   "Open Sans Condensed" => "Open+Sans+Condensed",
   "Oranienbaum" => "Oranienbaum",
   "Orbitron" => "Orbitron",
   "Oregano" => "Oregano",
   "Orienta" => "Orienta",
   "Original Surfer" => "Original+Surfer",
   "Oswald" => "Oswald",
   "Over the Rainbow" => "Over+the+Rainbow",
   "Overlock" => "Overlock",
   "Overlock SC" => "Overlock+SC",
   "Ovo" => "Ovo",
   "Oxygen" => "Oxygen",
   "Oxygen Mono" => "Oxygen+Mono",
   "PT Mono" => "PT+Mono",
   "PT Sans" => "PT+Sans",
   "PT Sans Caption" => "PT+Sans+Caption",
   "PT Sans Narrow" => "PT+Sans+Narrow",
   "PT Serif" => "PT+Serif",
   "PT Serif Caption" => "PT+Serif+Caption",
   "Pacifico" => "Pacifico",
   "Paprika" => "Paprika",
   "Parisienne" => "Parisienne",
   "Passero One" => "Passero+One",
   "Passion One" => "Passion+One",
   "Patrick Hand" => "Patrick+Hand",
   "Patrick Hand SC" => "Patrick+Hand+SC",
   "Patua One" => "Patua+One",
   "Paytone One" => "Paytone+One",
   "Peralta" => "Peralta",
   "Permanent Marker" => "Permanent+Marker",
   "Petit Formal Script" => "Petit+Formal+Script",
   "Petrona" => "Petrona",
   "Philosopher" => "Philosopher",
   "Piedra" => "Piedra",
   "Pinyon Script" => "Pinyon+Script",
   "Pirata One" => "Pirata+One",
   "Plaster" => "Plaster",
   "Play" => "Play",
   "Playball" => "Playball",
   "Playfair Display" => "Playfair+Display",
   "Playfair Display SC" => "Playfair+Display+SC",
   "Podkova" => "Podkova",
   "Poiret One" => "Poiret+One",
   "Poller One" => "Poller+One",
   "Poly" => "Poly",
   "Pompiere" => "Pompiere",
   "Pontano Sans" => "Pontano+Sans",
   "Port Lligat Sans" => "Port+Lligat+Sans",
   "Port Lligat Slab" => "Port+Lligat+Slab",
   "Prata" => "Prata",
   "Preahvihear" => "Preahvihear",
   "Press Start 2P" => "Press+Start+2P",
   "Princess Sofia" => "Princess+Sofia",
   "Prociono" => "Prociono",
   "Prosto One" => "Prosto+One",
   "Puritan" => "Puritan",
   "Purple Purse" => "Purple+Purse",
   "Quando" => "Quando",
   "Quantico" => "Quantico",
   "Quattrocento" => "Quattrocento",
   "Quattrocento Sans" => "Quattrocento+Sans",
   "Questrial" => "Questrial",
   "Quicksand" => "Quicksand",
   "Quintessential" => "Quintessential",
   "Qwigley" => "Qwigley",
   "Racing Sans One" => "Racing+Sans+One",
   "Radley" => "Radley",
   "Raleway" => "Raleway",
   "Raleway Dots" => "Raleway+Dots",
   "Rambla" => "Rambla",
   "Rammetto One" => "Rammetto+One",
   "Ranchers" => "Ranchers",
   "Rancho" => "Rancho",
   "Rationale" => "Rationale",
   "Redressed" => "Redressed",
   "Reenie Beanie" => "Reenie+Beanie",
   "Revalia" => "Revalia",
   "Ribeye" => "Ribeye",
   "Ribeye Marrow" => "Ribeye+Marrow",
   "Righteous" => "Righteous",
   "Risque" => "Risque",
   "Roboto:400,300,100" => "Roboto",
   "Roboto+Slab:700,400" => "Roboto+Slab",
   "Roboto Condensed" => "Roboto+Condensed",
   "Rochester" => "Rochester",
   "Rock Salt" => "Rock+Salt",
   "Rokkitt" => "Rokkitt",
   "Romanesco" => "Romanesco",
   "Ropa Sans" => "Ropa+Sans",
   "Rosario" => "Rosario",
   "Rosarivo" => "Rosarivo",
   "Rouge Script" => "Rouge+Script",
   "Ruda" => "Ruda",
   "Rufina" => "Rufina",
   "Ruge Boogie" => "Ruge+Boogie",
   "Ruluko" => "Ruluko",
   "Rum Raisin" => "Rum+Raisin",
   "Ruslan Display" => "Ruslan+Display",
   "Russo One" => "Russo+One",
   "Ruthie" => "Ruthie",
   "Rye" => "Rye",
   "Sacramento" => "Sacramento",
   "Sail" => "Sail",
   "Salsa" => "Salsa",
   "Sanchez" => "Sanchez",
   "Sancreek" => "Sancreek",
   "Sansita One" => "Sansita+One",
   "Sarina" => "Sarina",
   "Satisfy" => "Satisfy",
   "Scada" => "Scada",
   "Schoolbell" => "Schoolbell",
   "Seaweed Script" => "Seaweed+Script",
   "Sevillana" => "Sevillana",
   "Seymour One" => "Seymour+One",
   "Shadows Into Light" => "Shadows+Into+Light",
   "Shadows Into Light Two" => "Shadows+Into+Light+Two",
   "Shanti" => "Shanti",
   "Share" => "Share",
   "Share Tech" => "Share+Tech",
   "Share Tech Mono" => "Share+Tech+Mono",
   "Shojumaru" => "Shojumaru",
   "Short Stack" => "Short+Stack",
   "Siemreap" => "Siemreap",
   "Sigmar One" => "Sigmar+One",
   "Signika" => "Signika",
   "Signika Negative" => "Signika+Negative",
   "Simonetta" => "Simonetta",
   "Sintony" => "Sintony",
   "Sirin Stencil" => "Sirin+Stencil",
   "Six Caps" => "Six+Caps",
   "Skranji" => "Skranji",
   "Slackey" => "Slackey",
   "Smokum" => "Smokum",
   "Smythe" => "Smythe",
   "Sniglet" => "Sniglet",
   "Snippet" => "Snippet",
   "Snowburst One" => "Snowburst+One",
   "Sofadi One" => "Sofadi+One",
   "Sofia" => "Sofia",
   "Sonsie One" => "Sonsie+One",
   "Sorts Mill Goudy" => "Sorts+Mill+Goudy",
   "Source Code Pro" => "Source+Code+Pro",
   "Source Sans Pro" => "Source+Sans+Pro",
   "Special Elite" => "Special+Elite",
   "Spicy Rice" => "Spicy+Rice",
   "Spinnaker" => "Spinnaker",
   "Spirax" => "Spirax",
   "Squada One" => "Squada+One",
   "Stalemate" => "Stalemate",
   "Stalinist One" => "Stalinist+One",
   "Stardos Stencil" => "Stardos+Stencil",
   "Stint Ultra Condensed" => "Stint+Ultra+Condensed",
   "Stint Ultra Expanded" => "Stint+Ultra+Expanded",
   "Stoke" => "Stoke",
   "Strait" => "Strait",
   "Sue Ellen Francisco" => "Sue+Ellen+Francisco",
   "Sunshiney" => "Sunshiney",
   "Supermercado One" => "Supermercado+One",
   "Suwannaphum" => "Suwannaphum",
   "Swanky and Moo Moo" => "Swanky+and+Moo+Moo",
   "Syncopate" => "Syncopate",
   "Tangerine" => "Tangerine",
   "Taprom" => "Taprom",
   "Tauri" => "Tauri",
   "Telex" => "Telex",
   "Tenor Sans" => "Tenor+Sans",
   "Text Me One" => "Text+Me+One",
   "The Girl Next Door" => "The+Girl+Next+Door",
   "Tienne" => "Tienne",
   "Tinos" => "Tinos",
   "Titan One" => "Titan+One",
   "Titillium Web" => "Titillium+Web",
   "Trade Winds" => "Trade+Winds",
   "Trocchi" => "Trocchi",
   "Trochut" => "Trochut",
   "Trykker" => "Trykker",
   "Tulpen One" => "Tulpen+One",
   "Ubuntu" => "Ubuntu",
   "Ubuntu Condensed" => "Ubuntu+Condensed",
   "Ubuntu Mono" => "Ubuntu+Mono",
   "Ultra" => "Ultra",
   "Uncial Antiqua" => "Uncial+Antiqua",
   "Underdog" => "Underdog",
   "Unica One" => "Unica+One",
   "UnifrakturCook" => "UnifrakturCook",
   "UnifrakturMaguntia" => "UnifrakturMaguntia",
   "Unkempt" => "Unkempt",
   "Unlock" => "Unlock",
   "Unna" => "Unna",
   "VT323" => "VT323",
   "Vampiro One" => "Vampiro+One",
   "Varela" => "Varela",
   "Varela Round" => "Varela+Round",
   "Vast Shadow" => "Vast+Shadow",
   "Vibur" => "Vibur",
   "Vidaloka" => "Vidaloka",
   "Viga" => "Viga",
   "Voces" => "Voces",
   "Volkhov" => "Volkhov",
   "Vollkorn" => "Vollkorn",
   "Voltaire" => "Voltaire",
   "Waiting for the Sunrise" => "Waiting+for+the+Sunrise",
   "Wallpoet" => "Wallpoet",
   "Walter Turncoat" => "Walter+Turncoat",
   "Warnes" => "Warnes",
   "Wellfleet" => "Wellfleet",
   "Wendy One" => "Wendy+One",
   "Wire One" => "Wire+One",
   "Yanone Kaffeesatz" => "Yanone+Kaffeesatz",
   "Yellowtail" => "Yellowtail",
   "Yeseva One" => "Yeseva+One",
   "Yesteryear" => "Yesteryear",
   "Zeyada" => "Zeyada",
   );
   return $ample_googlefonts;
}
 endif;