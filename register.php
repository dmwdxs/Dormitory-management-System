<?php
	header("content-type:text/html;charset=utf-8");
	//连接数据库
	$link = mysqli_connect("localhost", "root", "Wck20040420", "sushe");
	if (!$link) {
		die("连接失败: " . mysqli_connect_error());
	}
	//接收$_POST用户名和密码
	$username=$_POST['userName'];
	$password=$_POST['passWord'];
	//查看表user用户名是否存在或为空
	$sql_select = "SELECT * FROM user WHERE username = '$username'";
	//result必需规定由 mysqli_query()、mysqli_store_result() 或 mysqli_use_result() 返回的结果集标识符。
	$select = mysqli_query($link,$sql_select);
	$num = mysqli_num_rows($select);//函数返回结果集中行的数量
	if($username == "" || $password == "")
	{
		echo "请确认信息完整性";
	}else if($num){
		echo "已存在用户名";//已存在账户名输出错误
	}else{
			$sql="insert into user(username,password) values('$username','$password')";
			$result=mysqli_query($link,$sql);
			//判断是否注册后显示内容
			if(!$result)
			{
				echo "注册不成功！";//输出错误
			}
			else
			{
				echo "注册成功!";//输出成功
			}
		}
	
?>