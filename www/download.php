<?php
include('db.php');
$page404 = "/404.html";
if ($_GET['file_id']) {
    $file_id = $_GET['file_id'];
    $arr = exec_sql("SELECT * FROM files WHERE file_id = '$file_id'");
    if (empty($_COOKIE)) {
        return false;
    }
    $user_uuid = $_COOKIE['uuid'];
    if (count($arr) > 0) {
        $row = $arr[0];
        $file_res = $row['file_res'];
        $file_name = $row['file_name'];
        $file_max_download_count = $row['file_max_download_count'];
        $file_download_count = $row['file_download_count'];
        exec_sql("UPDATE files SET file_download_count = file_download_count + 1 WHERE file_id = '$file_id'");
        exec_sql("UPDATE users SET user_download_file_count = user_download_file_count + 1 WHERE user_uuid = '$user_uuid'");
        $file_size = filesize('res/' . $file_res);
        header("Content-type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: " . $file_size);
        header("Content-Disposition: attachment; filename=" . $file_name);
        $file = fopen('res/' . $file_res, "rb");
        echo fread($file, $file_size);
        fclose($file);
        if ($file_download_count >= $file_max_download_count - 1) {
            exec_sql("DELETE FROM files WHERE file_id = '$file_id'");
            unlink('res/' . $file_res);
        }
    } else {
        header("Location: $page404");
        exit();
    }
} else {
    header("Location: $page404");
    exit();
}