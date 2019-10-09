<?php
session_start();
include("pdoInc.php");


if(isset($_POST['login'])){
	echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}
if (isset($_POST['logout'])) {
	echo"<meta http-equiv=REFRESH CONTENT=0;url=logout.php>";
}

if(isset($_GET['del']) && $_SESSION['account'] && $_SESSION['admin'] == 1){
	// echo "del";
    $sth = $dbh->prepare('DELETE FROM dz_thread WHERE id = ? and board_id = ?');
    $sth->execute(array((int)$_GET['del'],(int)$_GET['id']));
    echo
        '<meta http-equiv=REFRESH CONTENT=0;url='.
        basename($_SERVER['PHP_SELF']).'?id='.$_GET['id'].'&articleid='.$_GET['articleid'].'>';
}
if (isset($_POST['backToBoard'])) {
	echo"<meta http-equiv=REFRESH CONTENT=0;url=board.php>";

}


?>


<!DOCTYPE html>
<html>
<head>
	<title>article</title>
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
		.viewBoard{
			width: 1000px;
			margin:130px auto 10px auto; 
			/*background-color: white;*/
		}
		table{
			margin-bottom: 30px;

		}
		.title{

			font-size: 30px;
			line-height: 50px;
			/*color: lightblue;*/

		}
		.titleLabel{
			font-weight:700;
			color: lightcoral;
			/*background-color: white;*/
		}
		.response{
			/*left: 50vw;*/
			position: relative;
			height: 150px; 
			margin-top: 80px;
			/*margin-left: -100px;*/
		}
		.newmsg{
			position: absolute;
			left: 50%;
			margin-left: -500px;
			width: 1000px;
			height: 60px;
			border-radius: 15px;
			font-size: 26px;
			background-color: lightcoral;
			color: white;
			border: none;
		}
		
		
		.content{
			
		}
		.message{
			font-size: 20px;
		}
		.id{
			width: 10%;
			font-weight: 500;
			color: #2894ff;
			vertical-align: top;
			
		}
		.tddel{
			width: 6%;
			vertical-align: top;

		}
		.del{
			font-size: 10px;
			color: grey;
			text-decoration:none;
		}
		.message>table{
			width: 100%;
		}

		.time{
			width: 22%;
			text-align: right;

		}
	</style>
</head>
<body>
<div class="header">
	<form action="viewBoard.php?id=<?php echo (int)$_GET['id'];?>&articleid=<?php echo(int)$_GET['articleid'];?>" method="post" class='greet'>
		<?php
		if (!isset($_SESSION['account'])) {
			echo "<span>Hi, 訪客</span>";
			echo "<button name=\"login\" class='btn'>登入</button> ";
		}
		else {
			echo "<span>Hi, ".$_SESSION['account']." (".$_SESSION['nickname'].")</span>";
			echo "<button name=\"logout\" class='btn'>登出</button> ";
			echo "<button name=\"backToBoard\" class='btn'>回到首頁</button>";
			
		}		
		?>
	</form>
</div>
<div class="viewBoard">
	<table>
	
		<?php
		// echo $_GET['id'];
		if (isset($_GET['id'])&&isset($_GET['articleid'])) {
			$sth=$dbh->prepare('SELECT account,time,title,content from dz_board where board_id=? and id=?');
			$sth->execute(array((int)$_GET['id'],(int)$_GET['articleid']));
			if($sth->rowCount()>0){
				while($row = $sth->fetch(PDO::FETCH_ASSOC)){
					$nn = htmlspecialchars($row['account']);
					$tt = htmlspecialchars($row['title']);
			   		$msg = htmlspecialchars($row['content']);
			    	$msg = str_replace("\n", "<br/>", $msg);
					echo "<tr class='title'>
					<td class='titleLabel' colspan='1'>標題&nbsp&nbsp</td>
					<td >".$tt."</td>
					</tr>";
					echo "<tr class='title'>
					<td class='titleLabel'>作者</td><td>".$nn."</td>
					</tr>";
					echo "<tr class='title'>
					<td class='titleLabel'>時間</td><td>".$row['time']."</td>
					</tr>";
					echo "<tr class='content'>
					<td  colspan='200'><br/>".$msg."</td>
					</tr>";

				}
				
			}

		}
		?>
	</table>
<div class="response">
	<form action="newmsg.php?id=<?php echo (int)$_GET['id'];?>&articleid=<?php echo(int)$_GET['articleid'];?>" method="post">
		
		<button class='newmsg'name='newmsg'>新增回應</button>
	</form>
</div>
<div  class="message">
	<table>
		
<?php 
	if (isset($_GET['id'])&&isset($_GET['articleid'])) {
		
		$sth = $dbh->prepare('SELECT * from dz_thread where board_id=? and article_id=? ORDER BY id');
		$sth->execute(array((int)$_GET['id'],(int)$_GET['articleid']));
		
			while($row = $sth->fetch(PDO::FETCH_ASSOC)){
       			$nn = htmlspecialchars($row['account']);
			    $msg = htmlspecialchars($row['content']);
			    // $msg = str_replace("\n", "<br/>", $msg);
			   if (isset($_SESSION['account'])) {
				    if($_SESSION['admin'] == 1){
			            echo
			                '<tr><td class=\'tddel\'><a href="'.
			                basename($_SERVER['PHP_SELF']).'?id='.$_GET['id'].'&articleid='.$_GET['articleid'].'&del='.$row['id'].
			                '" class=\'del\'>刪除</a></td>';
			        }
			      }
		        echo '<td class=\'id\'>'.
		        $nn.':</td><td class=\'msg\'>'.$msg.
				'</td>
				<td class=\'time\'>'.$row['time'].'</td>
		        </tr>';
		        
		    }
	}

?>
	</table>
</div>
</div>

</body>
</html>
