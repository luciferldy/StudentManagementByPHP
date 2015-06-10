<?php
/**
 * Created by PhpStorm.
 * User: Maybe霏
 * Date: 2015/6/10
 * Time: 12:50
 */

$name = $_REQUEST["name"];
$password = $_REQUEST["password"];
$re_password = $_REQUEST["confirm_pwd"];
$class = $_REQUEST["class"];
$student_number = $_REQUEST["std_number"];
$sex = $_REQUEST["sex"];
$avatar = "";
$hobby = "";

if(isset($_REQUEST['internet'])){
    $checkbox = $_REQUEST['internet'];
    if(count($checkbox)==0)
        $hobby = "";
    else
    {
        # 将爱好拼接成字符串
        $hobby = $checkbox[0];
        for($i = 1 ; $i < count($checkbox); $i++){
            $hobby .= "#".$checkbox[$i];
        }
    }

}

$grade = $_REQUEST["grades"];
$remark = $_REQUEST["remark"];

# handle password
if($password != $re_password){
    echo "<script>location.href=\"add_stu.html\"</script>";
    return;
}


$db = new SQLite3("student.sqlite");
$update = "update student set name='$name' AND password='$password' AND student.hobby='$hobby' AND student.remark='$remark' WHERE student_number=$student_number;";
$result = $db->exec($update);
if(!$result){
    echo "<script>alert(\"db error\");location.href=\"student_index.php?id=$student_number\"</script>";
}else{
    echo "<script>alert(\"success\");location.href=\"student_index.php?id=$student_number\"</script>";
}

?>