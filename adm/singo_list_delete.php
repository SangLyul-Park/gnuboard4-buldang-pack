<?
$sub_menu = "300300";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

check_token();

//print_r2($_POST);

for ($i=0; $i<count($chk); $i++) {
    // ���� ��ȣ�� �ѱ�
    $k = $_POST[chk][$i];

    // �Ű����̺��� �Խ��� ���̺�� ���̵� �о�
    $sql = " select bo_table, wr_id from $g4[singo_table] where sg_id = '$sg_id[$k]' ";
    $row = sql_fetch($sql);

    // �Ű� �ڷḦ ����
    $sql = " delete from $g4[singo_table] where sg_id = '$sg_id[$k]' ";
    sql_query($sql);

    // �Ű� �ʵ��� �Ű� ī��Ʈ�� �����Ѵ�
    $sql = " select count(*) as cnt from $g4[singo_table] where bo_table = '$row[bo_table]' and wr_id = '$row[wr_id]' ";
    $sg_result = sql_fetch($sql);
    if ($row['bo_table'] == '@memo') {
        ;
    } else if ($row['bo_table'] == '@member') {
        ;
    } else if ($row['bo_table'] == '@hidden_comment') {
        $sql = " update $g4[hidden_comment_table] set wr_singo = '$sg_result[cnt]' where co_id = '$row[wr_id]' ";
        sql_query($sql);
    } else {      
        $write_table = $g4['write_prefix'].$row[bo_table];
        $sql = " update $write_table set wr_singo = '$sg_result[cnt]' where wr_id = '$row[wr_id]' ";
        sql_query($sql);
    }
}

goto_url("singo_list.php?$qstr");
?>
