<?
include_once("./_common.php");

// ��ȸ���� ������ �� ���� ��
if (!$is_member) 
    alert("�������� ���� �Դϴ�. �����ڿ��� �����Ͻñ� �ٶ��ϴ�.");

// ��й�ȣ �����ֱ⸦ reset �մϴ�.
// ������ �ڵ尡 bbs/register_form_update.php�� �ֽ��ϴ�.
$next_change = $g4[server_time] + ($config['cf_password_change_dates'] * 24 * 60 * 60);
$next_date = date('Y-m-d h:i:s', $next_change);

$sql = " update $g4[member_table] set mb_password_change_datetime = '$next_date' where mb_id = '$member[mb_id]'";
sql_query($sql);

if ($url)
    goto_url($url);
else
    goto_url("$g4[path]");
?>
