<?
include_once("./_common.php");

// id�� üũ �մϴ�.
if (!$member[mb_id])
    alert("ȸ���� �ƴմϴ�.");

if ($write[mb_id] !== $member[mb_id])
    alert("�����뿡 �ִ� Ÿ���� ���� ��ȸ�� �� �����ϴ�.");

// �Խ����� ��Ų�� �������� �մϴ�.
$bo = get_board($org_bo_table, "bo_skin");
$board['bo_skin'] = $bo['bo_skin'];

$board_skin_path = "{$g4['path']}/skin/board/{$bo['bo_skin']}"; // �Խ��� ��Ų ���

chdir($g4[bbs_path]);

include_once("../head.sub.php");

include_once("./view.php");

include_once("../tail.sub.php");
?>
