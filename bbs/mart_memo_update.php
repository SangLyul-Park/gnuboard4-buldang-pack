<?
include_once("./_common.php");

if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

if (!$member[mb_id]) 
  alert("ȸ���� ����� �� �ֽ��ϴ�");

$tmp_write_table = $g4[write_prefix] . $bo_table; // �Խ��� ���̺� ��ü�̸�
if ($is_admin)
  $sql = " update $tmp_write_table set wr_10 = '$wr_10' where wr_id='$wr_id' ";
else
  $sql = " update $tmp_write_table set wr_10 = '$wr_10' where wr_id='$wr_id' and mb_id='$member[mb_id]' ";
sql_query($sql);

goto_url("$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id=$wr_id");
?>
