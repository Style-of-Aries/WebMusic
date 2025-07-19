<div class="header">
    <form class="homeSearch" action="index.php" method="get">
        <input type="hidden" name="controller" value="user">
        <input type="hidden" name="action" value="search">
        <input type="text" name="keyword" placeholder="Tìm kiếm bài hát, nghệ sĩ, lời bài hát..." required>
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
    <?php if (isset($_SESSION['user'])): ?>
        <?php $username = $_SESSION['user']['username']; ?>
        <div class="avatarUser" id="avatarWrapper">
            <img src="<?= BASE_URL ?>img/avatar.jpg" alt="avatar" id="avatarBtn">
            <div class="dropdownMenu" id="dropdownMenu">
                <div class="username">
                    <?= htmlspecialchars($username); ?>
                </div>
                <?php if ($_SESSION['user']['email'] === 'admin123'): ?>
                    <a href="index.php?controller=admin&action=index">👤 Trang quản trị</a>
                <?php endif; ?>
                <a href="index.php?controller=auth&action=logout">🚪 Đăng xuất</a>
            </div>
        </div>
    <?php else: ?>
        <a href="index.php?controller=auth&action=login" class="loginBtn"> Đăng nhập</a>
    <?php endif; ?>
</div>