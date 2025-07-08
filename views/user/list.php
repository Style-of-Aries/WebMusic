<?php
ob_start();
?>
<div class="contentHeader">
    <h2>Danh sách bài hát</h2>
    <div class="playlist-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Tên bài hát</th>
                <th>Ngày tạo</th>
            </tr>

            <tbody>
                <?php foreach ($songs as $song): ?>
                    <tr>
                        <td><?= $song['id'] ?></td>
                        <td><?= htmlspecialchars($song['name']) ?></td>
                        <td><?= htmlspecialchars($song['release_date']) ?></td>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
include(__DIR__ . '/layout.php');
?>