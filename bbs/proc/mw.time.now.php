<?
include_once("_common.php");

// post�� ���� ���� ������
$sst        = strip_tags($_POST[sst]);
$sod        = strip_tags($_POST[sod]);
$sfl        = strip_tags($_POST[sfl]);
$stx        = strip_tags($_POST[stx]);
$page       = (int) strip_tags($_POST[page]);
$token      = strip_tags($_POST[token]);
$mb_id      = strip_tags($_POST[mb_id]);
$bo_table   = strip_tags($_POST[bo_table]);
$wr_id      = strip_tags($_POST[wr_id]);
$comment_id = strip_tags($_POST[comment_id]);
$flag       = strip_tags($_POST[flag]);

// �ʿ��� ������ ���ų�, ȸ���� �ƴϰų�, ������ �Ǵ°Խñ� �ۼ��ڰ� �ƴ� ���
if (!$bo_table || !$wr_id || !$member[mb_id] || !($is_admin || $mb_id == $member['mb_id']))
    alert("�������� ���� �Դϴ�.");

$url = "../board.php?bo_table=$bo_table&wr_id=$wr_id&page=$page&mnb=$mnb&snb=$snb";

// �Խñ��� ������Ʈ
sql_query(" update $write_table set wr_datetime='$g4[time_ymdhis]' where wr_id='$wr_id'");

// �ֱٱ��� ������Ʈ
$sql = " select * from $g4[board_new_table] where bo_table='$bo_table' and wr_id='$wr_id'";
$result = sql_fetch($sql);

// �ϴ� ���ο�� ���� insert �ϰ�,
$sql = "insert into $g4[board_new_table] 
                set bo_table        = '$bo_table',
                    wr_id           = '$wr_id',
                    wr_parent       = '$result[wr_parent]',
                    bn_datetime     = '$g4[time_ymdhis]',
                    mb_id           = '$result[mb_id]',
                    parent_mb_id    = '$result[parent_mb_id]',
                    wr_is_comment   = '$result[wr_is_comment]',
                    gr_id           = '$result[gr_id]',
                    wr_option       = '$result[wr_option]',
                    my_datetime     = '$g4[time_ymdhis]'
                    ";
sql_query($sql);

// �ֽű� ������ �ִ� ��쿡�� �������� ���� �ؾ�����? ����
if ($result) {
    $sql = " delete from $g4[board_new_table] where bn_id = '$result[bn_id]' ";
    sql_query($sql);
}

$msg = "�Խñ� �� �ֽű� ������ ����ð����� ������Ʈ �Ͽ����ϴ�";

alert($msg, $url);
?>
