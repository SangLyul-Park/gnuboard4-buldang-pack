<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

$sql = " delete from $g4[scrap_table] where mb_id = '$member[mb_id]' and ms_id = '$ms_id' ";
sql_query($sql);

// �Ҵ��� - ��ũ������ ���� ����Ʈ�� ��ϵ� ���... ��ũ���� �������� good count�� �ϳ� ���ش�
if ($board['bo_list_scrap'] > 0) {
    $sql = " update $g4[good_list_table] set good = good - 1 where bo_table='$bo_table' and wr_id='$wr_id' ";
    $result = sql_query($sql, FALSE);
}

goto_url("./scrap.php?page=$page&head_on=$head_on&mnb=$mnb&snb=$snb");
?>
