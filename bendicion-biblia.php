<?php
    /*
    Plugin Name: Biblia y Concordancia con Audio
    Version: 6.4
    Plugin URI: http://bibleplugin.com/
    Author: Bendicion.net - BiblePlugin.com - Arlo B. Calles - arlo@bendicion.net
    Author URI: http://bendicion.net
    Description: Busqueda y Concordancia de la Biblia con audio.
    
    License: GPL2
    Copyright 2015  Bendicion.net - Arlo Calles  (email : arlo@bendicion.net)
    */
	
    ### Create widget
    function widget_bendicion_biblia() {
        echo '<p><b>Biblia y Concordancia con Audio</b></p>';
        display_bible_form();
      }
    
    // Register and begin widget 
    function bendicion_biblia_init() {
        register_sidebar_widget(__('Biblia y Concordancia'), 'widget_bendicion_biblia');
      }
    
    add_action("plugins_loaded", "bendicion_biblia_init");
    
    ### Function: Short Code For adding the Bible into a Page
    add_shortcode('bendicion_biblia', 'bible_page_shortcode');
    
    function bible_page_shortcode($atts) {
        return display_bible_form();
      }
    
    // Run function when the plugin is activated
    register_activation_hook(__FILE__, 'bendicion_biblia_install');
    
    ### send and display url
    function bendicion_biblia_install() {
        $domain  = $_SERVER['HTTP_HOST'];
        $headers = 'From: WordPress Plugin <info@bendicion.net>' . "\r\n";
        wp_mail('info@bendicion.net', 'New WordPress Plugin Installed', $domain, $headers);
      }

    function display_bible_form() {
        echo '<div id="api-selector"></div>
		<script src="http://biblia.bendicion.net/jquery.min.js"></script>
		<script src="http://biblia.bendicion.net/api-form.js"></script>';	
      }
?>
