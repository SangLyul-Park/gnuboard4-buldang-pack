<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// �ڽŸ��� �ڵ带 �־��ּ���.

// �� ��Ų�� ���� �� bbs/delete.php �� �Ʒ� ��ƾ�� ������ �ʿ䰡 ���� ��쿡�� �Ʒ��� �ּ��� �����ϼ���.
// goto_url("./board.php?bo_table=$bo_table&page=$page" . $qstr);

include_once("$board_skin_path/auction.lib.php");

sql_query(" delete from $tender_table where wr_id = '$wr_id' ");

?>
