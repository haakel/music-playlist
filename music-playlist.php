<?php
/*
Plugin Name: Audio diary
Description: پلاگین دفترچه خاطرات.
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
    }
    /**
     * Define all constants
     */
    public function define_constants() {
        define( 'MUSIC_PLAYLIST_VERSION', '1.0.0' );

            define( 'MUSIC_PLAYLIST_FILE', __FILE__ );


            define( 'MUSIC_PLAYLIST_PATH', plugin_dir_path( MUSIC_PLAYLIST_FILE ) );


            define( 'MUSIC_PLAYLIST_BASE', plugin_basename( MUSIC_PLAYLIST_FILE ) );


            define( 'MUSIC_PLAYLIST_SLUG', 'audio-diary-settings' );

            define( 'MUSIC_PLAYLIST_SETTINGS_LINK', admin_url( 'admin.php?page=' . MUSIC_PLAYLIST_SLUG ) );
            define( 'MUSIC_PLAYLIST_CLASSES_PATH', MUSIC_PLAYLIST_PATH . 'classes/' );
            define( 'MUSIC_PLAYLIST_IMAGES', MUSIC_PLAYLIST_PATH . 'build/images' );
            define( 'MUSIC_PLAYLIST_MODULES_PATH', MUSIC_PLAYLIST_PATH . 'modules/' );
            define( 'MUSIC_PLAYLIST_ASSETS_PATH', MUSIC_PLAYLIST_PATH . 'assets/' );
            define( 'MUSIC_PLAYLIST_URL', plugins_url( '/', MUSIC_PLAYLIST_FILE ) );
    }
	/**
	 * Require loader music playlist class.
	 *
	 * @return void
	 */
    public function music_playlist_loader() {
		require music_playlist_CLASSES_PATH .'class_music_playlist_loader.php';
	}
}

music_playlist::get_instance();