<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>管理员查找学生</title>
</head>
<body>
<h2>管理员查找学生</h2>
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
        echo $item['name']."<br>";
    }
}
$db->close();
?>
</body>
</html>