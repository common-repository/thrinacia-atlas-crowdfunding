<?php
class ThrinaciaAtlasCrowdfundingSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'thrinacia_atlas_crowdfunding_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'thrinacia_atlas_crowdfunding_page_init' ) );
    }

    /**
     * Add options page
     */
    public function thrinacia_atlas_crowdfunding_add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin',
            'Thrinacia Atlas',
            'manage_options',
            'thrinacia-setting-admin',
            array( $this, 'thrinacia_atlas_crowdfunding_create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function thrinacia_atlas_crowdfunding_create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'thrinacia_atlas_crowdfunding_options' );
        ?>
        <div class="wrap">
            <h1>Thrinacia Atlas Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields('thrinacia_atlas_crowdfunding_option_group');
                do_settings_sections( 'thrinacia-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function thrinacia_atlas_crowdfunding_page_init()
    {
        register_setting(
            'thrinacia_atlas_crowdfunding_option_group', // Option group
            'thrinacia_atlas_crowdfunding_options'   // Option name
        );

        add_settings_section(
            'thrinacia_atlas_crowdfunding_section_id', // ID
            '', // Title
            array( $this, 'thrinacia_atlas_crowdfunding_info' ), // Callback
            'thrinacia-setting-admin' // Page
        );

        add_settings_field(
            'thrinacia_atlas_crowdfunding_path',
            'Path',
            array( $this, 'thrinacia_atlas_crowdfunding_path_callback' ),
            'thrinacia-setting-admin',
            'thrinacia_atlas_crowdfunding_section_id'
        );

        add_settings_field(
            'thrinacia_atlas_crowdfunding_path_id',
            'Path Id',
            'thrinacia-setting-admin',
            'thrinacia_atlas_crowdfunding_section_id'
        );
        add_settings_section(
            'thrinacia_atlas_crowdfunding_url', // ID
            '', // Title
            array( $this, 'thrinacia_atlas_crowdfunding_url' ), // Callback
            'thrinacia-setting-admin' // Page
        );
    }

    /**
     * Print the Section text
     */
    public function thrinacia_atlas_crowdfunding_info()
    {
        print 'Enter the path where Thrinacia Atlas will be located. Follow the instruction here: <a href="https://www.thrinacia.com/blog/post/setting-up-the-thrinacia-atlas-wordpress-plugin">https://www.thrinacia.com/blog/post/setting-up-the-thrinacia-atlas-wordpress-plugin</a> for a more detailed explanation or if you run into any problems.';
    }

    /**
     * Print the Section text
     */
    public function thrinacia_atlas_crowdfunding_url()
    {
        if(!empty($this->options['thrinacia_atlas_crowdfunding_path'])){
          $thrinacia_link = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/" .$this->options['thrinacia_atlas_crowdfunding_path'];
          print 'Link to your Thrinacia Atlas path: <a href="'.$thrinacia_link.'">' . $thrinacia_link . '</a>';
        }
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function thrinacia_atlas_crowdfunding_path_callback()
    {
        printf(
            '<input type="text" id="thrinacia_atlas_crowdfunding_path" name="thrinacia_atlas_crowdfunding_options[thrinacia_atlas_crowdfunding_path]" value="%s" />',
            isset( $this->options['thrinacia_atlas_crowdfunding_path'] ) ? esc_attr( $this->options['thrinacia_atlas_crowdfunding_path']) : ''
        );
    }
}

//Checks to see if the permalink already exists
function thrinacia_atlas_crowdfunding_check_permalink($path){
  $page = get_page_by_path('/' . $path);
  if(!$page){
      return true;
  } else{
      return false;
  }
}

//Creates a thrinacia page and system links it
function thrinacia_atlas_crowdfunding_create_page($old_value, $value){
  $main_page = array(
        'post_type' => 'page',
        'post_name' => $value["thrinacia_atlas_crowdfunding_path"],
        'post_title' => $value["thrinacia_atlas_crowdfunding_path"],
        'post_status' => 'publish',
  );
  $thrinacia_page_id = wp_insert_post($main_page);
  if(!empty($old_value["thrinacia_atlas_crowdfunding_path"])){
    unlink(ABSPATH . $old_value["thrinacia_atlas_crowdfunding_path"]);
  }

  $symlink = symlink(__DIR__ . '/angular', ABSPATH . $value["thrinacia_atlas_crowdfunding_path"]);
  if(!$symlink){
    add_settings_error('invalid-symlink','','System link failed. Please follow instructions here: <a href="https://www.thrinacia.com/blog/post/setting-up-the-thrinacia-atlas-wordpress-plugin">https://www.thrinacia.com/blog/post/setting-up-the-thrinacia-atlas-wordpress-plugin</a>','error');
  }
  $update_array['thrinacia_atlas_crowdfunding_path'] = $value["thrinacia_atlas_crowdfunding_path"];
  $update_array['thrinacia_atlas_crowdfunding_path_id'] = $thrinacia_page_id;
  update_option( 'thrinacia_atlas_crowdfunding_options', $update_array );

  //Updates page to correct template
  update_post_meta( $thrinacia_page_id, '_wp_page_template', 'angular/index.php' );
  add_rewrite_rule($value["thrinacia_atlas_crowdfunding_path"].'/(.*)?', 'index.php?page_id='.$thrinacia_page_id, 'top');
  flush_rewrite_rules();
}

//When the path option is updated try to create page and permalink
add_action('update_option_thrinacia_atlas_crowdfunding_options', function( $old_value, $value ) {
  if(empty($value["thrinacia_atlas_crowdfunding_path_id"])){
    if(empty($old_value["thrinacia_atlas_crowdfunding_path"])){
      if(!empty($value["thrinacia_atlas_crowdfunding_path"])){
        if($value["thrinacia_atlas_crowdfunding_path"] != $old_value["thrinacia_atlas_crowdfunding_path"]){
          $path_avaliable = thrinacia_atlas_crowdfunding_check_permalink($value["thrinacia_atlas_crowdfunding_path"]);
          if($path_avaliable){
            //Creates thrinacia page
          	thrinacia_atlas_crowdfunding_create_page($old_value, $value);
          }else{
            add_settings_error('invalid-path','','That path is already taken. Please choose a different one or adjust your previous paths.','error');
            $update_array['thrinacia_atlas_crowdfunding_path_id'] = "";
            update_option('thrinacia_atlas_crowdfunding_options', $update_array);
          }
        }
      }
    }else{
      if(!empty($value["thrinacia_atlas_crowdfunding_path"])){
        if($value["thrinacia_atlas_crowdfunding_path"] != $old_value["thrinacia_atlas_crowdfunding_path"]){
          $path_avaliable = thrinacia_atlas_crowdfunding_check_permalink($value["thrinacia_atlas_crowdfunding_path"]);
          if($path_avaliable){
            //Creates thrinacia page
            wp_delete_post($old_value["thrinacia_atlas_crowdfunding_path_id"]);
            thrinacia_atlas_crowdfunding_create_page($old_value, $value);
          }else{
            add_settings_error('invalid-path','','That path is already taken. Please choose a different one or adjust your previous paths.','error');
            wp_delete_post($old_value["thrinacia_atlas_crowdfunding_path_id"]);
            $update_array['thrinacia_atlas_crowdfunding_path_id'] = "";
            update_option( 'thrinacia_atlas_crowdfunding_options', $update_array );
          }
        }
      }else{
        wp_delete_post($old_value["thrinacia_atlas_crowdfunding_path_id"]);
        unlink(ABSPATH . $old_value["thrinacia_atlas_crowdfunding_path"]);
        $update_array['thrinacia_atlas_crowdfunding_path_id'] = "";
        update_option( 'thrinacia_atlas_crowdfunding_options', $update_array );
      }
    }
  }
}, 10, 2);

//When the path option is added try to create page and permalink
add_action('add_option_thrinacia_atlas_crowdfunding_options', function( $option_name, $option_value ) {
  if(!empty($option_value["thrinacia_atlas_crowdfunding_path"])){
    $path_avaliable = thrinacia_atlas_crowdfunding_check_permalink($option_value["thrinacia_atlas_crowdfunding_path"]);
    if($path_avaliable){
      //Creates thrinacia page
    	thrinacia_atlas_crowdfunding_create_page('', $option_value);
    }else{
      add_settings_error('invalid-path','','That path is already taken. Please choose a different one or adjust your previous paths.','error');
      $update_array['thrinacia_atlas_crowdfunding_path_id'] = "";
      update_option( 'thrinacia_atlas_crowdfunding_options', $update_array );
    }
  }
}, 10, 2);

//Adds a rewrite rule for thrinacia
add_action( 'init' , 'thrinacia_atlas_crowdfunding_add_rewrite_rule', 10, 2 );
function thrinacia_atlas_crowdfunding_add_rewrite_rule( ) {
  $thrinacia_options = get_option( 'thrinacia_atlas_crowdfunding_options' );
  $post_id = url_to_postid('/' . $thrinacia_options["thrinacia_atlas_crowdfunding_path"]);
  if (!$post_id) {
    $post_id = url_to_postid('/index.php/' . $thrinacia_options["thrinacia_atlas_crowdfunding_path"]);
  }
  if (!$post_id) {
    $post_id = url_to_postid('/?p=' . $thrinacia_options["thrinacia_atlas_crowdfunding_path"]);
  }
  if ($post_id) {
    add_rewrite_rule($thrinacia_options["thrinacia_atlas_crowdfunding_path"].'/(.*)?', 'index.php?page_id='.$post_id, 'top');
  }
  else if(!empty($thrinacia_options["thrinacia_atlas_crowdfunding_path"]) && !empty($thrinacia_options["thrinacia_atlas_crowdfunding_path_id"])){
    add_rewrite_rule($thrinacia_options["thrinacia_atlas_crowdfunding_path"].'/(.*)?', 'index.php?page_id='.$thrinacia_options["thrinacia_atlas_crowdfunding_path_id"], 'top');
  }
}

//Adds setting if the user is admin
if( is_admin() )
    $thrinacia_atlas_crowdfunding_settings_page = new ThrinaciaAtlasCrowdfundingSettingsPage();
