104405011 �s�q�| �d�f��

�@�B�U��{�����D�n�γ~
pdoInc.php:�s����Ʈw
login.php:�n�J����
logout.php:�n�X�b��
register.php:���U�s�b��
revise.php:�ק�b����ơ]�i�ק�ʺ٩M�K�X�^
board.php:�C�X�U�ӬݪO
index.php:�C�X�U�ӬݪO�U���峹
viewBoard.php:�C�X�峹���e�M���U���^��
newArticle.php:�s�W�ݪO�����峹
newmsg.php:�s�W�峹�����^��

�G�B�������[���\��
�޲z���i�H�R���D�D�M��@�^��
�޲z���i�ʺA�}�O

�T�B �p���קK�ۦP���b�����U(�A�i�H���]���|���h�H�X�G�P�ɵ��U) 
�b�ϥΪ̵��U�b���ɡA��select�y�y�d�ߦb��Ʈw���O�_�w�g���@�˪��b���A�p�GrowCount() == 1�A�N��w�g���ۦP���b���s�b�A�K�|���X���~�T���C

�|�B �p���קK���n�J���o��
�ϥ�isset($_SESSION['account'])�d�ݨϥΪ̬O�_�w�g�n�J�A�Y�|���n�J�K����ܷs�W�峹������C���~�A�bnewArticle.php�Bnewmsg.php���{�����]��J�H�U�{�����ˬd�A�Y���n�J�h�ഫ�ܵn�J�����C
if(!isset($_SESSION['account'])){
	die("<meta http-equiv=REFRESH CONTENT=0;url=login.php>");
}
���B �R���\��p�󱱺��v��
�b�s��b����ƪ���ƪ��s�Wadmin�����A�Y���޲z��admin=1�A�Y���@��ϥΪ�admin=0�C�b�{�����ϥ�if($_SESSION['admin'] == 1)�ӧP�_�O�_���޲z�������A�Y���޲z�������~��R���峹�P�^���C
