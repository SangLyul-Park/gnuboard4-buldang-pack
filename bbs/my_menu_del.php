<?
include_once("_common.php");

if (!function_exists("alert_only"))
{
    function alert_only($msg)
    {
        echo "<script language=javascript>alert(\"$msg\");</script>";
        exit;
    }
}

if (!$is_member)
    alert_only("�α��� �� �̿��Ͻ� �� �ֽ��ϴ�.");

if (!$bo_table)
    alert_only("bo_table �� �����ϴ�.");

/*
$row = sql_fetch("select * from $g4[my_menu_table] where bo_table = '$bo_table' and mb_id = '$member[mb_id]'");
if ($row)
    alert_only("��ϵǾ� ���� ���� �ٷΰ����Դϴ�.");
*/

sql_query("delete from $g4[my_menu_table] where mb_id = '$member[mb_id]' and bo_table = '$bo_table'");

goto_url("$g4[bbs_path]/my_menu_edit.php");
?>
