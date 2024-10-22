<?php
require_once("dbtools.inc.php");
$link=create_connection();
$id=$_POST["id"];
$name=$_POST["name"];
$gmail=$_POST["gmail"];
switch ($_POST["sex"]) {
    case '1':
        $sex=1;
        break;
    case '0';
        $sex=0;
        break;
}
$subject=$_POST["subject"];
$content=$_POST["content"];


// 圖片處理邏輯
$images_path = $row['images'];  // 預設為原圖
if (isset($_FILES["images"]) && $_FILES["images"]["error"] === UPLOAD_ERR_OK) {
    // 新圖片的上傳和處理
    $file_dir = "upload_file/";
    $file_ext = strtolower(pathinfo($_FILES["images"]["name"], PATHINFO_EXTENSION));
    $allowed_ext = array('jpg', 'png', 'gif', 'jpeg');
    
    if (in_array($file_ext, $allowed_ext)) {
        $new_file_name = uniqid() . '.' . $file_ext;
        $target_file = $file_dir . $new_file_name;

        // 將新圖片移動到指定的目錄
        if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
            $images_path = $target_file;  // 使用新圖片路徑

            // 刪除舊圖片，避免浪費儲存空間
            if (!empty($row['images']) && file_exists($row['images'])) {
                unlink($row['images']);
            }
        } else {
            echo "圖片上傳失敗";
            exit();
        }
    } else {
        echo "不支援的檔案格式";
        exit();
    }
}

// 更新資料庫
$sql = "UPDATE `talk` SET name='$name', gmail='$gmail', sex='$sex', subject='$subject', content='$content', images='$images_path' WHERE id='$id'";
$result = mysqli_query($link, $sql);

if ($result) {
    echo "更新成功";
    header("location:index.php");
} else {
    echo "更新失敗：" . mysqli_error($link);
}

mysqli_close($link);
?>