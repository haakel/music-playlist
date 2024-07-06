<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Music_Playlist_Admin_Page {
    
/**
     * Instance
     *
     * @access private
     * @var object Class object.
     * @since 1.0.0
     */
    private static $instance;

    /**
     * Initiator
     *
     * @return object Initialized object of class.
     * @since 1.0.0
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_pages'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('wp_ajax_add_playlist', array($this, 'add_playlist'));
        add_action('wp_ajax_add_music_to_playlist', array($this, 'add_music_to_playlist'));
        add_action('wp_ajax_fetch_playlists', array($this, 'fetch_playlists'));
        add_action('wp_ajax_fetch_playlist_songs', array($this, 'fetch_playlist_songs'));

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
        add_submenu_page(
            'music_playlist',
            'All Playlists',
            'All Playlists',
            'manage_options',
            'all_playlists',
            array($this, 'all_playlists_page')
        );
    }

    public function register_settings() {
        register_setting('music_playlist_group', 'music_playlist_name');
    }

    public function admin_index() {
        require_once plugin_dir_path(__FILE__) . '../templates/admin.php';
    }

    public function all_playlists_page() {
        require_once plugin_dir_path(__FILE__) . '../templates/all_playlists.php';
    }

    


    



    
}
Music_Playlist_Admin_Page::get_instance();