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
                    <?php foreach ($songs as $index => $song): ?>
                        <tr data-index="<?= $index ?>">
                            <td><?= $index + 1 ?></td> <!-- số thứ tự tăng dần -->
                            <td>
                                <div class="song-img-container">
                                    <img src="<?= $song['image'] ?>" class="song-img" />
                                    <div class="icon-overlay"><i class="fa-solid fa-play"></i></div>
                                </div>
                            </td>
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