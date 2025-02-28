<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['old_name'], $_POST['new_name'])) {
    $old_path = 'uploads/' . basename($_POST['old_name']);
    $new_path = 'uploads/' . basename($_POST['new_name']);

    if (file_exists($old_path) && !file_exists($new_path)) {

        $old_ext = pathinfo($old_path, PATHINFO_EXTENSION);
        $new_ext = pathinfo($new_path, PATHINFO_EXTENSION);

        if (empty($new_ext) || $new_ext !== 'apk') {
            echo "Lỗi: Tên tệp mới phải có định dạng .apk.";
            echo '</br><a href="index.php">Quay lại</a>';
        } else {
            rename($old_path, $new_path);
            echo "✅ Đổi tên tệp thành công: $old_path -> $new_path";
            echo '</br><a href="index.php">Quay lại</a>';
        }
    } else {
        echo "Lỗi: Tệp cũ không tồn tại hoặc tệp mới đã tồn tại.";
        echo '</br><a href="index.php">Quay lại</a>';
    }
}
?>
