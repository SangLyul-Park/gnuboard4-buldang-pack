<?
include_once("./_common.php");

$po = sql_fetch(" select a.*, b.gl_name from $g4[poll_table] a left join $g4[member_group_table] b on a.po_level = b.gl_id where a.po_id = '$_POST[po_id]' ");
if (!$po[po_id]) 
    alert_close("po_id ���� ����� �Ѿ���� �ʾҽ��ϴ�.");

// ��ǥ���� �̵��� url
$poll_url = "./poll_result.php?po_id=$po_id&skin_dir=$skin_dir";

// ��ǥ������ check 
$tm1 = explode("-", $po[po_date]);
$start_stamp = mktime(0,0,0, $tm1[1], $tm1[2], $tm1[0]);
if ($start_stamp > $g4['server_time'])
    alert("��ǥ�������� $po[po_date] �Դϴ�.", $poll_url);
   
// ��ǥ������ check
if ($po[po_end_date] != "0000-00-00") {
    $tm2 = explode("-", $po[po_end_date]);
    $end_stamp = mktime(0,0,0, $tm2[1], $tm2[2], $tm2[0]);
    if ($end_stamp < $g4['server_time'])
        alert("�̹� $po[po_date]�� ����� ��ǥ�Դϴ�.", $poll_url);
}

if ($member[mb_level] < $po[po_level]) 
    alert("$po[gl_name] �̻� ȸ���� ��ǥ�� �����Ͻ� �� �ֽ��ϴ�.");

// ��Ű�� ����� ��ǥ��ȣ�� ���ٸ�
if (get_cookie("ck_po_id") != $po[po_id]) 
{
    // ��ǥ�ߴ� ip�� �߿��� ã�ƺ���
    $search_ip = false;
    $ips = explode("\n", trim($po[po_ips]));
    for ($i=0; $i<count($ips); $i++) 
    {
        if ($_SERVER[REMOTE_ADDR] == trim($ips[$i])) 
        {
            $search_ip = true;
            break;
        }
    }

    // ��ǥ�ߴ� ȸ�����̵�� �߿��� ã�ƺ���
    $search_mb_id = false;
    if ($is_member)
    {
        $ids = explode("\n", trim($po[mb_ids]));
        for ($i=0; $i<count($ids); $i++) 
        {
            if ($member[mb_id] == trim($ids[$i])) 
            {
                $search_mb_id = true;
                break;
            }
        }
    }

    // ���ٸ� ������ ��ǥ�׸��� 1���� ��Ű�� ip, id�� ����
    if (!($search_ip || $search_mb_id)) 
    {
        $po_ips = $po[po_ips] . $remote_addr . "\n";
        $mb_ids = $po[mb_ids];
        if ($member[mb_id])
            $mb_ids .= $member[mb_id] . "\n";
        sql_query(" update $g4[poll_table] set po_cnt{$gb_poll} = po_cnt{$gb_poll} + 1, po_ips = '$po_ips', mb_ids = '$mb_ids' where po_id = '$po_id' ");
        $msg = "";
    } else 
    {
        $msg = "�̹� ��ǥ�� ���� �ϼ̽��ϴ�.";
    }

    if (!$search_mb_id)
        insert_point($member[mb_id], $po[po_point], $po[po_id] . ". " . cut_str($po[po_subject],20) . " ��ǥ ���� ", "@poll", $po[po_id], "��ǥ");
} else {
    $msg = "�̹� ��ǥ�� ���� �ϼ̽��ϴ�.";
}

set_cookie("ck_po_id", $po[po_id], 86400 * 15); // ��ǥ ��Ű ������ ����

if ($msg)
    alert("$msg", $poll_url);
else
    goto_url($poll_url);
?>
