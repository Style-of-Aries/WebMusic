<?php
ob_start();
?>
<style>
    form.song-form {
        padding: 24px;
        border-radius: 8px;
        backdrop-filter: blur(20px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        /* max-width: 600px; */
        width: 50%;
        /* height: 70%; */
        /* margin: auto; */
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="file"],
    select {
        padding: 10px;
        background-color: #5d646eff;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 4px;
        color: white;
        width: 95%;
        outline: none;
    }

    input[type="submit"] {
        padding: 12px;
        background-color: #00D3E5;
        border: none;
        color: #black;
        font-weight: bold;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
        outline: none;
    }

    input[type="submit"]:hover {
        background-color: #3a8b93ff;
    }
</style>

<h2>Thêm bài hát mới</h2>
<form class="song-form" action="index.php?controller=admin&action=store" method="POST" enctype="multipart/form-data">
    <div>
        <label for="title">Tên bài hát:</label>
        <input type="text" id="title" name="name" >
    </div>
    <div>
        <label for="artist">Ca sĩ:</label>
        <input type="text" id="artist" name="artist" >
    </div>
    <div>
        <label for="thumbnail">Ảnh nhạc:</label>
        <input type="file"  name="image" >
    </div>
    <div>
        <label for="audio">File nhạc (.mp3):</label>
        <input type="file" id="audio" name="audio" accept="audio/*" >
    </div>
    <div>
        <label for="genre">Thể loại:</label>
        <?php if (!empty($genres)): ?>
            <select name="genre" id="genre" required>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?= htmlspecialchars($genre['name']) ?>">
                        <?= htmlspecialchars($genre['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php else: ?>
            <p style="color:#bbb; font-size:14px;">Chưa có thể loại nào. Hãy tạo tại mục "Quản lý thể loại".</p>
            <input type="hidden" name="genre" value="Khác">
        <?php endif; ?>
    </div>
    <input type="submit" value="Thêm bài hát" name="btn_add">
</form>



<?php
$content = ob_get_clean();
include "../views/admin/layout.php";
?>