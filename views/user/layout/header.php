<div class="header">
    <form class="homeSearch" id="search-form" action="index.php" method="get">
        <input type="hidden" name="controller" value="user">
        <input type="hidden" name="action" value="search">
        <input type="text" name="keyword" 
            value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>" required>
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
    <?php if (isset($_SESSION['user'])): ?>
        <?php $username = $_SESSION['user']['username']; ?>
        <div class="uploadMusic" id="uploadMusic">
            <i class="fas fa-upload"></i>
            <span>Upload</span>
        </div>
        
        
        <div class="avatarUser" id="avatarWrapper">
            <?php if(isset($_SESSION['user']['image'])): ?>
                <img src="<?= $_SESSION['user']['image'] ?>" alt="avatar" id="avatarBtn">
            <?php else: ?>
                <img src="<?= BASE_URL ?>img/avatar.jpg" alt="avatar" id="avatarBtn">
            <?php endif; ?>
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