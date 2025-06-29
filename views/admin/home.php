<?php
$content = ob_start();
?>

<h1>Welcome to T1 MP3</h1>

<?php
$content = ob_get_clean();
include './../views/admin/layout.php';
?>