<?php
/*
Plugin Name: Thrinacia Atlas CrowdFunding
Description: Thrinacia Atlas WordPress CrowdFunding Plugin enables you to run/operate your own CrowdFunding website similar to IndieGoGo or Kickstarter. Once enabled plugin can be configured to listen on any website path e.g. "/crowdfunding". Plugin brings full functionality of Thrinacia Atlas into WordPress and allows you to configure your WordPress website with designated CrowdFunding area. Active Thrinacia Atlas Plan is required for operation of plugin. For more information about Thrinacia Atlas and how it can be used to create CrowdFunding portal please refer to https://www.thrinacia.com/atlas
Version: 1.1.58
Author: Thrinacia
Author URI: https://www.thrinacia.com/
*/

define( 'THRINACIA_ATLAS_CROWDFUNDING_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'THRINACIA_ATLAS_CROWDFUNDING_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

//Sets up the template for the page to use
require_once( THRINACIA_ATLAS_CROWDFUNDING_PLUGIN_DIR . 'class.thrinacia-atlas-crowdfunding-template.php' );

//Sets up the settings page
require_once( THRINACIA_ATLAS_CROWDFUNDING_PLUGIN_DIR . 'thrinacia-atlas-crowdfunding-settings.php' );
