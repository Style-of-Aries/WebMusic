<?php
ob_start();
?>
<h2>BXH Nhạc Mới</h2>
<?php shuffle($songs); ?>
<?php foreach ($songs as $index => $song): ?>
  <div class="card bxh-item" data-index="<?= $index; ?>" data-id="<?= $song['id']; ?>" data-name="<?= $song['name']; ?>"
    data-img="<?= $song['image']; ?>" data-artist="<?= $song['artist']; ?>" data-song="<?= $song['fileSong']; ?>">
    <div class="bxh-number"><?= $index + 1 ?></div>

    <div class="bxh-thumb-wrapper">
      <img src="<?= $song['image'] ?>" alt="<?= htmlspecialchars($song['name']) ?>" class="bxh-thumb">
      <i class="fa-solid fa-play play-icon"></i>
    </div>

    <div class="bxh-title"><?= htmlspecialchars($song['name']) ?></div>
    <div class="bxh-artist"><?= htmlspecialchars($song['artist']) ?></div>
    <div id="bxh-timeSong">00:00</div>
  </div>
<?php endforeach; ?>
<?php
$mainContent = ob_get_clean();
include __DIR__ . '/../layout/layout.php';
?>