<?php
require_once __DIR__ . '/../../../models/userModel.php';
$this->userModel = new userModel();
$artists = $this->userModel->getAllArtists();
?>
<input type="checkbox" id="toggle-menu" hidden>
<aside class="sidebar">
    <div class="logoWeb">
        <a href="index.php?controller=user&action=index"><img src="<?= BASE_URL ?>img/logoMusic.jpg" alt="Logo"></a>
    </div>
    <label for="toggle-menu" class="toggle-btn">☰</label>
    <div class="sidebar-content">
        <ul class="nav-ul">
            <li class="nav-li"><a href="index.php?controller=user&action=profile">
                <i class="fa-solid fa-user"></i>
                <span>Của tôi</span>
            </a></li>
            <li class="nav-li"><a href="index.php?controller=user&action=favorite" >
                    <i class="fa-solid fa-heart"></i>
                    <span>Bài hát yêu thích</span>
                </a></li>
            <li class="nav-li"><a href="index.php?controller=user&action=index" >
                    <i class="fas fa-compact-disc"></i>
                    <span>Khám phá</span>
                </a></li>
        </ul>
    </div>
</aside>