<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ����/������ bo_sex �ʵ忡 M/F�� ��ϵ� ��쿡�� �Խ����� ������ ���
check_bo_sex();

// �Ϻ� �۾��� ���� - a�ϵ��� bȸ �̻� �۾��⸦ �����մϴ�. a,b|c,d �� ���� �Է����ּ���
$bo_day_nowrite = $board[bo_day_nowrite];

if ($w=="" && !$is_admin && $bo_day_nowrite) {

     // �Խ��� ���̺� ��ü�̸�
    $tmp_write_table = $g4['write_prefix'] . $bo_table;

    // ����� ���̵�
    $mb_id = $member[mb_id];

    // $bo_day_nowrite�� explode �մϴ�.
    $day_array = explode("|", trim($bo_day_nowrite));
    foreach ($day_array as $key => $val) {
        $res = explode(",", trim($val));
        if ($res) {
            $day2_days[$res[0]] = $res[0];
            $day2_count[$res[1]] = $res[1];
        }
    }

    // �迭�� �����ϱ� (days �� ��������)
    array_multisort($day2_days, $day2_count);

    // �Էµ� �迭�� ����
    $day_array_count = count($day2_count);

    // �ִ볯¥
    $max_days = $day2_days[$day_array_count-1];

    // sort�Ǹ鼭 ��Ʈ���� key ���� �ٽ� �������ֱ�
    for ($i=0; $i < $day_array_count; $i++) {
        $day2_days2[$day2_days[$i]] = $day2_days[$i];
        $day2_count2[$day2_days[$i]] = $day2_count[$i];
    }

    // �۾��� ���ѿ� �ɸ����� Ȯ���� ���ϴ�.
    $sql = " SELECT to_days(now())-to_days(wr_datetime) AS t_diff, count( * ) AS cnt, date_format( wr_datetime, '%Y-%m-%d' ) 
               FROM `$tmp_write_table` 
              WHERE mb_id = '$mb_id' 
                AND wr_is_comment = '0'
                AND wr_reply = ''
                AND (to_days(now())-to_days(wr_datetime)-$max_days) < 0
              GROUP BY t_diff
          ";
    $result = sql_query($sql);

    if ($result && mysql_num_rows($result)) {
        // ������� �迭�� �ֽ��ϴ�
        for($i=0; $row = sql_fetch_array($result); $i++) {
            $day_result[$row[t_diff]] = $row[cnt];
        }
    
        // ������ �����ϴ��� check
        $sum = 0;
        for($i=0; $i <= $max_days; $i++) {
            $sum += $day_result[$i];
            if ($day2_days2[$i] && $day2_count2[$i] && $sum >= $day2_count2[$i]) {
                alert("{$i}�Ͽ� $day2_count2[$i]�� �̻��� ���� �ۼ��� �� �����ϴ�. ��ڿ��� ���� �Ͻñ� �ٶ��ϴ�.");
            }
        }
    }
}
?>
