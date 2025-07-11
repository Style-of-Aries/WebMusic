<?php
ob_start();
?>

        <h2>Danh sách bài hát</h2>
        <div class="playlist-container">
            
            <?php foreach ($songs as  $index => $song): ?>
                <div class="card list-item" data-index="<?=$index;?>">
                    <img src="<?= $song['image'] ?>" alt="" class="thumbnail">
                    <div class="play-btn">
                        <i class="fa-solid fa-play play-icon"></i>
                    </div>
                    <div class="info">
                        <h3 ><?= htmlspecialchars(string: $song['name']) ?></h3>
                        <p ><?= htmlspecialchars($song['artist']) ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php
$mainContent = ob_get_clean();
include(__DIR__ . '/layout.php');
?>