<?
include_once("./_common.php");

if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

$g4[title] = "ȸ�� ������õ�ϱ�";
include_once("$g4[path]/_head.php");

$mb_id = $member[mb_id];
if ($mb_id == "" or !$is_member)
    die("���α׷� ���� : 101");

$join_no = (int) $join_no;

switch($w) {
    case "d"  : 
                $sql = " delete from $g4[member_suggest_table] where mb_id='$mb_id' and join_no='$join_no' and join_datetime='0000-00-00 00:00:00' ";
                sql_query($sql);
                break;
    case "r"  : 
                $sql = " update $g4[member_suggest_table] set suggest_datetime='$g4[time_ymdhis]' where mb_id='$mb_id' and join_no='$join_no' and join_datetime='0000-00-00 00:00:00' ";
                sql_query($sql);
                break;
    default   : die("���α׷� ���� : 101");
}

goto_url("./index.php");

include_once("$g4[path]/_tail.php"); 
?>