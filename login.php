<?php
session_start();
include('pdoInc.php');
?>

<?php
$result='';
if(isset($_SESSION['account'])&& $_SESSION['account']!=null){
	echo '<meta http-equiv=REFRESH CONTENT=0;url=board.php>';
}
if(isset($_POST['visit'])){
	echo '<meta http-equiv=REFRESH CONTENT=0;url=board.php>';
}

else if (isset($_POST['register'])) {
	die ("<meta http-equiv=REFRESH CONTENT=0;url=register.php>");
}

else if(isset($_POST['account'])&&isset($_POST['password'])){
	$acc = preg_replace("/[^A-Za-z0-9]/","", $_POST['account']);
	$pwd = preg_replace("/[^A-Za-z0-9]/", "", $_POST['password']);
	// echo $acc.$pwd;
	if ($acc !=null && $pwd != null) {
		
		$sth = $dbh->prepare('SELECT account,password,nickname,admin From member where account=?');
		$sth->execute(array($acc));
		$row = $sth->fetch(PDO::FETCH_ASSOC);

	

		if ($row['password']== md5($pwd)) {
			
			$_SESSION['admin'] = $row['admin'];
			
			$_SESSION['account'] = $row['account'];
			$_SESSION['nickname'] = $row['nickname'];
			echo "<meta http-equiv=REFRESH CONTENT=0;url=board.php>";
		}
		elseif ($row['password']!= md5($pwd)) {
			
			$result="帳號密碼輸入錯誤";
		}
		
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<style type="text/css">
		body{
			background-color: rgb(240,245,243);
			font-size: 20px;
			/*font-family: 'Merriweather', serif;*/
			
		}
		.container{
			position: relative;
			/*top: 50%;*/
			left: 50%;
			width: 400px;
			height: 340px;
			margin:100px 0 0 -200px;
			text-align: center;
		}
		.title{
			font-size: 50px;
			color: lightcoral;
			font-weight: bolder;
			margin: 10px auto;
			text-align: center;
			
		}
		.login{
			font-size: 25px;
			/*background-color: lightgrey;*/
			width: 400px;
			height: 340px;
			border-radius: 20px;
			padding-top:30px;
			padding-bottom: 30px; 
		}
		button,#submit{
			background-color: rgb(235,240,235);
			border-color: lightgrey;
			font-size: 25px;
			border-radius: 10px;
			padding: 5px 10px;
			margin-top: 0px ;
			margin-bottom: 15px;
			width: 320px;

		}
		#submit{
			background-color: wheat;
			border-color: wheat;
			
			
		}
		#account,#password{
			border-radius: 5px;
			background-color: white;
			width: 250px;
			height: 40px;
			margin-bottom: 15px;
			/*border-style: none;*/
			border-color: white;


		}
		#error{
			font-size: 10px;
			color: red;
			padding: 0;
			margin: 0;
		}
		

			
		/*.header{
			width: 100vw;
			margin: auto;
		}*/
		
		
	</style>
</head>
<body>
<div class="container">
	<div class="title">
		留言版
	</div>
	<div class="login">
		<form action="login.php" method="post">
			帳號&nbsp<input type="text" id='account' name='account'><br/>
			密碼&nbsp<input type="password" id='password' name="password"><br/>
			<div id='error'>
				<?php
				echo $result.'<br/>';
				?>
			</div>
			<input type="submit" id='submit' value="登入"><br/>
			<button id='visit' name="visit">以訪客身份瀏覽</button><br/>
			<button id='register' name="register">註冊新帳號</button><br/>
			<!-- <?php
			echo $result.'<br/>';
			?> -->
		</form>
	</div>
</div>
</body>
</html>