<?
include_once("./_common.php");

if (!$is_member)
    alert_only("�α��� �� �̿��Ͻ� �� �ֽ��ϴ�.");

if (!$bo_table)
    alert_only("bo_table �� �����ϴ�.");

$row = sql_fetch("select * from $g4[my_menu_table] where bo_table = '$bo_table' and mb_id = '$member[mb_id]'");
if ($row)
    alert_only("�̹� ��ϵǾ� �ֽ��ϴ�.");

sql_query("insert into $g4[my_menu_table] set mb_id = '$member[mb_id]', bo_table = '$bo_table'");

alert_only("\'$board[bo_subject]\'�� ����Ͽ����ϴ�.");

?>
