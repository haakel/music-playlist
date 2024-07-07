<?php
/*
Plugin Name: music palylist
Description: پلاگین ساخت پلی لیست
Author: haakel
*/

if ( ! defined( 'ABSPATH' ) ) {
    echo "what the hell are you doing here?";
	exit;
	}
	
	class music_playlist{
  	/**
	 * Initiator
	 *
	 * @return object Initialized object of class.
     * 
	 */
    private static $instance;

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

    public function __construct(){
        $this->define_constants();
		$this->music_playlist_loader();
        add_action('wp_enqueue_scripts', array($this, 'my_music_plugin_enqueue_scripts'));
    }

    function my_music_plugin_enqueue_scripts() {

        wp_enqueue_style('my-music-plugin-style', MUSIC_PLAYLIST_ASSETS_URL . 'css/style_music_playlist.css');
        wp_enqueue_script('my-music-plugin-script', MUSIC_PLAYLIST_ASSETS_URL . 'js/script.js', array('jquery'), null, true);
    }

    /**
     * Define all constants
     */
    public function define_constants() {
            define( 'MUSIC_PLAYLIST_VERSION', '1.0.0' );
            define( 'MUSIC_PLAYLIST_FILE', __FILE__ );
            define('MUSIC_PLAYLIST_URL', plugin_dir_url(MUSIC_PLAYLIST_FILE));
            define('MUSIC_PLAYLIST_PATH', plugin_dir_path(MUSIC_PLAYLIST_FILE));
            define( 'MUSIC_PLAYLIST_BASE', plugin_basename( MUSIC_PLAYLIST_FILE ) );
            define( 'MUSIC_PLAYLIST_SLUG', 'music-playlist-settings' );     
            define( 'MUSIC_PLAYLIST_SETTINGS_LINK', admin_url( 'admin.php?page=' . MUSIC_PLAYLIST_SLUG ) );
            define( 'MUSIC_PLAYLIST_CLASSES_PATH', MUSIC_PLAYLIST_PATH . 'classes/' );
            define( 'MUSIC_PLAYLIST_IMAGES', MUSIC_PLAYLIST_PATH . 'build/images' );
            define( 'MUSIC_PLAYLIST_TEMPLATES_PATH', MUSIC_PLAYLIST_PATH . 'templates/' );
            define('MUSIC_PLAYLIST_ASSETS_URL', MUSIC_PLAYLIST_URL . 'assets/');
            
    }
    
	/**
	 * Require loader music playlist class.
	 *
	 * @return void
	 */
    public function music_playlist_loader() {
		require MUSIC_PLAYLIST_CLASSES_PATH .'class_music_playlist_loader.php';
	}

}

music_playlist::get_instance();