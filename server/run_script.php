<?php
// Thực thi script bash
$output = shell_exec('bash file.sh 2>&1');  // Chú ý chỉnh đường dẫn tới script bash
echo "<pre>$output</pre>";
echo '<a href="index.php">Quay lại</a>';
?>
