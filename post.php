<?php 
require_once("dbtools.inc.php");
$link=create_connection();

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


//圖片處理
if(isset($_FILES["images"])&& $_FILES["images"]["error"]===UPLOAD_ERR_OK){
    $file_dir="upload_file/";
    $file_ext=strtolower(pathinfo($_FILES["images"]["name"],PATHINFO_EXTENSION));
    $allowed_ext=array('jpg','png','gif','jpeg');
    if(in_array($file_ext,$allowed_ext)){
        $new_file_name=uniqid().'.'.$file_ext;

        $target_file=$file_dir.$new_file_name;

        if(move_uploaded_file($_FILES["images"]["tmp_name"],$target_file)){
            $images_path=$target_file;
        }else{
            echo "圖片上船失敗";
            exit();
        }
    }else{
        echo "不支援的檔案格式";
        exit();
    }

}


$sql="INSERT INTO talk(name,gmail,sex,subject,content,images)
    VALUES('$name','$gmail','$sex','$subject','$content','$images_path')";
$result=executed_sql($link,"iamgood4",$sql);

// mysqli_free_result($result);
mysqli_close($link);
header("location:index.php");
?>