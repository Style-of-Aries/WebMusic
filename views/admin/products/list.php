<!-- views/admin/songs/list.php -->
<?php
ob_start();
?>

<h2>Danh sách bài hát</h2>
      <!-- <a href="admin.php?action=create" class="btn-custom"><i class="ri-add-line"></i> Thêm bài hát</a> -->
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Ảnh</th>
            <th>Tên bài hát</th>
            <th>Ca sĩ</th>
            <th>Audio</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($songs as $index => $song): ?>
          <tr>
            <!-- <td><?= $song['id']   ?></td> -->
            <td><?= $index +1   ?></td>
            <td><img src="<?= $song['image'] ?>" class="img-thumbnail"></td>
            <td><?= htmlspecialchars($song['name']) ?></td>
            <td><?= htmlspecialchars($song['artist']) ?></td>
            <td><audio src="<?= htmlspecialchars($song['fileSong']) ?>" controls autoplay muted></audio></td>
            <td>
              <a href="index.php?controller=admin&action=edit&id=<?= $song['id'] ?>" class="action-btn edit-btn"><i class="ri-pencil-line"></i> Sửa</a>
              <a href="index.php?controller=admin&action=delete&id=<?= $song['id'] ?>" class="action-btn delete-btn" onclick="return confirm('Xóa bài hát này?')"><i class="ri-delete-bin-line"></i> Xóa</a>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>


<?php
$content=ob_get_clean();
include "../views/admin/layout.php";
?>
