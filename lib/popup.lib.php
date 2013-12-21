<?
if (!defined('_GNUBOARD_')) exit;

// �˾�â ����
function popup($skin_dir="", $bo_table, $cate="", $gallery_view=0, $options="")
{
    global $g4, $is_admin;

    if ($skin_dir)
        $popup_skin_path = "$g4[path]/skin/popup/$skin_dir";
    else
        $popup_skin_path = "$g4[path]/skin/popup/basic";

    $list = array();

    // �ʿ��� field�� select
    $sql = " select bo_table, bo_notice, bo_subject, bo_subject_len, bo_use_list_content, bo_use_sideview, bo_use_comment, bo_hot, bo_use_search from $g4[board_table] where bo_table = '$bo_table'";
    $board = sql_fetch($sql, FALSE);

    // ca_name�� ��ġ�ϰ�, ��¥�� �������� �ְ�, ��б��� �ƴ� �͸� ��� ���ϴ�. ��б��� ����� ���մϴ�.
    if ($is_admin != "super")
        $secret_sql = " and wr_option not like '%secret%' ";

    if ($board[bo_use_category] && $cate)
        $cate_sql = " and ca_name = '$cate' ";
    else
        $cate_sql = " ";

    $tmp_write_table = $g4['write_prefix'] . $bo_table; // �Խ��� ���̺� ��ü�̸�
    $wr_select = "wr_id, wr_subject, wr_content, wr_file_count, wr_link1, wr_link2, wr_datetime, wr_option, wr_1, wr_2, wr_3, wr_4, wr_5, wr_6, wr_7, wr_8, wr_9, wr_10";
    $sql = " select $wr_select from $tmp_write_table where ('$g4[time_ymdhis]' between wr_1 and wr_2) $secret_sql $cate_sql order by wr_num desc ";
    $result = sql_query($sql, FALSE);

    // ������ ©���� ���� �̻��ϹǷ� ������ ������ ��� ����ϰ� ���� �մϴ�. ���� �������� ������ 40���ڿ��� ©���ϴ�.
    $subject_len="255";
    
    for ($i=0; $row = sql_fetch_array($result); $i++) {
        $list[$i] = get_list($row, $board, $popup_skin_path, $subject_len, $gallery_view);
     
        // ��Ű�ϼ��� ������ ������ 7�Ϸ� ���� 
        if (!$list[$i][wr_7])
        {
            sql_query(" update $tmp_write_table set wr_7 = '7' where wr_id = '{$list[$i][wr_id]}' ");
            $list[$i]['wr_7'] = 7;
        }
    }

    ob_start();
    include "$popup_skin_path/popup.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>