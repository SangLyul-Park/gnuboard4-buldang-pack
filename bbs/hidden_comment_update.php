<?
include_once("./_common.php");

if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

if (!$member[mb_id]) 
  alert("ȸ���� ����� �� �ֽ��ϴ�");

if ($w == 'del') { // �����ϱ�
    if ($is_admin)
        $sql = " delete from $g4[hidden_comment_table] where co_id = '$co_id' and bo_table='$bo_table' and wr_id='$wr_id' ";
    else
        $sql = " delete from $g4[hidden_comment_table] where co_id = '$co_id' and bo_table='$bo_table' and wr_id='$wr_id' and mb_id = '$member[mb_id]' ";
    sql_query($sql);
} 
else if ($w == 'update') { // �����ϱ�
}
else // �����ϱ�
{
    $co_content = addslashes($wr_hidden_comment);
    $co_link = set_http($wr_hidden_comment_link);
    $sql = " insert into $g4[hidden_comment_table] 
                    (bo_table, wr_id, mb_id, co_content, co_link, co_datetime, wr_ip )
             values ('$bo_table', '$wr_id', '$member[mb_id]', '$co_content', '$co_link', '$g4[time_ymdhis]', '$remote_addr') ";
    sql_query($sql);
}

goto_url("$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id=$wr_id");
?>
