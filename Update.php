<?php
require_once("dbtools.inc.php");
$link=create_connection();
$id=$_GET["id"];
$sql="SELECT * FROM `talk` WHERE id='$id'";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_assoc($result);
// mysqli_free_result($result);
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Update_action.php" method="post" enctype="multipart/form-data">
        <table width="800" align="center" border="1">
            <tr>
                <td colspan="2" align="center">
                    修改留言
                </td>
            </tr>
            <input type="hidden" name="id" value="<?php echo $row["id"]?>">
            <tr>
                <td width="15">作者</td>
                <td width="85"><input type="text" name="name" value="<?php echo $row["name"]?>" size="50"></td>
            </tr>
            <tr>
                <td width="15">gmail</td>
                <td width="85"><input type="text" name="gmail" value="<?php echo $row["gmail"]?>" size="50"></td>
            </tr>
            <tr>
                <td width="15">性別</td>
                <td width="85">
                    男<input type="radio" name="sex" value="1" <?php if($row["sex"]==1) echo "checked";?>>
                    女<input type="radio" name="sex" value="0" <?php if($row["sex"]==0) echo "checked";?>>
                </td>
            </tr>
            <tr>
                <td width="15">主旨</td>
                <td width="85"><input type="text" name="subject" value="<?php echo $row["subject"]?>" size="50" ></td>
            </tr>
            <tr>
                <td width="15%">內容</td><br>
                <td width="85"><textarea name="content" cols="50" rows="5"><?php echo $row["content"]?></textarea></td>
            </tr>
            <tr>
                <td width="15">上傳相片</td>
                <td width="85">
                    <img src="<?php echo $row["images"]?>" style="width: 200px;" alt="">
                    <input type="file" name="images">
                </td>
            </tr>
            <tr >
                <td colspan="2" align="center">
                    <input type="submit" value="送出">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>