<?php
/**
 * Created by PhpStorm.
 * User: Maybe霏
 * Date: 2015/6/8
 * Time: 8:26
 */
#sqlite test
//$db = new SQLite3("student.sqlite");
//$query = "select * from admin WHERE user_name='liandongyang' AND password=123";
//echo $query;
//$result = $db->query($query);
//while($item = $result->fetchArray()){
//    var_dump($item);
//}
//echo ($result);
//
//$query = "select * from admin WHERE user_name='handeyong' AND password=123";
//$result = $db->query($query);
//while($item = $result->fetchArray()){
//    var_dump($item);
//}
//echo is_null($result);
//return;

$user_name = $_REQUEST['user_name'];
$password = $_REQUEST['password'];
$level = $_REQUEST['level'];
if($level=="administrator")
{
    $db = new SQLite3("student.sqlite");
    $query = "select * from admin WHERE user_name='$user_name' AND password='$password'";
    $result = $db->query($query);
    if(!$result){
        echo "<script>alert(\"db wrong\")</script>";
        echo "<script>location.href=\"index.html\";</script>";
    }else{
        $item = $result->fetchArray();
        if($item){
            echo "<script>alert(\"success\")</script>";
            echo "<script>location.href=\"admin_index.html\";</script>";
        }else{
            echo "<script>alert(\"no this one\")</script>";
            echo "<script>location.href=\"index.html\";</script>";
        }
    }
}else{

    $db = new SQLite3("student.sqlite");
    $query = "select * from student WHERE student_number=$user_name;";
    $result = $db->query($query);
    if(!$result){
        echo "<script>alert(\"db wrong\")</script>";
        echo "<script>location.href=\"index.html\";</script>";
    }else{
        $item = $result->fetchArray();
        if($item){
            echo "<script>alert(\"success\")</script>";
            echo "<script>location.href=\"student_index.php?id=$user_name\";</script>";
        }else{
            echo "<script>alert(\"no this one\")</script>";
            echo "<script>location.href=\"index.html\";</script>";
        }

    }
}


?>