<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý APK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h1 class="mb-4"><center>Quản lý Tệp APK</center></h1>

    <!-- Upload Form -->
    <form action="upload.php" method="post" enctype="multipart/form-data" class="mb-4">
        <div class="input-group">
            <input type="file" name="apkFile" class="form-control" required>
            <button type="submit" class="btn btn-primary">Upload APK</button>
        </div>
    </form>

    <!-- Danh sách tệp APK -->
    <h2>Danh sách tệp APK</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên tệp</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $files = glob('uploads/*.apk');
            foreach ($files as $file):
                $filename = basename($file);
            ?>
                <tr>
                    <td><?= htmlspecialchars($filename) ?></td>
                    <td>
                        <form action="rename.php" method="post" class="d-inline">
                            <input type="hidden" name="old_name" value="<?= htmlspecialchars($filename) ?>">
                            <input type="text" name="new_name" placeholder="Nhập tên mới" class="form-control d-inline w-50" required>
                            <button type="submit" class="btn btn-warning btn-sm">Đổi tên</button>
                            <a href="delete.php?file=<?= urlencode($filename) ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Chạy script bash -->
    <form action="run_script.php" method="post" class="mb-4">
        <button type="submit" class="btn btn-success">Tạo API</button>
    </form>

    <!-- Hiển thị thông tin từ apk_info.txt -->
    <h2>API Info</h2>
    <pre class="border p-3 bg-light">
        <?= file_exists('apk_info.txt') ? htmlspecialchars(file_get_contents('apk_info.txt')) : 'Không có dữ liệu.' ?>
    </pre>

</body>
</html>
