<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 


include_once("$board_skin_path/auction.lib.php");

for ($i=count($tmp_array)-1; $i>=0; $i--) 
{
    sql_query(" delete from $tender_table where wr_id = '{$tmp_array[$i]}' ");
}

?>
