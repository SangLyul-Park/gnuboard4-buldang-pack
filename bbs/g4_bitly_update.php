<?
include_once("./_common.php");

// bo_table�� ������ �״´�.
if( empty($bo_table) ) die("101");

// wr_id�� ��� �״°Ŵ�.
if( empty($wr_id) ) die("102");

// �Խñ��� �ִ����� Ȯ�� ���Ѵ�. ��? ������ ������ �ȵ��״ϱ�. ����

// bitly_url�� �ִ��� ����. ������ �׾����
if( empty($bitly_url) ) die("104");

$tmp_write_table = $g4['write_prefix'] . $bo_table; // �Խ��� ���̺� ��ü�̸�

$sql = " update {$tmp_write_table} set bitly_url = '$bitly_url' where wr_id='{$wr_id}' ";
$result = sql_query($sql, FALSE);

if (!$result) {
    //db�� ������Ʈ
    $sql2 = " ALTER TABLE $tmp_write_table ADD `bitly_url` VARCHAR( 255 ) NOT NULL ";
    sql_query($sql2);
    
    // �ٽ� �ѹ� ��~!
    sql_query($sql);
}

die("000");
?>
