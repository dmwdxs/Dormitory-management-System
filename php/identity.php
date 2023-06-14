<?php
// 获取登录表单提交的用户名和密码
$username = $_POST['username'];
$password = $_POST['password'];

// 连接到MySQL数据库
$servername = "localhost"; // MySQL服务器地址
$dbname = "sushe"; // 数据库名
$dbusername = "root"; // 数据库用户名
$dbpassword = "Wck20040420"; // 数据库密码

// 创建数据库连接
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 执行查询语句
$sql_student = "SELECT * FROM student WHERE sno = '$username'";
$sql_leader = "SELECT * FROM leader WHERE lid = '$username'";
$sql_manager = "SELECT * FROM manager WHERE mno = '$username'";


$result_student = $conn->query($sql_student);
$result_leader = $conn->query($sql_leader);
$result_manager = $conn->query($sql_manager);

// 检查查询结果
if ($result_student->num_rows > 0) {
    // 学生身份验证成功
    $response = array('identity' => 'student');
} else if($result_leader->num_rows > 0) {
    // 领导身份
    $response = array('identity' => 'leader');
} else if($result_manager->num_rows > 0) {
    // 宿管身份
    $response = array('identity' => 'manager');
} else {
    // 其它身份
    $response = array('identity' => 'other');
}

// 关闭数据库连接
$conn->close();

// 返回JSON响应
echo json_encode($response);
?>
