<?php 
//Enque Theme css to footer


wp_enqueue_style('solarvillage_css', get_stylesheet_directory_uri().'/css/solarvillage.min.css',array('font_awesome_css'),'1.0.0','all');
wp_enqueue_style('font_awesome_css', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css',array(),null,'all');


// function prefix_add_footer_styles() {
// 	echo '<link rel="preload" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600" as="style" onload="this.rel=\'stylesheet\'">';
// };
// add_action( 'get_footer', 'prefix_add_footer_styles' );
//Enque all js to footer
wp_enqueue_script('popper', get_stylesheet_directory_uri().'/js/popper.min.js',array('jquery'), false, true);
wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri().'/js/bootstrap.min.js',array('jquery'), false, true);

wp_enqueue_script('mmenu', get_stylesheet_directory_uri().'/js/jquery.mmenu.all.js',array('jquery'), false, true);
wp_enqueue_script('mmenu-bootstrap4', get_stylesheet_directory_uri().'/js/jquery.mmenu.bootstrap4.js',array('jquery','mmenu'), false, true);
wp_enqueue_script('owl-carosel', get_stylesheet_directory_uri().'/js/owl.carousel.min.js','', false, true);
wp_enqueue_script('globaljs', get_stylesheet_directory_uri().'/js/global.js',array('jquery'), false, true);

// Test all enqued scripts
/**
 *
 * Find script handles...
 * For TESTING ONLY: Comment out add_action line after testing!
 * Will print a list of handles in the head of the page.
 * Use this to find script handles of PROPERLY REGISTERED scripts.
 * Some plugins load scripts improperly, that is, without enqueueing and registering them;
 * those scripts will NOT be included in the list.
 *
 */
// function insite_inspect_scripts() {
//     global $wp_scripts;
//     echo PHP_EOL.'<!-- Script Handles: ';
//     foreach( $wp_scripts->queue as $handle ) :
//         echo $handle . ' || ';
//     endforeach;
//     echo ' -->'.PHP_EOL;
// }
// add_action( 'wp_print_scripts', 'insite_inspect_scripts' );

// move jquery in footer
add_action( 'wp_default_scripts', 'move_jquery_into_footer' );

function move_jquery_into_footer( $wp_scripts ) {

    if( is_admin() ) {
        return;
    }

    $wp_scripts->add_data( 'jquery', 'group', 1 );
    $wp_scripts->add_data( 'jquery-core', 'group', 1 );
}

//Remove jQuery-migrate

function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        
        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}

add_action('wp_default_scripts', 'remove_jquery_migrate');

//Add jquery to the header
// function insert_jquery(){
//   wp_enqueue_script('jquery', false, array(), false, false);
// }
// add_filter('wp_enqueue_scripts','insert_jquery',1);

//Testing javascript defer
function add_defer_attribute($tag, $handle) {
   // add script handles to the array below
   $scripts_to_defer = array('mmenu', 'mmenu-bootstrap4','globaljs','popper','owl-carosel','bootstrap-js');
   
   foreach($scripts_to_defer as $defer_script) {
      if ($defer_script === $handle) {
         return str_replace(' src', ' defer="defer" src', $tag);
      }
   }
   return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
 
function header_banner() {
  $post = get_post();
  $banner = get_the_post_thumbnail_url($post,'full');
  $content = $post->post_content; ?>
  <div class="about-content">
      <div class="bg-banner d-flex align-items-center" style='background-image: url("<?php echo $banner; ?>");'>
        <div class="container">
          <div class="banner-content text-center text-white">
             <?php echo $content; ?>
          </div>
        </div>
      </div>
  </div>
<?php 
}



// This theme uses wp_nav_menu() in two locations.
register_nav_menus(array(
    'main_menu' => esc_html__('Main Menu', 'devdmbootstrap4'),
    'footer_menu' => esc_html__('Footer Menu', 'devdmbootstrap4'),
));

add_theme_support( 'post-thumbnails' );

//Get Browser Name
function addon_button() {
  global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	if (wp_is_mobile()) {
	$name = "Share Solar village";
    $url = "https://www.facebook.com/solarvillageinitiative";
	} else {
		  if($is_chrome) {
			$name = "Add Solar village to Chrome";
			$url = "https://chrome.google.com/webstore/detail/solar-village/aehidfcdehnmhcjmdhgmaokcfkjagkkb";
		  } else if($is_gecko) {
			$name = "Add Solar village to Firefox";
			$url = "https://addons.mozilla.org/en-US/firefox/addon/the-solar-village-org/";
		  } else if($is_safari) {
		    $name = "Add Solar village to Safari";
		    $url = "https://safari-extensions.apple.com/details/?id=org.thesolarvillage.main-X9V849A8PU";

		  } else {
			$name = "Share Solar village";
			$url = "https://www.facebook.com/thesolarvillageorg";
		  }
	}
  
	$install_btn = '<a id="install-btn" onclick="fbq(\'track\', \'Lead\')" target="_blank"  class="text-uppercase text-dark btn-primary btn border-light" href="'.$url.'">'.$name.'</a>';
	$share_btn = '<a id="share-btn" onclick="fbq(\'track\', \'Lead\') + window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(\'https://www.thesolarvillage.org\'), \'facebook-share-dialog\', \'height=279, width=575\'); return false;" href="#" class="text-uppercase text-dark btn-primary btn border-light d-none">Share Solar village</a>';
	if(is_front_page()){
		return '<div class="svlg-buttons">'.$install_btn.$share_btn.'</div>';
	}
	return '<div class="svlg-buttons">'.$install_btn.'</div>';
}



//FAQ Post type
function faq_post_type() {
  register_post_type( 'faq',
    array(
      'labels' => array(
        'name' => __( 'FAQ' ),
        'singular_name' => __( 'FAQ' )
      ),
      'supports' => array('comments', 'title', 'editor'),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'faq'),
    )
  );
}
add_action( 'init', 'faq_post_type' );

//our team Post type
function our_team_post_type() {
  register_post_type( 'our-team',
    array(
      'labels' => array(
        'name' => __( 'Our Team' ),
        'singular_name' => __( 'Our Team'),
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Team Member',
        'new_item'           => 'New',
        'edit_item'          => 'Edit',
        'view_item'          => 'View',
        'all_items'          => 'All',
        'search_items'       => 'Search',
      ),
      'supports' => array('thumbnail', 'title', 'editor'),
      'public' => true,
      //'has_archive' => true,
      //'rewrite' => array('slug' => 'faq'),
    )
  );
}
add_action( 'init', 'our_team_post_type' );

//Custom post type for partners
function partners_post_type() {
  register_post_type( 'partners',
    array(
      'labels' => array(
        'name' => __( 'Our Partners' ),
        'singular_name' => __( 'Our Partner'),
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Partner',
        'new_item'           => 'New',
        'edit_item'          => 'Edit',
        'view_item'          => 'View',
        'all_items'          => 'All',
        'search_items'       => 'Search',
        'featured_image'        => __( 'Partner Logo', 'textdomain' ),
        // Overrides the “Set featured image” label
        'set_featured_image'    => __( 'Set logo', 'textdomain' ),
        // Overrides the “Remove featured image” label
        'remove_featured_image' => _x( 'Remove logo', 'textdomain' ),
        // Overrides the “Use as featured image” label
        'use_featured_image'    => _x( 'Use as partner logo', 'textdomain' ),
      ),
      'supports' => array('thumbnail', 'title', 'editor'),
      'public' => true,
      //'has_archive' => true,
      //'rewrite' => array('slug' => 'faq'),
    )
  );
}
add_action( 'init', 'partners_post_type' );

//unique categories for partners
function partners_taxonomy() {

  register_taxonomy(
      'partners-category',
      'partners',
      array(
          'label' => __( 'Category' ),
          'rewrite' => array( 'slug' => 'partners-category' ),
          'hierarchical' => true,
      )
  );
}
add_action( 'init', 'partners_taxonomy' );

//unique categories for ourteam
function our_team_taxonomy() {

    register_taxonomy(
        'our-team-category',
        'our-team',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'our-team-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'our_team_taxonomy' );

//unique categories for FAQ
function faq_taxonomy() {

    register_taxonomy(
        'faq-category',
        'faq',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'faq-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'faq_taxonomy' );

//Feautred post meta
function faq_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
  <p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Featured this post', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 <?php }
function faq_custom_meta() {
    add_meta_box( 'faq_meta', __( 'Featured Posts', 'solarvillage' ), 'faq_meta_callback', 'faq', 'side', 'low' );
}
add_action( 'add_meta_boxes', 'faq_custom_meta' );

/**
 * Saves the custom meta input
 */
function sm_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
 // Checks for input and saves
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}
 
}
add_action( 'save_post', 'sm_meta_save' );

// shortcode echo function
function last_updated_shortcode( $atts ) {
  extract( shortcode_atts( array( 'format' => 'F j, Y \a\t G:i a', 'before' => 'Last updated:', 'after' => '' ), $atts ) ); // extract optional format argument
  
  return the_modified_date( $format, $before . ' ', $after, 0 );
}

// hooks and filters
$shortcodes = array( 'lastupdate', 'lastupdated' ); // add shortcode triggers to array
foreach( $shortcodes as $shortcode ) add_shortcode( $shortcode, 'last_updated_shortcode' ); // create shortcode for each item in $shortcodes

//Get meta data
function get_meta_by_id( $post_id, $meta_id ) {
	  global $wpdb;
	  $mid = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE post_id = %d AND meta_id = %s", $post_id, $meta_id), ARRAY_A );
		return $mid;
	}

/**
 * Disable the emoji's script and styles
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
}
add_action( 'init', 'disable_emojis' );

function svlg_partner_logo_slider(){
  $args=array(
    'post_type' => 'partners',
    'posts_per_page'=> 10, // Number of logos to display.
    'orderby' => 'rand',
   );

  $logos = new WP_Query( $args );
  if ($logos->have_posts()): ?>
	<div class="slider-title">Partners</div>
    <div class="partners-strip owl-carousel">
		<?php while($logos->have_posts()): $logos->the_post(); ?>
        <div class="partner-logo">
        <?php the_post_thumbnail('medium', array('class'=>'gray-scale')); ?>
        </div>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
<?php } 
//Shortcode function for newsletter
function svlg_newsletter_widget(){ ?>
	<div class="subscribe-box">
<form class="d-flex justify-content-center" action="https://app4.easysendy.com/lists/nc614fwfvq44b/subscribe" method="post" accept-charset="utf-8" target="_blank">

        <div class="col-md-5">
	
          <input name="EMAIL" required="" class="form-control w-100" placeholder="Enter your email..." type="email">
        </div>
        
          <button type="submit" class="btn bg-yellow text-uppercase"><b>Subscribe</b></button>
      </form>
    </div>
                    
<?php }
add_shortcode('subscribe-widget', 'svlg_newsletter_widget');
//alter query post per page
function wpd_faq_query( $query ){
    if( ! is_admin()
        && $query->is_post_type_archive( 'faq' )
        && $query->is_main_query() ){
            $query->set( 'posts_per_page', 12 );
    }
}
add_action( 'pre_get_posts', 'wpd_faq_query' );

function svlg_donation_form(){?>
	<div class='donate_form'>
		<h3>Donate</h3>
		<form name="donateForm" id="donateForm" method='get' action='https://donations.auroville.com/'>
			<div class="first-row">
			<input id='projectName' class="projectName" type='hidden' value='Solar Village' name='project'>
			<input id='inr' class="currency" type='radio' value='inr' checked="checked" name='MCurrency'><label for='inr'>INR</label>
			<input id='usd' class="currency" type='radio' value='usd' name='MCurrency'><label for='usd'>USD</label>
			</div>
			<div class="second-row">
				<span class='inr price-list'>
					<input id='inr_1' type='radio' value='100' name='MAmount'>
					<label for='inr_1'>₹100</label>
					<input id='inr_2' type='radio' value='500' name='MAmount'>
					<label for='inr_2'>₹500</label>
					<input id='inr_3' type='radio' value='1000' name='MAmount'>
					<label for='inr_3'>₹1000</label>
					<input id='inr_4' type='radio' value='5000' name='MAmount'>
					<label for='inr_4'>₹5000</label>
				</span>
				<span class='usd price-list' style="display:none;">
					<input id='usd_1' type='radio' value='15' name='MAmount'>
					<label for='usd_1'>$15</label>
					<input id='usd_2' type='radio' value='75' name='MAmount'>
					<label for='usd_2'>$75</label>
					<input id='usd_3' type='radio' value='150' name='MAmount'>
					<label for='usd_3'>$150</label>
					<input id='usd_4' type='radio' value='750' name='MAmount'>
					<label for='usd_4'>$750</label>
				</span>
		
				<span>
					<input class='other_amt' id='other_amt' name='MAmount' type='radio'>
					<label for='other_amt'>Other</label>
				</span>
					<input id='other_amtTo_MAmount' type='radio' value='' name='MAmount'>
			</div>
			</form>
			<div class="other" id="otherAmountInput">

			</div>

			<div>
				<button id="submit" class="btn">Submit</button>
			</div>
			
		
		<div class="info" id="progress" style="display: none;">
			
			<p>You will now be redirected to the official Auroville donation gateway.<br>That is a secure website.</p>
			<img src="https://www.thesolarvillage.org/wp-content/uploads/2018/11/302.gif" width="80">
		</div>
	</div>
	
<script>
runScript();
function runScript() {
	// Script that does something and depends on jQuery being there.
    if( window.jQuery ) {
		
        // do your action that depends on jQuery.
			jQuery('#submit').click(function(){
				if(!jQuery('.price-list input[type="radio"]').is(':checked') && !jQuery('#other_amt').is(':checked') ) {
					alert('Please Choose the amount!');

				} else if (jQuery('#other_amt').is(':checked') && !jQuery('#other_amount').val()  ) {
					alert('Please Enter the amount!');
				} else {
					jQuery('#progress').show();
					jQuery('#donateForm,#submit,#otherAmountInput').hide();
					if(jQuery('#other_amount').val()){
					   const otherAmountValuePassed = jQuery('#other_amount').val();
					   jQuery('#other_amtTo_MAmount').prop("checked", true);
					   jQuery('#other_amtTo_MAmount').val(otherAmountValuePassed);
						}
					setTimeout(function()
							   {
						jQuery('#donateForm').submit();
					}, 
							   4000); // ToDo, Reset to 4000 - Increasing to test things
				}
			});

			jQuery(document).ready(function() {

				jQuery('.usd').hide();
				jQuery('.currency').click(function() {
					if(jQuery(this).val() == 'inr') {
						jQuery('.inr').show(); 
						jQuery('.usd').hide(); 
						jQuery('#input-symbol').html('₹')
					}

					else {
						jQuery('.inr').hide();  
						jQuery('.usd').show();
						jQuery('#input-symbol').html('$')
					}
				});
				jQuery('.other_amt').click(function() {
// 					jQuery('.other').show();
					jQuery('#other_amt').attr('disabled', true);
					if(jQuery('#other_amt').is(':checked')) {
					jQuery('#otherAmountInput').append(otherAmountField);
					}
				});
				jQuery('.price-list input[type="radio"]').click(function() {
					jQuery('#otherAmountInput').empty();
					jQuery('#other_amt').attr('disabled', false);
				});
				jQuery('#other_amount').keyup(function() {
					jQuery('#other_amt').val(jQuery(this).val());
				});

// 				jQuery('.other').hide(); 
			});
    } else {
        // wait 50 milliseconds and try again.
        window.setTimeout( runScript, 50 );
    }
	
	const otherAmountField = `
						
						<div class="input-group mb-3">
						<div class="input-group-prepend">
						<span class="input-group-text" id="input-symbol">₹</span>
							</div>
						<input id="other_amount" name='MAmount' type="text" class="form-control" placeholder="Amount" aria-label="Amount" aria-describedby="input-symbol">
							</div>`;
}
</script>
<style>
.donate_form label {
	background: #505050;
	color: #fff;
	padding: 3% 0;
}
.donate_form input[type="radio"]:checked + label {
	background: yellow;
}
.donate_form input[type="radio"] + label:hover {
	background: #fceea5;
	color: #000000;
	cursor: pointer;
}
.donate_form input[type="radio"]:checked + label {
	background: #ffdd2e;
	color: #000000;
	
}
.donate_form input[type="radio"] {
	display: none;
}
.donate_form {
	text-align: center;
	padding: 20px 10px;
	width: 50%;
	margin: 0 auto;
	background: #fceea533;
}
.donate_form .first-row label {
	width: 48%;
}
.donate_form .second-row label {
	width: 19%;
}

.donate_form button {
	width: 96.5%;
	margin-top: 10px;
	border-radius: 1px;
	background: #fbde40;
}
.donate_form h3 {
	margin-bottom: 20px;
	color: #fff;
	text-transform: uppercase;
	font-weight: bold;
}
.donate_form .info {
		color:#fff;
	}
.donate_form .input-group {
	width: 98% !important;
	margin: 0 auto;
}

</style>

<?php }
add_shortcode('svlg_donate_form', 'svlg_donation_form');

// include infospace file
    
require get_template_directory() . '/includes/InfoSpaceRequestSigner.php';

function svlg_signature($query='') {
	$file = new InfoSpaceRequestSigner("n2vc7N4XmU2XAb4nKlTOPA2");
	return $file->getSignature($query);
}
function searchpage_body_class($classes) {
	if(is_page(array('search'))) {
    $classes[] = 'search';
	}
    return $classes;
}
add_filter('body_class', 'searchpage_body_class');


/**
 * Gets the request parameter.
 *
 * @param      string  $key      The query parameter
 * @param      string  $default  The default value to return if not found
 *
 * @return     string  The request parameter.
 */
function get_param( $key, $default = '' ) {
    // If not request set
    if ( ! isset( $_REQUEST[ $key ] ) || empty( $_REQUEST[ $key ] ) ) {
        return $default;
    }
    // Set so process it
    return strip_tags( (string) wp_unslash( $_REQUEST[ $key ] ) );
}

/**
 * Gets the request parameter.
 *
 * @param      string  $key      The query parameter
 * @param      string  $default  The default value to return if not found
 *
 * @return     string  The request parameter.
 */
function get_query_param( $key, $default = '' ) {
    // If not request set
    if ( ! isset( $_REQUEST[ $key ] ) || empty( $_REQUEST[ $key ] ) ) {
        return $default;
    }
    // it will keep the tags
    return esc_html( $_REQUEST[ $key ]);
}


/**
 * Register custom query vars
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/query_vars
 */
function register_InfoSpace_QVars( $vars ) {
    $vars[] = 'q';
    $vars[] = 'pageNo';
	$vars[] = 'searchCategoryTab';
    return $vars;
}
add_filter( 'query_vars', 'register_InfoSpace_QVars' );

/**
 * Wiki Data
 *
 * @https://en.wikipedia.org/w/api.php?action=help&modules=query
 */
function svlg_get_wiki_data($query = "") {
	$api = @file_get_contents('https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro&redirects=1&titles='.$query);
	if($api) {
		$json = json_decode($api, true);
		$data = $json['query']['pages'];
		foreach ($data as $value) {
			$title[] = $value['title'];
			$content[] = $value['extract'];
		}
		$title = $title[0];
		$content = $content[0];
		//Getting First Para
		$content = explode('</p><p>', $content);
		$content = $content[0];
		return '<div class="wiki-data"><title>'.$title.'</title>'.$content.'</div>';	}
}

?>