<?php
$id = $_REQUEST['id'];
$db = new SQLite3("student.sqlite");
$result = $db->query("select * from student WHERE student_number=$id;");
if(!$result) {
    echo "<script>alert(\"db wrong\");
                location.href=\"index.html\";</script>";
    return;
}
else{
    $item = $result->fetchArray();
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>学生主页</title>
</head>
<body>
<h2>学生主页</h2>
<form action="add_stu.php" method="post" enctype="multipart/form-data">
    Name:
    <input type="text" name="name" value="<?php echo $item['name'];?>" required/>
    <br>
    Password:
    <input type="password" name="password" value="<?php echo $item['password'];?>" required />
    <br>
    Confirm Password:
    <input type="password" name="confirm_pwd" value="<?php echo $item['password'];?>" required/>
    <br>
    Class:
    <select name="class">
        <?php
        for($i = 1; $i<=2 ; $i++){
            if($item['class']==$i)
                echo "<option name=\"$i\" value=\"$i\" selected=\"selected\">$i</option>";
            else
                echo "<option name=\"$i\" value=\"$i\">$i</option>";
        }
        ?>
    </select>
    <br>
    Student Number:
    <input type="text" name="std_number" value="<?php echo $item['student_number'];?>" required/>
    <br>
    Sex:<br>
    <input type="radio" name="sex" value="female" checked="checked"/> Female<br>
    <input type="radio" name="sex" value="male" /> Male<br>
    Hobby:<br>
    <input type="checkbox" name="internet[]" value="cs"/> CS
    <br>
    <input type="checkbox" name="internet[]" value="economics"/> Economics
    <br>
    <input type="checkbox" name="internet[]" value="trip"/> Trip
    <br>
    <input type="checkbox" name="internet[]" value="sleep"/> Sleep
    <br>
    Avatar<br>
    <input type="image" name="file" src="<?php echo $item['avatar'];?>">
    <br>
    Grades
    <input type="number" name="grades" min="0" max="100" value="<?php echo $item['grade'];?>" />
    <br>
    Remark
    <input type="text" name="remark" value="<?php echo $item['remark'];?>" />
    <br>
    <br>
    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
    <input type="button" value="返回主页" onclick="return_home()">
</form>
<script type="text/javascript">
    function return_home(){
        location.href = "index.html";
    }
</script>
</body>
</html>