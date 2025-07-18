<!-- views/admin/songs/list.php -->
<?php
ob_start();
?>
<style>
    a{

        text-decoration: none;
        color: white;
    }
</style>
<h2>Danh sách ngươi dùng</h2>
      <!-- <a href="admin.php?action=create" class="btn-custom"><i class="ri-add-line"></i> Thêm bài hát</a> -->
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>UserName</th>
            <th>Email</th>
            <th>PassWord</th>
            <th>Số điện thoại</th>
            <th>Hành Động</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $index => $user): ?>
          <tr>
            <!-- <td><?= $user['id']   ?></td> -->
            <td><?= $index +1   ?></td>
            <td><a href="index.php?controller=admin&action=yeuThich&id=<?= $user['id'] ?>&user=<?=$user['username'] ?>"><?= htmlspecialchars($user['username']) ?></a></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['password']) ?></td>
            <td><?= htmlspecialchars($user['sodienthoai']) ?></td>
            <td>
              <a href="index.php?controller=admin&action=editUser&id=<?= $user['id'] ?>" class="action-btn edit-btn"><i class="ri-pencil-line"></i> Sửa</a>
              <a href="index.php?controller=admin&action=deleteUser&id=<?= $user['id'] ?>" class="action-btn delete-btn" onclick="return confirm('Xóa người dùng này?')"><i class="ri-delete-bin-line"></i> Xóa</a>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>


<?php
$content=ob_get_clean();
include "../views/admin/layout.php";
?>
