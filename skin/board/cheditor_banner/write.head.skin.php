<? 
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

if ($w == "") {

    // ����Ʈ����
    if ($bo_table == "2showup_ship") {
        $wr_point = 1000;
        $wr_days = 999999;
    } else {
        $wr_point = 5000;
        $wr_days = 30;
    }

    if (!$is_admin && $wr_point > $member[mb_point])
        alert("�� �Խ����� $wr_point ����Ʈ �̻��� ȸ���� �۾��Ⱑ ���� �մϴ�.\\n\\n");

    // �۾��� �ϼ� ����
    $tmp_write_table = $g4['write_prefix'] . $bo_table; // �Խ��� ���̺� ��ü�̸�
    $sql = " select count(*) as cnt from $tmp_write_table where mb_id = '$member[mb_id]' and wr_datetime >= date_sub(now(), interval $wr_days day) ";
    $result = sql_fetch($sql);
    if (!$is_admin && $result[cnt] > 0)
        alert("�� �Խ����� ���ۼ� �� $wr_days ���� ����� �Ŀ� �۾��Ⱑ ���� �մϴ�.\\n\\n");
}
?>
