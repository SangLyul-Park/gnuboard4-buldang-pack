<?
include_once("./_common.php");

// �ҹ������� ������ ��ū����
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

$g4[title] = "�̸��� ����";
include_once("$g4[path]/_head.php");

if ($is_member) {
    $mb_id = $member[mb_id];
} else {
    $mb_id = $_SESSION['email_mb_id'];
    // �α����Ŀ� �̵��� ���̸�
    if ($mb_id) {
        ;
    } else {
        set_session('email_mb_id', "");
        alert("�̸��� ������ ���� �α��� �Ͻñ� �ٶ��ϴ�.", "./login.php?$qstr&url=".urlencode("$_SERVER[PHP_SELF]"));
    }
}
$member = get_member($mb_id);

// �����ڴ� �̸��� �������� ���ϰ� �մϴ�.
if ($is_admin)
    die;

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/email_re_certify.skin.php");

include_once("$g4[path]/_tail.php");
?>
