<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "�ֽű�����";
include_once("./admin.head.php");

echo "'�Ϸ�' �޼����� ������ ���� ���α׷��� ������ �������� ���ʽÿ�.<br>";
echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

// ���� ���̺��� ���� �մϴ�.
$g4[board_new_copy_table ] = $g4[board_new_table] . "_copy";

// ���̺��� �ϳ� ���� �մϴ�. �Ż�� �ҿ�ưư
$sql = " DROP TABLE  IF EXISTS $g4[board_new_copy_table] ";
sql_query($sql);
$sql = " CREATE TABLE $g4[board_new_copy_table] select * from $g4[board_new_table] ";
sql_query($sql);

// ����� �Խ����� bn_datetime�� wr_datetime���� ������Ʈ �մϴ�. �̰Ŵ� �Ѷ� �Ѷ� �ؾ� �մϴ�.
$sql = " select * from $g4[board_new_copy_table] ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    $tmp_write_table = $g4['write_prefix'] . $row[bo_table]; // �Խ��� ���̺� ��ü�̸�
    $write = sql_fetch(" select wr_datetime from $tmp_write_table where wr_id = '$row[wr_id]' ");
    
    $sql = " update $g4[board_new_copy_table] set bn_datetime='$write[wr_datetime]' where bn_id='$row[bn_id]' ";
    sql_query($sql);
}
echo "<script>document.getElementById('ct').innerHTML += '<br><br>bn_datetime ������Ʈ �Ϸ�';</script>\n";

// ���� �Խ����� ��� �ֽű� ���ڵ带 �� ���������ϴ�.
sql_query(" delete from $g4[board_new_table] ");

echo "<script>document.getElementById('ct').innerHTML += '<br><br>max_id ��� �Ϸ�';</script>\n";

// ��������, ���� �־����. ���? ��~. ����... 
// �ѹ濡 �� ���� ���� ������, �׷����� �۾��� ���� ���� �۾��� �ȵǰŵ��. �׷��� �Ѷ��� �־�����ϴ�.
$sql = " select * from $g4[board_new_copy_table] order by bn_datetime asc ";
$result = sql_query($sql);
$bn_id = 1;
while ($row = sql_fetch_array($result)) {
    $sql = " insert into $g4[board_new_table]
                set 
                    bn_id = '$bn_id',
                    bo_table = '$row[bo_table]',
                    wr_id = '$row[wr_id]',
                    wr_parent = '$row[wr_parent]',
                    bn_datetime = '$row[bn_datetime]',
                    mb_id = '$row[mb_id]',
                    parent_mb_id = '$row[parent_mb_id]',
                    wr_is_comment = '$row[wr_is_comment]',
                    gr_id = '$row[gr_id]',
                    wr_option = '$row[wr_option]',
                    my_datetime = '$row[my_datetime]' ";
    sql_query($sql);
    $bn_id++;
}

echo "<script>document.getElementById('ct').innerHTML += '<br><br>�ֽű����̺� ���� �Ϸ�.<br><br>���α׷��� ������ ����ġ�ŵ� �����ϴ�.';</script>\n";

include_once("./admin.tail.php");
?>