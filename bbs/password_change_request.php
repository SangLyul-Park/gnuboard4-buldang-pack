<?
include_once("./_common.php");

// ��ȸ���� ������ �� ���� ��
if (!$is_member) 
    alert("�������� ���� �Դϴ�. �����ڿ��� �����Ͻñ� �ٶ��ϴ�.");

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";

include_once("./_head.php");
include_once("$member_skin_path/password_change_request.skin.php");
include_once("./_tail.php");
?>
