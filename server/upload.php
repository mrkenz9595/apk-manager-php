<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['apkFile'])) {
    $upload_dir = 'uploads/';
    $file_path = $upload_dir . basename($_FILES['apkFile']['name']);

    if (move_uploaded_file($_FILES['apkFile']['tmp_name'], $file_path)) {
        header('Location: index.php');
    } else {
        echo 'Lỗi khi tải lên tệp.';
    }
}
?>
