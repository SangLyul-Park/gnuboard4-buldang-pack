<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert_close("ȸ���� ��ȸ�Ͻ� �� �ֽ��ϴ�.");

$bg_id = (int) $bg_id;

$result = sql_fetch(" select * from $g4[board_good_table] where bg_id = '$bg_id' and mb_id = '$member[mb_id]' ");
$tmp_write_table = $g4['write_prefix'] . $result[bo_table]; // �Խ��� ���̺� ��ü�̸�

// ����ڰ� �ƴϸ� ƨ���ش�
if ($result['mb_id'] !== $member[mb_id])
    alert(" Ÿ���� ���� �Ժη� �ϸ� �ȵ˴ϴ�.");

// �����ش�
$sql = " delete from $g4[board_good_table] where bg_id = '$bg_id' and mb_id = '$member[mb_id]' ";
sql_query($sql);

// �Խñ��� coount ����
if ($result['bg_flag'] == "nogood")
    $sql = " update $tmp_write_table set wr_nogood = wr_nogood - 1 where wr_id = '$result[wr_id]' ";
else
    $sql = " update $tmp_write_table set wr_good = wr_good - 1 where wr_id = '$result[wr_id]' ";
sql_query($sql);

goto_url("./my_good.php?$qstr");
?>
