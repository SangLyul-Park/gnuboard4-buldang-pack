<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

$sql = " delete from $g4[scrap_table] where mb_id = '$member[mb_id]' and ms_id = '$ms_id' ";
sql_query($sql);

// �Ҵ��� - ��ũ������ ���� ����Ʈ�� ��ϵ� ���... ��ũ���� �������� good count�� �ϳ� ���ش�
if ($board['bo_list_scrap'] > 0) {

    // $ms_id���� $bo_table�� $wr_id�� ã�ƾ� �մϴ�.
    $result = sql_fetch(" select * from $g4[scrap_table] where ms_id = '$ms_id' ");
    $bo_table = $result['bo_table'];
    $wr_id = $result['wr_id'];

    // ī���͸� �ϳ� ���ݴϴ�
    $sql = " update $g4[good_list_table] set good = good - 1 where bo_table='$bo_table' and wr_id='$wr_id' ";
    $result = sql_query($sql, FALSE);
}

goto_url("./scrap.php?page=$page&head_on=$head_on&mnb=$mnb&snb=$snb");
?>