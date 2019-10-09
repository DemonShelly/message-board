
一、各支程式的主要用途
pdoInc.php:連接資料庫
login.php:登入頁面
logout.php:登出帳號
register.php:註冊新帳號
revise.php:修改帳號資料（可修改暱稱和密碼）
board.php:列出各個看板
index.php:列出各個看板下的文章
viewBoard.php:列出文章內容和底下的回應
newArticle.php:新增看板內的文章
newmsg.php:新增文章內的回應

二、有做的加分功能
管理員可以刪除主題和單一回應
管理員可動態開板

三、 如何避免相同的帳號註冊(你可以假設不會有多人幾乎同時註冊) 
在使用者註冊帳號時，用select語句查詢在資料庫中是否已經有一樣的帳號，如果rowCount() == 1，代表已經有相同的帳號存在，便會跳出錯誤訊息。

四、 如何避免未登入的發表
使用isset($_SESSION['account'])查看使用者是否已經登入，若尚未登入便不顯示新增文章的按鍵。此外，在newArticle.php、newmsg.php兩支程式內也放入以下程式來檢查，若未登入則轉換至登入頁面。
if(!isset($_SESSION['account'])){
	die("<meta http-equiv=REFRESH CONTENT=0;url=login.php>");
}
五、 刪除功能如何控管權限
在存放帳號資料的資料表中新增admin的欄位，若為管理員admin=1，若為一般使用者admin=0。在程式內使用if($_SESSION['admin'] == 1)來判斷是否為管理員身份，若為管理員身份才能刪除文章與回應。
