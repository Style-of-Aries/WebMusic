<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T1 MP3</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="main">
        <?php include 'header.php'; ?>
        <div class="container">
            <?php include 'sidebar.php'; ?>
            <div class="mainContent">
                <div class="contentHeader">
                    <h2>Danh sách bài hát</h2>
                    <div class="playlist-container">
                        <?php foreach ($songs as $song): ?>
                            <div class="playlist-card">
                                <div class="cover">
                                    <img src="<?= $song['cover_image'] ?? 'default.jpg' ?>" alt="Cover">
                                    <div class="play-button">▶</div>
                                </div>
                                <h3><?= htmlspecialchars($song['title']) ?></h3>
                                <p><?= htmlspecialchars($song['description'] ?? 'Chưa có mô tả...') ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>