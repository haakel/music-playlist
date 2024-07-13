jQuery(document).ready(function($) {
    const addPlaylistBtn = $('.music-playlist-add-btn');
    const addPlaylistForm = $('#musicPlaylistAddForm');
    const submitPlaylist = $('#musicPlaylistSubmit');
    const playlistNameInput = $('#musicPlaylistName');
    const playlist = $('#musicPlaylist');
    const songsContainer = $('#songsContainer');
    const playlistTitle = $('#playlistTitle');

    addPlaylistBtn.on('click', function() {
        addPlaylistForm.toggle();
    });

    submitPlaylist.on('click', function() {
        const playlistName = playlistNameInput.val().trim();
        if (playlistName) {
            $.ajax({
                url: musicPlaylist.ajax_url,
                type: 'post',
                data: {
                    action: 'add_playlist',
                    playlist_name: playlistName,
                    security: musicPlaylist.security
                },
                success: function(response) {
                    if (response.success) {
                        playlist.empty();
                        Object.entries(response.data).forEach(function ([index,name]) {
                            console.log(name,index);
                            playlist.append('<li>' + name + ' <button class="music-playlist-delete-btn" data-playlist="' + name + '">Delete</button></li>');
                        });
                        playlistNameInput.val('');
                        addPlaylistForm.hide();
                        $.toast({
                            text: "Playlist added successfully.",
                            heading: 'Success',
                            icon: 'success',
                            showHideTransition: 'fade',
                            allowToastClose: true,
                            hideAfter: 3000,
                            position: 'bottom-left'
                        });
                    }
                }
            });
        }
    });

    $(document).on('click', '.music-playlist-delete-btn', function() {
        const playlistName = $(this).data('playlist');
        if (confirm("Are you sure you want to delete this playlist?")) {
            $.ajax({
                url: musicPlaylist.ajax_url,
                type: 'post',
                data: {
                    action: 'delete_playlist',
                    playlist_name: playlistName,
                    security: musicPlaylist.security
                },
                success: function(response) {
                    if (response.success) {
                        playlist.empty();
                        response.data.forEach(function(name) {
                            playlist.append('<li>' + name + ' <button class="music-playlist-delete-btn" data-playlist="' + name + '">Delete</button></li>');
                        });
                        $.toast({
                            text: "Playlist deleted successfully.",
                            heading: 'Success',
                            icon: 'success',
                            showHideTransition: 'fade',
                            allowToastClose: true,
                            hideAfter: 3000,
                            position: 'bottom-left'
                        });
                    }
                }
            });
        }
    });

    $(document).on('click', '#musicPlaylist li', function() {
        const selectedPlaylist = $(this).text().trim();
        playlistTitle.text(selectedPlaylist);
        songsContainer.show();
    });

    $(document).click(function(event) {
        if (!$(event.target).closest('#songsContainer, #musicPlaylist li').length) {
            songsContainer.hide();
        }
    });

    $('#songsContainer h2').text(function(_, oldText) {
        return oldText.replace(' Delete', '');
    });
});
