jQuery(document).ready(function($) {
    const addPlaylistBtn = $('.music-playlist-add-btn');
    const addPlaylistForm = $('#musicPlaylistAddForm');
    const submitPlaylist = $('#musicPlaylistSubmit');
    const playlistNameInput = $('#musicPlaylistName');
    const playlist = $('#musicPlaylist');

    addPlaylistBtn.on('click', function() {
        addPlaylistForm.toggle();
    });

    submitPlaylist.on('click', function() {
        const playlistName = playlistNameInput.val().trim();
        if (playlistName) {
            const li = $('<li></li>').text(playlistName);
            playlist.append(li);
            playlistNameInput.val('');
            addPlaylistForm.hide();
        }
    });
});
