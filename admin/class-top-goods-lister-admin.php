<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.upwork.com/o/profiles/users/_~01a15cf8508f1d2eec/
 * @since      1.0.0
 *
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/admin
 * @author     Serhii Ruban <rubanwd@gmail.com>
 */
class Top_Goods_Lister_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Top_Goods_Lister_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Top_Goods_Lister_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/top-goods-lister-admin.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'wp-color-picker' );



	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Top_Goods_Lister_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Top_Goods_Lister_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/top-goods-lister-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );


		



	}




	
	/**
	 * Register a product post type.
	 */

	public function tgl_product_custom_post_init() {

		$labels = array(
			'name'               => _x( 'Product', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Product', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Products', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Product', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'product', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Product', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Product', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Product', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Product', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Products', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Products', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Products:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No Products found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No Products found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'exclude_from_search'=> true,
			'rewrite'            => array( 'slug' => 'product' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'menu_icon'   		 => 'dashicons-cart',
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'product', $args );

		
	}

	/**
	 * Add thumbnail support for Product Custom Type 
	 */

	public function add_thumbnail_to_product_type() { 
		add_theme_support( 'post-thumbnails', array( 'product' ) );
	}

	/**
	 * Enable WEBP format for upload in media
	 */

	public function enable_webp_upload() {

		/**
		 * Sets the extension and mime type for .webp files.
		 *
		 * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
		 *                                          'proper_filename' keys.
		 * @param string $file                      Full path to the file.
		 * @param string $filename                  The name of the file (may differ from $file due to
		 *                                          $file being in a tmp directory).
		 * @param array  $mimes                     Key is the file extension with value as the mime type.
		 */
		add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_webp', 10, 4 );
		function wpse_file_and_ext_webp( $types, $file, $filename, $mimes ) {
		    if ( false !== strpos( $filename, '.webp' ) ) {
		        $types['ext'] = 'webp';
		        $types['type'] = 'image/webp';
		    }

		    return $types;
		}

		/**
		 * Adds webp filetype to allowed mimes
		 * 
		 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
		 * 
		 * @param array $mimes Mime types keyed by the file extension regex corresponding to
		 *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
		 *                     removed depending on '$user' capabilities.
		 *
		 * @return array
		 */
		add_filter( 'upload_mimes', 'wpse_mime_types_webp' );
		function wpse_mime_types_webp( $mimes ) {
		    $mimes['webp'] = 'image/webp';

		  return $mimes;
		}

	}

	/* Meta box setup function. */
	public function tgl_product_meta_boxes_setup() {
		function tgl_add_post_meta_boxes() {
			add_meta_box(
				'product_custom_meta',
				esc_html__( 'Product Meta Fields', 'tgl' ),
				'tgl_meta_box_callback',
				'product',
				'advanced',
				'high'
			);
		};

		/* Display the post meta box. */
		function tgl_meta_box_callback() {
		    global $post;
		    // Nonce field to validate form request came from current site
		    wp_nonce_field( basename( __FILE__ ), 'event_fields' );

		    // Get the location data if it's already been entered

		    $afflink = get_post_meta( $post->ID, 'afflink', true );
		    $fdblink = get_post_meta( $post->ID, 'fdblink', true );
		    $brendname = get_post_meta( $post->ID, 'brendname', true );
		    $brendlink = get_post_meta( $post->ID, 'brendlink', true );
		    $order = get_post_meta( $post->ID, 'order', true );
		    $starrange = get_post_meta( $post->ID, 'starrange', true );
		    $term = get_the_terms( $post->ID, 'list' );


		    include( plugin_dir_path(__FILE__) . 'partials/custom-meta-box-template.php' );

			
		}


		/* Save the meta box's post metadata. */

		function tgl_save_post_meta( $post_id, $post ) {
		    // Return if the user doesn't have edit permissions.
		    if ( ! current_user_can( 'edit_post', $post_id ) ) {
		        return $post_id;
		    }
		    // Verify this came from the our screen and with proper authorization,
		    // because save_post can be triggered at other times.
		    if ( ! isset( $_POST['afflink'] ) || ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
		        return $post_id;
		    }
		    if ( ! isset( $_POST['fdblink'] ) || ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
		        return $post_id;
		    }
		    if ( ! isset( $_POST['brendname'] ) || ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
		        return $post_id;
		    }
		    if ( ! isset( $_POST['brendlink'] ) || ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
		        return $post_id;
		    }
		    if ( ! isset( $_POST['order'] ) || ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
		        return $post_id;
		    }
		    if ( ! isset( $_POST['starrange'] ) || ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
		        return $post_id;
		    }
		    // Now that we're authenticated, time to save the data.
		    // This sanitizes the data from the field and saves it into an array $events_meta.
		    $events_meta['afflink'] = esc_textarea( $_POST['afflink'] );
		    $events_meta['fdblink'] = esc_textarea( $_POST['fdblink'] );
		    $events_meta['brendname'] = esc_textarea( $_POST['brendname'] );
		    $events_meta['brendlink'] = esc_textarea( $_POST['brendlink'] );
     		$events_meta['order'] = esc_textarea( $_POST['order'] );
     		$events_meta['starrange'] = esc_textarea( $_POST['starrange'] );
		    // Cycle through the $events_meta array.
		    // Note, in this example we just have one item, but this is helpful if you have multiple.
		    foreach ( $events_meta as $key => $value ) :
		        // Don't store custom data twice
		        if ( 'revision' === $post->post_type ) {
		            return;
		        }
		        if ( get_post_meta( $post_id, $key, false ) ) {
		            // If the custom field already has a value, update it.
		            update_post_meta( $post_id, $key, $value );
		        } else {
		            // If the custom field doesn't have a value, add it.
		            add_post_meta( $post_id, $key, $value);
		        }
		        if ( ! $value ) {
		            // Delete the meta key if there's no value
		            delete_post_meta( $post_id, $key );
		        }
		    endforeach;
		}

		// Move all "advanced" metaboxes above the default editor
		function move_custom_meta_box_above() {
			global $post, $wp_meta_boxes;
		    do_meta_boxes(get_current_screen(), 'advanced', $post);
		    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
		}
		/* Add meta boxes on the 'add_meta_boxes' hook. */
		add_action( 'add_meta_boxes', 'tgl_add_post_meta_boxes' );
		/* Save post meta on the 'save_post' hook. */
		add_action( 'save_post', 'tgl_save_post_meta', 10, 2 );
		// Move all "advanced" metaboxes above the default editor
		add_action( 'edit_form_after_title', 'move_custom_meta_box_above' );
	}

	// Remove permalink section from admin
	public function hide_permalink() {
	    return '';
	}
	// Remove Publish button for Product post type from admin
	public function delete_publsh_button() {
	    global $post_type;
	    $post_types = array(
                    /* set post types */
                    'product'
              );
	    if(in_array($post_type, $post_types))
	    echo '<style type="text/css">#post-preview, #view-post-btn{display: none;}</style>';
	}
	//create a custom taxonomy, name it "list" for product posts
	public function tgl_create_custom_taxonomy_list() {
	  $labels = array(
	    'name' => _x( 'List', 'taxonomy general name' ),
	    'singular_name' => _x( 'List', 'taxonomy singular name' ),
	    'search_items' =>  __( 'Search Lists' ),
	    'all_items' => __( 'All Lists' ),
	    'parent_item' => __( 'Parent List' ),
	    'parent_item_colon' => __( 'Parent List:' ),
	    'edit_item' => __( 'Edit List' ), 
	    'update_item' => __( 'Update List' ),
	    'add_new_item' => __( 'Add New List' ),
	    'new_item_name' => __( 'New List Name' ),
	    'menu_name' => __( 'Lists' ),
	  ); 	
	  register_taxonomy('list',array('product'), array(
	    'hierarchical' => true,
	    'labels' => $labels,
	    'show_ui' => true,
	    'show_admin_column' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'list' ),
	  ));
	}


















///////////////////////////  OPTION MENU AND PAGE ///////////////////////////////



	function tgl_options_page() {
		add_submenu_page(
		    'edit.php?post_type=product',
		    'TGL Options',
		    'Options',
		    'manage_options',
		    'tgl',
		    array($this, 'tgl_options_page_html')
		    
		);
	}

	function tgl_options_page_html() {
	 	// check user capabilities
	 	if ( ! current_user_can( 'manage_options' ) ) {
	 		return;
	 	}
	 
	 	// add error/update messages
	 
	 	// check if the user have submitted the settings
	 	// wordpress will add the "settings-updated" $_GET parameter to the url
	 	if ( isset( $_GET['settings-updated'] ) ) {
	 		// add settings saved message with the class of "updated"
	 		add_settings_error( 'tgl_messages', 'tgl_message', __( 'Settings Saved', 'tgl' ), 'updated' );
	 	}
	 
	 	// show error/update messages
	 	settings_errors( 'tgl_messages' );
	 	?>

	 	<div class="tgl">
	 		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	 		<form action="options.php" method="post">
		 		<?php
		 		// output security fields for the registered setting "tgl"
		 		settings_fields( 'tgl_options' );
		 		// output setting sections and their fields
		 		// (sections are registered for "tgl", each field is registered to a specific section)
		 		do_settings_sections( 'tgl_options' );
		 		// output save settings button
		 		submit_button( 'Save Settings' );
		 		?>
	 		</form>
	 	</div>
	 <?php
	}

	/**
	 * custom option and settings
	 */
	function tgl_settings_init() {

	 	// register a new setting for "tgl" page
	 	register_setting( 'tgl_options', 'tgl_options' );
	 
	 	// Settings background color, text color and text value for the "Target Button"
	 	add_settings_section(
	 		'tgl_section_turget_button',
	 		__( 'Settings for Turget Button', 'tgl' ),
	 		array($this, 'tgl_section_turget_button_cb'),
	 		'tgl_options'
	 	);
	 	add_settings_field(
	 		'tgl_turget_button_style', // as of WP 4.6 this value is used only internally
	 		// use $args' label_for to populate the id inside the callback
	 		__( 'Target Button Style', 'tgl' ),
	 		array($this, 'tgl_turget_button_style_cb'),
	 		'tgl_options',
	 		'tgl_section_turget_button',
	 		[
	 			'label_for' => 'tgl_button_style',
	 			'class' => 'tgl_row',
	 			'tgl_custom_data' => 'custom',
	 		]
	 	);
	 	add_settings_field(
	 		'tgl_turget_button_text_value', // as of WP 4.6 this value is used only internally
	 		// use $args' label_for to populate the id inside the callback
	 		__( 'Target Button Text Value', 'tgl' ),
	 		array($this, 'tgl_turget_button_text_value_cb'),
	 		'tgl_options',
	 		'tgl_section_turget_button',
	 		[
	 			'label_for' => 'tgl_button_text_value',
	 			'class' => 'tgl_row',
	 			'tgl_custom_data' => 'custom',
	 		]
	 	);





	 	// Settings for text color and text value for the "Feedback Button"
		add_settings_section(
	 		'tgl_section_feedback_button',
	 		__( 'Settings for Feedback Button', 'tgl' ),
	 		array($this, 'tgl_section_feedback_button_cb'),
	 		'tgl_options'
	 	);


	 	add_settings_field(
	 		'tgl_feedback_button_style', // as of WP 4.6 this value is used only internally
	 		// use $args' label_for to populate the id inside the callback
	 		__( 'Feedback Button Style', 'tgl' ),
	 		array($this, 'tgl_feedback_button_style_cb'),
	 		'tgl_options',
	 		'tgl_section_feedback_button',
	 		[
	 			'label_for' => 'tgl_button_style',
	 			'class' => 'tgl_row',
	 			'tgl_custom_data' => 'custom',
	 		]
	 	);


	 	add_settings_field(
	 		'tgl_feedback_button_text_value', // as of WP 4.6 this value is used only internally
	 		// use $args' label_for to populate the id inside the callback
	 		__( 'Feadback Button Text Value', 'tgl' ),
	 		array($this, 'tgl_feedback_button_text_value_cb'),
	 		'tgl_options',
	 		'tgl_section_feedback_button',
	 		[
	 			'label_for' => 'tgl_button_text_value',
	 			'class' => 'tgl_row',
	 			'tgl_custom_data' => 'custom',
	 		]
	 	);






	}
 
	function tgl_section_turget_button_cb( $args ) {
	 	?>
	 	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'In this section you can set background color, text color and text value for the "Target Button"', 'tgl' ); ?></p>
	 	<?php
	}

	
	 
	function tgl_turget_button_style_cb( $args ) {
	 	$options = get_option( 'tgl_options' );

	 	?>
	<!--      <input type="text" name="tgl_button_color" id="tgl_button_color" value="<?php echo get_option('tgl_button_color'); ?>" /> -->
		<div class="target-button-style">
			<p>
				<label for="target-button-background-color">Background color: </label>
				<input class="tgl-option-color-picker" name="tgl_options[target-button-background-color]" type="text" id="target-button-background-color" value="<?php echo $options['target-button-background-color'] ?>" />
			</p>
			
			<p>
				<label for="target-button-background-color">Text color: </label>
				<input class="tgl-option-color-picker" name="tgl_options[target-button-text-color]" type="text" id="target-button-text-color" value="<?php echo $options['target-button-text-color'] ?>" />
			</p>
		 	
		</div>

	 <?php
	}

	function tgl_turget_button_text_value_cb( $args ) {
	 	$options = get_option( 'tgl_options' );

	 	?>
	    
		<div class="target-button-text-value">
			<p>
				<input type="text" class="target-button-text-value" name="tgl_options[target-button-text-value]" id="target-button-text_value" value="<?php echo $options['target-button-text-value'] ?>" /> 
			</p>
			
		</div>

	 <?php
	}







	function tgl_section_feedback_button_cb( $args ) {
	 	?>
	 	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'In this section you can set text color and text value for the "Feedback Button"', 'tgl' ); ?></p>
	 	<?php
	}


	function tgl_feedback_button_style_cb( $args ) {
	 	$options = get_option( 'tgl_options' );

	 	?>
		<div class="feedback-button-style">
			<p>
				<label for="feedback-button-background-color">Text color: </label>
				<input class="tgl-option-color-picker" name="tgl_options[feedback-button-text-color]" type="text" id="feedback-button-text-color" value="<?php echo $options['feedback-button-text-color'] ?>" />
			</p>
		 	
		</div>

	 <?php
	}



	function tgl_feedback_button_text_value_cb( $args ) {
	 	$options = get_option( 'tgl_options' );

	 	?>
	    
		<div class="feedback-button-text-value">
			<p>
				<input type="text" class="feedback-button-text-value" name="tgl_options[feedback-button-text-value]" id="feedback-button-text_value" value="<?php echo $options['feedback-button-text-value'] ?>" /> 
			</p>
			
		</div>

	 <?php
	}

	



}























