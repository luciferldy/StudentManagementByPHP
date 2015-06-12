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
    <link href="foundation-5.5.0/css/foundation.min.css" rel="stylesheet"/>
    <link href="foundation-5.5.0/css/custom.css" rel="stylesheet" />
</head>
<body>
<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="index.html">Home</a></h1>
        </li>
    </ul>
    <section class="top-bar-section">
        <!-- Right Nav Section -->
    </section>
</nav>
<header>
    <div class="row">
        <div class="large-12 columns">
            <h2>学生主页</h2>
            <h4>可重新填写姓名，密码等进行更新操作</h4>
        </div>
    </div>
</header>
<div class="row">
    <form class="large-4 large-offset-4" action="update_stu.php" method="post" enctype="multipart/form-data">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $item['name'];?>" required/>
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $item['password'];?>" required />
        <label>Confirm Password</label>
        <input type="password" name="confirm_pwd" value="<?php echo $item['password'];?>" required/>
        <label>Class</label>
        <input type="number" name="class" value="<?php echo $item['class'];?>" readonly>
        <label>Student Number</label>
        <input type="text" name="std_number" value="<?php echo $item['student_number'];?>" readonly/>
        <label>Sex</label>
        <input type="text" name="sex" value="<?php echo $item['sex']?>" readonly><br>
        <label>Hobby</label>
        <?php
        # var_dump($item['hobby']);
        $hobby = explode(',', $item['hobby']);
        # var_dump($hobby);
        ?>
        <input id="cs" type="checkbox" name="internet[]" value="cs"  <?php if(in_array("cs", $hobby)){echo "checked";}?> />
        <label for="cs">CS</label>
        <br>
        <input id="economics" type="checkbox" name="internet[]" value="economics" <?php if(in_array("economics", $hobby)){echo "checked";}?> />
        <label for="economics">Economics</label>
        <br>
        <input id="trip" type="checkbox" name="internet[]" value="trip" <?php if(in_array("trip", $hobby)){echo "checked";}?> />
        <label for="trip">Trip</label>
        <br>
        <input id="sleep" type="checkbox" name="internet[]" value="sleep" <?php if(in_array("sleep", $hobby)){echo "checked";}?> />
        <label for="sleep">Sleep</label>
        <br>
        <label>Avatar</label>
        <img class="th" src="<?php echo $item['avatar'];?>" /><br><br>
        <label>Upload</label>
        <input type="file" name="file">
        <br>
        <label>Grades</label>
        <input type="number" name="grades" min="0" max="100" value="<?php echo $item['grade'];?>" readonly required="required">
        <label>Remark</label>
        <textarea name="remark"><?php echo $item['remark'];?></textarea>
        <br>
        <br>
        <input class="small radius button left" type="submit" value="Update">
    </form>
</div>

</body>
</html>