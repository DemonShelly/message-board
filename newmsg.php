<?php
session_start();
include('pdoInc.php');

if(!isset($_SESSION['account'])){
	die("<meta http-equiv=REFRESH CONTENT=0;url=login.php>");
}
if (isset($_POST['logout'])) {
	echo"<meta http-equiv=REFRESH CONTENT=0;url=logout.php>";
}
if (isset($_POST['backToBoard'])) {
	echo"<meta http-equiv=REFRESH CONTENT=0;url=board.php>";

}

$result = '';	
if (isset($_GET['id'])&&isset($_GET['articleid'])&&isset($_POST['submit'])&&isset($_POST['content'])) {
	if (empty($_POST['content'])||trim($_POST['content']) == '') {
		$result = "請填入內容";
	}
	else{
	    $sth = $dbh->prepare(
	        'INSERT INTO dz_thread (board_id, article_id, account, content, ip) VALUES (?, ?, ?, ?, ?)');
	    $sth->execute(array(
	        (int)$_GET['id'],
	        (int)$_GET['articleid'],
	        $_SESSION['account'],
	        $_POST['content'],
	        $_SERVER['REMOTE_ADDR']
	    ));
	    echo
	        '<meta http-equiv=REFRESH CONTENT=0;url=viewBoard.php?id='.(int)$_GET['id'].'&&articleid='.(int)$_GET['articleid'].'>';
		    
	}	
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>newMessange</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			background-color: rgb(240,245,243);
			font-size: 25px;

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
		button{
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
			width: 1000px;
			margin:100px auto;
			line-height: 60px;
			color:lightcoral;
		}
		input[type='submit']{
			background-color: wheat;
			font-size: 25px;
			border-radius: 10px;
			width: 1000px;
			height: 60px;
			margin-top: 10px ;
			margin-bottom: 15px;
			
		}
		.inputtext{
			border-radius: .2rem;
			/*border-style: none;*/
			border-color: lightgrey;
			width: 1000px;	
		}
		#error{
			font-size: 10px;
			color: red;
			width: 100%;
			text-align: center;
		}
		
	</style>
</head>
<body>
<div class="header">
	<form action="newmsg.php?id=<?php echo (int)$_GET['id'];?>&articleid=<?php echo(int)$_GET['articleid'];?>" method="post" class='greet'>
		
		<?php
		
			echo "<span>Hi, ".$_SESSION['account']." (".$_SESSION['nickname'].")</span>";
			echo "<button name=\"logout\">登出</button> ";
			echo "<button name=\"backToBoard\" class='btn'>回到首頁</button>";
		
		?>
				
	</form>
</div>
<form action="newmsg.php?id=<?php echo (int)$_GET['id'];?>&articleid=<?php echo(int)$_GET['articleid'];?>" method="post">
	<div class="container">
		
		<div class="content">
			回應內容<br/>
			<textarea name="content" rows="30" class="inputtext" required="required"></textarea>
		</div>
		<div id="error">
			<?php echo $result; ?>
		</div>
			<input type="submit" name="submit" value="送出回應">
	</div>
</form>
</body>
</html>