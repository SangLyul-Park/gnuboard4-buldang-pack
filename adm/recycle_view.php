<?
$sub_menu = "300560";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

// �Խ����� ��Ų�� �������� �մϴ�.
$bo = get_board($org_bo_table, "bo_skin");
$board['bo_skin'] = $bo['bo_skin'];

$board_skin_path = "{$g4['path']}/skin/board/{$bo['bo_skin']}"; // �Խ��� ��Ų ���

chdir($g4[bbs_path]);

include_once("../head.sub.php");

include_once("./view.php");

include_once("../tail.sub.php");
?>
