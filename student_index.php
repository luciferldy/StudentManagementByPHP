<?php
header("Content-type: text/html; charset=utf-8");
$id = $_REQUEST['id'];
$db = new SQLite3("student.sqlite");
$result = $db->query("select * from student WHERE student_number=$id;");
if(!$result) {
    $db->close();
    echo "<script>alert(\"db wrong\");
                location.href=\"index.html\";</script>";
    return;
}
else{
    $item = $result->fetchArray();
    $db->close();
    # var_dump($item);
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
<form action="update_stu.php" method="post" enctype="multipart/form-data">
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
    <input type="number" name="class" value="<?php echo $item['class'];?>" readonly>
    <br>
    Student Number:
    <input type="text" name="std_number" value="<?php echo $item['student_number'];?>" readonly/>
    <br>
    Sex:<br>
    <input type="text" name="sex" value="<?php echo $item['sex']?>" readonly><br>
    Hobby:<br>
    <?php
        var_dump($item['hobby']);
        $hobby = explode('#', $item['hobby']);
        # var_dump($hobby);

    ?>
    <input type="checkbox" name="internet[]" value="cs"  <?php if(in_array("cs", $hobby)){echo "checked";}?> /> CS
    <br>
    <input type="checkbox" name="internet[]" value="economics" <?php if(in_array("economics", $hobby)){echo "checked";}?> /> Economics
    <br>
    <input type="checkbox" name="internet[]" value="trip" <?php if(in_array("trip", $hobby)){echo "checked";}?> /> Trip
    <br>
    <input type="checkbox" name="internet[]" value="sleep" <?php if(in_array("sleep", $hobby)){echo "checked";}?> /> Sleep
    <br>
    Avatar<br>
    <img src="<?php echo $item['avatar'];?>" />
    <br>
    Grades
    <input type="number" name="grades" min="0" max="100" value="<?php echo $item['grade'];?>" readonly/>
    <br>
    Remark
    <input type="text" name="remark" value="<?php echo $item['remark'];?>" />
    <br>
    <br>
    <input type="submit" value="Update">
    <input type="button" value="返回主页" onclick="return_home()">
</form>
<script type="text/javascript">
    function return_home(){
        location.href = "index.html";
    }
</script>
</body>
</html>