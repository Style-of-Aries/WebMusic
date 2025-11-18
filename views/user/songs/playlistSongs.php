<?php 
ob_start();
?>
<?php if (isset($songs)): ?>
<h2>Bài hát trong playlist: <?= htmlspecialchars($playlist['name']) ?></h2>
<?php foreach ($songs as $index => $song): ?>
  <div class="card playlistSongs-item" data-index="<?= $index; ?>" data-id="<?= $song['id']; ?>" data-name="<?= $song['name']; ?>"
    data-img="<?= $song['image']; ?>" data-artist="<?= $song['artist']; ?>" data-song="<?= $song['fileSong']; ?>">
    <div class="playlistSongs-number"><?= $index + 1 ?></div>

    <div class="playlistSongs-thumb-wrapper">
      <img src="<?= $song['image'] ?>" alt="<?= htmlspecialchars($song['name']) ?>" class="playlistSongs-thumb">
      <div class="play-btn">
        <i class="fa-solid fa-play play-icon"></i>
      </div>
    </div>

    <div class="playlistSongs-title"><?= htmlspecialchars($song['name']) ?></div>
    <div class="playlistSongs-artist"><?= htmlspecialchars($song['artist']) ?></div>
    <div id="playlistSongs-timeSong"><?= $song['duration'] ?></div>
    <form class="playlistSongs-removeForm" method="POST" action="index.php?controller=user&action=removeSongFromPlaylist" onsubmit="event.stopPropagation(); return confirm('Xóa bài hát này khỏi playlist?');">
      <input type="hidden" name="playlist_id" value="<?= $playlist['id'] ?>">
      <input type="hidden" name="song_id" value="<?= $song['id'] ?>">
      <button type="submit" class="playlistSongs-removeBtn" title="Xóa khỏi playlist">
        <i class="fa-solid fa-trash"></i>
      </button>
    </form>
    <!-- <div class="favoriteBtn" data-id="<?= $song['id']; ?>">
      <i class="fa-regular fa-heart"></i>
    </div> -->
  </div>
<?php endforeach; ?>
<?php else: ?>
  <p>Không có bài hát nào trong playlist này.</p>
<?php endif; ?>