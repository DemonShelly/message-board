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
$result='';
if (isset($_POST['submit'])&&isset($_POST['title'])&&isset($_POST['content'])) {	
	$title = $_POST['title'];
	$content = $_POST['content'];
	if (empty($title)||empty($content)||trim($title) == ''||trim($content) == '') {
		$result = "請填入標題與內容";
	}
	// if ($title==null || $content==null) {
	// 	$result = '請填入標題與內容';
	// }
	else {
	
    $sth = $dbh->prepare(
        'INSERT INTO dz_board (board_id, account, title, content, ip) VALUES (?, ?, ?, ?, ?)');
    $sth->execute(array(
    	$_GET['id'],
    	$_SESSION['account'],
        $_POST['title'],
        $_POST['content'],
        $_SERVER['REMOTE_ADDR']
    ));
    echo
        '<meta http-equiv=REFRESH CONTENT=0;url=index.php?id='.$_GET['id'].'>';
	    }
	}


?>



<!DOCTYPE html>
<html>
<head>
	<title>newArticle</title>
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
		.inputtitle{
			width: 1000px;
			height: 50px;
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
	<form action="newArticle.php?id=<?php echo (int)$_GET['id'];?>" method="post" class='greet'>
		
		<?php
		
			echo "<span>Hi, ".$_SESSION['account']." (".$_SESSION['nickname'].")</span>";
			echo "<button name=\"logout\">登出</button> ";
			echo "<button name=\"backToBoard\" class='btn'>回到首頁</button>";
		
			
		?>
		
		
	</form>
</div>
<div class="container">
<form action="newArticle.php?id=<?php echo (int)$_GET['id'];?>" method="post">
	<div class="article">
		<div class="title">
			標題<br/>
			<input type="text" name="title" class="inputtitle"required="required"  >
		</div>
		<div class="content">
			文字內容<br/>
			<textarea name="content"  rows="30" class="inputtext" required="required" ></textarea>
		</div>
		<div id="error"><?php echo$result; ?></div>
			<input type="submit" name="submit" value="發表文章">
	</div>
</form>
</div>
</body>
</html>