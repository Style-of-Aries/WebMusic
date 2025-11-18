<?php
ob_start();
?>
<style>
    .genre-grid {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .genre-form {
        padding: 16px;
        border-radius: 8px;
        backdrop-filter: blur(20px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .genre-form input[type="text"] {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        min-width: 220px;
    }

    .genre-form button {
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }

    .genre-form button.add {
        background: #00d3e5;
        color: #000;
    }

    .genre-form button.save {
        background: #3a8b93;
        color: #fff;
    }

    .genre-table {
        margin-top: 20px;
    }

    .genre-table table input[type="text"] {
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
    }

    .genre-table .delete-btn {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 6px;
        background: #dc3545;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
    }

    .genre-empty {
        margin-top: 20px;
        font-style: italic;
        color: #aaa;
    }
</style>

<h2>Quản lý thể loại</h2>

<div class="genre-grid">
    <form class="genre-form" action="index.php?controller=admin&action=storeGenre" method="POST">
        <input type="text" name="name" placeholder="Tên thể loại mới" required>
        <button type="submit" class="add">Thêm thể loại</button>
    </form>
</div>

<div class="genre-table">
    <?php if (!empty($genres)): ?>
        <table>
            <thead>
                <tr>
                    <th width="80">ID</th>
                    <th>Tên thể loại</th>
                    <th width="140">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($genres as $genre): ?>
                    <tr>
                        <td><?= $genre['id'] ?></td>
                        <td>
                            <form class="genre-form" style="border:none;padding:0;" action="index.php?controller=admin&action=updateGenre" method="POST">
                                <input type="hidden" name="id" value="<?= $genre['id'] ?>">
                                <input type="text" name="name" value="<?= htmlspecialchars($genre['name']) ?>" required>
                                <button type="submit" class="save">Lưu</button>
                            </form>
                        </td>
                        <td>
                            <a class="delete-btn" href="index.php?controller=admin&action=deleteGenre&id=<?= $genre['id'] ?>"
                                onclick="return confirm('Xóa thể loại này?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="genre-empty">Chưa có thể loại nào. Hãy thêm mới!</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include "../views/admin/layout.php";
?>

