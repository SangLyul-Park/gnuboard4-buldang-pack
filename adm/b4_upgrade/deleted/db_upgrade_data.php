<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

$g4[title] = "�״�����4 -> �Ҵ��� ���׷��̵�";
include_once("./admin.head.php");

// ����4 ���� ���� �о���̱�
include_once("../memo.config.php");

// �ֽű� �Խ����� ������Ʈ (�׷����� �߰�)
$sql = " select distinct bo_table from $g4[board_new_table] ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result))
{    
    $sql2 = " select gr_id from $g4[board_table] where bo_table = '$row[bo_table]' ";
    $result2 = sql_fetch($sql2);
    
    $sql3 = "update $g4[board_new_table] set gr_id = '$result2[gr_id]' where bo_table = '$row[bo_table]' ";
    sql_query($sql3);
}
echo "<br>�ֱٱ� �Խ��� - gr_id UPGRADE �Ϸ�.";

// �ֽű� �Խ����� ������Ʈ (�ڸ�Ʈ �������� �߰�)
$sql = " select bn_id, bo_table, wr_id from $g4[board_new_table] ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result))
{    
    $tmp_write_table = $g4[write_prefix] . $row[bo_table];
    $sql2 = " select wr_is_comment from $tmp_write_table where wr_id = '$row[wr_id]' ";
    $result2 = sql_fetch($sql2);
    
    $sql3 = "update $g4[board_new_table] set wr_is_comment = '$result2[wr_is_comment]' where bn_id = '$row[bn_id]' ";
    sql_query($sql3);
}
echo "<br>�ֱٱ� �Խ��� - wr_is_comment UPGRADE �Ϸ�.";

// Ʃ�� (board_table : wr_file_count)
include_once("./upgrade_turning1.php");

// Ʃ�� (board_table : min_wr_num)
include_once("./upgrade_turning2.php");

// Ʃ�� (member_table : mb_auth_count)
include_once("./upgrade_turning3.php");

// Ʃ�� (�Խ����� index �߰�)
include_once("./upgrade_board_index.php");

// Ʃ�� (�Խ����� ccl �߰�)
include_once("./upgrade_ccl.php");

// Ʃ�� (�Խ����� ���� index)
include_once("./upgrade_turning_write_idx.php");

// ���ñ�
include_once("./upgrade_related.php");

// �г��� �����丮
include_once("./upgrade_mb_nick.php");

// ��ũ�� 
include_once("./upgrade_scrap.php");

// �Ű�
include_once("./upgrade_singo.php");

include_once("./admin.tail.php");
?>
