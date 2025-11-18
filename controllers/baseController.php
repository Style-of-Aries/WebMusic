<?php
class BaseController
{
    public function render($view, $data = [])
    {
        extract($data); // biến $data thành các biến riêng lẻ

        ob_start();
        include BASE_PATH . "/views/$view.php";
        $mainContent = ob_get_clean();

        include BASE_PATH . "/views/user/layout/layout.php";
    }
}
