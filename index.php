<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_POST['login'])){
	echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}
if (isset($_POST['logout'])) {
	echo"<meta http-equiv=REFRESH CONTENT=0;url=logout.php>";
}
if (isset($_POST['backToBoard'])) {
	echo"<meta http-equiv=REFRESH CONTENT=0;url=board.php>";

}
if (isset($_SESSION['account'])&&isset($_GET['id']) && isset($_POST['newArticle'])) {	
	echo"<meta http-equiv=REFRESH CONTENT=0;url=newArticle.php?id=".$_GET['id'].">";
}
if(isset($_GET['del']) && $_SESSION['account'] && $_SESSION['admin'] == 1){
	// echo "del";
    $sth = $dbh->prepare('DELETE FROM dz_board WHERE  board_id = ? and id = ?');
    $sth->execute(array((int)$_GET['id'],(int)$_GET['del']));
    echo
        '<meta http-equiv=REFRESH CONTENT=0;url='.
        basename($_SERVER['PHP_SELF']).'?id='.$_GET['id'].'>';
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
		
		table{
			width: 1000px;
			margin:80px auto;
			/*text-align: center;*/
			border-collapse:collapse;
			line-height: 60px;

		}

		td{
			border-radius: 10px;
			border-bottom: 3px solid lightgrey;

		}
		.account{
			width: 10%;
			
		}
		.tddel{
			width: 6%;
		}
		a{
			font-size: 30px;
		    text-decoration:none;
		    color: lightcoral;
		    font-weight: 500;

		}
		a:hover{
			color: #2894ff;
		}

		.del{
			/*width: 28%;*/
			font-size: 10px;
			color: grey;
		}		
	</style>
</head>
<body>

<div class="header">
	<form action="index.php?id=<?php echo (int)$_GET['id'];?>" method="post" class='greet'>
		
		<?php
		if (!isset($_SESSION['account'])) {
			echo "<span>Hi, 訪客</span>";
			echo "<button name=\"login\">登入</button> ";
		}
		else {
			echo "<span>Hi, ".$_SESSION['account']." (".$_SESSION['nickname'].")</span>";
			echo "<button name=\"logout\">登出</button> ";
			echo "<button name=\"backToBoard\" class='btn'>回到首頁</button>";
			echo "<button name=\"newArticle\">新增文章</button>";

			
		}		
		?>
		
		
	</form>
</div>

<div class="board_content">
	<table>
        
<?php
    $sth = $dbh->prepare('SELECT * from dz_board where board_id = ? ORDER BY id');
    $sth->execute(array((int)$_GET['id']));
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        
        echo '<tr>';
        if (isset($_SESSION['account'])) {
        	if($_SESSION['admin'] == 1){
            echo
                '<td class=\'tddel\'><a href="'.
                basename($_SERVER['PHP_SELF']).'?id='.$_GET['id'].'&del='.$row['id'].
                '" class=\'del\'>刪除</a></td>';
        }}
        $nn = htmlspecialchars($row['account']);
		$tt = htmlspecialchars($row['title']);
   		
        echo '<td>
        <a href="viewBoard.php?id='.$_GET['id'].'&articleid='.$row['id'].'">'.$tt.'</a>
		</td>
		<td class=\'account\'>'.$nn.'</td>
        </tr>';
        
    }
?>

</table>
</div>
 
</body></html>