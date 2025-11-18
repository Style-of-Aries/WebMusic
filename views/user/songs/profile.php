<div class="profile">
    <?php if (isset($_SESSION['user'])): ?>
        <?php $username = $_SESSION['user']['username']; ?>
        <?php if (isset($_SESSION['user']['image'])): ?>
            <img src="<?= $_SESSION['user']['image'] ?>" alt="avatar" id="avatarProfile">
        <?php else: ?>
            <img src="<?= BASE_URL ?>img/avatar.jpg" alt="avatar" id="avatarProfile">
        <?php endif; ?>
        <div class="usernameProfile">
            <?= htmlspecialchars($username); ?>
        </div>
    <?php endif; ?>
</div>

<div class="mySongs-list">
    <a href="index.php?controller=user&action=favorite">
        <div class="yeuThich">
            <div class="favoriteIcon">
                <i class="fa-solid fa-heart"></i>
                <span>Bài hát yêu thích</span>
            </div>
            <div class="songsCount">
                (<?= count($favoriteSongs); ?> bài hát)
            </div>
        </div>
    </a>
    <a href="index.php?controller=user&action=mySongs">
        <div class="uploadedSongs">
            <div class="uploadIcon">
                <i class="fa-solid fa-upload"></i>
                <span>Bài hát đã tải lên</span>
            </div>
            <div class="songsCount">
                (<?= count($songs); ?> bài hát)
            </div>
        </div>
    </a>
</div>
<div class="playlist">
    <h2>Playlist của tôi</h2>
    <i class="fa-solid fa-plus addPlaylistBtn" id="addPlaylistBtn" title="Thêm playlist"></i>
</div>

<div class="khungPlaylist">
    <?php
    // 💡 THÊM ĐIỀU KIỆN KIỂM TRA TÍNH HỢP LỆ VÀ SỰ TỒN TẠI
    if (isset($playlists) && is_array($playlists) && !empty($playlists)):
        ?>
        <?php foreach ($playlists as $index => $playlist): ?>
            <div class="playlist-item" >
                <a class="playlist-link" href="index.php?controller=user&action=viewPlaylist&id=<?= $playlist['id'] ?>">
                    <div class="imgPlaylist">
                        <img src="<?= BASE_URL ?>img/logoMusic.jpg" alt="">
                    </div>
                    <span><?= htmlspecialchars($playlist['name']) ?></span>
                    <div class="songsCount">
                        (<?= isset($playlist['song_count']) ? (int) $playlist['song_count'] : 0; ?> bài hát)
                    </div>
                </a>
                <div class="playlist-actions">
                    <button class="playlist-btn edit editPlaylistBtn"
                        title="Chỉnh sửa playlist"
                        data-playlist-id="<?= $playlist['id'] ?>"
                        data-playlist-name="<?= htmlspecialchars($playlist['name'], ENT_QUOTES) ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <a href="index.php?controller=user&action=deletePlaylist&id=<?= $playlist['id'] ?>"
                        onclick="return confirm('Xóa playlist này?')">
                    <button class="playlist-btn delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-playlists">
            <p>Hiện bạn chưa có playlist nào. Hãy tạo một playlist mới!</p>
        </div>
    <?php endif; ?>

</div>