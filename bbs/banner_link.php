<?
include_once("./_common.php");

$html_title = "$group[gr_subject] > $board[bo_subject] > " . conv_subject($write[wr_subject], 255) . " > ��ũ";

// common.php���� $bo_table�� �����ϰ� �ϴ� �ڵ�
$bn_id = preg_match("/^[a-zA-Z0-9_]+$/", $bn_id) ? $bn_id : "";
if (!$bn_id)
    alert_close("��ũ���� ����� �Ѿ���� �ʾҽ��ϴ�.");

// SQL Injection ����
$bn = sql_fetch(" select * from $g4[banner_table] where bn_id = '$bn_id' ");
if (!$bn['bn_id'] || !$bn['bn_url'])
    alert_close("�����ϴ� ��ʰ� �ƴմϴ�.");

$ss_name = "ss_banner_click_{$bn_id}_{$bn[bg_id]}";
if (empty($_SESSION[$ss_name])) 
{
    $sql = " update $g4[banner_table] set bn_click = bn_click + 1 where bn_id = '$bn_id' ";
    sql_query($sql);

    $sql = "insert into $g4[banner_click_table] 
                    set bn_id = '$bn[bn_id]',
                        bg_id = '$bn[bg_id]',
                        bc_agent = '$useragent',
                        bc_datetime = '$g4[time_ymdhis]'
            ";
    $result = sql_query($sql);

    // �������� INSERT �Ǿ��ٸ� ���Ŭ�� �հ迡 �ݿ�
    if ($result) {
      
        // UPDATE�� �����ϰ� ������ �߻��� insert�� ���� (����������)
        $sql = " update $g4[banner_click_sum_table] set bc_count = bc_count + 1 where bc_date = '$g4[time_ymd]' ";
        $result = sql_query($sql);

        if ( mysql_affected_rows() == 0 ) {
            $sql = " insert $g4[banner_click_sum_table] ( bc_count, bc_date) values ( 1, '$g4[time_ymd]' ) ";
            $result = sql_query($sql);
        }
    }
    set_session($ss_name, true);
}

if ($bn['target'])
    goto_url(set_http($bn['bn_url']));
else
    goto_url($bn['bn_url']);
?>