<?
$sub_menu = "300700";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

if ($is_admin != "super")
    alert("������ ������ �ְ�����ڸ� �����մϴ�.");

$g4[title] = "������ ����";

include_once("./admin.head.php");

include_once("./recycle_recover.inc.php");
?>
