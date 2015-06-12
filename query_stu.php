<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>管理员查找学生</title>
    <link href="foundation-5.5.0/css/foundation.min.css" rel="stylesheet">
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
        <!-- Left Nav Section -->
        <ul>
            <li><a href="add_stu.html">Add Student</a></li>
            <li><a href="query_stu.html">Query Student</a></li>
        </ul>
        <!-- Right Nav Section -->
        <ul class="right">
            <li><a href="https://github.com/MaybeMercy/StudentManagementByPHP">Fork me on GitHub</a></li>
        </ul>
    </section>
</nav>
<header>
    <div class="row">
        <div class="large-12 columns">
            <h2>查询结果</h2>
        </div>
    </div>
</header>
<div class="row">
    <table class="large-12">
        <thead>
        <tr>
            <th>Avatar</th>
            <th>Name</th>
            <th>Class</th>
            <th>Student Number</th>
            <th>Sex</th>
            <th>Hobby</th>
            <th>Grade</th>
            <th>Remark</th>
        </tr>
        </thead>
        <tbody>
<?php
/**
 * Created by PhpStorm.
 * User: Maybe霏
 * Date: 2015/6/8
 * Time: 9:06
 */
header("Content-type: text/html; charset=utf-8");
# false 表示之前没有判断条件
$has_position = false;
$query = "select * from student";
if(isset($_REQUEST['name']) && $_REQUEST['name']!=null) {
    # 之前有判断条件，需要加AND
    if ($has_position)
        $query .= " AND ";
    # 没有判断条件，不需要加AND
    else{
        $has_position = true;
        $query .= " WHERE ";
    }

    $query .=  "name='" . $_REQUEST['name'] . "'";
}
if(isset($_REQUEST['class'])){
    if($_REQUEST['class']!=0){
        if ($has_position)
            $query .= " AND ";
        else{
            $has_position = true;
            $query .= " WHERE ";
        }
        $query .=  "class=" . $_REQUEST['class'];
    }
}
if(isset($_REQUEST['stu_number']) && $_REQUEST['stu_number']!=null) {
    if ($has_position)
        $query .= " AND ";
    else{
        $has_position = true;
        $query .= " WHERE ";
    }
    $query .= "student_number=" . $_REQUEST['stu_number'];
}
if(isset($_REQUEST['sex'])) {
    if ($has_position)
        $query .= " AND ";
    else{
        $has_position = true;
        $query .= " WHERE ";
    }
    $query .= "sex='" . $_REQUEST['sex'] . "'";
}
# hobby
if(isset($_REQUEST['internet'])){
    $checkbox = $_REQUEST['internet'];
}
# grade
if(isset($_REQUEST['grade']) && $_REQUEST['grade'] != null){
    if($has_position)
        $query .= " AND ";
    else{
        $has_position = true;
        $query .= " WHERE ";
    }
    $query .= "grade=" . $_REQUEST;
}

$db = new SQLite3("student.sqlite");
echo $query;
$result = $db->query($query);
if(!$result){
    echo "db error";
}else{
    while($item = $result->fetchArray()){
        $tr = "<tr>";
        $tr .= "<td class='large-1'><img src=".$item['avatar']."></td>";
        $tr .= "<td>".$item['name']."</td>";
        $tr .= "<td>".$item['class']."</td>";
        $tr .= "<td>".$item['student_number']."</td>";
        $tr .= "<td>".$item['sex']."</td>";
        $tr .= "<td>".$item['hobby']."</td>";
        $tr .= "<td>".$item['grade']."</td>";
        $tr .= "<td>".$item['remark']."</td>";
        $tr .= "</tr>";
        echo $tr;
    }
}
$db->close();
?>
        </tbody>
    </table>
</div>
</body>
</html>