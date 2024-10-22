<?php
require_once("dbtools.inc.php");
$link=create_connection();
$id=$_GET["id"];
$sql="DELETE FROM `talk` WHERE `id`='$id'";
$result=mysqli_query($link,$sql);

header("location:index.php");
mysqli_free_result($result);
mysqli_close($link);
?>