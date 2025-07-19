<?php
ob_start();
?>

<h2>Danh sách bài hát</h2>
<div class="playlist-container">
    <?php foreach ($songs as $index => $song): ?>
        <div class="card list-item" data-playlist="all" data-index="<?= $index; ?>" data-id="<?= $song['id']; ?>"
            data-name="<?= $song['name']; ?>" data-img="<?= $song['image']; ?>" data-artist="<?= $song['artist']; ?>"
            data-song="<?= $song['fileSong']; ?>">
            <img src="<?= $song['image'] ?>" alt="" class="thumbnail">
            <div class="play-btn">
                <i class="fa-solid fa-play play-icon"></i>
            </div>
            <div class="info">
                <h3><?= htmlspecialchars(string: $song['name']) ?></h3>
                <p><?= htmlspecialchars($song['artist']) ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>
<h2>Dương Domic</h2>
<div class="playlist-container">
    <?php foreach ($songsDomic as $index => $song): ?>
        <div class="card list-item" data-playlist="duongdomic" data-index="<?= $index; ?>" data-id="<?= $song['id']; ?>"
            data-name="<?= $song['name']; ?>" data-img="<?= $song['image']; ?>" data-artist="<?= $song['artist']; ?>"
            data-song="<?= $song['fileSong']; ?>">
            <img src="<?= $song['image'] ?>" alt="" class="thumbnail">
            <div class="play-btn">
                <i class="fa-solid fa-play play-icon"></i>
            </div>
            <div class="info">
                <h3><?= htmlspecialchars(string: $song['name']) ?></h3>
                <p><?= htmlspecialchars($song['artist']) ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>
<h2>Dương Domic</h2>
<div class="playlist-container">
    <?php foreach ($songsEXSH as $index => $song): ?>
        <div class="card list-item" data-playlist="EXSH" data-index="<?= $index; ?>" data-id="<?= $song['id']; ?>"
            data-name="<?= $song['name']; ?>" data-img="<?= $song['image']; ?>" data-artist="<?= $song['artist']; ?>"
            data-song="<?= $song['fileSong']; ?>">
            <img src="<?= $song['image'] ?>" alt="" class="thumbnail">
            <div class="play-btn">
                <i class="fa-solid fa-play play-icon"></i>
            </div>
            <div class="info">
                <h3><?= htmlspecialchars(string: $song['name']) ?></h3>
                <p><?= htmlspecialchars($song['artist']) ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php
$mainContent = ob_get_clean();
include __DIR__ . '/../layout/layout.php';

?>