<?
include_once("./_common.php");

include_once("$g4[path]/head.sub.php");

if (!$member[mb_id]) 
    alert_close("ȸ���� �Ű����� �� �� �ֽ��ϴ�.", "login.php?url=".urlencode("$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id=$wr_id"));

// �Ű��� �� �ִ� ȸ���� ����Ʈ �������� ���ٸ�
if (!isset($config[cf_unsingo_point])) $config[cf_unsingo_point] = 6000;
if ($member[mb_point] < $config[cf_unsingo_point])
    alert_close("ȸ������ ����Ʈ�� ".number_format($config[cf_unsingo_point])."�� �̻��̾�� �Ű����� �� �� �ֽ��ϴ�.");

if ($member[mb_id]==$write[mb_id])
    alert_close("�ڽ��� �Խù��� �Ű����� �� �� �����ϴ�.");

if ($member['mb_level'] < $board['bo_comment_level'])
    alert_close("�ڸ�Ʈ ���� ������ �ִ� ȸ���� �Խñ��� �Ű����� �� �� �ֽ��ϴ�.");

$mb = get_member($write[mb_id], "mb_level");
if ($mb[mb_level] > $member[mb_level])
    alert_close("�ڽź��� ������ ���� ȸ���� �Խù��� �Ű����� �� �� �����ϴ�.");

// �Ϸ��� �Ű����� �Ǽ��� ������ �����ϴ�.
/*
if (!isset($config[cf_singo_today_count])) $config[cf_singo_today_count] = 3;
$sql = " select count(*) from $g4[singo_table] 
          where sg_mb_id = '$member[mb_id]' and left(sg_datetime,10)='$g4[time_ymd]' ";
$row = sql_fetch($sql);
if ($row[cnt] >= $config[cf_singo_today_count])
    alert_close("�Ű�� �Ϸ翡 {$config[cf_singo_today_count]}ȸ�� �����մϴ�.");
*/

// hidden_comment ���̺��� ��б� �������� assign �� �� �Դϴ�. �Խ��� �̸����� ����������
if ($bo_table == 'hidden_comment') {
}
else
{
$write_table = $g4['write_prefix'].$bo_table;
$sql = " select wr_is_comment, wr_subject, mb_id from $write_table where wr_id = '$wr_id' and wr_parent = '$wr_parent' ";
$row = sql_fetch($sql);
if (!is_array($row))
    alert_close("�Ű����� �� �Խù��� �����ϴ�.");

$write[wr_subject] = $row[wr_subject];

if ($row[wr_is_comment]) {
    $sql = " select wr_subject from $write_table where wr_id = '$wr_parent' ";
    $row = sql_fetch($sql);
    if (!$row)
        alert_close("�Ű����� �� �Խù��� �����ϴ�..");

    $write[wr_subject] = "[��] ".$row[wr_subject];
}
} // end of if

$wr_subject = get_text(cut_str($write[wr_subject], 255));

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/unsingo_popin.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
