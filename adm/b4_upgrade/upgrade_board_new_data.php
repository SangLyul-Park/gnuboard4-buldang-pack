<?
$sub_menu = "100600";
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

$g4[title] = "���׷��̵�";
if (!$g4[b4_upgrade]) include_once("./admin.head.php");

// ��� �Խ��� �׷� ������ ������ �ɴϴ�.
$sql = " select * from $g4[group_table] where gr_use_access = '0' and gr_use_search = '1' ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {

    // �׷쿡 ���� ��� �Խ��� ������ ������ �ɴϴ�
    $sql1 = " select * from $g4[board_table] where bo_use_search = '1' ";
    $result1 = sql_query($sql1);
    
    // ��� �Խñ��� ������ �ͼ�, �ֽű��� ����� �ݴϴ� (��¥�� �����ϰ� �������� ������ ������ �մϴ�).
    for ($j=0; $row1=sql_fetch_array($result1); $j++) {
        $sql2 = " select * from $tmp_write_table ";
        $result2 = sql_query($sql2);
        // �ֽű��� �ִ����� Ȯ��
        $sql3 = " ";
        
        // �ֽű��� ������ �־��ݴϴ�.
      
    }
}


if (!$g4[b4_upgrade]) include_once("./admin.tail.php");
?>
