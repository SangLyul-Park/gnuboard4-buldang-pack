<?
include_once("./_common.php");

$g4[title] = "$config[cf_title] - My on";

$head = (int) $head;
$rows = (int) $rows;

if ($member[mb_id]) 
    ;
else 
    alert("MyOn�� ȸ���� ���� ���� �Դϴ�.\\n\\nȸ���̽ö�� �α��� �� �̿��� ���ʽÿ�.", "./login.php?url=".urlencode("myon.php?head=$head"));

if ($head)
    include_once("../head.sub.php");
else
    include_once("./_head.php");

// ��Ų�� $_GET���� ���� �Ѱ��ش�
$myon_skin = strip_tags($myon_skin);
if ($myon_skin)
    $skin = $myon_skin;
else
    $skin = "basic";

if ($rows > 0) {
    if ($rows > 50)
        $rows = 50;
}
else
    $rows = 20;

// �ֱ� Whats On
$sql = " select * from $g4[whatson_table] where mb_id='$member[mb_id]' order by wo_id desc limit 0, $rows";
$whatson_result = sql_query($sql);

// ���� �湮�� �Խ���
$sql = " select b.bo_table, b.bo_subject, a.my_datetime from $g4[my_board_table] a left join $g4[board_table] b on a.bo_table = b.bo_table
          where a.mb_id = '$member[mb_id]' group by b.bo_table order by a.my_datetime desc limit 0, $rows ";
$myboard_result = sql_query($sql);

// �ֱ� �Խñ�
$sql = " select * from $g4[board_new_table]
          where mb_id = '$member[mb_id]' and wr_is_comment = '0' order by bn_id desc limit 0, $rows ";
$recent_result = sql_query($sql);

// �ֱ� �ڸ�Ʈ
$sql = " select * from $g4[board_new_table]
          where mb_id = '$member[mb_id]' and wr_is_comment = '1' order by bn_id desc limit 0, $rows ";
$comment_result = sql_query($sql);

// ������ ����
$sql = " select bo_table, wr_id from $g4[board_new_table] 
          where mb_id = '$member[mb_id]'  and wr_is_comment = '0' and my_datetime not like '0%' and bn_datetime > '$sql_datetime' 
          order by my_datetime desc limit 0, $rows ";
$my_result = sql_query($sql);

// ������
$sql = " select * from $g4[recycle_table] where rc_wr_id = rc_wr_parent and mb_id = '$member[mb_id]' order by rc_no desc limit 0, $rows ";
$recycle_result = sql_query($sql);

// �Ű�� ��
$sql = " select * from $g4[singo_table] where mb_id= '$member[mb_id]' order by sg_id desc limit 0, $rows ";
$singoed_result = sql_query($sql);

// �Ű��� ��
$sql = " select * from $g4[singo_table] where sg_mb_id= '$member[mb_id]' order by sg_id desc limit 0, $rows ";
$singo_result = sql_query($sql);

// �ֱ� ����Ʈ
$sql = " select * from $g4[point_table] where mb_id='$member[mb_id]' order by po_id desc limit 0, $rows";
$point_result = sql_query($sql);


$myon_skin_path = "$g4[path]/skin/myon/$skin";

include_once("$myon_skin_path/myon.skin.php");

if ($head)
    include_once("./_tail.php");
else
    include_once("../tail.sub.php");
?>
