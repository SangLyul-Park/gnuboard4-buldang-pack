<?
$sub_menu = "200200";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

if (!$ok)
    alert();

if ($is_admin != "super")
    alert("����Ʈ ������ �ְ�����ڸ� �����մϴ�.");

$g4[title] = "����Ʈ ����";
include_once("./admin.head.php");

echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

echo "<script>document.getElementById('ct').innerHTML += '<p>����Ʈ ������...';</script>\n";
flush();

// ����Ʈ�� 30�� �̻��� ȸ���� ���ؼ��� point�� clear �մϴ�.
$max_count = 30;
// ������� 30�� ������ ����Ʈ�� ���ؼ��� point�� clear �մϴ�.
$clear_days = 30;
$clear_datetime = date("Y-m-d H:i:s", $g4[server_time] - (86400 * $clear_days));
// �ѹ��� ������ ȸ���� ����
$max_mb_num = 1000;

// ������̺��� �����
$sql = "
CREATE TABLE `$g4[point_table]_backup` (
  `po_id` int(11) NOT NULL auto_increment,
  `mb_id` varchar(20) NOT NULL default '',
  `po_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `po_content` varchar(255) NOT NULL default '',
  `po_point` int(11) NOT NULL default '0',
  `po_rel_table` varchar(20) NOT NULL default '',
  `po_rel_id` varchar(20) NOT NULL default '',
  `po_rel_action` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`po_id`),
  KEY `index1` (`mb_id`,`po_rel_table`,`po_rel_id`,`po_rel_action`)
) ";
sql_query($sql, false);

// 30�� ������ ����Ʈ������ �����ϱ� ������ lock�� ���� �ʾƵ� �˴ϴ�.
// ���̺� ���� �ɰ� 
//$sql = " LOCK TABLES $g4[member_table] WRITE, $g4[point_table] WRITE ";
//sql_query($sql);

// ������ ȸ������� ����� (������ ������ ���� ȸ������ ������ �ϵ��� ����)
$sql = " SELECT mb_id, count(po_point) as cnt, sum(po_point) as po_sum
           FROM $g4[point_table] 
          WHERE po_datetime < '{$clear_datetime}'
          GROUP BY mb_id
         HAVING cnt > {$max_count}+1
          ORDER BY cnt desc ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++)
{
    // õ���� �Ǹ� break;
    if ($i >= $max_mb_num) 
        break;

    // ó���� �Ǽ��� �������� ������ ��� �Ǽ����� $max-count�� �� ��
    $count = $row['cnt'] - $max_count;

    // �հ�� ��ü�Ǽ��� ���� ���̹Ƿ� $max_count�� ���� �հ�� ������ ���� �մϴ�.
    // select sum(po_point) ... limit 1, 30�� �ǹ̴� 
    // select �� ��� ���� return���� select ��ü�� limit�� �ƴϱ� ��������(��Ƴ���? ����)
    $total = $row['po_sum'];
    
    $sql2 = " select po_id, po_point
                from $g4[point_table] 
               where mb_id = '$row[mb_id]' and po_datetime < '{$clear_datetime}'
               order by po_id desc 
               limit 1, $max_count ";
    $result2 = sql_query($sql2);
    $max_sum = 0;
    for ($k=0; $row2=sql_fetch_array($result2); $k++)
    {
        $max_sum += $row2['po_point'];
    }
    $total = $total - $max_sum;
    
    $sql3 = " INSERT INTO $g4[point_table]_backup 
              SELECT * FROM $g4[point_table] WHERE mb_id = '$row[mb_id]' and po_datetime < '{$clear_datetime}'
               order by po_id desc 
               limit $max_count, $row[cnt] ";
    $result3 = sql_query($sql3, false);
    
    $sql4 = " DELETE FROM $g4[point_table] 
               WHERE mb_id = '$row[mb_id]' and po_datetime < '{$clear_datetime}'
               order by po_id asc 
               limit $count";
    $result4 = sql_query($sql4);
    
    insert_point($row[mb_id], $total, "{$clear_datetime} ���������� ����Ʈ {$count}�� ����", "@clear", $row[mb_id], $g4[time_ymd]."-".uniqid(""));

    $str = $row[mb_id]."�� ����Ʈ ���� ".number_format($count)."�� ".number_format($total)."�� ����<br>";
    echo "<script>document.getElementById('ct').innerHTML += '$str';</script>\n";
    flush();
}

// ���̺� ���� Ǯ��
//$sql = " UNLOCK TABLES ";
//sql_query($sql);

echo "<script>document.getElementById('ct').innerHTML += '<p>�� ".$i."���� ȸ������Ʈ ������ ���� �Ǿ����ϴ�.';</script>\n";
echo "<script>document.getElementById('ct').innerHTML += '<a href=\'" . $g4[admin_path] . "/point_list.php\'>����Ʈ������ �̵��ϱ�</a>'</script>\n";
?>
