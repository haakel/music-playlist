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
        add_action('wp_ajax_add_playlist', array($this, 'add_playlist'));
        add_action('wp_ajax_delete_playlist', array($this, 'delete_playlist'));
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
        register_setting('music_playlist_group', 'music_playlist_names', array(
            'default' => array('All Songs')
        ));
    }

    public function admin_index() {
        require_once MUSIC_PLAYLIST_TEMPLATES_PATH . "admin_page_main.php";
    }

    public function enqueue_admin_scripts($hook) {
        if ($hook == 'toplevel_page_music_playlist' || $hook == 'music-playlist_page_all_playlists') {
            wp_enqueue_style('music-playlist-admin-styles', MUSIC_PLAYLIST_ASSETS_URL. 'css/styles.css');
            wp_enqueue_style('audio-diary-toast-style', MUSIC_PLAYLIST_ASSETS_URL . 'css/jquery.toast.css');
            wp_enqueue_script('audio-diary-toast-style', MUSIC_PLAYLIST_ASSETS_URL . 'js/jquery.toast.js');
            wp_enqueue_script('music-playlist-admin-scripts', MUSIC_PLAYLIST_ASSETS_URL. 'js/script.js', array('jquery'), null, true);
            wp_localize_script('music-playlist-admin-scripts', 'musicPlaylist', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'security' => wp_create_nonce('add_playlist_nonce')
            ));
            add_action('wp_ajax_delete_playlist', array($this, 'delete_playlist'));
        }
    }
    
    public function add_playlist() {
        check_ajax_referer('add_playlist_nonce', 'security');
        $playlist_name = sanitize_text_field($_POST['playlist_name']);
        if (!empty($playlist_name)) {
            $playlists = get_option('music_playlist_names', array('All Songs'));
            if (!in_array($playlist_name, $playlists)) {
                $playlists[] = $playlist_name;
                update_option('music_playlist_names', $playlists);
            }
        }
        wp_send_json_success($playlists);
    }
    
    public function delete_playlist() {
        check_ajax_referer('add_playlist_nonce', 'security');
        $playlist_name = sanitize_text_field($_POST['playlist_name']);
        if (!empty($playlist_name)) {
            $playlists = get_option('music_playlist_names', array('All Songs'));
            if (($key = array_search($playlist_name, $playlists)) !== false) {
                unset($playlists[$key]);
                update_option('music_playlist_names', $playlists);
            }
        }
        wp_send_json_success($playlists);
    }
}

Music_Playlist_Admin_Page::get_instance();