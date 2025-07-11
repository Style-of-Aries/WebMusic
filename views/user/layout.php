<?php require_once __DIR__ . "/../../config/config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music MP3</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>css/styles.css">
</head>

<body>
    <div class="main">
        <?php include 'sidebar.php'; ?>
        <div class="container">
            <?php include 'header.php'; ?>
            <div class="mainContent">
                <div class="contentHeader">
                    <?= $mainContent ?>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>
<script src="<?= BASE_URL ?>js/audio.js"></script>

</html>