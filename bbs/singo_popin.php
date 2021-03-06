<?
include_once("./_common.php");

include_once("$g4[path]/head.sub.php");

if (!$member['mb_id']) 
    alert_close("회원만 신고 할 수 있습니다.", "login.php?url=".urlencode("$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id=$wr_id"));

// 신고할 수 있는 회원의 포인트 설정값이 없다면, 회원가입시 포인트의 2배로 한다.
if (!isset($config['cf_singo_point']))
    $config['cf_singo_point'] = $config['cf_register_point'] * 2;

if ($member['mb_point'] < $config['cf_singo_point'])
    alert_close("회원님의 포인트가 ".number_format($config['cf_singo_point'])."점 이상이어야 신고할 수 있습니다.");

if ($member['mb_id']==$write['mb_id'])
    alert_close("자신의 게시물은 신고할 수 없습니다.");

if ($member['mb_level'] < $board['bo_comment_level'])
    alert_close("코멘트 쓰기 권한이 있는 회원만 게시글을 신고할 수 있습니다.");

$mb = get_member($write['mb_id'], "mb_level");
if ($mb['mb_level'] > $member['mb_level'])
    alert_close("자신보다 권한이 높은 회원의 게시물은 신고할 수 없습니다.");

// 신고횟수 제한이 걸려 있지 않으면, 3회로 초기설정을 해준다
if (!isset($config['cf_singo_today_count']))
    $config['cf_singo_today_count'] = 3;

$sql = " select count(*) as cnt from $g4[singo_table] 
          where sg_mb_id = '$member[mb_id]' and left(sg_datetime,10)='$g4[time_ymd]' ";
$row = sql_fetch($sql);
if ($row['cnt'] >= $config['cf_singo_today_count'])
    alert_close("신고는 하루에 {$config[cf_singo_today_count]}회 이상 하실 수 없습니다.");

// hidden_comment 테이블은 비밀글 목적으로 assign 된 것 입니다. 게시판 이름으로 쓰지마세요
if ($bo_table == 'hidden_comment') {
}
else
{
$write_table = $g4['write_prefix'].$bo_table;
$sql = " select wr_is_comment, wr_subject, mb_id from $write_table where wr_id = '$wr_id' and wr_parent = '$wr_parent' ";
$row = sql_fetch($sql);
if (!is_array($row))
    alert_close("신고할 게시물이 없습니다.");

$write['wr_subject'] = $row['wr_subject'];

if ($row['wr_is_comment']) {
    $sql = " select wr_subject from $write_table where wr_id = '$wr_parent' ";
    $row = sql_fetch($sql);
    if (!$row)
        alert_close("신고할 게시물이 없습니다..");

    $write['wr_subject'] = "[코] ".$row['wr_subject'];
}
} // end of if

$wr_subject = get_text(cut_str($write['wr_subject'], 255));
$wr_content = $write['wr_content'];
$wr_ip = $write['wr_ip'];
$wr_datetime = $write['wr_datetime'];

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/singo_popin.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
