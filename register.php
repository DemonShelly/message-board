<?php
session_start();
include('pdoInc.php');
$result='';
// $acc='';
if(isset($_SESSION['account'])&& $_SESSION['account']!=null){
	echo '<meta http-equiv=REFRESH CONTENT=0;url=board.php>';
}
if (isset($_POST['back'])) {
	echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}
else if (isset($_POST['nickname'])&&isset($_POST['account'])&&isset($_POST['password'])&&isset($_POST['passwordchk'])) {

	if (preg_match('/^[\p{Han}\w]{1,8}$/u', $_POST['nickname'], $match)) {
		$name = $match[0];
		if (preg_match('/^[a-zA-Z0-9_]{1,8}$/', $_POST['account'], $match)) {
			$acc = $match[0];
			if (preg_match('/^[a-zA-Z0-9_]{1,16}$/', $_POST['password'], $match)) {
				$pwd = $match[0];
				if (preg_match('/^[a-zA-Z0-9_]{1,16}$/', $_POST['passwordchk'],$match)) {
					$pwdchk = $match[0];
					if ($pwd != $pwdchk) {
						$result="兩次密碼輸入不一致";
					}

					else{
						$sql = 'SELECT * from member where account=?';
						$sth = $dbh->prepare($sql);
						$sth->execute(array($acc));
						if($sth->rowCount() == 1){
							$result="已存在此帳號";
						}
						else{
							$sth = $dbh->prepare('INSERT INTO member(account,password,nickname,admin) VALUES(?,?,?,?)');
							$sth->execute(array($acc,md5($pwd),$name,0));
							$row = $sth->fetch(PDO::FETCH_ASSOC);
							echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
						}
					}
					
				}
				else{
					$result="兩次密碼輸入不一致";
				}
			}
			else{
				$result='密碼不符合格式';
			}

		}
		else{
			$result='帳號不符合格式';
		}
	}
	else{
		$result='暱稱不符合格式';
	}
	
	// else  {
		
	// 	$sth = $dbh->prepare('INSERT INTO member(account,password,nickname,admin) VALUES(?,?,?,?)');
	// 	$sth->execute(array($acc,md5($pwd),$name,0));
	// 	$row = $sth->fetch(PDO::FETCH_ASSOC);
	// 	echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
	// }
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>register</title>
	<style type="text/css">
	body{
			background-color: rgb(240,245,243);
			font-size: 25px;
		}
		
		.container{
			position: relative;
			/*top: 50%;*/
			left: 50%;
			width: 550px;
			height: 420px;
			margin:100px 0 0 -250px;
			text-align: center;
		}
		.title{
			font-size: 50px;
			color: lightcoral;
			font-weight: bolder;
			margin: 10px auto;
			text-align: center;
			/*height: 300px;  */
		}
		form{
			font-size: 25px;
			/*background-color: lightgrey;*/
			width: 550px;
			height: 420px;
			border-radius: 20px;
			padding-top:30px;
			padding-bottom: 30px; 
		}
		.row{
			position: relative;
			height: 60px;
			line-height: 60px;
		}

		.label{
			display: inline-block;
			position: absolute;
			left: 50px;
			vertical-align: middle;
			font-weight: 500;
		}
		.labelText{
			text-align: right;
			margin-right: 50px;

		}
		input{
			font-size: 20px;
			border-radius: 5px;
			background-color: white;
			width: 280px;
			height: 40px;
			margin-bottom: 15px;
			border-style: none;
			/*border-color: lightgray;*/
		}

		#submit,button{
			background-color: wheat;
			font-size: 25px;
			border-radius: 10px;
			width: 450px;
			height: 60px;
			margin-top: 10px ;
			margin-bottom: 10px;
			border-color: lightgray;
			
		}

		button{
			background-color: rgb(235,240,235);
			margin-top: 5px ;
	
		}
		#error{
			font-size: 10px;
			color: red;
		}

	</style>

</head>
<body>
	
<div class="container">
	<div class="title">
		註冊新帳號
	</div>
	<form action="register.php" method="post">
		<div class="row">
			<div class="label">
				暱稱</div>
			<div class="labelText">
				<input type="text" name="nickname" placeholder="8字內的中英文數字底線" ></div>
		</div>
		<div class="row">
			<div class="label">	
				新增帳號</div>
			<div class="labelText">
				<input type="text" name='account' placeholder="8字內的英文數字底線" ></div>
		</div>
		<div class="row">
			<div class="label">
				輸入密碼</div>
			<div class="labelText">
				<input type="text" name="password" placeholder="16字內的英文數字底線" ></div>
		</div>
		<div class="row">
			<div class="label">
				確認密碼</div>
			<div class="labelText">
				<input type="text" name="passwordchk" placeholder="再輸入一次密碼" ></div>
		</div>
		<div id="error">
			<?php echo $result;?><br/>
		</div>
			<input id='submit' type="submit" value="註冊">
			<button name='back'>返回登入頁</button>
	</form>
</div>
</body>
</html>

