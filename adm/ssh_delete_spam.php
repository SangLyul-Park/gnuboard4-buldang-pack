<?
include_once("./_common.php");

$g4[title] = "����� �Խñ� �Խù� �ϰ� ����" . $act;
include_once("$g4[path]/head.sub.php");

// ���� : /bbs/delete_all.php (�ش� �ڵ尡 ����Ǹ� �� �ڵ嵵 �ݵ�� �����ؾ� ��)

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.");

if ($sw != "d")
    alert("�ٸ��� ���� ����Դϴ�.");

// $_POST[chk_wr_id] : $list[$i][wr_id]}|{$list[$i][bo_table]}

$count_write = 0;
$count_comment = 0;

$tmp_array = array();
if ($wr_id) // �Ǻ�����
    $tmp_array[0] = $wr_id;
else // �ϰ�����
    $tmp_array = $_POST[chk_wr_id];

// �Ųٷ� �д� ������ �亯�ۺ��� ������ �Ǿ�� �ϱ� ������
for ($i=count($tmp_array)-1; $i>=0; $i--) {
    // ������ �Խñ� ������ ��������
    $wr_array=explode("|",$tmp_array[$i]);
    $wr_id = $wr_array[0];
    $bo_table = $wr_array[1];
    $write_table = $g4['write_prefix'] . $bo_table; // �Խ��� ���̺� ��ü�̸�

    $sql = " select * from $write_table where wr_id = '{$wr_id}' ";
    $write = sql_fetch($sql);

if ($write[wr_is_comment]) { // �ڸ�Ʈ�� ���

    // �ڸ�Ʈ ����Ʈ ����
    if (!delete_point($row[mb_id], $bo_table, $row[wr_id], '�ڸ�Ʈ'))
       insert_point($row[mb_id], $board[bo_comment_point] * (-1), "$board[bo_subject] {$write[wr_id]}-{wr_id} �ڸ�Ʈ����");

    // �ڸ�Ʈ ����
    sql_query(" delete from $write_table where wr_id = '$wr_id' ");
    
    $sql = " delete from $write_table where wr_id = '$wr_id' ";

    // �ֱٰԽù� ����
    sql_query(" delete from $g4[board_new_table] where bo_table = '$bo_table' and wr_id = '$wr_id' ");

    // �Խñ��� �ڸ�Ʈ ���� ����
    sql_query(" update $write_table set wr_comment = wr_comment - 1 where wr_id = '$write[wr_parent]' ");    
    
    // �� ���� ����
    sql_query(" update $g4[board_table] set bo_count_comment = bo_count_comment - 1 where bo_table = '$bo_table' ");    

} else { // �ڸ�Ʈ�� �ƴѰ��

    // �̺κ� ���ʹ� delete_all.php���� �׷��� ���� (���ۻ���)
    $len = strlen($write[wr_reply]);
    if ($len < 0) $len = 0; 
    $reply = substr($write[wr_reply], 0, $len);

    // ���۸� ���Ѵ�.
    $sql = " select count(*) as cnt from $write_table
              where wr_reply like '$reply%'
                and wr_id <> '$write[wr_id]'
                and wr_num = '$write[wr_num]'
                and wr_is_comment = 0 ";
    $row = sql_fetch($sql);
    if ($row[cnt])
            continue;

    // ��������� ���� : ���۰� �ڸ�Ʈ���� ���������� ������Ʈ ���� �ʴ� ������ ��� �ּ̽��ϴ�.
    //$sql = " select wr_id, mb_id, wr_comment from $write_table where wr_parent = '$write[wr_id]' order by wr_id ";
    $sql = " select wr_id, mb_id, wr_is_comment from $write_table where wr_parent = '$write[wr_id]' order by wr_id ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result)) 
    {
        // �����̶��
        if (!$row[wr_is_comment]) 
        {
            // ���� ����Ʈ ����
            if (!delete_point($row[mb_id], $bo_table, $row[wr_id], '����'))
                insert_point($row[mb_id], $board[bo_write_point] * (-1), "$board[bo_subject] $row[wr_id] �ۻ���");

            // ���ε�� ������ �ִٸ�
            $sql2 = " select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$row[wr_id]' ";
            $result2 = sql_query($sql2);
            while ($row2 = sql_fetch_array($result2))
                // ���ϻ���
                @unlink("$g4[data_path]/file/$bo_table/$row2[bf_file]");
                
            // �������̺� �� ����
            sql_query(" delete from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$row[wr_id]' ");

            $count_write++;
        } 
        else 
        {
            // �ڸ�Ʈ ����Ʈ ����
            if (!delete_point($row[mb_id], $bo_table, $row[wr_id], '�ڸ�Ʈ'))
                insert_point($row[mb_id], $board[bo_comment_point] * (-1), "$board[bo_subject] {$write[wr_id]}-{$row[wr_id]} �ڸ�Ʈ����");

            $count_comment++;
        }
    }

    // �Խñ� ����
    sql_query(" delete from $write_table where wr_parent = '$write[wr_id]' ");

    // �ֱٰԽù� ����
    sql_query(" delete from $g4[board_new_table] where bo_table = '$bo_table' and wr_parent = '$write[wr_id]' ");

    // ��ũ�� ����
    sql_query(" delete from $g4[scrap_table] where bo_table = '$bo_table' and wr_id = '$write[wr_id]' ");

    // �������� ����
    $notice_array = explode("\n", trim($board[bo_notice]));
    $bo_notice = "";
    for ($k=0; $k<count($notice_array); $k++)
        if ((int)$write[wr_id] != (int)$notice_array[$k])
            $bo_notice .= $notice_array[$k] . "\n";
    $bo_notice = trim($bo_notice);
    sql_query(" update $g4[board_table] set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");
    $board[bo_notice] = $bo_notice;

    // �ۼ��� ����
    if ($count_write > 0 || $count_comment > 0)
        sql_query(" update $g4[board_table] set bo_count_write = bo_count_write - '$count_write', bo_count_comment = bo_count_comment - '$count_comment' where bo_table = '$bo_table' ");

    // �ۼ��� ���� ī���� �ʱ�ȭ (��? �Խ����� ��� �ٸ��ϱ�)
    $count_write = 0;
    $count_comment = 0;

} // if�� ��
} // for loop�� ��

goto_url("$g4[bbs_path]/new.php?gr_id=$gr_id&view=$view&mb_id=$mb_id" . $qstr);
?>
