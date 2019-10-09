<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_POST['login'])){
	echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}

if (isset($_POST['logout'])) {
	# code...
	echo"<meta http-equiv=REFRESH CONTENT=0;url=logout.php>";
}
if (isset($_POST['revise'])&&isset($_SESSION['account'])) {
	echo"<meta http-equiv=REFRESH CONTENT=0;url=revise.php>";
}
if(isset($_POST['newBoard'])&&$_POST['newBoard']!=null &&$_POST['newBoard']!=''&&$_SESSION['admin']==1){
	// echo "newBoard!!";
	$sql='INSERT INTO board(board) values(?)';
	$sth=$dbh->prepare($sql);
	$sth->execute(array($_POST['newBoard']));
}

?>
<html>
<head>
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
			/*right: 100px;*/
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
		.newBoard{
			position: absolute;
			right:  200px;
			top: 20px;
			/*background-color: white;*/
			line-height: 80px;
			/*vertical-align: top;*/
		}
		input{
			vertical-align: text-bottom;
			width: 200px;
			height: 40px;
			margin: 0 10px;
			border: none;
			border-radius: .2rem;
			padding: 5px 3px;
		}

		table{
			width: 1000px;
			margin:80px auto;
			text-align: center;
			border-collapse:collapse;
			line-height: 60px;

		}

		td{
			border-radius: 10px;
			border-bottom: 3px solid lightgrey;

		}
		a{
			font-size: 35px;
		    text-decoration:none;
		    color: lightcoral;
		    font-weight: 500;

		}
		a:hover{
			color: #2894ff;
		}
		
		
	</style>
</head>
<body>
<div class="header">
	<form action="board.php" method="post" class="greet">
		<?php
		if (!isset($_SESSION['account'])) {
			echo "<span>Hi, 訪客</span>";
			echo "<button name=\"login\" class='btn'>登入</button>";
		}
		else {
			echo "<span>Hi, ".$_SESSION['account']." (".$_SESSION['nickname'].")</span>";
			echo "<button name='logout' class='btn'>登出</button> ";
			echo "<button name='revise' class='btn'>修改帳號資料</button>";
			if ($_SESSION['admin']==1) {
				echo "<span class='newBoard'><input type='text'name='newBoard' placeholder='新增討論板名稱'>";
				echo "<input type='submit' class='btn' value='確定新增'></span>";
			}
		}
		
		
		?>

	</form>
</div>
<div class="board_list">
	<table>
        
<?php
    $sth = $dbh->query('SELECT * from board ORDER BY id');
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        // echo '<a href="viewBoard.php?id='.$row['id'].'">'.$row['title'].'</a><br>';
        echo '<tr>';
        echo '<td>
        <a href="index.php?id='.$row['id'].'">'.$row['board'].'</a>
		</td>
		
        </tr>';
        
    }
?>

</table>
</div>
 
</body></html>
