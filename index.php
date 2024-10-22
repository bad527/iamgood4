<?php 
require_once("dbtools.inc.php");
$link=create_connection();
$sql="SELECT * FROM talk ORDER BY id DESC";
$result=executed_sql($link,"iamgood4",$sql);
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function Delete(id){
            if(confirm("確認是否刪除")){
                window.location.href="Delete.php?id="+id;
            }
        }

        function Update(id){
            window.location.href="Update.php?id="+id;
        }
    </script>
</head>
<body>
    <?php
    echo "<table align='center' border='1' width='800'>";
    $j=1;
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr><td><div>";
        echo "作者:".$row["name"]."&nbsp&nbsp&nbsp   id:".$row["id"]."<br>";
        echo "信箱:".$row["gmail"]."<br>";
        if($row["sex"]==1){
            echo "男<br>";
        }else{
            echo "女<br>";
        }
        echo "主旨:".$row["subject"]."<br>";
        echo "<button class='del-btn' onclick='Delete(".$row["id"].")'>x</button>";
        echo "<button class='update-btn' onclick='Update(".$row["id"].")'>更改</button>";
        echo "內容<br><textarea name='content' cols='50' rows='5' readonly>".$row["content"]."
            </textarea><br>";
        echo "<img src='".$row["images"]."' width='200px'>";
        $j++;
        echo "</div></td></tr>";
    }
    echo "</table>";
    ?>
   
    <form action="post.php" method="post" enctype="multipart/form-data">
        <table width="800" align="center">
            <tr>
                <td colspan="2" align="center">
                    新增留言
                </td>
            </tr>
            <tr>
                <td width="15">作者</td>
                <td width="85"><input type="text" name="name" size="50"></td>
            </tr>
            <tr>
                <td width="15">gmail</td>
                <td width="85"><input type="text" name="gmail" size="50"></td>
            </tr>
            <tr>
                <td width="15">性別</td>
                <td width="85">
                    男<input type="radio" name="sex" value="1">
                    女<input type="radio" name="sex" value="0">
                </td>
            </tr>
            <tr>
                <td width="15">主旨</td>
                <td width="85"><input type="text" name="subject" size="50"></td>
            </tr>
            <tr>
                <td width="15%">內容</td><br>
                <td width="85"><textarea name="content" cols="50" rows="5"></textarea></td>
            </tr>
            <tr>
                <td width="15">上傳相片</td>
                <td width="85"><input type="file" name="images"></td>
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