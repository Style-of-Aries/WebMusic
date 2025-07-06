<?php require_once __DIR__ . "/../../config/config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music MP3</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/styles.css">
</head>

<body>
    <div class="main">
        <?php include 'sidebar.php'; ?>
        <div class="container">
            <?php include 'header.php'; ?>
            <div class="mainContent">
                <div class="contentHeader">
                    <h2>Danh sách bài hát</h2>
                    <div class="playlist-container">
                        <!-- <?php foreach ($songs as $song): ?>
                            <div class="playlist-card">
                                <div class="cover">
                                    <img src="<?= $song['cover_image'] ?? 'default.jpg' ?>" alt="Cover">
                                    <div class="play-button">▶</div>
                                </div>
                                <h3><?= htmlspecialchars($song['title']) ?></h3>
                                <p><?= htmlspecialchars($song['description'] ?? 'Chưa có mô tả...') ?></p>
                            </div>
                        <?php endforeach; ?> -->
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>