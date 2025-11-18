<?php
require_once __DIR__ . "/../../../config/config.php";
$layoutGenres = $genres ?? null;
if ($layoutGenres === null) {
    require_once __DIR__ . "/../../../models/userModel.php";
    $layoutGenreModel = new UserModel();
    $layoutGenres = $layoutGenreModel->getGenres();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NhacCuaNĐT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>css/styles.css">

</head>

<body>


    <?php if (!empty($_SESSION['flash_message'])): ?>
        <div id="flash-message" class="flash">
            <?= $_SESSION['flash_message']; ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <div id="overlay" class="overlay"></div>
    <div class="popupUpload" id="popupUpload">
        <div class="popupUpload-content">
            <h2>Upload Music</h2>
            <button type="button" id="closePopup" class="closePopup">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <form action="index.php?controller=user&action=uploadMusic" method="post" enctype="multipart/form-data">
                <label for="file">Select file</label>
                <input type="file" name="audio" id="audio" accept="audio/*">
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
                <label for="artist">Artist</label>
                <input type="text" name="artist" id="artist" value="<?= $_SESSION['user']['username'] ?>" readonly>
                <label for="genre">Thể loại</label>
                <select name="genre" id="genre" required>
                    <?php if (!empty($layoutGenres)): ?>
                        <?php foreach ($layoutGenres as $genreItem):
                            $genreValue = is_array($genreItem) ? ($genreItem['name'] ?? '') : $genreItem;
                            if ($genreValue === '') {
                                continue;
                            }
                            ?>
                            <option value="<?= htmlspecialchars($genreValue) ?>"><?= htmlspecialchars($genreValue) ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="Khác">Khác</option>
                    <?php endif; ?>
                </select>
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="image" id="image" accept="image/*">
                <button type="submit" name="btn_upload" value="upload">Upload</button>
            </form>
        </div>
    </div>
    <div class="popupEdit" id="popupEdit">
        <div class="popupEdit-content">
            <h2>Edit Music</h2>
            <button type="button" id="closeEditPopup" class="closePopup">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <form action="index.php?controller=user&action=updateMySong" method="post" enctype="multipart/form-data">
                <!-- ID và file/ảnh cũ lưu ẩn -->
                <input type="hidden" name="id" id="edit-id">
                <input type="hidden" name="old_audio" id="edit-old-audio">
                <input type="hidden" name="old_image" id="edit-old-image">

                <label for="audio">Select file (Audio)</label>
                <input type="file" id="edit-audio" name="audio" accept="audio/*">

                <label for="name">Name</label>
                <input type="text" id="edit-title" name="name">

                <label for="artist">Artist</label>
                <input type="text" id="edit-artist" name="artist">

                <label for="image">Thumbnail</label>
                <input type="file" id="edit-image" name="image">

                <button type="submit" name="btn_edit" value="edit">Edit</button>
            </form>
        </div>
    </div>
    <div id="popupAddPlaylist" class="popupAddPlaylist">
        <div class="popupAddPlaylist-content">
            <h2>Thêm Playlist Mới</h2>
            <button type="button" id="closeAddPlaylistPopup" class="closePopup">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <form action="index.php?controller=user&action=addPlaylist" method="post" enctype="multipart/form-data">
                <label for="playlistName">Tên Playlist</label>
                <input type="text" name="playlistName" id="playlistName" required>
                <button type="submit" name="btn_add_playlist" value="add">Thêm</button>
            </form>
        </div>
    </div>
    <div id="popupEditPlaylist" class="popupEditPlaylist">
        <div class="popupEditPlaylist-content">
            <h2>Chỉnh sửa Playlist</h2>
            <button type="button" id="closeEditPlaylistPopup" class="closePopup">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <form action="index.php?controller=user&action=editPlaylist" method="post" enctype="multipart/form-data">
                <input type="hidden" name="playlist_id" id="edit-playlist-id">
                <label for="playlistName">Tên Playlist</label>
                <input type="text" name="playlistName" id="edit-playlist-name" required>
                <button type="submit" name="btn_edit_playlist" value="edit">Lưu</button>
            </form>
        </div>
    </div>
    <div id="playlistPopup" style="display:none;">
        <button type="button" id="closeplaylistPopup" class="closePopup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        <h3>Chọn playlist</h3>
        <?php foreach ($playlists as $pl): ?>
            <form method="POST" action="index.php?controller=user&action=addSong">
                <input type="hidden" name="song_id" data-song_id="">
                <input type="hidden" name="playlist_id" value="<?= $pl['id'] ?>">
                <button class="btnplaylistPopup" type="submit">
                    <img src="<?= BASE_URL ?>img/logoMusic.jpg" alt="">
                    <?= $pl['name'] ?>
                </button>
            </form>
        <?php endforeach; ?>
    </div>

    <div class="main">
        <?php include __DIR__ . '/sidebar.php'; ?>
        <div class="container">
            <?php include __DIR__ . '/header.php'; ?>
            <div class="mainContent" id="main-content">
                <?= $mainContent ?>
            </div>

        </div>
        <?php include __DIR__ . '/footer.php'; ?>
    </div>
</body>
<script src="<?= BASE_URL ?>js/audio.js"></script>

</html>