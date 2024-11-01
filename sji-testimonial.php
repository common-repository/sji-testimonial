<?php
/*
 * Plugin Name: SJI Testimonial
Plugin URI:  
Description: This is a testimonial plugin developed by SJI team. SJI Testimonial has been built purely on HTML5, CCS3 and javascript. 
It is very easy to use and provides fully responsive slider view and also lets you choose the order of slide. You can either randomly slide them or slide them with either newest slide first or newest slide last. The Admin will get the flexibility to edit, trash and view each testimonials from the dashboard.
SJI testimonial plugin is also very user-friendly, as users need to not take much hassle to submit their testimonial. Just fill-up a form and done!
It also provides auto-generated Shortcode.
Version:     1.1
Author:      SJ Innovation
Author URI: http://sjinnovation.com
License:     
License URI: 
Domain Path: 
Text Domain: http://sjinnovation.com
Read me :
*/
?>
<?php
add_action('admin_init', 'sji_testimonial_load_my_script_style');
   function sji_testimonial_load_my_script_style()
   {
       
       
     if (is_admin()) {
        $css = plugins_url('bootstrap/css/bootstrap.min.css' , __FILE__);
        $js = plugins_url('bootstrap/js/bootstrap.min.js' , __FILE__);
        wp_enqueue_style( 'font-awesome', 'http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css');
        wp_enqueue_style( 'testimonial_style1', $css , false);
        wp_enqueue_script("jquery");
        wp_enqueue_script( 'testimonial-script1', $js , array(), '3.3.7', true);

       // wp_enqueue_style( 'font-awesome', 'http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css');
       //    wp_enqueue_style( 'testimonial_style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
       //    wp_enqueue_script( 'testimonial-script', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');
       //    wp_enqueue_script( 'testimonial-script1', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
       }
   }
function sji_testimonial_setup_post_types() {
 
    // Register our "testimonial" custom post type
     register_post_type( 'testimonial', array( 'can_export' => TRUE
        ,   'exclude_from_search' => FALSE
        ,   'has_archive'         => TRUE
        ,   'hierarchical'        => TRUE
        ,   'label'               => 'Testimonials'
        ,   'menu_position'       => 0
        ,   'public'              => TRUE
        ,   'publicly_queryable'  => TRUE
        ,   'query_var'           => 'testimonial'
        ,   'rewrite'             => array ( 'slug' => 'testimonial' )
        ,   'show_ui'             => TRUE
        ,   'show_in_menu'        => FALSE // this can be made TRUE to display in main menu next to posts
        ,   'show_in_nav_menus'   => TRUE
        ,   'supports'            => array ( 'editor', 'title','excerpt','revisions', 'thumbnail')) );
 }
add_action( 'init', 'sji_testimonial_setup_post_types' );
 
function sji_testimonial_install() { 
    // Trigger our function that registers the custom post type
    sji_testimonial_setup_post_types(); 
    // Clear the permalinks after the post type has been registered
    flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'sji_testimonial_install' );

function sji_testimonial_deactivation() { 
    // Our post type will be automatically removed, so no need to unregister it 
    // Clear the permalinks to remove our post type's rules
    flush_rewrite_rules(); 
}
register_deactivation_hook( __FILE__, 'sji_testimonial_deactivation' );
//adding Testimonial as a seperate menu and its settings
add_action( 'admin_menu', 'sji_testimonial_add_admin_menu' );

function sji_testimonial_add_admin_menu(){
  add_menu_page('Settings', 'SJI Testimonial Settings', 'manage_options', 'testimonial-options', 'sji_testimonial_settings', 'dashicons-edit', 35); // last paramter is the value which call the function below
  add_submenu_page('testimonial-options', 'Testimonials', 'Testimonials', 'manage_options', 'edit.php?post_type=testimonial', '');
  add_submenu_page('testimonial-options', 'Settings', 'Settings', 'manage_options', 'settings_for_testimonial' ,'sji_general_setting_tab_');
  add_submenu_page('testimonial-options', 'Add New', 'Add New', 'manage_options', 'post-new.php?post_type=testimonial', '');
   
}

function sji_general_setting_tab_(){
	?>
	<div class="container">
	<h1>Testimonial Settings </h1>
	<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">General</a></li>
    <li><a data-toggle="pill" href="#menu1">Shortcode Options</a></li>
    <li><a data-toggle="pill" href="#menu2">Credits</a></li>
	</ul>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <br><br><h2>Plugin Description:</h2>
       <br><p>This is a testimonial plugin developed by SJI team. SJI Testimonial has been built purely on HTML5, CCS3 and javascript.
		It is very easy to use and provides fully responsive slider view and also lets you choose the order of slide. You can either randomly slide them or slide them with either newest slide first or newest slide last. The Admin will get the flexibility to edit, trash and view each testimonials from the dashboard.
		SJI testimonial plugin is also very user-friendly, as users need to not take much hassle to submit their testimonial. Just fill-up a form and done!
		It also provides auto-generated Shortcode.
		</p>
    </div>
    <div id="menu1" class="tab-pane fade">
	  <h4>INFORMATION: </h4>
	  <div >
      <label >Testimonial Form: </label>
	  <p>
		[sji_testimonial_form_] - Paste this Shortcode to display testimonial form in the frontend
	  </p>
	  </div>
	  <label>Testimonial Basic: </label>
	  <p>
		[sji-testimonial-basic] - Paste this Shortcode to display testimonial carousel
	  </p>
		
    </div>
    <div id="menu2" class="tab-pane fade">
	  <div class = "post-box">
                  <div class ="inside">
                     <div>
                       <img style= "display: block;margin-left: auto; margin-right: auto;" src= <?php echo  plugins_url('images/logo.png', __FILE__) ?> />
                       <div class="company-links" style="text-align: center; margin-top:20px;margin-bottom:20px">
                         <a  style="margin:20px; font-size: 30px;" target = "_blank" href ="http://sjinnovation.com"><i class="fa fa-external-link"></i></a>
                         <a style="margin:20px; font-size: 30px;"  target = "_blank" href ="https://www.facebook.com/sjinnovation?fref=ts"><i class="fa fa-facebook" aria-hidden="true"></i></i></a>
                         <a  style="margin:20px; font-size: 30px;" target = "_blank"  href ="https://in.linkedin.com/company/sj-innovation"><i class="fa fa-linkedin" aria-hidden="true"></i></i></a>
                         <a  style="margin:20px; font-size: 30px;"  target = "_blank" href ="https://twitter.com/sjinnovation"><i class="fa fa-twitter" aria-hidden="true"></i></i></a>
                         <a  style="margin:20px; font-size: 30px;" target = "_blank" href ="https://www.instagram.com/sj_innovation/"><i class="fa fa-instagram" aria-hidden="true"></i></i></a>
                         <a  style="margin:20px; font-size: 30px;"  target = "_blank" href ="https://plus.google.com/u/0/+Sjinnovation/posts"><i style="font-size: 40px;" class="fa fa-google-plus" aria-hidden="true"></i></i></a>
                        </div>
                        <div><h3>Developed by: </h3></div> 
                        <p> SJ INNOVATION LLC</p>   
                     </div>
                  </div>
              </div>
    </div>
  </div>
</div> 
	<?php
}


//adding testimonial page settings values  and registering this as pageoption
add_action( 'admin_init', 'sji_testimonial_settings_init' );
function sji_testimonial_settings_init() {
    register_setting( 'testimonialsettings', 'sji_testimonial_settings' );
    add_settings_section(
        'testimoniall_pluginPage_section', 
        __( 'Testimonial Settings Page', 'testimonial' ), 
        'sji_testimonial_settings_section_callback', 
        'pluginPage'
    );
}

function sji_testimonial_settings(){ 
     ?>
    <h2>Testimonial Settings Page</h2>
    <b>INFORMATION: </b><br>
    [sji_testimonial_form_] - Paste this Shortcode to display testimonial form in the frontend<br>
    [sji-testimonial-basic] - Paste this Shortcode to display testimonial carousel <br>
    <br>
    <br>
    
    <form action='options.php' method='post'>
    <?php
        settings_fields( 'testimonialsettings' );
        do_settings_sections( 'testimonialsettings' );
        
        $options = get_option( 'sji_testimonial_settings' );
        $checked;
        if(!empty($options['testimonial_text_checkbox_0']))
            {
                $checked= $options['testimonial_text_checkbox_0'];
                  if($options['testimonial_text_checkbox_0']=='1')
                    {
                        $checked = 'checked'; 
                    }
                
            }

        $selectedValue= $options['testimonial_dropdown_field_1'];
    ?>
	
        <div class="checkbox">
            <label>
                <input type="checkbox" name="sji_testimonial_settings[testimonial_text_checkbox_0]" value="1" <?php echo $checked; ?>> <b>If Ticked the testimonials submitted will be auto approved and displayed in frontend.</b><br>
            </label>
        </div>
        <br>
        <div class="select">                  
            <select  name="sji_testimonial_settings[testimonial_dropdown_field_1]">
                <option value="" <?php if($selectedValue==''){ echo "selected"; } ?> >Select One</option>
                <option value="Random" <?php if($selectedValue=="Random"){ echo "selected"; } ?> >Random</option>
                <option value="Newest First" <?php if($selectedValue=="Newest First"){ echo "selected"; } ?>  >Newest First</option>
                <option value="Newest Last" <?php if($selectedValue=="Newest Last"){ echo "selected"; }  ?>  >Newest Last</option>
            </select>  
            Default will be random.             
        </div>                
    <?php  submit_button(); ?>
    </form>  
    <?php
}



//registering shortcode testimonial form
function sji_testimonial_form__code() {
    echo '<h2>Submit Your Testimonial</h2>';
    echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post" enctype="multipart/form-data" onsubmit="document.getElementById(\'myButton\').disabled=true; document.getElementById(\'myButton\').value=\'Submitting, please wait...\';">';
    echo '<p>';
    echo 'Your Name (required) <br />';
    echo '<input type="text" name="sji-testimonial-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["sji-testimonial-name"] ) ? esc_attr( $_POST["sji-testimonial-name"] ) : '' ) . '" size="40" />';
   
    echo '</p>';
    echo '<p>';
    echo 'Your Email (required) <br />';
    echo '<input type="email" name="sji-testimonial-email" value="' . ( isset( $_POST["sji-testimonial-email"] ) ? sanitize_email( $_POST["sji-testimonial-email"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Company Name (required) <br />';
    echo '<input type="text" name="sji-testimonial-company" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["sji-testimonial-company"] ) ? esc_attr( $_POST["sji-testimonial-company"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Website URL <br />';
    echo '<input type="url" name="sji-testimonial-url"  value="' . ( isset( $_POST["sji-testimonial-url"] ) ? esc_url( $_POST["sji-testimonial-url"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Write your testimonial (required) <br />';
    echo '<textarea rows="7" cols="30" name="sji-testimonial-message">' . ( isset( $_POST["sji-testimonial-message"] ) ? esc_textarea( $_POST["sji-testimonial-message"] ) : '' ) . '</textarea>';
    echo '</p>';
    echo '<p>';
    echo 'Attach your profile pic (preferred jpg file format) <br />';
    echo '<input type="file" name="sji-testimonial-profile-img"  value="" size="40"  accept="image/jpg, image/jpeg,image/jpg, image/png" data-max-size="5242880"/>';
    echo '</p>';
    echo '<p><input type="submit" name="sji-testimonial-submitted" value="Send" id="myButton" /></p>';
    echo '</form>';
   /*  if (empty($_POST['sji-testimonial-name']){
        return false;
    }
    if (preg_match('[a-zA-Z ]+', $_POST['sji-testimonial-name'])){

    }*/
}

function sji_save_testimonial() {

    // if the submit button is clicked, send the email
    if (trim($_POST['sji-testimonial-name'])!='' && trim($_POST['sji-testimonial-email'])!=''&&trim($_POST['sji-testimonial-company'])!=''&&trim($_POST['sji-testimonial-url'])!=''&&trim($_POST['sji-testimonial-message'])!='' ) 
    {


        // sanitize form values
        $name    = sanitize_text_field( $_POST["sji-testimonial-name"] );
        $email   = sanitize_email( $_POST["sji-testimonial-email"] );
        $company = sanitize_text_field( $_POST["sji-testimonial-company"] );
        $url = sanitize_text_field( $_POST["sji-testimonial-url"] );
        esc_url($url);
        $message = esc_textarea( $_POST["sji-testimonial-message"] );

        global $user_ID;

        $options = get_option( 'sji_testimonial_settings' );
        $status = 'pending'; 
        if(!empty($options['testimonial_text_checkbox_0']))
            {
                $checked= $options['testimonial_text_checkbox_0'];
                  if($options['testimonial_text_checkbox_0']=='1')
                    {
                        $status = 'publish'; 
                    }
                
            }

        $create_testimonial_record = array(
        'post_author' => $user_ID,
        'post_content' => '',
        'post_content_filtered' => '',
        'post_title' => $name,
        'post_excerpt' => $message,
        'post_status' => $status,
        'post_type' => 'testimonial',
        'comment_status' => 'closed',
        'ping_status' => 'closed',       
        'post_parent' => 0,
        'menu_order' => 0,
        'guid' => ''
        );
        $testimonial_id = wp_insert_post($create_testimonial_record);

        update_post_meta( $testimonial_id, 'sji_testimonial_email', $email );
        update_post_meta( $testimonial_id, 'sji_testimonial_company', $company );
        update_post_meta( $testimonial_id, 'sji_testimonial_url', $url );

        // $filename should be the path to a file in the upload directory.
        if($_FILES['sji-testimonial-profile-img']['name']!='')
        {

             $filename =  date("Y"). '/'.date("m"). '/' .$_FILES['sji-testimonial-profile-img']['name'];
         
            // The ID of the post this attachment is for.
            $parent_post_id = $testimonial_id;
             
            // Check the type of file. We'll use this as the 'post_mime_type'.
            $filetype = wp_check_filetype( basename( $filename ), null );
             
            // Get the path to the upload directory.
            $wp_upload_dir = wp_upload_dir();
            
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            $overrides = array(
                // tells WordPress to not look for the POST form
                // fields that would normally be present, default is true,
                // we downloaded the file from a remote server, so there
                // will be no form fields
                'test_form' => false,

                // setting this to false lets WordPress allow empty files, not recommended
                'test_size' => true,

                // A properly uploaded file will pass this test. 
                // There should be no reason to override this one.
                'test_upload' => true, 
            );

            $file_return = wp_handle_sideload( $_FILES['sji-testimonial-profile-img'], $overrides );

            //return error if there is one
            if ( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
                echo '<span style="color:red;">Sorry there were some errors uploading your file!</span>';

            } else {  
                    // Prepare an array of post data for the attachment.
                    $attachment = array(
                        'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                        'post_mime_type' => $filetype['type'],
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                    );

                   
                     
                    // Insert the attachment.
                    $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
                     
                    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                     
                    // Generate the metadata for the attachment, and update the database record.
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
                    wp_update_attachment_metadata( $attach_id, $attach_data );
                    set_post_thumbnail( $parent_post_id, $attach_id );
                    wp_get_attachment_url( $parent_post_id );
                    add_image_size( 'thumbnail_size', 150, 150, array( 'left', 'top' ) );
                    add_image_size( 'medium-size', 300, 300, array( 'left', 'top' ) );
                    add_image_size( 'lasrge-size', 1024, 1024, array( 'left', 'top' ) );
                  
            }
		}
       
         echo '<span style="color:green;">Thank You for submission!</span>';
            unset($_POST);
    }
    elseif (!empty($_POST)) {
        echo '<span style="color:red;">Please enter required fields!</span>';
    }
    
}

function sji_testimonial_form_shortcode() {
    ob_start();
    sji_save_testimonial();
    sji_testimonial_form__code();
    return ob_get_clean();
}
 
function sji_testimonial_form_() {
    add_shortcode( 'sji_testimonial_form_', 'sji_testimonial_form_shortcode' );
}

add_action( 'init', 'sji_testimonial_form_' );


/* edit/ add meta boxes fields form adminsection */
add_action( 'add_meta_boxes', 'sji_add_testimonial_metaboxes' ); // registration action for meta fields

// Add the Testimonial Meta Boxes
function sji_add_testimonial_metaboxes() {
    add_meta_box('sji_testimonial_email', 'Email', 'sji_testimonial_email', 'testimonial', 'side', 'default');
    add_meta_box('sji_testimonial_company', 'Company', 'sji_testimonial_company', 'testimonial', 'side', 'default');
    add_meta_box('sji_testimonial_url', 'Website URL', 'sji_testimonial_url', 'testimonial', 'side', 'default');

}

// The Testimonial Email/ COmpany / Location Metabox as html on admin right hand side
function sji_testimonial_email() {
    global $post;
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="testimonialmeta_noncename" id="testimonialmeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    // Get the location data if its already been entered
    $testimonial_email = get_post_meta($post->ID, 'sji_testimonial_email', true);    
    // Echo out the field
    echo '<input type="text" name="sji_testimonial_email" value="' . $testimonial_email  . '" class="widefat" />';
}

function sji_testimonial_company() {
    global $post;    
    echo '<input type="hidden" name="testimonialmeta_noncename2" id="testimonialmeta_noncename2" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    $testimonial_company = get_post_meta($post->ID, 'sji_testimonial_company', true);
    echo '<input type="text" name="sji_testimonial_company" value="' . $testimonial_company  . '" class="widefat" />';
}

function sji_testimonial_url() {
    global $post;
    echo '<input type="hidden" name="testimonialmeta_noncename3" id="testimonialmeta_noncename3" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    $testimonial_url = get_post_meta($post->ID, 'sji_testimonial_url', true);
    echo '<input type="text" name="sji_testimonial_url" value="' . $testimonial_url  . '" class="widefat" />';
}

/* below post submitting values to save  start */
// Save the Metabox Data
function sji_testimonial_save_meta($post_id, $post) {    
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['testimonialmeta_noncename'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }

    if ( !wp_verify_nonce( $_POST['testimonialmeta_noncename2'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }

    if ( !wp_verify_nonce( $_POST['testimonialmeta_noncename3'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }


    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.
    
    $events_meta['sji_testimonial_email'] = sanitize_email($_POST['sji_testimonial_email']);
    update_post_meta( $post->ID, 'sji_testimonial_email', $events_meta['sji_testimonial_email'] );
    esc_url($events_meta['sji_testimonial_email']);
   
    $events_meta['sji_testimonial_company'] = sanitize_text_field($_POST['sji_testimonial_company']);
    update_post_meta( $post->ID, 'sji_testimonial_company', $events_meta['sji_testimonial_company'] );
    esc_url( $events_meta['sji_testimonial_company']);
   
    $events_meta['sji_testimonial_url'] = sanitize_text_field($_POST['sji_testimonial_url']);
    update_post_meta( $post->ID, 'sji_testimonial_url', $events_meta['sji_testimonial_url'] );
    esc_url($events_meta['sji_testimonial_url']);
    
    // Add values of $events_meta as custom fields
    
    foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }

}

add_action('save_post', 'sji_testimonial_save_meta', 1, 2); // save the custom fields
/* below post submitting values to save  end */


/* display owl slider for testimonial */
function tp_function_($type='tp_function_') {
    

    //you will notice the jquery file is commented. its obvious we have alredy in defualt WP jquery file.
    //wp_register_script('ts_js-script', plugins_url('sji-testimonial/js/jquery-3.1.0.min.js',false ));
    $owl_min_js = plugins_url('js/owl.carousel.min.js' , __FILE__);
    $owl_js = plugins_url('js/owlscript.js' , __FILE__);
    wp_register_script('ts_owl-script', $owl_min_js ,false );
    wp_register_script('ts_script', $owl_js, false );
 
    // enqueue
    //wp_enqueue_script('ts_js-script');
    wp_enqueue_script('ts_owl-script');
    wp_enqueue_script('ts_script');

    $owl_css = plugins_url('css/owl.carousel.css', __FILE__); 
    $custom_css = plugins_url('css/testimonial-custom.css', __FILE__); 
    wp_register_style('tp_styles', $owl_css ,false );
    wp_register_style('tp_custom-styles', $custom_css ,false );
    
    // enqueue
    wp_enqueue_style('tp_styles');
    wp_enqueue_style('tp_custom-styles');


    // content generation start below
    $result = '<div id="sji-testimonial-slider" class="owl-carousel">';
        $options = get_option( 'sji_testimonial_settings' );
        if($options['testimonial_dropdown_field_1']=='Newest First') {
            $field ='ID';
            $order = 'DESC';  
        }
        elseif($options['testimonial_dropdown_field_1']=='Newest Last'){
             $order = 'ASC';
              $field ='ID';
        }else{
            $order = '';
             $field ='rand';
        }       

        $args = array(
            'post_type' => 'testimonial',
            'post_status' => 'publish',
            'posts_per_page' => 20,
            'order'  => $order, 
            'orderby' => $field,
            
        );
    //the loop
    $loop = new WP_Query($args);
    plugins_url('css/testimonial-default.png', __FILE__ );;

    $i=0;
    while ($loop->have_posts()) {

        $loop->the_post();
        $testimonial_url = get_post_meta($loop->posts[$i]->ID, 'sji_testimonial_url', true);
        $testimonial_email = get_post_meta($loop->posts[$i]->ID, 'sji_testimonial_email', true);
        $testimonial_company = get_post_meta($loop->posts[$i]->ID, 'sji_testimonial_company', true);

        $the_url = wp_get_attachment_image_src(get_post_thumbnail_id($loop->posts[$i]->ID), $type,'icon');
        
        if(trim($the_url[0])=='')
        {            
             $the_url[0] = plugins_url('sji-testimonial/css/testimonial-default.png', __FILE__ );
        }

        $result .='
                <div>
                    <div class="sj-testimonial-clientimg"><img title="'.get_the_title().'" src="' . $the_url[0] . '" data-thumb="' . $the_url[0] . '" alt=""/></div>
                    <div class="sj-testimonial-clientname">'.get_the_title().'</div>
                    <div class="sj-testimonial-description">'.get_the_excerpt().'</div>
                    <div class="sj-testimonial-company">'.$testimonial_company.'</div>
                    <div class="sj-testimonial-email">'.$testimonial_email.'</div>
                    <div class="sj-testimonial-websiteurl">'.$testimonial_url.'</div>
               </div>';

               $i++;
    }
    $result .= '</div>';

    return $result;
}

add_shortcode('sji-testimonial-basic', 'tp_function_');


