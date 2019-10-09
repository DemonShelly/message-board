<?php
session_start();
include("pdoInc.php");

if(!isset($_SESSION['account'])){
	die("<meta http-equiv=REFRESH CONTENT=0;url=login.php>");
}
if (isset($_POST['logout'])) {
	echo"<meta http-equiv=REFRESH CONTENT=0;url=logout.php>";
}
if (isset($_POST['backToBoard'])) {
	echo"<meta http-equiv=REFRESH CONTENT=0;url=board.php>";

}

$resultStr = '';
if(isset($_POST['nickname']) && isset($_POST['password'])){
    $sth = $dbh->prepare('SELECT account FROM member WHERE account = ? and password = md5(?)');
    $sth->execute(array($_SESSION['account'], $_POST['password']));

    if($sth->rowCount() == 1){
    	// echo "succees";
        if($_POST['newpwd1'] != '' && $_POST['newpwd2'] != ''){
            if($_POST['newpwd1'] == $_POST['newpwd2']){
                $sth2 =  $dbh->prepare('UPDATE member SET nickname = ?, password = md5(?) WHERE account = ?');
                $sth2->execute(array($_POST['nickname'], $_POST['newpwd1'], $_SESSION['account']));
                $resultStr = '修改暱稱或密碼成功';
                $_SESSION['nickname'] = $_POST['nickname'];
            }
            else {
                $resultStr = '兩次新密碼填寫不同';
            }
        }
        else {
            $sth2 =  $dbh->prepare('UPDATE member SET nickname = ? WHERE account = ?');
            $sth2->execute(array($_POST['nickname'], $_SESSION['account']));
            $_SESSION['nickname'] = $_POST['nickname'];
            $resultStr = '修改暱稱成功';
        }
    }
    else {
        $resultStr = '密碼填寫錯誤';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>revise</title>
	<style type="text/css">
		body{
			background-color: rgb(240,245,243);
			font-size: 25px;
			/*font-family: 'Merriweather', serif;*/
			
		}
		.header{
			background-color: lightgrey;
			position: absolute;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 80px;
		}
		.greet{
			position: relative;
			line-height: 80px;
			left: 100px;

		}
		span{
			margin: 0 10px;
		}
		.btn{
			font-size: 20px;
			width: 150px;
			margin: 0 10px;
			vertical-align: text-bottom;
			border: none;
			border-radius: .5rem;
			padding: 5px 3px;
			background-color: rgb(240,245,243);
			
		}
		
		.container{
			position: relative;
			/*top: 50%;*/
			left: 50%;
			width: 500px;
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
		#revise{
			font-size: 25px;
			width: 500px;
			height: 400px;
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
			left: 30px;
			vertical-align: middle;
			font-weight: 500;
		}
		.labelText{
			text-align: right;
			margin-right: 30px;

		}
		input{

			font-size: 20px;
			border-radius: 5px;
			background-color: white;
			width: 250px;
			height: 40px;
			margin-bottom: 15px;
			border-style: none;
		}

		#submit{
			background-color: wheat;
			font-size: 25px;
			border-radius: 10px;
			width: 450px;
			height: 60px;
			margin-top: 10px ;
			margin-bottom: 15px;
			
		}
		
		#error{
			font-size: 10px;
			color: red;
			padding: 0;
			margin: 0;
		}
	
		
	</style>
</head>
<body>
	<div class="header">
	<form action="board.php" method="post" class="greet">
		<?php
		
			echo "<span>Hi, ".$_SESSION['account']." (".$_SESSION['nickname'].")</span>";
			echo "<button name='logout' class='btn'>登出</button> ";
			echo "<button name='backToBoard' class='btn'>回到首頁</button>";
			
		?>

	</form>
	</div>

	
	 <div class="container">
	 	<div class="title">
			修改資料
		</div>
		<form action="<?php echo basename($_SERVER['PHP_SELF']);?>" method="POST" id='revise'>
		<div class="row">
			<div class="label">帳號</div>
			<div class="labelText">
			<?php echo $_SESSION['account'];?>
		    </div></div>
		<div class="row">
		   	<div class="label">暱稱</div>
		   	<div class="labelText">
		   	<input name="nickname" value="<?php echo $_SESSION['nickname']?>"><br/></div></div>
		<div class="row">	  
		    <div class="label">原密碼</div>
		    <div class="labelText">
		    <input name="password" placeholder="必填"><br/></div></div>
	    <div class="row">
		    <div class="label">修改密碼</div>
		    <div class="labelText">
		    <input name="newpwd1" placeholder="僅修改密碼時需填"><br/></div></div>
	    <div class="row">
		    <div class="label">確認密碼</div>
		    <div class="labelText">
		    <input name="newpwd2" placeholder="僅修改密碼時需填"><br/></div></div>
	    <div id="error">
	    	<?php echo $resultStr;?><br/>
	    </div>
		    <input type="submit" id='submit' value="確定修改">
		</form>
	</div>
	 
	

</body>
</html>