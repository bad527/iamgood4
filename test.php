<?php 
require_once("dbtools.inc.php");
$link=create_connection();
$sql="SELECT * FROM talk ORDER BY id DESC ";
$result=executed_sql($link,"iamgood4",$sql);

//設定每頁顯示幾筆紀錄
$records_per_page=5;
if(isset($_GET["page"])){
    $page=$_GET["page"];
}else{
    $page=1;
}

//計算總紀錄
$total_records=mysqli_num_rows($result);
//計算總頁數
$total_pages=ceil($total_records/$records_per_page);
//計算本頁第一筆紀錄的序號
$started_record=$records_per_page*($page-1);
//將記錄指標移至本頁第一筆紀錄的序號
mysqli_data_seek($result,$started_record);


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
    while($row=mysqli_fetch_assoc($result) and $j<=$records_per_page){
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

    echo "<p align='center'>";

    if($page>1){
        echo "<a href='index.php?page=".($page-1)."'>上一頁</a>";
    }

    for($i=1;$i<=$total_pages;$i++){
        if($i==$page){
            echo "$i";
        }else{
            echo "<a href='index.php?page=$i'>$i</a> ";
        }
    }

    if($page<$total_pages){
        echo "<a href='index.php?page=".($page+1)."'>下一頁</a> ";
    }
    echo "</p>";
    mysqli_free_result($result);
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