<?
// SMS4 ����
include_once("./_common.php");

include_once("$g4[path]/_head.php");

if ($is_admin || ($config[cf_sms4_member] && $member[mb_level] >= $config[cf_sms4_level])) {
    ;
} else {
    die("sms4�� ������ �� �����ϴ�. �ڼ��� ���� ��ڿ��� �����Ͻñ� �ٶ��ϴ�.");
}
?>

<iframe src='write.php?mb_id=<?=$mb_id?>' name=member_sms width=100% height=500 border=0 frameborder=0></iframe>

<?
include_once("$g4[path]/_tail.php");
?>