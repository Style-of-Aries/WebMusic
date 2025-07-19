<input type="checkbox" id="toggle-menu" hidden>
<aside class="sidebar">
    <div class="logoWeb">
        <a href="index.php?controller=user&action=index"><img src="<?= BASE_URL ?>img/logoMusic.jpg" alt="Logo"></a>
    </div>
    <label for="toggle-menu" class="toggle-btn">☰</label>
    <div class="sidebar-content">
        <ul class="nav-ul">
            <li class="nav-li"><a href="index.php?controller=user&action=favorite">
                    <i class="fa-solid fa-heart"></i>
                    <span>Yêu thích</span>
                </a></li>
            <li class="nav-li"><a href="index.php?controller=user&action=index">
                    <i class="fas fa-compact-disc"></i>
                    <span>Khám phá</span>
                </a></li>
            <li class="nav-li"><a href="index.php?controller=user&action=bxh">
                    <i class="fas fa-chart-line"></i>
                    <span>BXH Nhạc Mới</span>
                </a></li>
        </ul>
    </div>
</aside>