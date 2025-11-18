<div class="cuaToi">
  <h2>Bài hát của tôi</h2>
<?php if (empty($songs)): ?>
    <p class="noFind">
        Bạn chưa có bài hát nào. Hãy tải lên những bài hát của bạn!
    </p>
<?php else: ?>
<?php foreach ($songs as $index => $song): ?>
  <div class="card mySongs-item" data-index="<?= $index; ?>" data-id="<?= $song['id']; ?>" data-name="<?= $song['name']; ?>"
    data-img="<?= $song['image']; ?>" data-artist="<?= $song['artist']; ?>" data-song="<?= $song['fileSong']; ?>">
    <div class="mySongs-number"><?= $index + 1 ?></div>

    <div class="mySongs-thumb-wrapper">
      <img src="<?= $song['image'] ?>" alt="<?= htmlspecialchars($song['name']) ?>" class="mySongs-thumb">
      <div class="play-btn">
        <i class="fa-solid fa-play play-icon"></i>
      </div>
    </div>

    <div class="mySongs-title"><?= htmlspecialchars($song['name']) ?></div>
    <div class="mySongs-artist"><?= htmlspecialchars($song['artist']) ?></div>
    <div id="mySongs-timeSong"><?= $song['duration'] ?></div>
    <!-- <div class="favoriteBtn" data-id="<?= $song['id']; ?>">
      <i class="fa-regular fa-heart"></i>
    </div> -->
    <div class="btnMySongs">
      <button class="editBtn" data-id="<?= $song['id']; ?>">
        <i class="fa-solid fa-pen-to-square"></i>
      </button>
      <a href="index.php?controller=user&action=deleteMySong&id=<?= $song['id'] ?>"
        onclick="return confirm('Xóa bài hát này?')">
        <button class="deleteBtn">
          <i class="fa-solid fa-trash"></i>
        </button>
      </a>
    </div>
  </div>

<?php endforeach; ?>
<?php endif; ?>
</div>