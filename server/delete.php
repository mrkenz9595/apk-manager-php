<?php
if (isset($_GET['file'])) {
    $file_path = 'uploads/' . basename($_GET['file']);
    if (file_exists($file_path)) {
        unlink($file_path);
    }
    header('Location: index.php');
}
?>
