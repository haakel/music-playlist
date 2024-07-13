<div class="music-playlist-container">
    <h1 class="music-playlist-title">Music Playlist</h1>
    <button class="music-playlist-add-btn">+</button>
    <div class="music-playlist-add-form" id="musicPlaylistAddForm">
        <input type="text" id="musicPlaylistName" placeholder="Enter playlist name">
        <button class="music-playlist-submit-btn" id="musicPlaylistSubmit">Add Playlist</button>
    </div>
    <ul class="music-playlist-list" id="musicPlaylist">
        <?php
        $playlists = get_option('music_playlist_names', array('All Songs'));
        foreach ($playlists as $playlist) {
            echo '<li>' . esc_html($playlist) . ' <button class="music-playlist-delete-btn" data-playlist="' . esc_attr($playlist) . '">Delete</button></li>';
        }
        ?>
    </ul>
</div>
<div id="songsContainer" style="display: none;">
    <h2>Songs in <span id="playlistTitle"></span></h2>
    <button class="add-song-btn">Add Song</button>
    <table class="songs-table">
        <thead>
            <tr>
                <th>Artist</th>
                <th>Song Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Song content goes here -->
        </tbody>
    </table>
</div>