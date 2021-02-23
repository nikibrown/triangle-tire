<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. 
 * 
 * @package WordPress
 * @subpackage wpcustom
*/

//Registration Fields
/**
 * Adds the custom fields to the registration form and profile editor
 *
 */
function pw_rcp_add_user_fields() {
	
	$company = get_user_meta( get_current_user_id(), 'rcp_company', true );
	$newsletter = get_user_meta( get_current_user_id(), 'rcp_newsletter', true );
	$newsletterreject = get_user_meta( get_current_user_id(), 'rcp_newsletterreject', true );
	?>
	<p>
		<label for="rcp_company"><?php _e( 'Company', 'rcp' ); ?></label>
		<input name="rcp_company" id="rcp_company" type="text" value="<?php echo esc_attr( $company ); ?>"/>
	</p>
	<p>
		<label for="rcp_newsletter"><?php _e( 'Optin to Newsletter?', 'rcp' ); ?></label>
		<select name="rcp_newsletter" id="rcp_newsletter" value="<?php echo esc_attr( $newsletter ); ?>">
    		<option value="yes">Yes</option>
			<option value="no">No</option>
		</select>
	</p>
<?php
}
add_action( 'rcp_after_password_registration_field', 'pw_rcp_add_user_fields' );
add_action( 'rcp_profile_editor_after', 'pw_rcp_add_user_fields' );

/**
 * Adds the custom fields to the member edit screen
 *
 */
function pw_rcp_add_member_edit_fields( $user_id = 0 ) {
	
	$company = get_user_meta( $user_id, 'rcp_company', true );
	$newsletter = get_user_meta( $user_id, 'rcp_newsletter', true );
	?>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_company"><?php _e( 'Company', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_company" id="rcp_company" type="text" value="<?php echo esc_attr( $company ); ?>"/>
			<p class="description"><?php _e( 'The member\'s company', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_newsletter"><?php _e( 'Newsletter Optin', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_newsletter" id="rcp_newsletter" type="text" value="<?php echo esc_attr( $newsletter ); ?>"/>
			<p class="description"><?php _e( 'Optin answer', 'rcp' ); ?></p>
		</td>
	</tr>
	<?php
}
add_action( 'rcp_edit_member_after', 'pw_rcp_add_member_edit_fields' );

/**
 * This will remove the username requirement on the registration form
 * and use the email address as the username.
 */
function jp_rcp_user_registration_data( $user ) {
	rcp_errors()->remove( 'username_empty' );
	$user['login'] = $user['email'];
	return $user;
}

add_filter( 'rcp_user_registration_data', 'jp_rcp_user_registration_data' );

/**
 * Determines if there are problems with the registration data submitted
 *
 */
function pw_rcp_validate_user_fields_on_register( $posted ) {
	if ( is_user_logged_in() ) {
	   return;
    	}
	if( empty( $posted['rcp_company'] ) ) {
		rcp_errors()->add( 'invalid_company', __( 'Please enter your company', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_newsletter'] ) ) {
		rcp_errors()->add( 'invalid_newsletter', __( 'Please select an option', 'rcp' ), 'register' );
	}
}
add_action( 'rcp_form_errors', 'pw_rcp_validate_user_fields_on_register', 10 );

// Adding body class for registration page
add_filter( 'body_class', 'registration');
function registration( $classes ) {
     if ( is_page(4640) )
          $classes[] = 'registration-page';
 
     return $classes; 
}

//Register Menus
register_nav_menus( array(
	'about_triangle' => 'About Triangle',
	'tire_menu' => 'Tire Menu',
	'contact_us' => 'Contact Us',
	'products' => 'Products',
	'support_center' => 'Support Center',
) );

//Require the theme options panel settings
require_once( dirname( __FILE__ ) . '/inc/load.php' );
require_once( dirname( __FILE__ ) . '/inc/ImportHelper.php' );

//Remove meta generated by wordpress tag that spambots love
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', '_ak_framework_meta_tags' );
add_theme_support( 'post-thumbnails' );

function current_v()
{
	/*return time();*/
	return '2.0.1';
}

function add_customizations()
{
	wp_enqueue_script( 'triangle-js', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), current_v(), true );
	wp_localize_script( 'triangle-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action('enqueue_scripts', 'add_customizations');

//To add custom post types, or custom metaboxes, use Wp-Cuztom
//See: https://github.com/gizburdt/wp-cuztom/wiki for more instructions


/**
 * Output GA only if current user is not logged in
 */
function ga_output()
{
    $ga_id = get_option( 'project_gaq' );
    if( !is_user_logged_in() && $ga_id != '' )
    {
    ?>
<!--GA added by theme adjust-->
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', '<?php echo $ga_id; ?>']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
    <?php
    }
}
add_action( 'wp_footer', 'ga_output', 1 );



/**
 * Featured image retrieval.  Returns full URI to image if found
 * @param null $id
 * @param string $size
 * @param null $fallback
 * @return bool|null|string
 */
function featured_image( $id = null, $size = 'medium', $fallback = null )
{
    if( is_null( $id ) )
    {
        global $post;
        $post_id = $post->ID;
    }
    else
    {
        $post_id = $id;
        $post = get_post( $post_id );
    }

    if( has_post_thumbnail( $post_id ) )
    {
        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size, false );
        $this_src = $src[0];
        return $this_src;
    }
    else
    {
        $szPostContent = $post->post_content;
        $szSearchPattern = '~<img [^\>]*\ />~';
        preg_match_all( $szSearchPattern, $szPostContent, $aPics );
        $iNumberOfPics = count($aPics[0]);
        if( $iNumberOfPics > 0 )
        {
            $pix = $aPics[0][0];
            $t1 = strpos($pix, 'src="');
            $t2 = strpos($pix, '"', $t1 + 6);
            $pixt = substr($pix, $t1 + 5, $t2 - $t1 - 5);
            return $pixt;

        }
    }
    return !is_null( $fallback ) ? $fallback : false;
}


add_action( 'wp_ajax_contact_form', 'send_contact_form');
add_action( 'wp_ajax_nopriv_contact_form', 'send_contact_form');

function send_contact_form() {

	$response = array(
		'success' => false,
		'message' => 'An unexpected error occurred',
	);

	if( !isset( $_REQUEST['email'] ) )
	{
		echo json_encode( $response );
		die;
	}


	$email = sanitize_email( $_REQUEST['email'] );
	$name = sanitize_text_field( $_REQUEST['name'] );
	$body = esc_textarea( $_REQUEST['message'] );
	$subject = 'Become a Dealer Contact Submission';
	if( isset( $_REQUEST['subject'] ) && !empty( $_REQUEST['subject'] ) )
	{
		$subject = sanitize_text_field( $_REQUEST['subject'] );
	}


	$errors = array();
	if( empty( $email ) || !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
	{
		$errors[] = 'Please enter a valid email';
	}
	if( empty( $body ) )
	{
		$errors[] = 'Please enter your message';
	}

	//If we have any errors, stop here and show them to the user
	if( !empty( $errors ) )
	{
		$response['message'] = implode( '<br />', $errors );
		echo json_encode( $response );
		die;
	}

	$to = get_option( 'admin_email' );
	$headers = 'From: '.$name.' <'.$email.'>';

	if( !empty( $_REQUEST['type'] ) )
	{
		$body .= "\n\n\n";
		$body .= "Request for: ". $_REQUEST['type'];
	}

	//Add the sender info...
	$body .= "\n\n\n";
	$body .= "Name: {$name}\r\n";
	$body .= "Email: {$email}";

	if( wp_mail( $to, $subject, strip_tags( $body ), $headers ) )
	{
		$response['success'] = true;
		$response['message'] = 'Thank you for contacting '.get_bloginfo( 'sitename' ).'!';
	}
	else
	{
		$response['message'] = 'An unexpected error occurred';
	}
	echo json_encode( $response );
	die;
}
//end submit contact and booking requests


/**
 * This function will connect wp_mail to your authenticated
 * SMTP server. This improves reliability of wp_mail, and
 * avoids many potential problems.
 *
 * Author:     Chad Butler
 * Author URI: http://butlerblog.com
 *
 * For more information and instructions, see:
 * http://b.utler.co/Y3
 */
//add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {

	// Define that we are sending with SMTP
	$phpmailer->isSMTP();

	// The hostname of the mail server
	$phpmailer->Host = "smtp.mailgun.org";

	// Use SMTP authentication (true|false)
	$phpmailer->SMTPAuth = true;

	// SMTP port number - likely to be 25, 465 or 587
	$phpmailer->Port = "587";

	// Username to use for SMTP authentication
	$phpmailer->Username = "";

	// Password to use for SMTP authentication
	$phpmailer->Password = "";

	// Encryption system to use - ssl or tls
	$phpmailer->SMTPSecure = "tls";
}


add_action( 'wp_ajax_print_contents', 'generate_print_view');
add_action( 'wp_ajax_nopriv_print_contents', 'generate_print_view');

function generate_print_view() {

	$response = array(
		'success' => false,
		'message' => 'An unexpected error occurred',
	);

	if( !isset( $_REQUEST['email'] ) )
	{
		echo json_encode( $response );
		die;
	}


	echo json_encode( $response );
	die;
}
//end submit contact and booking requests

add_action( 'admin_menu', 'triangle_admin_pages' );
if( !function_exists( 'triangle_admin_pages' ) )
{
	/**
	 * Function to add admin pages
	 * Also adds employee level pages
	 */
	function triangle_admin_pages()
	{
		add_submenu_page( 'tools.php', 'Triangle', 'Import Tires', 'manage_options', 'import-tire', 'tire_import_page' );
	}
}

function tire_import_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<h2>Import Tire Data</h2>';
	if( isset( $_GET['status'] ) && isset( $_GET['message'] ) && !empty( $_GET['message'] ) )
	{
		$status = $_GET['status'] == 0 ? 'error' : 'success';
		echo '<div id="message" class="'.$status.' notice is-dismissible"><p>'.stripslashes( urldecode( $_GET['message'] ) ).'</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
	}
	echo '<p>Import CSV, XLS, or XLSX file for bulk tire upload.</p>';
	echo '<p>Be sure to use the example template provided, available <a href="'. get_template_directory_uri() . '/inc/template.xlsx" target="_top">here</a></p>';
	require( __DIR__ . '/inc/tire-import-form.php' );
	echo '</div>';
}


/**
 * Function to provide case sensitive context
 * Context will always only have suffix for 0 or >2 counts
 *
 * @access public
 * @param int count
 * @param string word
 * @param suffix
 * @return string
 */
function tense( $count = 0, $word, $append = 's' )
{
	if( $count == 0 || $count >= 2 )
		$return = $word . $append;
	else
		$return = $word;

	return $return;
}


add_action( 'wp_loaded', 'process_import_form' );
function process_import_form()
{
	if(isset( $_POST['new_import_submit'] ) && isset( $_FILES['upload_new_form'] ) )
	{
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		require_once( __DIR__ . '/inc/ImportHelper.php' );

		$pdf = $_FILES['upload_new_form'];

		// Use the wordpress function to upload
		// test_upload_pdf corresponds to the position in the $_FILES array
		// 0 means the content is not associated with any other posts
		$params = array(
			'post_title' => null
		);
		$attachment_id = media_handle_upload( 'upload_new_form', 0, $params );
		$user = get_current_user_id();

		$message = '';
		if( is_wp_error( $attachment_id ) )
		{
			$status = 0;
			$message = $attachment_id->get_error_message();
		}
		else
		{
			$status = 1;
			require_once( __DIR__ . '/inc/spreadsheet-reader-master/php-excel-reader/excel_reader2.php' );
			require_once( __DIR__ . '/inc/spreadsheet-reader-master/SpreadsheetReader.php' );

			$reader = new SpreadsheetReader( get_attached_file( $attachment_id ) );
			$importer = new ImportHelper();
			$groups = $importer->deep_parse( $reader );
			$response = $importer->import( $groups );
			wp_delete_attachment( $attachment_id, true );

			$message = urlencode( "Imported ". count( $response ) ." ". tense( count( $response ), 'item' ) . " successfully" );
		}
		wp_redirect( 'tools.php?page=import-tire&status='. $status .'&message='. $message );
		die;
	}

}

/**
 * @return array
 */
function get_all_taxonomies()
{
	$all_cats = array(
		'passenger_tires' => array(),
		'truckbus_tires' => array(),
		'offroad_tires' => array(),
	);

	$passenger_types = get_terms([
		'taxonomy' => 'categories',
		'hide_empty' => true,
	]);
	foreach( $passenger_types as $t )
	{
		$all_cats['passenger_tires'][$t->taxonomy][] = $t;
	}

	$truckbus_types = get_terms([
		'taxonomy' => array(
			'application',
			'position',
			'feature',
		),
		'hide_empty' => true,
		'orderby' => 'name',
	]);
	foreach( $truckbus_types as $t )
	{
		$all_cats['truckbus_tires'][$t->taxonomy][] = $t;
	}

	$offroad_types = get_terms([
		'taxonomy' => array(
			'applications',
			'classification',
			'equipment',
		),
		'hide_empty' => true,
		'orderby' => 'name',
	]);
	foreach( $offroad_types as $t )
	{
		$all_cats['offroad_tires'][$t->taxonomy][] = $t;
	}

	return $all_cats;
}

// Add specific CSS class by filter
add_filter('body_class','er_logged_in_filter');
function er_logged_in_filter($classes) {
if( is_user_logged_in() ) {
$classes[] = 'loggedin-product-class';
} else {
$classes[] = 'loggedout-product-class';
}
// return the $classes array
return $classes;
}