<h2>Kết quả tìm kiếm: </h2>

<?php if (!empty($songs)): ?>
  <?php foreach ($songs as $index => $song): ?>
    <div class="card search-item"
         data-index="<?= $index; ?>"
         data-name="<?= htmlspecialchars($song['name']); ?>"
         data-artist="<?= htmlspecialchars($song['artist']); ?>"
         data-img="<?= htmlspecialchars($song['image']); ?>"
         data-song="<?= htmlspecialchars($song['fileSong']); ?>">

      <div class="search-number"><?= $index + 1 ?></div>

      <div class="search-thumb-wrapper">
        <img src="<?= $song['image'] ?>" alt="<?= htmlspecialchars($song['name']) ?>" class="search-thumb">
        <i class="fa-solid fa-play play-icon"></i>
      </div>

      <div class="search-title"><?= htmlspecialchars($song['name']) ?></div>
      <div class="search-artist"><?= htmlspecialchars($song['artist']) ?></div>
      <div class="search-time">00:00</div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p class="noFind">Không tìm thấy kết quả nào cho từ khóa "<strong><?= htmlspecialchars($keyword) ?></strong>".</p>
<?php endif; ?>
