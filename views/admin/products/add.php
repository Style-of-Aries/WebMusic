<?php
ob_start();
?>
<style>
    form.song-form {
        background-color: #231b2e;
        padding: 24px;
        border-radius: 8px;
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
        border: none;
        border-radius: 4px;
        background-color: #2e253a;
        color: white;
        width: 100%;
        outline: none;
    }

    input[type="submit"] {
        padding: 12px;
        background-color: #9b4de0;
        border: none;
        color: white;
        font-weight: bold;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
        outline: none;
    }

    input[type="submit"]:hover {
        background-color: #b86aff;
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
    <input type="submit" value="Thêm bài hát" name="btn_add">
</form>



<?php
$content = ob_get_clean();
include "../views/admin/layout.php";
?>