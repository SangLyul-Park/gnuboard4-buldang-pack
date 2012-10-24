<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// wr_1 : ��Ž����Ͻ�
// wr_2 : ��������Ͻ�
// wr_3 : ���� ����Ʈ
// wr_4 : ���� �ּ� ����Ʈ
// wr_5 : ���� �ְ� ����Ʈ
// wr_6 : �Ϸ� ���� Ƚ�� 
// wr_7 : ������
// wr_8 : ��Ż��� (0: �����, 1:������, 2:����, 3:����)
// wr_9 : ���� ����Ʈ
// wr_10 : ����ȸ�����̵�

$tender_table = "{$write_table}_tender";

if (!$board[bo_1]) 
{
    $sql = " update $g4[board_table] set ";
    $sql.= "  bo_1_subj = '���� ����Ʈ �⺻��' ";
    $sql.= " ,bo_2_subj = '���� �ּ� ����Ʈ �⺻��' ";
    $sql.= " ,bo_3_subj = '���� �ִ� ����Ʈ �⺻��' ";
    $sql.= " ,bo_4_subj = '�Ϸ� ���� Ƚ�� �⺻��' ";
    $sql.= " where bo_table = '$bo_table' ";
    sql_query($sql, false);

    $sql = " update $g4[board_table] set ";
    $sql.= "  bo_1 = '500' ";
    $sql.= " ,bo_2 = '1' ";
    $sql.= " ,bo_3 = '10000' ";
    $sql.= " ,bo_4 = '3' ";
    $sql.= " where bo_table = '$bo_table' ";
    sql_query($sql, false);
}

$sql = " create table $tender_table ( ";
$sql.= " `td_id` INT NOT NULL AUTO_INCREMENT ,";
$sql.= " `wr_id` INT NOT NULL ,";
$sql.= " `mb_id` VARCHAR( 30 ) NOT NULL ,";
$sql.= " `mb_name` VARCHAR( 255 ) NOT NULL ,";
$sql.= " `mb_nick` VARCHAR( 255 ) NOT NULL ,";
$sql.= " `mb_email` VARCHAR( 255 ) NOT NULL ,";
$sql.= " `mb_homepage` VARCHAR( 255 ) NOT NULL ,";
$sql.= " `td_inter_point` INT NOT NULL ,";
$sql.= " `td_tender_point` INT NOT NULL ,";
$sql.= " `td_status` CHAR( 1 ) NOT NULL ,";
$sql.= " `td_last` DATETIME NOT NULL ,";
$sql.= " `td_datetime` DATETIME NOT NULL ,";
$sql.= " PRIMARY KEY ( `td_id` ) ,";
$sql.= " INDEX ( `wr_id` ) ";
$sql.= " ); ";
sql_query($sql, false);

// ��� ���� ���
function auction_status($status)
{
    switch ($status)
    {
        case "0": $status = "�����"; break;
        case "1": $status = "������"; break;
        case "2": $status = "����"; break;
        case "3": $status = "����"; break;
    }
    return $status;
}

// �������(�߰��ʵ�)�� �����´�.
function get_info_auction($wr_id, $row=null)
{
    global $write, $write_table;

    if (!$row && !$write) {
        $row = sql_fetch(" select wr_subject, wr_1, wr_2, wr_3, wr_4, wr_5, wr_6, wr_7, wr_8, wr_9, wr_10 from $write_table where wr_id = '$wr_id' ");
    } elseif ($write) {
        $row = $write;
    }

    $pd = explode("|", $row[wr_subject]);

    unset($res);
    $res[company] = trim($pd[0]);
    $res[product] = trim($pd[1]);
    $res[start_datetime] = $row[wr_1];
    $res[end_datetime] = $row[wr_2];
    $res[inter_point] = $row[wr_3];
    $res[tender_lower] = $row[wr_4];
    $res[tender_higher] = $row[wr_5];
    $res[day_limit] = $row[wr_6];
    $res[tender_count] = $row[wr_7];
    $res[status] = $row[wr_8];
    $res[td_id] = $row[wr_9];
    $res[mb_id] = $row[wr_10];

    return $res;
}

// ��� ���� ����
function tender_send($wr_id, $point)
{
    global $g4, $board, $member, $tender_table, $write_table, $write, $bo_table;

    if (!$member[mb_id])
        alert_only("�α��� ���ּ���.");

    if ($board[bo_5] > 0 && (($g4[server_time] - strtotime($member[mb_datetime])) < ($board[bo_5]*86400)))
        alert_only("ȸ������ �� $board[bo_5] ���� ������ ���� �����մϴ�.");

    $auction = get_info_auction($wr_id);

    if ($g4[time_ymdhis] < $auction[start_datetime])
        alert_only("��� ���� ���Դϴ�.");

    if ($g4[time_ymdhis] > $auction[end_datetime]) 
        alert_only("��Ű� ����Ǿ����ϴ�.");

    $row2 = sql_fetch(" select count(mb_id) as cnt from $tender_table where td_datetime like '$g4[time_ymd]%' and mb_id = '$member[mb_id]' and wr_id = '$wr_id' ");
    $tender_count = $row2[cnt];

    if ($tender_count >= $auction[day_limit])
        alert_only("�Ϸ翡 $auction[day_limit] �� ���� �����մϴ�.");

    if ($point < $auction[tender_lower] || $point > $auction[tender_higher])
        alert_only("���� ����Ʈ�� ".number_format($auction[tender_lower])."~".number_format($auction[tender_higher])." ���̷� �������ּ���.");

    $total_point = (int)$auction[inter_point] + (int)$point;

    if ($member[mb_point] - $total_point < 0)
        alert_only("������ ��� ����Ʈ(".number_format($member[mb_point]).") �� ���� ����Ʈ+���� ����Ʈ(".number_format($total_point).") ���� �����մϴ�.");

    $row = sql_fetch(" select * from $tender_table where wr_id = '$wr_id' and mb_id = '$member[mb_id]' and td_tender_point = '$point' ");
    if ($row)
        alert_only("�̹� ���� ����Ʈ�� ���� �ϼ̽��ϴ�.");

    //////////////////////////////////////////////////////////////////////
    // ���ӹ�ȣ �Ұ� 
    //////////////////////////////////////////////////////////////////////
    /*
    $series = 4;
    $half = floor($series/2);
    $msg = "���ӵ� ��ȣ�� ".($series-1)."�� �̻� �����Ͻ� �� �����ϴ�.";

    // �Ʒ��� 
    $row = sql_fetch(" select count(*) as cnt from {$tender_table} where wr_id = '$wr_id' and mb_id = '$member[mb_id]' and td_tender_point < {$point} and td_tender_point > {$point}-{$series} ");
    if ($row[cnt] >= $series-1)
        alert_only($msg);

    // ����
    $row = sql_fetch(" select count(*) as cnt from {$tender_table} where wr_id = '$wr_id' and mb_id = '$member[mb_id]' and td_tender_point > {$point} and td_tender_point < {$point}+{$series} ");
    if ($row[cnt] >= $series-1)
        alert_only($msg);

    // ���̿�
    $row = sql_fetch(" select count(*) as cnt from {$tender_table} where wr_id = '$wr_id' and mb_id = '$member[mb_id]' and td_tender_point >= {$point}-{$half} and td_tender_point <= {$point}+{$half} ");
    if ($row[cnt] >= $series+1)
        alert_only($msg);
    */

    //////////////////////////////////////////////////////////////////////
    // ���� ���� ���� 
    //////////////////////////////////////////////////////////////////////
    $sec = 10; // ���� 10��
    $cnt = 5; // ��밹�� 5��

    if ($point % $sec)
        $tmp = $point;
    else
        $tmp = $point - 1;

    $min = floor($tmp/$sec) * $sec + 1;
    $max = ceil(($tmp/$sec)) * $sec;

    $row = sql_fetch(" select count(*) as cnt from {$tender_table} where wr_id = '$wr_id' and mb_id = '$member[mb_id]' and td_tender_point >= {$min} and td_tender_point <= {$max} ");
    if ($row[cnt] >= $cnt)
        alert_only("�̹� $min �� $max ���̿� $cnt �� �����ϼ̽��ϴ�.");
    //////////////////////////////////////////////////////////////////////

    $sql = "insert into {$tender_table} set ";
    $sql.= " wr_id = '$wr_id' ";
    $sql.= ",mb_id = '$member[mb_id]' ";
    $sql.= ",mb_name = '$member[mb_name]' ";
    $sql.= ",mb_nick = '$member[mb_nick]' ";
    $sql.= ",mb_email = '$member[mb_email]' ";
    $sql.= ",mb_homepage = '$member[mb_homepage]' ";
    $sql.= ",td_inter_point = '$auction[inter_point]' ";
    $sql.= ",td_tender_point = '$point' ";
    $sql.= ",td_status = '1' ";
    $sql.= ",td_last = '$g4[time_ymdhis]' ";
    $sql.= ",td_datetime = '$g4[time_ymdhis]' ";
    sql_query($sql);

    sql_query(" update $write_table set wr_7 = wr_7 + 1 where wr_id = '$wr_id' ");

    if ($auction[inter_point])
        insert_point($member[mb_id], $auction[inter_point]*-1, "$wr_id ��� ����", $bo_table, $wr_id, "���� : $g4[time_ymdhis]");

    if ($point)
        insert_point($member[mb_id], $point*-1, "$wr_id ��� ����", $bo_table, $wr_id, "���� : $g4[time_ymdhis]");
}

// ����� ���� ���� �˻� �� ������Ʈ
function auction_successful($wr_id)
{
    global $g4, $write_table, $tender_table, $auction, $write, $bo_table;

    if (!$auction)
        $auction = get_info_auction($wr_id);

    // ��Ż��� ��ȸ - �̹� ����Ǿ����� return
    if ($auction[status] > 1) return false;

    // ��Ű� �������̸� return
    if ($auction[start_datetime] > $g4[time_ymdhis]) return false;

    // ��ų�¥�� ���Ͽ� �������ϰ�� return
    if ($auction[start_datetime] < $g4[time_ymdhis] && $auction[end_datetime] > $g4[time_ymdhis]) return false;

    // ������ ������ ������ ��ȸ
    $row = sql_fetch(" select td_tender_point as point, count(td_tender_point) as cnt from $tender_table where wr_id = '$wr_id' group by td_tender_point order by cnt, td_tender_point limit 1 ");

    // �ߺ��Ǿ��ų� ���������� ���� ��� ����
    if ($row[cnt] > 1 || !$row)
    {
        sql_query(" update $write_table set wr_8 = '3' where wr_id = '$wr_id' ");

        $qry = sql_query(" select * from $tender_table where wr_id = '$wr_id' ");
        while ($row = sql_fetch_array($qry))
        {
            insert_point($row[mb_id], $row[td_tender_point], "$wr_id ��� ����, ���� ����Ʈ ȯ��", $bo_table, $wr_id, "���� $row[td_tender_point] ����Ʈ ȯ��");
        }

        $res = sql_fetch(" select wr_7, wr_8, wr_9, wr_10 from $write_table where wr_id = '$wr_id' ");
        return $res;
    }
    else
    {
        // ������ �������� ��������
        $row = sql_fetch(" select * from $tender_table where td_tender_point = '$row[point]' and wr_id = '$wr_id' ");
        sql_query(" update $write_table set wr_8 = '2', wr_9 = '$row[td_tender_point]', wr_10 = '$row[mb_id]' where wr_id = '$wr_id' ");

        $qry = sql_query(" select * from $tender_table where td_tender_point <> '$row[td_tender_point]' and wr_id = '$wr_id' ");
        while ($row = sql_fetch_array($qry))
        {
            insert_point($row[mb_id], $row[td_tender_point], "$wr_id ��� �����ȵ�, ���� ����Ʈ ȯ��", $bo_table, $wr_id, "���� $row[td_tender_point] ����Ʈ ȯ��");
        }

        $res = sql_fetch(" select wr_7, wr_8, wr_9, wr_10 from $write_table where wr_id = '$wr_id' ");
        return $res;
    }
}
?>
