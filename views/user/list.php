<?php
ob_start();
?>
<div class="mainContent">
    <div class="contentHeader">
        <h2>Danh sách bài hát</h2>
        <div class="playlist-container">
            <table class="song-table">
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên bài hát</th>
                    <th>Tác giả</th>
                </tr>

                <tbody>
                    <?php $stt = 1; ?>
                    <?php foreach ($songs as $song): ?>
                        <tr>
                            <td><?= $stt++ ?></td> <!-- số thứ tự tăng dần -->
                            <td><img src="<?= $song['image'] ?>" ></td>
                            <td><?= htmlspecialchars($song['name']) ?></td>
                            <td><?= htmlspecialchars($song['artist']) ?></td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$mainContent = ob_get_clean();
include(__DIR__ . '/layout.php');
?>