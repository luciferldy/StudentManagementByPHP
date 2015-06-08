<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
</head>
<body></body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: Maybe霏
 * Date: 2015/6/6
 * Time: 9:48
 */

// 表单其他的处理部分
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
        $hobby = $checkbox[0];
        for($i = 1 ; $i < count($checkbox); $i++){
            $hobby = "#".$checkbox[$i];
        }
    }

}

$grade = $_REQUEST["grades"];
$remark = $_REQUEST["remark"];

# handle password
if($password != $re_password){
    echo "<script>alert(\"两次输入的密码不一致\");
                    location.href=\"add_stu.html\";</script>>";
    return;
}

# handle the file
echo $_FILES["file"]["type"];
if (($_FILES["file"]["type"] == "image/jpeg")
    && ($_FILES["file"]["size"] < 1024000))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Stored in: " . $_FILES["file"]["tmp_name"];

        # store the image
        if (file_exists("upload/" . $student_number.".jpg"))
        {
            echo "upload/" . $student_number.".jpg" . " already exists. ";
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp_name"],
                "upload/" . $student_number.".jpg");
            echo "Stored in: " . "upload/" . $student_number.".jpg";
            $avatar = "upload/" . $student_number.".jpg";
        }
    }

}
else
{
    echo "Invalid file";
    return;
}

$db = new SQLite3("student.sqlite");
$insert = "insert into student VALUES ( '$name', '$password', $class, $student_number, '$sex',
 '$hobby', $grade, '$remark', '$avatar');";
$query = "select * from student WHERE student_number = $student_number";

echo $insert;
$result = $db->exec($insert);
if(!$result){
    echo "<script>alert(\"db wrong\")</script>";
}else{
    echo "<script>alert(\"success\")</script>";
}
# 跳转到管理员主页
echo "<script>location.href=\"admin_index.html\";</script>";

?>