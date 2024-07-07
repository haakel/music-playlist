<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class Music_Playlist_Admin_Page {
    
    private static $instance;

    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_pages'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    public function add_admin_pages() {
        add_menu_page(
            'Music Playlist',
            'Music Playlist',
            'manage_options',
            'music_playlist',
            array($this, 'admin_index'),
            'dashicons-playlist-audio',
            110
        );
    }

    public function register_settings() {
        register_setting('music_playlist_group', 'music_playlist_name');
    }

    public function admin_index() {
        require_once MUSIC_PLAYLIST_TEMPLATES_PATH . "admin_page_main.php";
    }

    public function enqueue_admin_scripts($hook) {
        if ($hook == 'toplevel_page_music_playlist' || $hook == 'music-playlist_page_all_playlists') {
            wp_enqueue_style('music-playlist-admin-styles', MUSIC_PLAYLIST_ASSETS_URL. 'css/styles.css');
            wp_enqueue_script('music-playlist-admin-scripts', MUSIC_PLAYLIST_ASSETS_URL. 'js/script.js', array('jquery'), null, true);
        }
    }

    

}

Music_Playlist_Admin_Page::get_instance();