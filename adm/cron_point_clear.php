#!/usr/local/php/bin/php
<?php
// �� ���α׷��� cron���� ����Ʈ ������ �ϱ� ���� ���� ���α׷� �Դϴ�.
// cron�� ���� ������ �Ǵ� cron �۾��� ���� ����ڿ��Ը� �����մϴ�.

// cron������ ������� ���α׷� ��θ� �� �� ���� ������, $g4[path]�� �ݵ�� ���� ��η� ��������� �մϴ�.
// �Ʒ��� $g4[path]�� �ݵ�� �����ؼ� ����Ͻñ� �ٶ��ϴ�.
$g4[path] = "/home/opencode/public_html";

include_once("$g4[path]/lib/constant.php");
include_once("$g4[path]/config.php");
include_once("$g4[path]/lib/common.lib.php");

$dbconfig_file = "dbconfig.php";
include_once("$g4[path]/$dbconfig_file");
$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
$select_db = sql_select_db($mysql_db, $connect_db);
if (!$select_db)
    die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script language='JavaScript'> alert('DB ���ӿ���'); </script>");

// config ������ �о���� �մϴ�. common.php�� ������ϴϱ��
$config = " select * from $g4[config_file] ";

//-------------- �Ʒ��κ��� point_clear.php���� ������ �� �Դϴ� -----------------------

// ����Ʈ�� n�� �̻��� ȸ���� ���ؼ��� point�� clear �մϴ�.
$max_count = 8;
// ������� m�� ������ ����Ʈ�� ���ؼ��� point�� clear �մϴ�.
$clear_days = 30;
$clear_datetime = date("Y-m-d H:i:s", $g4[server_time] - (86400 * $clear_days));
// �ѹ��� ������ ȸ���� ����
$max_mb_num = 1000;

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
    //echo "<script>document.getElementById('ct').innerHTML += '$str';</script>\n";
    //flush();
    echo $str;
}

//---------------
?> 
