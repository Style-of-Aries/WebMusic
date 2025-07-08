<?php
// Trả kết quả về dạng JSON
header("Content-Type: application/json");

// Gọi model
require_once "../models/adminModel.php";

$model = new adminModel();
$songs = $model->getAll();

// Chuẩn hóa đường dẫn để tránh lỗi ./.. gây 404
foreach ($songs as &$song) {
    $song['fileSong'] = "/WebMusic/public/uploads/audio/" . basename($song['fileSong']);
    $song['image'] = "/WebMusic/public/uploads/img/" . basename($song['image']);
}

// Trả JSON về trình duyệt
echo json_encode($songs);
