<!-- <div class="header">
    <div class="homeSearch">
        <input type="text" placeholder="Tìm kiếm bài hát, nghệ sĩ, lời bài hát...">
        <i class="fas fa-search"></i>
    </div>
    <div class="avatarUser">
        <a href="index.php?controller=admin&action=index"><img src="<?= BASE_URL ?>img/avatar.jpg" alt="avatar"></a>
    </div>
</div> -->
<div class="header">
    <form class="homeSearch" action="index.php" method="get">
        <input type="hidden" name="controller" value="user">
        <input type="hidden" name="action" value="search">
        <input type="text" name="keyword" placeholder="Tìm kiếm bài hát, nghệ sĩ, lời bài hát..." required>
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
    <div class="avatarUser">
        <a href="index.php?controller=admin&action=index">
            <img src="<?= BASE_URL ?>img/avatar.jpg" alt="avatar">
        </a>
    </div>
</div>