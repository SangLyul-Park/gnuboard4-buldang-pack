<?
$sub_menu = "300410";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "�ֽű� �ٽ� �����";
include_once("./admin.head.php");

echo "'�Ϸ�' �޼����� ������ ���� ���α׷��� ������ �������� ���ʽÿ�.<br>";
echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

// �Խ����� ��� �о� ���ϴ�.
$sql = " select * from $g4[board_table] ";
$result = sql_query($sql);
while($board = sql_fetch_array($result)) {
    $tmp_write_table = $g4['write_prefix'] . $board[bo_table]; // �Խ��� ���̺� ��ü�̸�

    $sql2 = " select * from $tmp_write_table where (TO_DAYS('$g4[time_ymdhis]') - TO_DAYS(wr_datetime)) <= '$config[cf_new_del]' order by wr_datetime asc ";
    $result2 = sql_query($sql2);
    
    while ($write = sql_fetch_array($result2)) {
        // �ֽű� ���̺� �ִ��� üũ
        $res = sql_fetch(" select count(*) as cnt from $g4[board_new_table] where bo_table = '$board[bo_table]' and wr_id = '$write[wr_id]' ");
        if ($res[cnt] > 0)
          continue;
        
        // parent_mb_id�� ���Ѵ�.
        if ($write[wr_is_comment]) {
            // �ڸ�Ʈ�� ��쿡�� ������ mb_id�� �־��ݴϴ�.
            $tmp_mb_id = sql_fetch(" select mb_id from $tmp_write_table where wr_id = '$write[wr_parent]' ");
            if ($tmp_mb_id[mb_id] !== "")
                $parent_mb_id = $tmp_mb_id[mb_id];
        } if ($write[wr_reply]) {
            // �Ҵ��� - ����� ��� ������ mb_id�� �Է�
            // ���۸� ���Ѵ�. + ����� �ۼ��ڿʹ� �޶�� �Ѵ�
            $sql = " select mb_id from $tmp_write_table
                      where wr_reply = ''
                      and wr_id <> '$write[wr_id]'
                      and wr_num = '$write[wr_num]'
                      and mb_id <> '$write[mb_id]'
                      and wr_is_comment = 0 ";
            $tmp_mb_id = sql_fetch($sql);
            if ($tmp_mb_id[mb_id] !== "")
                $parent_mb_id = $tmp_mb_id[mb_id];
        } else {
            $parent_mb_id = "";
        }

        // �ֽű� ���̺� ���� insert
        $sql = " insert into $g4[board_new_table]
                    set 
                    bo_table = '$board[bo_table]',
                    wr_id = '$write[wr_id]',
                    wr_parent = '$write[wr_parent]',
                    bn_datetime = '$write[wr_datetime]',
                    mb_id = '$write[mb_id]',
                    parent_mb_id = '$parent_mb_id',
                    wr_is_comment = '$write[wr_is_comment]',
                    gr_id = '$board[gr_id]',
                    wr_option = '$write[wr_option]',
                    my_datetime = '$write[wr_last]' ";
        sql_query($sql, FALSE);
    }
}


echo "<script>document.getElementById('ct').innerHTML += '<br><br>�ֽű����̺� ������ �Ϸ�.<br><br>���α׷��� ������ ����ġ�ŵ� �����ϴ�.';</script>\n";

include_once("./admin.tail.php");
?>